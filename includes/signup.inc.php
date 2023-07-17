<?php 

if (isset($_POST["submit"])) { // Run code only if it was called with POST method (and submit button)
    // Instantiate loginContr class (db User) 
    include "../classes/signup-contr.classes.php";
    include "../classes/signup.classes.php";
    
    // Get data from POST request
    $uname = $_POST["uname"];
    $pwd = $_POST["pwd"]; 
    $pwdRepeat = $_POST["pwdrepeat"]; 

    // NOTE: Importing and creating contr classes crashes the server for signing up (need to resolve)
    $controller = new SignupContr($uname, $pwd, $pwdRepeat);
    $controller->signupUser();

    echo "Created Signup Contr Object";
    
    // Running error handlers and user login

    // Return back to front page 
    header("location: ../index.php?error=none");
}