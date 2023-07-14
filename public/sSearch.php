<?php
    declare(strict_types=1);
    // import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";
?>

<html> <!-- HS: Is this HTML tag required? -->
    <body>
        <form action="" method="post">
            ID: <input type="text" name="id"><br>
            Name: <input type="text" name="name"><br>
            Address:  <input type="text" name="address"><br>
            Phone:  <input type="text" name="phone"><br>
            Email: <input type="text" name="email"><br>
        <input type="submit">

        <br/><br/>

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

        </form>
    </body>
</html>


<?php

    function read ($conn){
        // prepared SQL statement
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

    function search($conn, $field, $search){
            $field = $_POST['Field'];
            $search = $_POST['entry'];
            $query = "SELECT * FROM supplier WHERE $field LIKE CONCAT('%',:search,'%')";
            try{
                $stmt = $conn->prepare($query);
                $stmt->bindValue(':search', '%' . $search . '%');
                $stmt->execute();
                if ($stmt->rowCount()<= 0){
                    echo "The query outputted no results";
                } else {
                    while ($read = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $rValues = '';
                        foreach ($read as $column => $value) {
                            $rValues .= "<strong>".$column . ":</strong>  " . $value . " <br>";
                        }
                
                        echo $rValues . "<br>";
                    }
            }
                $conn = null;
        } catch (PDOException $e){
            ECHO "ERROR: ". $e->getMessage();
        }
        
    };
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $field = $_POST['Field'];
        $search = $_POST['entry'];
        search($conn, $field, $search);        
    }  
    require "../templates/footer.php";
?>

