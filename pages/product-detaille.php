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
  <div class="container">
    <div class="product">
        <div class="image">
          <?php echo '<p class="titel-top titel">'. $productdetaille['Titel'] .'</p> '?> 

          <?php echo '<img  src="../images/alle_produkte/' . $productdetaille['Dateiname'] . '" alt="' . $productdetaille['Titel'] . '">';?>
        </div>       
        <div class="product-info">
            <H2 class="donne-green">Preis</H2>
            <?php echo '<H1 class="product-donne">'. $productdetaille['Preis'] .' € </H1> '?> 
            <H2 class="donne-green">Versand</H2>
            <?php echo '<H1 class="product-donne"> Lieferung bis '.$lieferzeit.' </H1> '?> 
            <H2 class="donne-green">Lagerbestand</H2>
            <?php echo $lagerbestand ?> 
            <button src ="#" class="button-kaufen donne">Kaufen</button>

        </div>
    </div>  

  </div>    
  <?php }?>
  <p class="header titel">Ähnliche Suchvorschläge</p>
  <div class="similar-products" >
        <?php
            // Afficher les produits
           /* while ($row = $result_vorschlage->fetch_assoc()) {
                
                  echo '<a href="product-detaille.php?productdetaille='.$row['ProduktID'].'" >';
                  echo '<div class="product-card">';
            
                // Vérifier si le stock est égal à zéro
                if ($row['Lagerbestand'] !== 0) {
                  echo '<div class="product-info">';
                  echo '<H1 class="product-title">' . $row['Titel'] . '</H1>';
                  echo '<H2 class="donne-green product-price">' . $row['Preis'] . ' €</H2>';
                  echo '</div>';
                  echo '<div class="product-img">';
                  echo '<img class="product-image" src="../images/alle_produkte/' . $row['Dateiname'] . '" alt="' . $row['Titel'] . '">';
                  echo '</div>';

                } 
                echo '</div>';
                echo '<a/>';

            }*/
        ?>
  </div>

 
</body>
</html>


