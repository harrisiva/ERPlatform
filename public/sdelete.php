<?php
    //import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";

?>


<div class="container mt-5">
    <h1 class="mb-3">Suppliers - Delete</h1>
</div>



<?php
    
    // initialize variables
    $entryErr = $success = $supplier_id = "";
    
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        if (empty($_POST['supp_id'])){
            $entryErr = "Entry is required";
        }
        else {
            // creates new object instance
            $supplier_id = (int)$_POST['supp_id'];
            $handler = new Supplier();
            $success = $handler->deleteSuppliers($supplier_id);
    
        }
    }
    
?>

<!-- Delete Form -->

<div class = "container mt-5">

    <!--for security measures-->
    <form action="<?php echo htmlspecialchars ($_SERVER["PHP_SELF"]);?>" class="form-group" method="post"> 
    <p><span class="text-danger">* required field</span></p>

    <!-- User entry section  -->
        <div>
            <label for = "prod_id"> Supplier ID:</label>
            <span class="text-danger">* <?php echo $entryErr ?></span>
            <br> <br>
            <!-- allows users to only input numbers as product ID --> 
            <input type="number" name="supp_id" class="form-control" id="supp_id" placeholder="Enter what you wish to delete">
            <br><br>
            <button type="submit" class="btn btn-primary" name="delete_supplier"> Delete Supplier </button>

        </div>
    </form>
    
    <br>

    <?php
    if (isset($_POST['delete_supplier'])){
        echo ($success == 1) ?  ("Supplier with ID: ". $supplier_id . " deleted succesfully") : ("Delete unsuccesful. Please try again");
    }
    ?>
</div>