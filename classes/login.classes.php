<?php 
require "../packages/db.php";

class Login {

    function getUser($username, $password) {
        $handler = new Database();
        $response = $handler->read (
            query: "SELECT * FROM users WHERE username=?;", values: array($username)
        );
        if (count($response)==0) {header("location: ../index.php?error=userNotFound");exit();};
        echo "Response from login getUser(): <br>";
        echo var_dump($response);
        //$checkPwd = password_verify($password, $response[1]);
        return $response; 
    }
}