<?php 

if (isset($_POST["submit"])) { // Run code only if it was called with POST method (and submit button)
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"]; 
    $pwdRepeat = $_POST["pwdrepeat"]; 
 
    // Instantiate loginContr class (db User) 
    include "../classes/signup.classes.php";
    
    // NOTE: Importing and creating contr classes crashes the server for signing up (need to resolve)
    include "../classes/signup-contr.classes.php";
    //$signup = new SignupContr($uid, $pwd, $pwdRepeat);

    echo "Created Signup Contr Object";

    // Running error handlers and user login

    // Return back to front page 
    //header("location: ../index.php?error=none");
}