<!-- driver/test code -->
<?php 

include "db.php";
include "queries.php";


$handler = new Supplier();

echo "Working <br>";
$field = "address";
$search = "789 Park Ave";
$response = $handler->search($field, $search);
echo "Response Retrived: <br>";
echo var_dump($response)

?>