<?php
    declare(strict_types=1);
    //import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";
?>

        <!--when submit is clicked, the form data is sent for processing to a PHP file defined in action-->
        <form action ="deletecode.php" method ="post">
            Product ID: <input type="text" name="prodid">
        <button type="submit" name="delete_product"> Delete Product </button>
        </form>

        <br/><br/>

        <form action ="" method ="post">
            Supplier ID: <input type="text" name="suppid">
        <button type="submit" name="delete_supplier"> Delete Supplier </button>
        </form>





