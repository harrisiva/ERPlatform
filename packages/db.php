<?php
    declare(strict_types=1);
    require "queries.php";

    // NOTE: Not sure if we should be closing the conn inside every function. I think this decision is based on how I (HS) set up the login system and how a user shares the session.

    class Database { // Our PDO Wrapper (Simplifies CRUD operations)
        // Properties
        public $conn;

        // Constructor that establishes the SQL connection and sets the conn property. 
        // If the connection fails, exit() is called.
        function __construct(string $host, string $name, string $username, string $password) {
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

        // Create (and update) operations are supported by single or multi query functions
        function single_query(string $query): int{ // prepare and execute queries/statements without data (preperation not required)
            $success = 0;
            try{
                $this->conn->exec($query);
                $success = 1;
            } catch (PDOException $e){
                echo "Error: " . $e->getMessage();
            }
            return $success;
        }

        function multi_query(string $statement, array $data): int { // prepare and execute multiple query satements with data in them (ideally for inserting multiple)
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

        function search($query, $search): array{
            $rValues = array();
            try{
                $stmt = $this->conn->prepare($query);
                $stmt->bindValue(':search', '%' . $search . '%');
                $stmt->execute();
                if ($stmt->rowCount()<= 0){
                    echo "The query outputted no results";
                } else {
                    while ($read = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        foreach ($read as $column => $value) {
                            $rValues[$column] = $value;
                        }
                    }
                }
            } catch (PDOException $e){
                ECHO "ERROR: ". $e->getMessage();
            }
            $this->conn = null;
            return $rValues;
        }
        
        function read ($query){
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $rValues = array();

            // fetches all sql entries in table as rows
            while ($read = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $row = array();
                foreach ($read as $column => $value) {
                    $row[$column] = $value;
                }
                $rValues[] = $row;
            }
             
            $this->conn = null;
            return $rValues;
        }
    
        // TODO: Add other general database functions as the project requires
        // Create functions for inserting (individual), updating, and deleting, and selecting (should return an associate array)
    }

    class Products extends Database { 
        function createProductTable(){
            $query = "CREATE TABLE product (
                productID INT PRIMARY KEY,
                productName VARCHAR(45) NOT NULL,
                description VARCHAR(100),
                price FLOAT,
                quantity INT,
                status CHAR(1),
                supplierID INT NOT NULL,
                FOREIGN KEY (supplierID) REFERENCES supplier (supplierID) ON DELETE CASCADE ON UPDATE CASCADE
              );";
            return $this->createTable($query);
        }
        function insertProducts(array $data): int {
            $statement = "INSERT INTO product (productID, productName, description, price, quantity, status, supplierID) VALUES (:productID, :productName, :description, :price, :quantity, :status, :supplierID)";
            $success = $this->insertMultiple($statement, $data);
            return $success;
        }
        function searchProducts($field,$search){
            $query = "SELECT * FROM product WHERE $field LIKE CONCAT('%',:search,'%')";
            return $this->search($query,$search);
            
        }
        function readProducts(){
            $query = "SELECT * FROM product";
            return $this->read($query);
        }
        // TODO: Add specific functionality on top of the generic function for each of the generic functions from the parent Database handler (PDO wrapper) class (i.e. class above)
    }

    class Supplier extends Database {
        function createSupplierTable(){
            
            $query = "CREATE TABLE supplier (
                supplierID int UNIQUE PRIMARY KEY,
                supplierName varchar(45) NOT NULL,
                address varchar(45),
                phone varchar(45),
                email varchar(45)
            );";

            return $this->single_query($query);
        }

        function searchSuppliers($field,$search){
            $query = "SELECT * FROM supplier WHERE $field LIKE CONCAT('%',:search,'%')";
            return $this->search($query,$search);            
        }

        function readSuppliers(){
            $query = "SELECT * FROM supplier";
            return $this->read($query);
        }
        
    }

?>