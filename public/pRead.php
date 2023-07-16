<?php
    declare(strict_types=1);
    require "../packages/db.php";
    require "../templates/header.php";
?>
<link rel="stylesheet" type="text/css" href="../styles/styles.css">

<!-- creating tables with column names -->
<table>
    <tr>
    <th class = spacing>Product ID  </th>
    <th class = spacing>Product Name  </th>
    <th class = spacing>Description  </th>
    <th class = spacing>Price  </th>
    <th class = spacing>Quantity  </th>
    <th class = spacing>Status  </th>
    <th class = spacing>Supplier ID  </th>
    </tr> 

<?php 
    // Load ENV variables and setup the required info for establishing a DB connection
    $host = 'mydb.cbbhaex7aera.us-east-2.rds.amazonaws.com';
    $name = 'CP476_Project';
    // $username = $_ENV['php_db_username'];
    // $password = $_ENV['php_db_username'];
    $username = 'admin';
    $password = 'cp476-%uni';
    $handler = new Products($host, $name, $username, $password);
    $rValues = $handler->readProducts();

    foreach ($rValues as $row){
        echo '<tr>';
        foreach ($row as $column=>$value){
            echo "<td class = spacing>".$value.'</td>';
        }
        echo '</tr>';
   }
?>
</table>

<?php require "../templates/footer.php"; ?>
