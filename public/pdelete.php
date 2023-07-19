<?php
    //import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";

?>

<div class="container mt-5">
    <h1 class="mb-3">Products - Delete</h1>
</div>

<?php

    // initalize variables
    $entryErr = $success = $product_id = "";
   
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        if (empty($_POST['prod_id'])){
            $entryErr = "Entry is required";
        }
        else {
            // creates new object instance
            $product_id = (int)$_POST['prod_id'];
            $handler = new Products();
            $success = $handler->deleteProducts($product_id);
    
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
            <label for = "prod_id"> Product ID:</label>
            <span class="text-danger">* <?php echo $entryErr ?></span>
            <br> <br>
            <!-- allows users to only input numbers as product ID --> 
            <input type="number" name="prod_id" class="form-control" id="prod_id" placeholder="Enter what you wish to delete">
            <br><br>
            <button type="submit" class="btn btn-primary" name="delete_product"> Delete Product </button>

        </div>
    </form>
    
    <br>
    <?php
    if (isset($_POST['delete_product'])){
        echo ($success == 1) ?  ("Product with ID: ". $product_id . " deleted succesfully") : ("Delete unsuccesful. Please try again");
    }
    ?>
</div>
