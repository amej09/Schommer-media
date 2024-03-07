<?php 
  // Pagination
  $limit = 6; // Nombre de produits par page
  $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
  $offset = ($page - 1) * $limit;
   
  // Requête pour récupérer les kategorys

  $sql = "SELECT * FROM kategorie  "; 
  $Allkategorys = $conn->query($sql);


    if(isset($_GET['search'] )|| isset($_GET['Kategory'])|| isset($_GET['price-filter'] )){
          $sql="SELECT DISTINCT p.* FROM produkte p  ";
         //test POST  Kategoryes
         if(isset($_GET['Kategory']) && $_GET['Kategory']!="" ){
            $kategorys=$_GET['Kategory'];
            //echo '<pre>'; print_r($kategorys); echo '</pre>';
            
            $sql.=" INNER JOIN produktekategory pk ON p.ProduktID = pk.ProduktID 
             WHERE pk.KategorieID IN (".implode(',', $kategorys).") ";
        
        }else{
            $sql .= " WHERE 1=1";
        }
        if(isset($_GET['search']) && $_GET['search']!="" ){
           
            $search=$_GET['search'];
            $sql .= " AND p.Titel Like '%$search%' "; 
           
        }
        
        if(isset($_GET['price-filter']) && $_GET['price-filter']!="" ){
            $selectedPrice=$_GET['price-filter'];

            if ($selectedPrice == 0) {
                $sql .= "";
            }
            elseif ($selectedPrice == 1) {
                $sql .= " AND p.Preis <= 50";
            } elseif ($selectedPrice == 2) {
                $sql .= " AND p.Preis BETWEEN 50 AND 100";
            } elseif ($selectedPrice == 3) {
                $sql .= " AND p.Preis BETWEEN 100 AND 200";
            } elseif ($selectedPrice == 4) {
                $sql .= " AND p.Preis >= 200";
            }
           
        }
        $sql1= $sql;
        $sql.="  LIMIT $offset, $limit ";
        $result = $conn->query($sql);
    
        $result2 = $conn->query($sql1);
    
        $totalProducts = $result2->num_rows ;
        $totalPages = ceil($totalProducts / $limit);
    }else{
        // Requête pour récupérer les produits avec pagination
        $sql = "SELECT * FROM Produkte LIMIT $offset, $limit";
        $result = $conn->query($sql);
        $sql2 = "SELECT * FROM Produkte ";
        $result2 = $conn->query($sql2);
        $totalProducts = $result2->num_rows ;
        $totalPages = ceil($totalProducts / $limit);
    }

$conn->close();

?>