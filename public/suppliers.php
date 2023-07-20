<?php
    declare(strict_types=1);
    // import necessary pages, packages, etc.
    require "../packages/db.php";
    require "../templates/header.php";
    if (isset($_SESSION["userid"])) {
?>
        

<body>
    <div class="container">
        <h1>Suppliers</h1>
        <a href="sInsert.php" class="card-link">Create |</a>
        <a href="sRead.php" class="card-link">Read |</a>
        <a href="sUpdate.php" class="card-link">Update |</a>
        <a href="sdelete.php" class="card-link">Delete</a>
        <br>

        <?php
            $handler = new Supplier();
            $response = $handler->show();   
        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    foreach ($response as $key => $value) {
                        echo '<tr>';
                        echo '<th scope="row">'.$value["supplierID"].'</th>';
                        echo '<td>'.$value["supplierName"].'</td>';
                        echo'<td>'.$value["address"].'</td>';
                        echo'<td>'.$value["phone"].'</td>';
                        echo'<td>'.$value["email"].'</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
            
        </div>
    </table>

</body>

<?php } else { ?>

<body>
    <div class="container">
        <h1>Please login first!</h1>
    </div>
</body>

<?php } ?>