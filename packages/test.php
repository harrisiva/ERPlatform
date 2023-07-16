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
$handler = new Supplier($host, $name, $username, $password);


echo "Working <br>";
$field = "address";
$search = "789 Park Ave";
$response = $handler->searchSuppliers($field, $search);
echo "Response Retrived: <br>";
echo var_dump($response)

?>