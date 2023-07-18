<?php

    declare(strict_types=1);
    //import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";

?>


<!--when sublmit is clicked, the form data is sent for processing to a PHP file defined in action-->
<form action="" method="post">
    Product ID: <input type="text" name="prod_id">
    <button type="submit" name="delete_product"> Delete Product </button>
</form>

<br /><br />


<?php

    // Load ENV variables and setup the required info for establishing a DB connection
    $host = 'mydb.cbbhaex7aera.us-east-2.rds.amazonaws.com';
    $name = 'CP476_Project';
    $username = 'admin';
    $password = 'cp476-%uni';

    if (isset($_POST['delete_product']))
{
    $product_id = (int)$_POST['prod_id'];
    if ($product_id){
        $handler = new Products($host, $name, $username, $password);
        $success = $handler->deleteProducts($product_id);
        echo ($success);
    }
    else{
        echo('Please enter a product ID to delete');
    }
    
}
    
require "../templates/footer.php";
?>