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
    <link href="font/Montserrat/Montserrat-Regular.ttf" rel="stylesheet">
    <link href="font/Montserrat/Montserrat-Bold.ttf" rel="stylesheet">
</head>
<body>

    <div class="sidebar">

        <form method="GET" id="form" name="Filter">
            <div class="icon-input">

                <input type="search" name="search"  value="<?=$_GET['search'] ?? "" ?>" placeholder="Suche.."/>
                <button type="submit" class="img-btn" onclick="submitsearch()"><img src="../images/grafiken/lupe.svg" /></button>

            </div>
             <div class="categories">
                <H2 class="donne-green">Kategorien</H2>
                    <?php 
                    foreach ($Allkategorys as $Kat){?>
                    <label class="donne">
                    <input type="checkbox" onclick="submit()" name="Kategory[]" value="<?= $Kat['KategorieID']?>" 
                    <?=  in_array($Kat['KategorieID'] , $_GET['Kategory'] ?? [] ) ?   "checked='checked'" :  "";
                    ?> />
                    <?php echo  $Kat["KategorieName"] ?>
                    </label> <br>
                    <?php }  
                    
                    ?>
             </div>
             <div class="Preis">

                <H2 class="donne-green" >Preis</H2>
                <select name="price-filter" class="donne" onchange="submit()">
                    <option value ="0" <?= (( $_GET['price-filter'] ?? '') =='0' ) ?    "selected" :  ""?>>Preisspanne wählen</option>
                    <option value ="1" <?= ( ( $_GET['price-filter'] ?? '')=='1' ) ?   "selected" :  ""?>>0 $ - 50 $</option>
                    <option value ="2" <?= ( ( $_GET['price-filter'] ?? '')  =='2' ) ?   "selected" :  ""?>>50 $ - 100 $</option>
                    <option value ="3" <?= (( $_GET['price-filter'] ?? '') =='3' ) ?   "selected" :  ""?>>100 $ - 200 $</option>
                    <option value ="4" <?= (( $_GET['price-filter'] ?? '') =='4' ) ?   "selected" :  ""?>>200 $ und mehr</option>
                </select>
            </div>


        </form>
        
    </div>

    <div class="right-section">
                <div class="product-cards">
                <?php
                    // Afficher les produits
                    while ($row = $result->fetch_assoc()) {
                        
                         echo '<a href="product-detaille.php?productdetaille='.$row['ProduktID'].'" >';
                         echo '<div class="product-card">';
                    
                        // Vérifier si le stock est égal à zéro
                        if ($row['Lagerbestand'] == 0) {
                            echo '<div class="product-info">';
                                echo '<H1 class="product-title">' . $row['Titel'] . '</H1>';
                                echo '<H2 class="donne-green product-price">' . $row['Preis'] . ' €</H2>';
                            echo '</div>';
                            echo '<div class="out-of-stock">';
                            echo '<img  src="../images/alle_produkte/' . $row['Dateiname'] . '" alt="' . $row['Titel'] . '">';
                            echo '</div>';
                            echo '<H2 class="out-of-stock-text  ">nicht mehr </br> auf Lager!</H2>';

                        } else {
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

                    }
                ?>
            </div>


        <div class=" pagination">
            <?php
                $previousPage = ($page > 1) ? $page - 1 : 1;
                $nextPage = ($page < $totalPages) ? $page + 1 : $totalPages;
            ?>
            
            <?php if ($page > 1) : ?>
                <?php
                $previousLink = isset($_GET['search']) || isset($_GET['Kategory']) ? $_SERVER['REQUEST_URI'] . '&page=' . $previousPage : '?page=' . $previousPage;
                ?>
                <a href="<?= $previousLink; ?>"><</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <?php $activeClass = ($i == $page) ? 'active' : ''; ?>
                <?php if (isset($_GET['search']) || isset($_GET['Kategory'])) : ?>
                    <a href="<?= $_SERVER['REQUEST_URI'] ?>&page=<?= $i; ?>" class="<?= $activeClass; ?>"><?= $i; ?></a>
                <?php else : ?>
                    <a href="?page=<?= $i; ?>" class="<?= $activeClass; ?>"><?= $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($page < $totalPages) : ?>
                <?php
                $nextLink = isset($_GET['search']) || isset($_GET['Kategory']) ? $_SERVER['REQUEST_URI'] . '&page=' . $nextPage : '?page=' . $nextPage;
                ?>
                <a href="<?= $nextLink; ?>">></a>
            <?php endif; ?>


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
