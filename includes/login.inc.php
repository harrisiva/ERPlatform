<?php 

if (isset($_POST["submit"])) { // Run code only if it was called with POST method (and submit button)
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"]; 

    // Instantiate loginContr class (db User)

    // Running error handlers and user login

    // Return back to front page 
    header("location: ../index.php?error=none");
}