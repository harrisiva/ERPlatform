<?php 

if (isset($_POST["submit"])) { // Run code only if it was called with POST method (and submit button)
    // Instantiate loginContr class (db User) 
    require "../classes/signup.classes.php";
    require "../classes/signup-contr.classes.php";
    
    // Get data from POST request
    $uname = $_POST["uname"];
    $pwd = $_POST["pwd"]; 
    $pwdRepeat = $_POST["pwdrepeat"]; 

    // Running error handlers and user sign up function (extends DB)
    $controller = new SignupContr($uname, $pwd, $pwdRepeat); 
    //$controller->signupUser();

    // Return back to front page 
    header("location: ../index.php?error=none");
}