<?php

include '../db.php';



// Funktion zum Importieren von Daten aus der CSV-Datei
function importCSV($conn, $file_path){
    $csv_file = fopen($file_path, 'r');

    // Verwenden Sie eine Variable, um die erste Zeile zu erkennen
    $is_first_line = true;

    if ($csv_file !== false) {
        // Dies ist eine PHP-Funktion, die eine Zeile aus einer geöffneten CSV-Datei liest und die Daten in ein Array speichert.
        while (($data = fgetcsv($csv_file, 1000, ';')) !== false) {
            $data= array_map("utf8_encode",$data);
            // Die erste Zeile ignorieren
            if ($is_first_line) {
                $is_first_line = false;
                continue;
            }

            // Fügen Sie hier die Logik zum Einfügen der Daten in die Datenbank ein
            $title = $data[0];

            // Punkt entfernen
            $prixSansPoint = str_replace('.', '', $data[1]);
            $prixSansPoint = str_replace(',', '.', $prixSansPoint);

            // In Zahl konvertieren (Kommazahl)
            $price = floatval($prixSansPoint);
            //Dies ist eine PHP-Funktion, die eine Zeichenkette (String) in eine Ganzzahl (Integer) umwandelt
            $stock = intval($data[2]);
            $delivery_time = intval($data[3]);
            $category_name = $data[4];
            $image_path = $data[5];

            // Rufen Sie die Funktion zum Hinzufügen des Produkts auf
            $category_id = addCategory($conn, $category_name);
            $product_id=addProduct($conn, $title, $price, $stock, $delivery_time, $image_path);
            addProductCategory($conn,$product_id,$category_id);
        }
        //dateizeiger schliessen
        fclose($csv_file);
    }
}

// Funktion zum Hinzufügen einer Kategorie zur Datenbank
function addCategory($conn, $categoryName) {

    // Überprüfen, ob die Kategorie bereits existiert
    $checkSql = "SELECT KategorieID FROM Kategorie WHERE KategorieName = '$categoryName'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {

        // Die Kategorie existiert bereits, gib die ID der vorhandenen Kategorie zurück
        $row = $result->fetch_assoc();
        return $row['KategorieID'];

    } else {
        // Die Kategorie existiert nicht, füge sie zur Datenbank hinzu
        $insertSql = "INSERT INTO Kategorie (KategorieName) VALUES ('$categoryName')";
        $conn->query($insertSql);
        return $conn->insert_id;
    }

}

 
// Funktion zum Hinzufügen eines Produkts zur Datenbank
function addProduct($conn, $title, $price, $stock, $deliveryTime, $image_path) {

    // Überprüfen, ob das Produkt bereits existiert
    $checkSql = "SELECT ProduktID FROM produkte WHERE Titel = '$title'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {

        // Das Produkt existiert bereits, gib die ID des vorhandenen Produkts zurück
        $row = $result->fetch_assoc();
        return $row['ProduktID'];
    } else {
            $sql = "INSERT INTO produkte(Titel, Preis, Lagerbestand, Lieferzeit, Dateiname) VALUES
            ('$title', $price, $stock, $deliveryTime, '$image_path')";
            $conn->query($sql);
            return $conn->insert_id;
    }

}

function addProductCategory($conn,$productID, $categoryID){

    $sql="INSERT INTO produktekategory(ProduktID,KategorieID) VALUES ($productID,$categoryID)";
    $conn->query($sql);

}

?>
