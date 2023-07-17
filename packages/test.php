<!-- driver/test code -->
<?php 

include "db.php";
include "queries.php";

//$handler = new Products($host, $name, $username, $password); // Create Products Handler (inherited from the DB Handler/PDO Wrapper)

//$products_test_data = array(
//    array(0004, 'Product', 'Another Thing', 799.9, 50, 'B', 7890),
//);
$handler = new Supplier();


echo "Working <br>";
$field = "address";
$search = "789 Park Ave";
$response = $handler->search($field, $search);
echo "Response Retrived: <br>";
echo var_dump($response)

?>