<?php
include '../db.php';
require 'functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liste des Produits</title>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>

    <div class="sidebar">

        <form method="GET" id="form" name="Filter">
            <div class="icon-input">

                <input type="search" name="search"  value="<?=$_GET['search'] ?? "" ?>" placeholder="Suche.."/>
                <button type="submit" class="img-btn" onclick="submitsearch()"><img src="../images/grafiken/lupe.svg" /></button>

            </div>
             <div class="categories">
                <h3>Kategorien</h3>
                    <?php 
                    foreach ($Allkategorys as $Kat){?>
                    <label>
                    <input type="checkbox" onclick="submit()" name="Kategory[]" value="<?= $Kat['KategorieID']?>" 
                    <?=  in_array($Kat['KategorieID'] , $_GET['Kategory'] ?? [] ) ?   "checked='checked'" :  "";
                    ?> />
                    <?php echo  $Kat["KategorieName"] ?>
                    </label> <br>
                    <?php }  
                    
                    ?>
             </div>
            <select name="price-filter" onchange="submit()">
                <option value ="0" <?= (( $_GET['price-filter'] ?? '') =='0' ) ?    "selected" :  ""?>>Preisspanne wählen</option>
                <option value ="1" <?= ( ( $_GET['price-filter'] ?? '')=='1' ) ?   "selected" :  ""?>>0 $ - 50 $</option>
                <option value ="2" <?= ( ( $_GET['price-filter'] ?? '')  =='2' ) ?   "selected" :  ""?>>50 $ - 100 $</option>
                <option value ="3" <?= (( $_GET['price-filter'] ?? '') =='3' ) ?   "selected" :  ""?>>100 $ - 200 $</option>
                <option value ="4" <?= (( $_GET['price-filter'] ?? '') =='4' ) ?   "selected" :  ""?>>200 $ und mehr</option>
            </select>

        </form>
        
    </div>

    <div class="right-section">
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
                                echo '<img class="out-of-stock-image" src="../images/alle_produkte/' . $row['Dateiname'] . '" alt="' . $row['Titel'] . '">';
                            echo '</div>';
                            echo '<div class="out-of-stock-text">nicht mehr auf Lager!</div>';

                        } else {
                            echo '<div class="product-info">';
                            echo '<h3 class="product-title">' . $row['Titel'] . '</h3>';
                            echo '<p class="product-price">' . $row['Preis'] . ' €</p>';
                            echo '</div>';
                            echo '<div class="product-img">';
                            echo '<img class="product-image" src="../images/alle_produkte/' . $row['Dateiname'] . '" alt="' . $row['Titel'] . '">';
                            echo '</div>';

                            
                        }
                    
                        echo '</div>';
                    }
                ?>
            </div>


        <div class="pagination-container pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <?php $activeClass = ($i == $page) ? 'active' : ''; 
                if(isset($_GET['search']) || isset($_GET['Kategory']) ){?>

                <a  href="<?=$_SERVER['REQUEST_URI'] ?>&page=<?= $i;?>" class="<?= $activeClass; ?>"><?= $i; ?></a>
                <?php
                }else{?>
                    <a  href="?page=<?= $i;?>" class="<?= $activeClass; ?>"><?= $i; ?></a>

                <?php }
                endfor; ?>
        </div>
    </div>
    <script>
        function submitsearch(){
            var searchValue =document.getElementById('form').elements['search'].value;
            if(searchValue.trim() !== ''){
                document.getElementById('form').submit();
            }else{
                alert('Bitte geben Sie einen Suchwert ein.');
            }
        }
        function submit(){
             document.getElementById('form').submit();
            
        }
        
    </script>
</body>
</html>
