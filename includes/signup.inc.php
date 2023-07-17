<?php 

if (isset($_POST["submit"])) { // Run code only if it was called with POST method (and submit button)
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"]; 
    $pwdRepeat = $_POST["pwdrepeat"]; 
 
    // Instantiate loginContr class (db User) 
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    $signup = new SignupContr($uid, $pwd, $pwdRepeat);

    // Running error handlers and user login

    // Return back to front page 
    header("location: ../index.php?error=none");
}