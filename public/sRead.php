<?php
    declare(strict_types=1);
    require "../packages/db.php";
    require "../templates/header.php";
?>
<?php
    function read ($conn){
        // prepared SQL statement
        $stmt =$conn->prepare("SELECT * FROM supplier");
        $stmt->execute();

        // creating tables with column names
        echo "<table class = readTable>";
        echo "<tr>";
        echo "<th class = spacing>Supplier ID  </th>";
        echo "<th class = spacing>Supplier Name  </th>";
        echo "<th class = spacing>Address  </th>";
        echo "<th class = spacing>Phone  </th>";
        echo "<th class = spacing>Email  </th>";
        echo "</tr>";

        // fetches all sql entries in supplier table as rows
        while ($read = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td class = spacing>" . $read['supplierID'] . "</td>";
            echo "<td class = spacing>" . $read['supplierName'] . "</td>";
            echo "<td class = spacing>" . $read['address'] . "</td>";
            echo "<td class = spacing>" . $read['phone'] . "</td>";
            echo "<td class = spacing>" . $read['email'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        $conn = null;
    };

    // calling read function
    read($conn);

    require "../templates/footer.php";

?>
<style>
/* .readTable{
    border: 1px solid black;
    margin-left: 1px;
} */
.spacing{
    
    padding-right:25px;
    /* border: 1px solid black; */
}
</style>