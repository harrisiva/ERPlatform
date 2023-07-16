<!-- driver/test code -->
<?php 

include "db.php";
include "queries.php";

// Load ENV variables and setup the required info for establishing a DB connection
$host = 'mydb.cbbhaex7aera.us-east-2.rds.amazonaws.com';
$name = 'CP476_Project';
$username = 'admin';
$password = 'cp476-%uni';

//$handler = new Products($host, $name, $username, $password); // Create Products Handler (inherited from the DB Handler/PDO Wrapper)

//$products_test_data = array(
//    array(0004, 'Product', 'Another Thing', 799.9, 50, 'B', 7890),
//);
$handler = new Database($host, $name, $username, $password);


echo "Working <br>";

$success = $handler->single_query($create_products);
echo $success;

?>