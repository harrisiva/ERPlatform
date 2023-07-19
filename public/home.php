<?php 
    require "../templates/header.php";
    if (isset($_SESSION["userid"])) {
?>

<body>

    <div class="container">

    
        <?php 
            echo '<h1> Hi '. $_SESSION["username"] .'! Welcome Back! </h1>';
        ?>

        <div class="card text-white bg-dark mb-3" style="max-width: 50rem;">
            <a class="card-header h3" href="suppliers.php">Suppliers</a>
            <div class="card-body">
                <p class="card-text">Suppliers table contains information such as the suppliers names, address, phone number, and the emails.</p>
                <!-- Setup your pages and add the links here -->
                <a href="#" class="card-link">Create |</a>
                <a href="sRead.php" class="card-link">Read |</a>
                <a href="sUpdate.php" class="card-link">Update |</a>
                <a href="sDelete.php" class="card-link">Delete |</a>
                <a href="sInsert.php" class="card-link">Insert </a>

                
            </div>
        </div>

        <div class="card text-white bg-dark mb-3" style="max-width: 50rem;">
        <a class="card-header h3" href="products.php">Products</a>
            <div class="card-body">
                <p class="card-text">Products table contains information such as the products names, description, price, quantity, status, and the supplier ID.</p>
                <!-- Setup your pages and add the links here -->
                <a href="#" class="card-link">Create |</a>
                <a href="pRead.php" class="card-link">Read |</a>
                <a href="pUpdate.php" class="card-link">Update |</a>
                <a href="pDelete.php" class="card-link">Delete |</a>
                <a href="pInsert.php" class="card-link">Insert </a>
            </div>
        </div>

    </div>


</body>

<?php } else { ?>

<body>
    <div class="container">
        <h1>Please login first!</h1>
    </div>
</body>

<?php } ?>