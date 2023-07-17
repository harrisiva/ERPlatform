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
            echo "Working";
            echo var_dump($response);
        ?>

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