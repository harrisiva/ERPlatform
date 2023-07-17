<?php 

if (isset($_POST["submit"])) { // Run code only if it was called with POST method (and submit button)
    require "../classes/signup-contr.classes.php"; // Instantiate loginContr class (db User) 
    
    // Get data from POST request
    $uname = "harri"; //$_POST["uname"];
    $pwd = "test";//$_POST["pwd"]; 
    $pwdRepeat = "test";//$_POST["pwdrepeat"]; 
    
    // Running error handlers and user sign up function (extends DB)
    $controller = new SignupContr($uname, $pwd, $pwdRepeat); 
    $controller->signupUser();

    // Return back to front page 
    header("location: ../index.php?error=none");
}