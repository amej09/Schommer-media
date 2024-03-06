<?php 

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