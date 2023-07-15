<?php
declare(strict_types=1);
require "../packages/db.php";
require "../templates/header.php";
/*
$host = 'mydb.cbbhaex7aera.us-east-2.rds.amazonaws.com';
$name = 'CP476_Project';
$username = 'admin';
$password = 'cp476-%uni';
*/

// checks to see if user entered product id to be deleted
if (isset($_POST['delete_product']))
{
    $product_id = $_POST['prodid'];
    if ($product_id){
        remove_prod($product_id, $conn);
    }
    else{
        echo('EMPTY');
    }
    
}


// checks to see if user entered supplier id to be deleted
if (isset($_POST['delete_supplier']))
{
    $supplier_id = $_POST['suppid'];
    if ($supplier_id){
        remove_supp($supplier_id, $conn);
    }
    else{
        echo('EMPTY');
    }
    
}

//user enters a product id to delete
function remove_prod ($conn, $product_id){
    try{
        $query = "DELETE FROM products where productID=: delprod_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':delprod_id',$product_id, PDO::PARAM_STR);
        $stmt->execute();

        if($stmt)
        {
            echo("Product Deleted");
        }
        else{
            echo("Product ID invalid");
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

//user enters supplier ID to delete
function remove_supp ($conn, $supplier_id){
    try{
        $query = "DELETE FROM supplier where supplierID=: delsup_id";
        $stmt = $conn -> prepare($query);
        $stmt-> bindParam(':delsup_id', $supplier_id, PDO::PARAM_STR);
        $stmt-> execute();
        
        if ($stmt){
            echo("Supplier Deleted");
            // remove products that are produced by the deleted supplier
            adjust_prod($conn, $supplier_id);
        }
        else{
            echo("Supplier ID invalid");
        }

        
    }catch (PDOException $e){
        echo $e-> getMessage();
    }

}

function adjust_prod ($conn, $supplier_id){
    try{
        $query = "DELETE FROM products where supplierID=: delsup_id";
        $stmt = $conn-> prepare($query);
        $stmt->bindParam(':delsup_id',$supplier_id, PDO::PARAM_STR);
        $stmt->execute();

        if($stmt)
        {
            echo("Products removed with recently deleted supplier");
        }
        else{
            echo("Error");
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

    
 

?>