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
             <div class="Preis custom-select">

                <h2 class="donne-green" >Preis</H2>
                <select name="price-filter" id="potencial" class="custom-select sources" placeholder="Preisspanne wählen"  class="donne" onchange="submit()">
                <option value="0" <?= (( $_GET['price-filter'] ?? '') == '0' ) ? "selected" :  "" ?>>Preisspanne wählen</option>
                <option value="1" <?= ( ( $_GET['price-filter'] ?? '') == '1' ) ? "selected" :  "" ?>>0 $ - 50 $</option>
                <option value="2" <?= ( ( $_GET['price-filter'] ?? '') == '2' ) ? "selected" :  "" ?>>50 $ - 100 $</option>
                <option value="3" <?= (( $_GET['price-filter'] ?? '') == '3' ) ? "selected" :  "" ?>>100 $ - 200 $</option>
                <option value="4" <?= (( $_GET['price-filter'] ?? '') == '4' ) ? "selected" :  "" ?>>200 $ und mehr</option>
            </select>
            <span class="custom-select-trigger"></span>
            </div>


        </form>
        
    </div>

    <div class="right-section">
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
                                <h2 class="out-of-stock-text">nicht mehr <br> auf Lager!</h2>
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



                $(".custom-select").each(function() {
        var classes = $(this).attr("class"),
            id = $(this).attr("id"),
            name = $(this).attr("name");
        var template = '<div class="' + classes + '">';
        template +=
            '<span class="custom-select-trigger">' +
            $(this).attr("placeholder") +
            "</span>";
        template += '<div class="custom-options">';
        $(this)
            .find("option")
            .each(function() {
            template +=
                '<span class="custom-option ' +
                $(this).attr("class") +
                '" data-value="' +
                $(this).attr("value") +
                '">' +
                $(this).html() +
                "</span>";
            });
        template += "</div></div>";

        $(this).wrap('<div class="custom-select-wrapper"></div>');
        $(this).hide();
        $(this).after(template);
        });
        $(".custom-option:first-of-type").hover(
        function() {
            $(this)
            .parents(".custom-options")
            .addClass("option-hover");
        },
        function() {
            $(this)
            .parents(".custom-options")
            .removeClass("option-hover");
        }
        );
        $(".custom-select-trigger").on("click", function() {
        $("html").one("click", function() {
            $(".custom-select").removeClass("opened");
        });
        $(this)
            .parents(".custom-select")
            .toggleClass("opened");
        event.stopPropagation();
        });
        $(".custom-option").on("click", function() {
        $(this)
            .parents(".custom-select-wrapper")
            .find("select")
            .val($(this).data("value"));
        $(this)
            .parents(".custom-options")
            .find(".custom-option")
            .removeClass("selection");
        $(this).addClass("selection");
        $(this)
            .parents(".custom-select")
            .removeClass("opened");
        $(this)
            .parents(".custom-select")
            .find(".custom-select-trigger")
            .text($(this).text());
        });

        
    </script>
</body>
</html>
