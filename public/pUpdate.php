<?php
    declare(strict_types=1);
    // import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";

    if (isset($_SESSION["userid"])) {
?>

<div class="container mt-5">
    <h1 class="mb-3">Products - Update</h1>
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
            // create new object instance
            $handler = new Products();  
            $id = test_input($_POST["id"]);
            $name = test_input($_POST["productName"]);
            $desc = test_input($_POST["description"]);
            $price = test_input($_POST["price"]);
            $quant = test_input($_POST["quantity"]);
            $status = test_input($_POST["status"]);
            // $sID = test_input($_POST["supplierID"]);

            $data = array(
                'productName' => $name,
                'description' => $desc,
                'price' => $price,
                'quantity' => $quant,                
                'status' => $status,
                // 'supplierID' => $sID,
                'id' => $id
            );
            $bool = $handler->updateSupplier($data);
        }
         

        
        
    }
?>

<!-- Update Form -->
<div class="container mt-5">
    <!-- action section ensures hackers can't access it -->
    <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form-group" method = "post" id = "update-form2">
        <p><span class="text-danger">* required fields</span></p>
        <br>

    <!-- ID field - what update is based on  -->
      <div>
        <label for="id">ID to Update:</label>
        <span class="text-danger">* <?php echo $idErr;?></span> <!-- shows field is required and spits out error if not filled -->
        <input type="id" class="form-control" id="id" name = "id" placeholder="Enter ID to Update">
      </div>
      <br>

      <!-- product name field -->
      <div>
        <label for="productName">New Name:</label>
        <input type="name" class="form-control" id="productName" name = "productName" placeholder="Enter a product name to Update">
      </div>
      <br>
      <!-- product desc field -->
      <div>
        <label for="description">New Description:</label>
        <input type="text" class="form-control" id="description" name = "description" placeholder="Enter a desription to Update">
      </div>
      <br>
      <!-- product price field -->
      <div>
        <label for="price"> New Price:</label>
        <input type="text" class="form-control" id="price" name = "price" placeholder="Enter a price to Update">
      </div>
      <br>
      <!-- product quant field -->
      <div>
        <label for="quantity">New Quantity:</label>
        <input type="text" class="form-control" id="quantity" name = "quantity" placeholder="Enter a quantity to Update">
      </div>
      <br>
      <!-- product status field -->
      <div>
        <label for="status">New Status:</label>
        <input type="text" class="form-control" id="status" name = "status" placeholder="Enter a status to Update">
      </div>
      <br>
      <!-- supplier ID field -->
      <!-- <div>
        <label for="supplierID">New Supplier ID:</label>
        <input type="text" class="form-control" id="supplierID" name = "supplierID" placeholder="Enter a supplier ID to Update">
      </div>
      <br> -->
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