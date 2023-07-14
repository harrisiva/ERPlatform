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

        function insertMultiple(string $statement, array $data): int {
            $success = 0; // 0: Failure, 1: Success
            try {
                $stmt = $this->conn->prepare($statement);
                foreach ($data as $row){
                    $stmt->execute($row);
                    
                } $success = 1;
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage();
            }
            return $success;
        }

        // Add other general database functions as the project requires
    }

    class Products extends Database { 
        function insertProducts(array $data): int {
            $statement = "INSERT INTO product (productID, productName, description, price, quantity, status, supplierID) VALUES (:productID, :productName, :description, :price, :quantity, :status, :supplierID)";
            $success = $this->insertMultiple($statement, $data);
            return $success;
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

$handler = new Products($host, $name, $username, $password); // Create Products Handler (inherited from the DB Handler/PDO Wrapper)

$products_test_data = array(
    array(0002, 'Object', 'Another Thing', 799.9, 50, 'B', 7890),
    array(3374, 'Laptop', 'MacBook Pro', 1799.9, 30, 'A', 9876),
);
// Print suppliers information using the handler as a associated array ??

echo "Working <br>";
$success = $handler->insertProducts($products_test_data);
echo "Inserted <br>";
echo "Success: $success <br>";
?>