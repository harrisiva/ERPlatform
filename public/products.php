<?php
    declare(strict_types=1);
    // import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";
    
    // prepared SQL statement
    $stmt =$conn->prepare("SELECT * FROM product");
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

    require "../templates/footer.php";
?>