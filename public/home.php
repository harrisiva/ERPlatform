<?php 
    require "../templates/header.php";
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
                <a href="#" class="card-link">Create |</a>
                <a href="#" class="card-link">Read |</a>
                <a href="#" class="card-link">Update |</a>
                <a href="#" class="card-link">Delete</a>
            </div>
        </div>

        <div class="card text-white bg-dark mb-3" style="max-width: 50rem;">
            <div class="card-header h3">Products</div>
            <div class="card-body">
                <p class="card-text">Products table contains information such as the products names, description, price, quantity, status, and the supplier ID.</p>
                <a href="#" class="card-link">Create |</a>
                <a href="#" class="card-link">Read |</a>
                <a href="#" class="card-link">Update |</a>
                <a href="#" class="card-link">Delete</a>
            </div>
        </div>

    </div>


</body>

<?php require "../templates/footer.php"; ?>