<?php
    declare(strict_types=1);
    //import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";

?>


<!--when sublmit is clicked, the form data is sent for processing to a PHP file defined in action-->
<form action="" method="post">
    Supplier ID: <input type="text" name="supplierID"> <br>
    Supplier Name: <input type ="text" name = "supp_name"> <br>
    Address: <input type = "text" name = "add"> <br>
    Phone: <input type = "text" name = "phone"> <br>
    Email: <input type = "text" name = "email"> <br> <br>
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
    $supplierID = $_POST['supplierID'];
    $supplierName = $_POST['supp_name'];
    $address = $_POST['add'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $data = array($supplierID, $supplierName, $address, $phone, $email);

    $handler = new Supplier($host, $name, $username, $password);
    $success = $handler->insertSupplier($data);
    if ($success == 1){
        echo ("Insert completed");
    }
    else{
        echo ("Insert incompleted. Please try again");
    }

}
    
require "../templates/footer.php";
?>