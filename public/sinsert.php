<?php
    //import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";

?>



<div class="container mt-5">
    <h1 class="mb-3">Suppliers - Insert</h1>
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

    // run if submit button is clicked
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        if (empty($_POST["supp_id"])&& ($_POST['supp_id'] != 0)){
            $entryErr = "Please fill in required blanks";
        } else{
            // assign variables cleaned user input
            $supplierID = test_input($_POST['supp_id']);
            $supplierName = test_input($_POST['supp_name']);
            $address = test_input($_POST['add']);
            $phone = test_input($_POST['phone']);
            $email = test_input($_POST['email']);

            $data = array($supplierID, $supplierName, $address, $phone, $email);

            $handler = new Supplier();
            $success = $handler->insertSupplier($data);
    }

}
    
?>


<!-- Insert Form -->

<div class = "container mt-5">
    <form action="<?php echo htmlspecialchars ($_SERVER["PHP_SELF"]);?>" class="form-group" method="post"> 
    <p><span class="text-danger">* required field</span></p>

    <!-- Supplier ID Entry -->

    <div>
        <label for = "supp_id" > Supplier ID: </label>
        <span class="text-danger">* <?php echo $entryErr ?></span>
        <input type="number" name="supp_id" id = "supp_id" class="form-control" required> <br>
    </div>
    <br>

     <!-- Supplier Name Entry -->

     <div>
        <label for = "supp_name" > Supplier Name: </label>
        <span class="text-danger">* <?php echo $entryErr ?></span>
        <input type ="name" name = "supp_name" id="supp_name" class="form-control" required placeholder="Enter supplier name">
    </div>
    <br>

    <!-- Address Entry -->
    <div>
        <label for = "address" > Address: </label>
        <span class="text-danger">* <?php echo $entryErr ?></span>
        <input type = "address" name = "add" id = "add" class="form-control" required placeholder="Enter address"> <br>
    </div>
    <br>

    
    <!-- Phone Entry -->
    <div>
        <label for = "phone" > Phone: </label>
        <span class="text-danger">* <?php echo $entryErr ?></span>
        <input type = "phone" name = "phone" id = "phone" class="form-control" required placeholder="Enter phone number"> <br>
    </div>
    <br>

     <!-- Email Entry -->
    <div>
        <label for = "email" > Email: </label>
        <span class="text-danger">* <?php echo $entryErr ?></span>
        <input type = "email" name = "email" id = "email" class="form-control" required placeholder="Enter email"> <br>
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
