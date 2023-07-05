<?php
    echo "hellooo <br/>";
    // phpinfo();
    
    // using pdo connection
    $host = 'mydb.cbbhaex7aera.us-east-2.rds.amazonaws.com';
    // $host = "localhost";
    $dbname = 'CP476_Project';
    // $dbname = "world";
    $username = 'admin';
    $password = 'cp476-%uni';

    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
    PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];
    try {
    $conn = new PDO($dsn, $username, $password, $options);
        echo "connection successful";
    } catch (PDOException $e) {
    error_log($e->getMessage());
    echo $e->getMessage();
    exit('Something wrong'); //something a user can understand
    }
    $conn=null;
    // $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

    // try {
    //     $conn = new PDO($dsn, $username, $password);
    //     echo "Connected successfully!";
    // } catch (PDOException $e) {
    //     echo "Connection failed: " . $e->getMessage();
    // }

?>