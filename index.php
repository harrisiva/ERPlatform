<?php 
    require 'templates/header.php';
    // import the required packages for this file (with require)
?>

<body>

    <!-- Login Form-->
    <div class="container">
        <h2>Login:</h2>
        <form action="/webapp/includes/login.inc.php" method=post>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="uid" placeholder="Username">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="pwd" placeholder="Password">
            </div>

            <button type="submit" name="submit" class="btn btn-default">Login</button>
        </form>

    </div>

    <!-- Signup Form-->
    <div class="container">
    <h2>Signup:</h2>
    <form action="/webapp/includes/signup.inc.php" method=post>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="uid" placeholder="Username">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="pwd" placeholder="Password">
        </div>

        <div class="form-group">
            <label for="password">Repeat Password:</label>
            <input type="password" class="form-control" name="pwdrepeat" placeholder="Repeat Password">
        </div>

        <button type="submit" name="submit" class="btn btn-default">Login</button>
    </form>

</div>



</body>


<?php require 'templates/footer.php';?>