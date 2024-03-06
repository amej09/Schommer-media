<?php
include '../db.php';
require 'functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>

    <div id="left-section">
        <h2>Moteur de Recherche</h2>
        <!-- Ajoutez ici votre formulaire de recherche -->
    </div>

    <div id="right-section">
        <h2>Liste des Produits</h2>

        <div class="product-cards">
            <?php
                // Afficher les produits
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product-card">';
                
                    // Vérifier si le stock est égal à zéro
                    if ($row['Lagerbestand'] == 0) {
                        echo '<div class="product-info">';
                        echo '<h3 class="product-title">' . $row['Titel'] . '</h3>';
                        echo '<p class="product-price">' . $row['Preis'] . ' €</p>';
                        echo '</div>';
                        echo '<div class="out-of-stock">';
                        echo '<img src="../images/alle_produkte/' . $row['Dateiname'] . '" alt="' . $row['Titel'] . '" class="out-of-stock-image">';
                        echo '</div>';
                        echo '<div class="out-of-stock-text">nicht mehr auf Lager!</div>';

                    } else {
                        echo '<div class="product-info">';
                        echo '<h3 class="product-title">' . $row['Titel'] . '</h3>';
                        echo '<p class="product-price">' . $row['Preis'] . ' €</p>';
                        echo '</div>';
                        echo '<img src="../images/alle_produkte/' . $row['Dateiname'] . '" alt="' . $row['Titel'] . '" class="product-image">';
                     
                    }
                
                    echo '</div>';
                }
           ?>
           
        </div>

        <div class="pagination-container pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <?php $activeClass = ($i == $page) ? 'active' : ''; ?>
                    <a href="?page=<?= $i; ?>" class="<?= $activeClass; ?>"><?= $i; ?></a>
                <?php endfor; ?>
        </div>
    </div>

</body>
</html>
