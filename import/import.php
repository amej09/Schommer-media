<?php

// Assurez-vous d'avoir une connexion à la base de données ici*
$conn = new mysqli("localhost", "root", "", "db-schommer");

// Vérifiez la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Fonction pour ajouter une catégorie à la base de données
function addCategory($conn, $categoryName) {
    // Vérifier si la catégorie existe déjà
    $checkSql = "SELECT KategorieID FROM Kategorie WHERE KategorieName = '$categoryName'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        // La catégorie existe déjà, retourner l'ID de la catégorie existante
        $row = $result->fetch_assoc();
        return $row['KategorieID'];
    } else {
        // La catégorie n'existe pas, l'ajouter à la base de données
        $insertSql = "INSERT INTO Kategorie (KategorieName) VALUES ('$categoryName')";
        $conn->query($insertSql);
        return $conn->insert_id;
    }
}

// Fonction pour ajouter un produit à la base de données
function addProduct($conn, $title, $price, $stock, $deliveryTime, $categoryID, $image_path) {
    $sql = "INSERT INTO Produkte (Titel, Preis, Lagerbestand, Lieferzeit, KategorieID, Dateiname)
            VALUES ('$title', $price, $stock, $deliveryTime, $categoryID, '$image_path')";
    $conn->query($sql);
}

// Fonction pour importer les données du fichier CSV
function importCSV($conn, $file_path)
{
    $csv_file = fopen($file_path, 'r');

    // Utilisez une variable pour détecter la première ligne
    $is_first_line = true;

    if ($csv_file !== false) {
        while (($data = fgetcsv($csv_file, 1000, ';')) !== false) {
            // Ignorer la première ligne
            if ($is_first_line) {
                $is_first_line = false;
                continue;
            }

            // Ajoutez ici la logique pour insérer les données dans la base de données
            $title = $data[0];
            $price = floatval(str_replace('€', '', $data[1]));
            $stock = intval($data[2]);
            $delivery_time = intval($data[3]);
            $category_name = $data[4];
            $image_path = $data[5];

            // Appelez la fonction d'ajout de produit
            $category_id = addCategory($conn, $category_name);
            addProduct($conn, $title, $price, $stock, $delivery_time, $category_id, $image_path);
        }

        fclose($csv_file);
    }
}




?>
