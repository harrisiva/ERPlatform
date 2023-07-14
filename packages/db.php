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
        // Add other general database functions as the project requires
    }

    
    class Products extends Database { 

        function insertProducts(array $values): int {
            
            // Prepare SQL statement for binding and entering multiple products
            $stmt = $this->conn->prepare(
            "INSERT INTO product (productID, productName, description, price, quantity, status, supplierID) 
            VALUES (:productID, :productName, :description, :price, :quantity, :status, :supplierID)"
            );
            
            // Begin transaciton
            $this->conn->beginTransaction();
            foreach ($values as $entry) { // Iterate over the given array of entires and create transactions to enter them into the DB
                $stmt->bindValue("issdisi", $entry[0], $entry[1], $entry[2], $entry[3], $entry[4], $entry[5], $entry[6], $entry[7]);
                $stmt->execute();
            };
            $this->conn->commit(); // Commit the transactions that we just prepared and executed to the Database

            return 0; // 1 if successful, 0 otherwise
        }
        
    }

    class Supplier extends Database {
    }

?>

<!-- driver/test code -->
<?php 

// Load ENV variables and setup the required info for establishing a DB connection
$host = 'mydb.cbbhaex7aera.us-east-2.rds.amazonaws.com';
$name = 'CP476_Project';
$username = 'admin';
$password = 'cp476-%uni';

$db = new Database($host, $name, $username, $password); // Create DB Handler object

// Print suppliers information using the handler as a associated array ??
echo 'Working';

// Code to open a file and add the contents, iterate over the lines and add the data to the database using the products function




?>