<?php 

require "../packages/db.php";

class Signup extends Database {
    
    function checkUser($username) {
        $exists = False;
        $response = $this->read(query: "SELECT * FROM users WHERE username=?", values: array($username));
        if (count($response)>1){$exists=True;};
        return $exists;
    }

}

// Load ENV variables and setup the required info for establishing a DB connection
$test = new Signup();
$test->checkUser("david");