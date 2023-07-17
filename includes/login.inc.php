<?php 

if (isset($_POST["submit"])) { // Run code only if it was called with POST method (and submit button)
    require "../classes/login-contr.classes.php"; // Instantiate loginContr class (db User) 
    
    // Get data from POST request
    $uname = $_POST["uname"];
    $pwd = $_POST["pwd"]; 

    // Running error handlers and user sign up function (extends DB)
    $controller = new LoginContr($uname, $pwd); 
    $controller->loginUser(); // Instantiate loginContr class (db User)

    // Return back to front page 
    //header("location: ../index.php?error=none");
}