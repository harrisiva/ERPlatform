<?php 

require "../packages/db.php";

class Signup extends Database {
    
    function checkExists($username) {
        $exists = False;
        $response = $this->read(query: "SELECT * FROM users WHERE username=?", values: array($username));
        if (count($response)>1){$exists=True;};
        return $exists;
    }

    function setUser($username, $password){
        
        return;
    }

}