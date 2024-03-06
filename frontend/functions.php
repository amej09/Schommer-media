<?php
// Connectez-vous à votre base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db-schommer";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Récupérer les paramètres de filtrage depuis la requête GET
$searchQuery = $_GET['search'];
$selectedCategories = explode(',', $_GET['categories']);
$selectedPrice = $_GET['price'];

// Construire la requête SQL pour récupérer les produits filtrés
// Adapté en fonction de votre structure de base de données et de votre logique de filtrage

$sql = "SELECT * FROM Produkte WHERE Titel LIKE '%$searchQuery%'";

if (!empty($selectedCategories)) {
    $sql .= " AND KategorieID IN (" . implode(',', $selectedCategories) . ")";
}

if ($selectedPrice == 1) {
    $sql .= " AND Preis <= 50";
} elseif ($selectedPrice == 2) {
    $sql .= " AND Preis BETWEEN 50 AND 100";
} elseif ($selectedPrice == 3) {
    $sql .= " AND Preis BETWEEN 100 AND 200";
} elseif ($selectedPrice == 4) {
    $sql .= " AND Preis >= 200";
}

// Exécuter la requête et renvoyer les résultats au format JSON
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();

// Renvoyer les résultats au format JSON
echo json_encode($products);
?>
