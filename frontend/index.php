<?php
include 'functions.php';
// Pagination
$limit = 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Requête pour récupérer les produits avec la pagination
$sql = "SELECT * FROM Produkte LIMIT $start, $limit";
$Produkte = mysqli_query($conn, $sql);

// Requête pour compter le nombre total de produits
$total_records = mysqli_query($conn, "SELECT COUNT(*) as total FROM Produkte");
$total_records = mysqli_fetch_assoc($total_records)['total'];
$total_pages = ceil($total_records / $limit);

// Récupérer les catégories depuis la base de données
$sql = "SELECT * FROM Kategorie";
$result = $conn->query($sql);

// Stocker les catégories dans un tableau
$categories = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>

</head>
<body>
    <div class="container">
        <form name="filter">
            <div class="search-filter">
                <h3>Moteur de recherche</h3>
                <input type="text" name="search" placeholder="Rechercher par titre">
                
                <h3>Catégories</h3>
                <?php
                // Afficher les catégories dans des checkboxes
                foreach ($categories as $category) {
                    echo '<label><input type="checkbox" name="category[]" value="' . $category['KategorieID'] . '">' . $category['KategorieName'] . '</label>';
                }
                ?>
                
                <h3>Prix</h3>
                <select name="price-filter">
                    <option value="1">0$ - 50$</option>
                    <option value="2">50$ - 100$</option>
                    <option value="3">100$ - 200$</option>
                    <option value="4">>= 200$</option>
                </select>
                <button type="button" onclick="filterProducts()">Filtrer</button>
            </div>
        </form>
        
        <div  class="content">
            <div class="product-list" id="product-list">
                <!-- Affichage des produits -->
                <?php while ($row = mysqli_fetch_assoc($Produkte)) : ?>
                    <div class="product-card">
                        <img src="alle_produktev/<?php echo $row['Dateiname']; ?>" alt="<?php echo $row['Titel']; ?>">
                        <h3><?php echo $row['Titel']; ?></h3>
                        <p>Prix: <?php echo $row['Preis']; ?> €</p>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
        </div>
        
    </div>

</body>

</html>
