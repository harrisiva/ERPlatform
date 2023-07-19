<?php
     //import necessary pages, packages, etc.
     require "../packages/db.php";
     require "../templates/header.php";
?>

<div class="container mt-5">
    <h1 class="mb-3">Product - Insert</h1>
</div>

<?php
    // clean user input

    function test_input ($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }


    // initialize variables
    $entryErr = $success = "";

    if ($_SERVER['REQUEST_METHOD']=='POST'){
        if (empty($_POST["prod_id"]) && ($_POST['prod_id'] != 0)){
            $entryErr = "Please fill in required blanks";
        } else{
            $product_id = test_input($_POST['prod_id']);
            $product_name = test_input($_POST['prod_name']);
            $description = test_input($_POST['desc']);
            $price = test_input($_POST['price']);
            $quantity = test_input($_POST['quant']);
            $status = test_input($_POST['status']);
            $supplierID = test_input($_POST['supp_id']);

            $data = array($product_id, $product_name, $description, $price, $quantity, $status, $supplierID);

            $handler = new Products();
            $success = $handler->insertProduct($data);
        }
        
   
}
    
?>

<!-- Insert Form -->

<div class = "container mt-5">
    <form action="<?php echo htmlspecialchars ($_SERVER["PHP_SELF"]);?>" class="form-group" method="post"> 
    <p><span class="text-danger">* required field</span></p>

    <!-- Product ID Entry -->

    <div>
        <label for = "prod_id" > Product ID: </label>
        <span class="text-danger">* <?php echo $entryErr ?></span>
        <input type="number" name="prod_id" id = "prod_id" class="form-control" required> <br>
    </div>
    <br>

     <!-- Product Name Entry -->

     <div>
        <label for = "prod_name" > Product Name: </label>
        <span class="text-danger">* <?php echo $entryErr ?></span>
        <input type ="name" name = "prod_name" id="prod_name" class="form-control" required>
    </div>
    <br>

    <!-- Product Description Entry -->
    <div>
        <label for = "description" > Description: </label>
        <span class="text-danger">* <?php echo $entryErr ?></span>
        <input type = "text" name = "desc" id = "desc" class="form-control" required> <br>
    </div>
    <br>

    <!-- Product Price Entry -->
    <div>
        <label for = "price" > Price: </label>
        <span class="text-danger">* <?php echo $entryErr ?></span>
        <input type = "number" name = "price" id = "price" class="form-control" step=".01" required> <br>
    </div>
    <br>

    <!-- Product Quantity Entry -->
    <div>
        <label for = "quantity" > Quantity: </label>
        <span class="text-danger">* <?php echo $entryErr ?></span>
        <input type = "number" name = "quant" id = "quant" class="form-control" required> <br>
    </div>
    <br>

     <!-- Product Status Entry -->
     <div>
        <label for = "status" > Status: </label>
        <span class="text-danger">* <?php echo $entryErr ?></span>
        <input type = "text" name = "status" id = "status" class="form-control" required> <br>
    </div>
    <br>

    <!--  Supplier ID Entry -->
    <div>
        <label for = "supp_id" > Supplier ID: </label>
        <span class="text-danger">* <?php echo $entryErr ?></span>
        <input type = "number" name = "supp_id" id = "supp_id" class="form-control" required> <br>
    </div>
    <br>

    <input type="submit" name ="submit" value = "Submit" class="btn btn-primary">
    </form>

    <br>

    <?php
        if (isset($_POST['submit'])){
            echo ($success == 1) ?  ("Insert succesful") : ("Insert unsuccesful. Please try again. " . $success);
        }
    ?>

    <br>
    <br>

</div>