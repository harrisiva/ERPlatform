
<?php
    //STILL NEEDS TO BE ADJUSTED FOR SUPPLIER ONE - Work in Progress
    declare(strict_types=1);
    //import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";


?>


<!--when sublmit is clicked, the form data is sent for processing to a PHP file defined in action-->
<form action="" method="post">
    Product ID: <input type="text" name="prod_id"> <br>
    Product Name: <input type ="text" name = "prod_name"> <br>
    Description: <input type = "text" name = "desc"> <br>
    Price: <input type = "text" name = "price"> <br>
    Quantity: <input type = "text" name = "quant"> <br>
    Status: <input type = "text" name = "status"> <br>
    supplierID: <input type = "text" name = "supplierID"> <br> <br>
    <input type="submit" name ="submit" value = "Submit">
</form>

<br /><br />



<?php
// $query = "INSERT INTO product (productID, productName, description, price, quantity, status, supplierID) VALUES (:productID, :productName, :description, :price, :quantity, :status, :supplierID)";

    // Load ENV variables and setup the required info for establishing a DB connection
    $host = 'mydb.cbbhaex7aera.us-east-2.rds.amazonaws.com';
    $name = 'CP476_Project';
    $username = 'admin';
    $password = 'cp476-%uni';

    //if (isset($_POST['submit']))
//{
    if ($_SERVER['REQUEST_METHOD']=='POST'){
    $product_id = $_POST['prod_id'];
    $product_name = $_POST['prod_name'];
    $description = $_POST['desc'];
    $price = $_POST['price'];
    $quantity = $_POST['quant'];
    $status = $_POST['status'];
    $supplierID = $_POST['supplierID'];

    $data = array($product_id, $product_name, $description, $price, $quantity, $status, $supplierID);

    $handler = new Products($host, $name, $username, $password);
    $success = $handler->insertProduct($data);
    if ($success == 1){
        echo ("Insert completed");
    }
    else{
        echo ("Insert incompleted. Please try again");
    }

}
    
require "../templates/footer.php";
?>