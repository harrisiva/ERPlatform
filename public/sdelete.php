<?php

    declare(strict_types=1);
    //import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";

?>


<form action="" method="post">
    Supplier ID: <input type="text" name="supp_id">
    <button type="submit" name="delete_supplier"> Delete Supplier </button>
</form>

<?php

    // Load ENV variables and setup the required info for establishing a DB connection
    $host = 'mydb.cbbhaex7aera.us-east-2.rds.amazonaws.com';
    $name = 'CP476_Project';
    $username = 'admin';
    $password = 'cp476-%uni';

    if (isset($_POST['delete_supplier']))
{
    $supplier_id = $_POST['supp_id'];
    if ($product_id){
        $handler = new Supplier($host, $name, $username, $password);
        $success = $handler->deleteSuppliers($product_id);
        echo ($success);
    }
    else{
        echo('Please enter a supplier ID to delete');
    }
    
}
    
require "../templates/footer.php";
?>