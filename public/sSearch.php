<?php
    declare(strict_types=1);
    // import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";
?>

<!-- html search form for supplier table-->
<form action="" method="POST">
    <label for="entry">Entry:</label>
    <input type="text" id="entry" name="entry" required>
    <label for="field">Field:</label>
    <select id="field" name="Field">
        <option value="supplierID">supplierID</option>
        <option value="supplierName">supplierName</option>
        <option value="address">address</option>
        <option value="phone">phone</option>
        <option value="email">email</option>
    </select>
    <input type="submit" value="Submit">
</form>


<?php
        // Load ENV variables and setup the required info for establishing a DB connection
        $host = 'mydb.cbbhaex7aera.us-east-2.rds.amazonaws.com';
        $name = 'CP476_Project';
        // $username = $_ENV['php_db_username'];
        // $password = $_ENV['php_db_username'];
        $username = 'admin';
        $password = 'cp476-%uni';
        $handler = new Supplier($host, $name, $username, $password);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $field = $_POST['Field'];
            $search = $_POST['entry'];
            // $query = "SELECT * FROM supplier WHERE $field LIKE CONCAT('%',:search,'%')";
            $rValues = $handler->searchSuppliers($field,$search);

        //    foreach ($rValues as $column=>$value){
        //         echo "<strong>".$column.":</strong> ".$value.'<br>';
        //    }

        }
        
    function read ($conn){
        
        $stmt =$conn->prepare("SELECT * FROM supplier");
        $stmt->execute();


        // fetches all sql entries in table as rows
        while ($read = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rValues = '';
            foreach ($read as $column => $value) {
                $rValues .=  $value . ", ";
            }

            echo $rValues . "<br>";
        }
        
        $conn = null;
    };
    require "../templates/footer.php";
?>

