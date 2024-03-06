<?php


require 'import.php';

// Define the directory where you want to save the uploaded files
$uploadDir = 'uploads/';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file has been uploaded
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Process the uploaded file
        $uploadedFile = $_FILES['file'];

        // Create the uploads directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Generate a unique filename to avoid overwriting existing files
        $uniqueFilename = uniqid('file_') . '_' . $uploadedFile['name'];

        // Move the uploaded file to the specified directory
        $destination = $uploadDir . $uniqueFilename;
        if (move_uploaded_file($uploadedFile['tmp_name'], $destination)) {
            // Provide feedback or redirect as necessary
            
            importCSV($conn, $destination);
            // Rediriger vers index.php
            header("Location: index.php");
            exit; // Assurez-vous de terminer l'exécution du script après la redirection
            echo '<script>alert("Importation réussie!");</script>';

            //echo "File uploaded successfully! Saved as: " . $uniqueFilename;
        } else {
            // Error moving the file
            echo '<script>alert("Erreur : Impossible de déplacer le fichier téléchargé.");</script>';

            //echo "Error: Unable to move the uploaded file.";
        }
    } else {
        // No file uploaded or an error occurred
        echo "Error: Please select a file to upload.";
        echo '<script>alert("Error: Please select a file to upload.");</script>';

    }
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    //echo "Error: Invalid request method.";
    echo '<script>alert("Error: Invalid request method.");</script>';

    
}

?>
