<?php
    declare(strict_types=1);
    require "../packages/db.php";
    require "../templates/header.php";

    if (isset($_SESSION["userid"])) {
?>

<body>
    <div class="container">
        <h1>Products</h1>
        <a href="#" class="card-link">Create |</a>
        <a href="#" class="card-link">Read |</a>
        <a href="#" class="card-link">Update |</a>
        <a href="#" class="card-link">Delete</a>
        <br>

        <?php
            $handler = new Products();
            $response = $handler->readProducts();
        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Status</th>
                    <th scope="col">Supplier ID</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    foreach ($response as $key => $value) {
                        echo '<tr>';
                        echo '<th scope="row">'.$value["productID"].'</th>';
                        echo '<td>'.$value["productName"].'</td>';
                        echo'<td>'.$value["description"].'</td>';
                        echo'<td>'.$value["price"].'</td>';
                        echo'<td>'.$value["quantity"].'</td>';
                        echo'<td>'.$value["status"].'</td>';
                        echo'<td>'.$value["supplierID"].'</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
            
        </div>

</body>

<?php 
} else {?>

<body>
    <div class="container">
        <h1>Please login first!</h1>
    </div>
</body>

<?php } ?>