<?php
// Connectez-vous à votre base de données et effectuez la requête pour récupérer les produits
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db-schommer";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion à la base de données
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Pagination
$limit = 6; // Nombre de produits par page
$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Requête pour récupérer les produits avec pagination
$sql = "SELECT * FROM Produkte LIMIT $offset, $limit";
$result = $conn->query($sql);

// Récupérer le nombre total de produits pour la pagination
$totalProducts = $conn->query("SELECT COUNT(*) as total FROM Produkte")->fetch_assoc()['total'];
$totalPages = ceil($totalProducts / $limit);

// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .product-card {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            width: 200px;
            text-align: center;
            display: inline-block;
        }

        .product-card img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin-right: 5px;
        }

        .pagination a {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border-radius: 3px;
        }
    </style>
</head>
<body>

    <h2>Liste des Produits</h2>

    <?php
    // Afficher les produits
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-card">';
        echo '<h3>' . $row['Titel'] . '</h3>';
        echo '<p>Prix: ' . $row['Preis'] . ' €</p>';
        echo '<img src="../images/alle_produkte/' . $row['Dateiname'] . '" alt="' . $row['Titel'] . '">';
        echo '</div>';
    }
    ?>

    <!-- Pagination -->
    <ul class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <li><a href="?page=<?= $i; ?>"><?= $i; ?></a></li>
        <?php endfor; ?>
    </ul>

</body>
</html>
