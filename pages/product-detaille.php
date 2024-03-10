<?php
include '../db.php';
require 'functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detaille de Produit</title>
    <link rel="stylesheet" href="../css/detaille.css">
    <link href="font/Montserrat/Montserrat-Bold.ttf" rel="stylesheet">
    <link href="font/Montserrat/Montserrat-Regular.ttf" rel="stylesheet">

</head>
<body>

  <div class="header donne"><a href="index.php" > < zurück</a></div>
  <?php 
    if(isset($_GET['productdetaille']) && $_GET['productdetaille']!="" ){
    ?>
  <div class="container-text" >
      <?php echo '<p class="titel-top titel">'. $productdetaille['Titel'] .'</p> '?> 
  </div> 

  <div class="container product">
          <div class="image zoom">
          
          <img src="../images/alle_produkte/<?php echo $productdetaille['Dateiname']; ?>" alt="<?php echo $productdetaille['Titel']; ?>">          </div>       
          <div class="product-info">
          <p class="titel-product titel"><?php echo $productdetaille['Titel']; ?></p>

          <h2 class="donne-green">Preis</h2>
          <h1 class="product-donne"><?php echo $productdetaille['Preis']; ?> €</h1>
          <h2 class="donne-green">Versand</h2>
          <h1 class="product-donne">Lieferung bis <?php echo $lieferzeit; ?></h1>
          <h2 class="donne-green">Lagerbestand</h2>
          <?php echo $lagerbestand; ?>
          <button class="button-kaufen donne">Kaufen</button>

        </div>
 
  </div>    
  <?php }?>
  <p class="similar-products-title titel">Ähnliche Suchvorschläge</p>
  <div class="similar-products" >
      <?php
          // Afficher les produits
          while ($row = $result_similair->fetch_assoc()) { ?>
              
              <a href="product-detaille.php?productdetaille=<?php echo $row['ProduktID']; ?>">
              <div class="product-card-similar">
                  
                  <div class="product-info-similar">
                      <h1 class="product-donne"><?php echo $row['Titel']; ?></h1>
                      <h2 class="donne-green product-price"><?php echo $row['Preis']; ?> €</h2>
                  </div>
                  <div class="product-img-similar zoom">
                      <img  src="../images/alle_produkte/<?php echo $row['Dateiname']; ?>" alt="<?php echo $row['Titel']; ?>">
                  </div>
              
              </div>
          </a>
          <?php }
      ?>
  </div>

 
</body>
</html>


