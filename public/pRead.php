<?php
    declare(strict_types=1);
    // import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";

    if (isset($_SESSION["userid"])) {
?>
<div class="container mt-5">
    <h1 class="mb-3">Products - Filtered Read</h1>
</div>

<?php
    // cleans user input 
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // create new object instance
    $handler = new Products();

    // define variables 
    $entryErr = "";
    $search = $field = $rValues = "";
 
    // error validation of form
        // if the user has not entered anything, will display error. 
        // Otherwise it will capsulate answers and object will create search query
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (empty($_POST["pEntry"])) {
            $entryErr = "Entry is required";

        } else {
            $search = test_input($_POST["pEntry"]);
            $field = test_input($_POST["pField"]);
            $rValues = $handler->searchProducts($field,$search); 
            if (!(isset( $rValues[0] ) && is_array($rValues[0]))) {$rValues = array($rValues);}   
        }
    }     
?>

<!-- Search Form -->
<div class="container mt-5">
    <!-- action section ensures hackers can't access it -->
    <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form-group" method = "post" id = "search-form">
        <p><span class="text-danger">* required field</span></p>

    <!-- Entry field  -->
      <div>
        <label for="pEntry">Entry:</label>
        <span class="text-danger">* <?php echo $entryErr;?></span> <!-- shows field is required and spits out error if not filled -->
        <input type="pEntry" class="form-control" id="pEntry" name = "pEntry" placeholder="Enter what you wish to search">
      </div>
      <br>
      <!-- dropdown of mysql column names -->
      <div class="form-group">
        <label for="pField">Field:</label>
        <span class="text-danger">*</span>  <!-- shows field is required -->
        <select class="form-control" id="pField" name = "pField">
            <option value="productID">productID</option>
            <option value="productName">productName</option>
            <option value="description">description</option>
            <option value="price">price</option>
            <option value="quantity">quantity</option>
            <option value="status">status</option>
            <option value="supplierID">supplierID</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- creates and outputs bootstrap table of search query -->
<div class="container mt-5">
   <div class = "table-responsive"> 
        <table class = "table table-bordered table-striped">
            <thead>
                <tr>
<?php
        if (!empty($rValues)){
            foreach ($rValues[0] as $column=>$value){
                echo "<th>".$column."</th>";
            }
            echo "</tr> </thead>";
            foreach ($rValues as $row) {
                echo '<tr>';
                foreach ($row as $value) {
                    echo '<td>'.$value.'</td>';
                }
                echo "</tr>";
            }      
        }
        else if (empty($rValues) && !empty($search)){
            echo "No query results found";
        }
    } 
?>
</table>
</div>