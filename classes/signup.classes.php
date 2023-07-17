<?php 

require "../packages/db.php";

class Signup extends Database {
    
    protected function checkUser($uid) {
        $stmt = $this->read("SELECT * FROM supplier WHERE user_id=?", array(array($uid)));


    }

}
