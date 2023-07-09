<?php
    declare(strict_types=1);
    // import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";
    
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

    require "../templates/footer.php";
?>

<!-- <div class="container">
        <table class="table-striped">
            <tr>
                <td>John</td>
                <td>Doe</td>
                <td>john@example.com</td>
            <tr>
            <tr>
                <td>Mary</td>
                <td>Moe</td>
                <td>mary@example.com</td>
            </tr>
            <tr>
                <td>July</td>
                <td>Dooley</td>
                <td>july@example.com</td>
            </tr>
        </table>
</div> -->