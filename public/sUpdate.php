<?php
    declare(strict_types=1);
    // import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";

    if (isset($_SESSION["userid"])) {
?>

<!-- title -->
<div class="container mt-5">
    <h1 class="mb-3">Suppliers - Update</h1>
</div>

<?php
    // cleans user input 
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // define variables
    $idErr = $bool = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (empty($_POST["id"])) {
            $idErr = "ID is required";
        } else {
            // create new object instance and saving user input in variables
            $handler = new Supplier();  
            $id = test_input($_POST["id"]);
            $name = test_input($_POST["supplierName"]);
            $add = test_input($_POST["sAddress"]);
            $phone = test_input($_POST["sPhone"]);
            $email = test_input($_POST["sEmail"]);

            $data = array(
                'supplierName' => $name,
                'address' => $add,
                'phone' => $phone,
                'email' => $email,
                'id' => $id
            );
            $bool = $handler->updateSupplier($data);
        }
         

        
        
    }
?>

<!-- Update Form -->
<div class="container mt-5">
    <!-- action section ensures hackers can't access it -->
    <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form-group" method = "post" id = "update-form">
        <p><span class="text-danger">* required fields</span></p>
        <br>

    <!-- ID field - what update is based on  -->
      <div>
        <label for="id">ID to Update:</label>
        <span class="text-danger">* <?php echo $idErr;?></span> <!-- shows field is required and spits out error if not filled -->
        <input type="id" class="form-control" id="id" name = "id" placeholder="Enter ID to Update">
      </div>
      <br>

      <!-- supplier name field -->
      <div>
        <label for="supplierName">New Name:</label>
        
        <input type="name" class="form-control" id="supplierName" name = "supplierName" placeholder="Enter supplier name to Update">
      </div>
      <br>
      <!-- supplier address field -->
      <div>
        <label for="sAddress">New Address:</label>
       
        <input type="address" class="form-control" id="sAddress" name = "sAddress" placeholder="Enter address to Update">
      </div>
      <br>
      <!-- supplier phone field -->
      <div>
        <label for="sPhone"> New Phone Number:</label>
        
        <input type="phone" class="form-control" id="sPhone" name = "sPhone" placeholder="Enter phone to Update">
      </div>
      <br>
      <!-- supplier email field -->
      <div>
        <label for="sEmail">New Email:</label>
        
        <input type="email" class="form-control" id="sEmail" name = "sEmail" placeholder="Enter email to Update">
      </div>
      <br>
      <!-- submit button -->
      <button type="submit" class="btn btn-primary" name = "submit-update">Submit</button>
    </form>
</div>

<div class="container mt-5">
<?php
    if (isset($_POST['submit-update'])){
        if ($bool) { echo "<p>Successful. View database or main supplier page to see updates</p>";}
        else {echo "<p>Unsuccessful Update </p>";};
    }
}?>
</div>