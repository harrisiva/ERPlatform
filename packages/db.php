<?php    

    class Database { // Our PDO Wrapper
        // Properties
        public $conn;

        // Constructor that establishes the SQL connection and sets the conn property. 
        // If the connection fails, exit() is called.
        function __construct(string $host, string $name, string $username, string $password,) {
            $dsn = "mysql:host=$host;dbname=$name;charset=utf8mb4";
            $options = [
            PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
            ];
            try {
                $this->conn = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                error_log($e->getMessage());
                echo $e->getMessage();
                exit('Failed to connect to the database. Please contact the administrator.');
            }
        }

        // Methods
            // Insert
            // Remove
            // and other stuff if we need that the PDO doesnt give

    }

    
    class Products extends Database {

    }

    class Supplier extends Database {

    }


?>