<?php    
    // using pdo connection
    $host = 'mydb.cbbhaex7aera.us-east-2.rds.amazonaws.com';
    $dbname = 'CP476_Project';
    // $username = 'admin';
    // $password = 'cp476-%uni';
    // $username = $_ENV['php_db_username'];
    // $password = $_ENV['php_db_password'];
    $username = getenv('php_db_username');
    $password = getenv('php_db_password');


    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
    PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];
    global $conn;
    try {
        // $conn = new PDO ($dsn,$_SESSION['username'],$_SESSION['password'],$options);
        $conn = new PDO($dsn, $username, $password, $options);
        echo "connection successful";
    } catch (PDOException $e) {
        error_log($e->getMessage());
        echo $e->getMessage();
        exit('Something wrong'); //something a user can understand
    }
    

?>