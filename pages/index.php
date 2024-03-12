<?php

include '../db.php';
require 'functions.php';
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Produktliste</title>
    <link rel="stylesheet" href="../css/style.css">
    
</head>
 
<body>
    <div class="sidebar">

        <form method="GET" id="form" name="Filter">
            <div class="icon-input">

                <input type="search" class="search" name="search"  value="<?=$_GET['search'] ?? "" ?>" placeholder="Suche.."/>
                <button type="submit" class="img-btn" onclick="submitsearch()"><img src="../images/grafiken/lupe.svg" /></button>

            </div>
             <div class="categories">
                <h2 class="donne-green">Kategorien</h2>
                <?php foreach ($Allkategorys as $Kat) { ?>
                    <div class="checkbox-custom">
                        <input type="checkbox" id="myCheckbox<?= $Kat['KategorieID'] ?>" onclick="submit()" name="Kategory[]" value="<?= $Kat['KategorieID'] ?>"
                            <?= in_array($Kat['KategorieID'], $_GET['Kategory'] ?? []) ? "checked='checked'" : ""; ?> />
                        <label class="donne" for="myCheckbox<?= $Kat['KategorieID'] ?>">
                            <!-- Icône par défaut -->
                            <img src="../images/grafiken/button_inaktiv.svg" alt="Icône par défaut" class="icon" />
                            <span class="category-name"><?php echo $Kat['KategorieName'] ?></span>
                        </label>
                    </div>
                <?php } ?>


             </div>
         
            <div class="dropdown Preis">
            <h2 class="donne-green">Preis</h2>

            <button class="dropbtn">Preisspanne wählen 
            <span><img id="arrow" class="flip" src="../images/grafiken/pfeil.png" /></span></button>
            <div class="dropdown-content donne">
                
                <input type="hidden" value="0" name="price-filter"/>
                <a  onclick="price_filter(0)" >Preisspanne wählen</a>
                <a  onclick="price_filter(1)" >0 $ - 50 $</a>
                <a  onclick="price_filter(2)" >50 $ - 100 $</a>
                <a  onclick="price_filter(3)" >100 $ - 200 $</a>
                <a  onclick="price_filter(4)" >200 $ und mehr</a>
              
            </div>
            </div>
                  
            
        </form>
        
    </div>

    <div class="right-section">
        <?php  if($result->num_rows == 0){?>
         <div class="notfound " >Nicht gefundene Produkte</div>    
        <?php }?> 
            <div class="product-cards">
            <?php
                // Afficher les produits
                while ($row = $result->fetch_assoc()) { ?>
                    
                    <a href="product-detaille.php?productdetaille=<?php echo $row['ProduktID']; ?>">
                    <div class="product-card">
                        <?php if ($row['Lagerbestand'] == 0){ ?>
                            <div class="product-info">
                                <h1 class="product-title"><?php echo $row['Titel']; ?></h1>
                                <h2 class="donne-green product-price"><?php echo $row['Preis']; ?> €</h2>
                            </div>
                            <div class="out-of-stock zoom">
                                <img src="../images/alle_produkte/<?php echo $row['Dateiname']; ?>" alt="<?php echo $row['Titel']; ?>">
                            </div>
                            <h2 class="out-of-stock-text">ausverkauft</h2>
                        <?php }else {?>
                            <div class="product-info">
                                <h1 class="product-title"><?php echo $row['Titel']; ?></h1>
                                <h2 class="donne-green product-price"><?php echo $row['Preis']; ?> €</h2>
                            </div>
                            <div class="product-img zoom">
                                <img class="product-image" src="../images/alle_produkte/<?php echo $row['Dateiname']; ?>" alt="<?php echo $row['Titel']; ?>">
                            </div>
                        <?php }?>
                    </div>
                </a>
                <?php }


            ?>
            </div>
            <div class=" pagination ">
                <?php
                    $previousPage = ($page > 1) ? $page - 1 : 1;
                    $nextPage = ($page < $totalPages) ? $page + 1 : $totalPages;
                ?>
                
                <?php if ($page > 1) : ?>
                    <?php
                
                $previousLink = isset($_GET['search']) || isset($_GET['Kategory']) ? $_SERVER['REQUEST_URI'] . '&page=' . $previousPage : '?page=' . $previousPage;        
                    ?>
                    <a href="<?= $previousLink; ?>"><<</a>
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
                    <a href="<?= $nextLink; ?>">>></a>
                <?php endif; ?>


            </div>
    </div>
 
    <script>
       
        function price_filter(price){
            event.stopPropagation();
            document.getElementById('form').elements['price-filter'].value = price;
            document.getElementById('form').submit();


        }
            
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
