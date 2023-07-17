<?php
    declare(strict_types=1);
    // import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";
?>

<!-- html search form for product table -->
<form action="" method="POST">
    <label for="pEntry">Entry:</label>
    <input type="text" id="pEntry" name="pEntry" required>
    <label for="pField">Field:</label>
    <select id="pField" name="pField">
        <option value="productID">productID</option>
        <option value="productName">productName</option>
        <option value="description">description</option>
        <option value="price">price</option>
        <option value="quantity">quantity</option>
        <option value="status">status</option>
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
        $handler = new Products($host, $name, $username, $password);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $field = $_POST['pField'];
            $search = $_POST['pEntry'];
            // $query = "SELECT * FROM product WHERE $pField LIKE CONCAT('%',:search,'%')";
            $rValues = $handler->searchProducts($field,$search);
           foreach ($rValues as $column=>$value){
                echo "<strong>".$column.":</strong> ".$value.'<br>';
           }

        }

        require "../templates/footer.php"; 
?>