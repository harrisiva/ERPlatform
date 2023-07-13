<?php
    declare(strict_types=1);
    // import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";
?>



<?php

    function read ($conn){
        // prepared SQL statement
        $stmt =$conn->prepare("SELECT * FROM supplier");
        $stmt->execute();

        // creating tables with column names
        echo "<table>";
        echo "<tr>";
        echo "<th style = 'padding-right:25px'>Supplier ID  </th>";
        echo "<th style = 'padding-right:25px'>Supplier Name  </th>";
        echo "<th style = 'padding-right:25px'>Address  </th>";
        echo "<th style = 'padding-right:25px'>Phone  </th>";
        echo "<th style = 'padding-right:25px'>Email  </th>";
        echo "</tr>";

        // fetches all sql entries in supplier table as rows
        while ($read = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td style = 'padding-right:25px'>" . $read['supplierID'] . "</td>";
            echo "<td style = 'padding-right:25px'>" . $read['supplierName'] . "</td>";
            echo "<td style = 'padding-right:25px'>" . $read['address'] . "</td>";
            echo "<td style = 'padding-right:25px'>" . $read['phone'] . "</td>";
            echo "<td style = 'padding-right:25px'>" . $read['email'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        $conn = null;
    };

    // calling read function
    read($conn);

    require "../templates/footer.php";

?>