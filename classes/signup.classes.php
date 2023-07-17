<?php 

require "../packages/db.php";

class Signup extends Database {
    
    function checkUser($username) {
        $response = $this->read(query: "SELECT * FROM users WHERE username=?", values: array($username));
        echo var_dump($response);
    }

}

// Load ENV variables and setup the required info for establishing a DB connection
$host = 'mydb.cbbhaex7aera.us-east-2.rds.amazonaws.com';
$name = 'CP476_Project';
$username = 'admin';
$password = 'cp476-%uni';
$test = new Signup($host, $name, $username, $password);
$test->checkUser("harri");