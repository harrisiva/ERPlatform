<?php 
    require 'templates/header.php';
?>

<body>

    <div class="container">
        <h1>Project Overview</h1>
        <p>Bunch of overview and maybe some stats from DB</p>
    </div>
    
    <div class="container">

        <!-- Login Form -->
        <div class="col">
            <h2>Login:</h2>
            <form action="/webapp/includes/login.inc.php" method=post>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="uname" placeholder="Username">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="pwd" placeholder="Password">
                </div>

                <button type="submit" name="submit" class="btn btn-default">Login</button>
            </form>
        </div>

        <!-- Signup Form-->
        <div class="col">
            <h2>Sign Up:</h2>
            <form action="/webapp/includes/signup.inc.php" method=post>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="uname" placeholder="Username">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="pwd" placeholder="Password">
                </div>

                <div class="form-group">
                    <label for="password">Repeat Password:</label>
                    <input type="password" class="form-control" name="pwdrepeat" placeholder="Repeat Password">
                </div>

                <button type="submit" name="submit" class="btn btn-default">Sign Up</button>
            </form>
        </div>
    
    </div>

</body>
