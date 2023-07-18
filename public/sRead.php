<?php
    declare(strict_types=1);
    // import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";

    if (isset($_SESSION["userid"])) {
?>

<div class="container mt-5">
    <h1 class="mb-3">Suppliers - Filtered Read</h1>
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
    $handler = new Supplier();

    // define variables 
    $entryErr = "";
    $search = $field = $rValues = "";
 
    // error validation of form
        // if the user has not entered anything, will display error. 
        // Otherwise it will capsulate answers and object will create search query
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (empty($_POST["sEntry"])) {
            $entryErr = "Entry is required";

        } else {
            $search = test_input($_POST["sEntry"]);
            $field = $_POST["sField"];
            $rValues = $handler->search($field,$search); 
            if (!(isset( $rValues[0] ) && is_array($rValues[0]))) {$rValues = array($rValues);}   
        }
    }     
?>

<!-- Search Form -->
<div class="container mt-5">
    <!-- action section ensures hackers can't access it -->
    <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form-group" method = "post" id = "search-form2">
        <p><span class="text-danger">* required field</span></p>

    <!-- Entry field  -->
      <div>
        <label for="sEntry">Entry:</label>
        <span class="text-danger">* <?php echo $entryErr;?></span> <!-- shows field is required and spits out error if not filled -->
        <input type="sEntry" class="form-control" id="sEntry" name = "sEntry" placeholder="Enter what you wish to search">
      </div>
      <br>
      <!-- dropdown of mysql column names -->
      <div class="form-group">
        <label for="sField">Field:</label>
        <span class="text-danger">*</span>  <!-- shows field is required -->
        <select class="form-control" id="sField" name = "sField">
            <option value="supplierID">supplierID</option>
            <option value="supplierName">supplierName</option>
            <option value="address">address</option>
            <option value="phone">phone</option>
            <option value="email">email</option>
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
            
        } else if (empty($rValues) && !empty($search)){
            echo "No query results found";
        }
    } 
?>
</table>
</div>