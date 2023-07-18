<?php 
require "../packages/db.php";

class Signup {
    
    function checkExists($username) {
        $handler = new Database();
        $exists = False;
        $response = $handler->read(query: "SELECT * FROM users WHERE username=?", values: array($username));
        if (count($response)>=1){$exists=True;};
        return $exists;
    }

    function setUser($username, $password): int {
        $handler = new Database();
        $success = $handler->execMultiQueryWithData(
            "INSERT INTO users (username, password) VALUES (?,?)", array(array($username, $password))
        );
        return $success; 
    }
}