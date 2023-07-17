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
        <a href="#" class="card-link">Create |</a>
        <a href="#" class="card-link">Read |</a>
        <a href="#" class="card-link">Update |</a>
        <a href="#" class="card-link">Delete</a>
        <br>

        <?php
            $handler = new Supplier();
            $response = $handler->show();
            echo "Working";
            echo var_dump($response);
        ?>

    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td>@Email</td>
            </tr>
        </tbody>

    </table>

</body>

<?php } else { ?>

<body>
    <div class="container">
        <h1>Please login first!</h1>
    </div>
</body>

<?php } ?>