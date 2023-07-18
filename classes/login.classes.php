<?php 
require "../packages/db.php";

class Login {

    function getUser($username, $password) {
        
        // Get entry matching username
        $handler = new Database();
        $response = $handler->read (
            query: "SELECT * FROM users WHERE username=?;", values: array($username)
        );
        if (count($response)<=0) {header("location: ../index.php?error=userNotFound");exit();};
        
        // Check if given password matches with password for given username in the DB entry
        if ($password!=$response["password"]) {
            header("location: ../index.php?error=passwordIncorrect");exit();
        };

        // Start session and set session variables
        session_start();
        $_SESSION["userid"] = $response["user_id"];
        $_SESSION["username"] = $response["username"];

        return $response; 
    }
}