<?php
    declare(strict_types=1);
    require "../packages/db.php";
    require "../templates/header.php";
?>
<link rel="stylesheet" type="text/css" href="../styles/styles.css">
<!-- creating tables with column names -->
<table>
    <tr>
    <th class = spacing>Supplier ID  </th>
    <th class = spacing>Supplier Name  </th>
    <th class = spacing>Address  </th>
    <th class = spacing>Phone  </th>
    <th class = spacing>Email  </th>
    </tr> 

<?php
    // Load ENV variables and setup the required info for establishing a DB connection
    $host = 'mydb.cbbhaex7aera.us-east-2.rds.amazonaws.com';
    $name = 'CP476_Project';
    // $username = $_ENV['php_db_username'];
    // $password = $_ENV['php_db_username'];
    $username = 'admin';
    $password = 'cp476-%uni';
    $handler = new Supplier($host, $name, $username, $password);
    $rValues = $handler->readSuppliers();

    foreach ($rValues as $row){
        // echo $row;
        echo '<tr>';
        foreach ($row as $column=>$value){
            echo "<td class = spacing>".$value.'</td>';
        }
        echo '</tr>';
   }
?>
</table>

<?php require "../templates/footer.php"; ?>