<?php


require 'import.php';

// Definieren Sie das Verzeichnis, in dem Sie die hochgeladenen Dateien speichern möchten
$uploadDir = 'uploads/';

// Überprüfen Sie, ob die Anfragemethode POST ist
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Überprüfen Sie, ob eine Datei hochgeladen wurde
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {

        // Verarbeiten Sie die hochgeladene Datei
        $uploadedFile = $_FILES['file'];

        // Erstellen Sie das Upload-Verzeichnis, wenn es nicht vorhanden ist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Generieren Sie einen eindeutigen Dateinamen, um das Überschreiben vorhandener Dateien zu vermeiden
        $uniqueFilename = uniqid('file_') . '_' . $uploadedFile['name'];

        // Verschieben Sie die hochgeladene Datei in das angegebene Verzeichnis
        $destination = $uploadDir . $uniqueFilename;

        if (move_uploaded_file($uploadedFile['tmp_name'], $destination)) {

            
            
            importCSV($conn, $destination);
            // Weiterleiten zu index.php

            header("Location: ../index.php");
            
            exit; 

         } else {
            // Fehler beim Verschieben der Datei
           echo ' Fehler: Die hochgeladene Datei konnte nicht verschoben werden. ';
        }
    } else {
         echo "Fehler: Bitte wählen Sie eine Datei zum Hochladen aus.";
    }
} else { 
    http_response_code(405); 
    echo 'Fehler: Bitte wählen Sie eine Datei zum Hochladen aus.';
}

?>
