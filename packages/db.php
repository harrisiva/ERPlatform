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

        // NOTE: Should create (and update) operations be supported by single or multi query functions? (is it possible is this scope too wide for these functions)?
        function execSingleQueryNoData(string $query): int{ // prepare and execute queries/statements without data (preperation not required)
            $success = 0;
            try{
                $this->conn->exec($query);
                $success = 1;
            } catch (PDOException $e){
                echo "Error: " . $e->getMessage();
            }
            return $success;
        }

        function execMultiQueryWithData(string $statement, array $data): int { // prepare and execute multiple query satements with data in them (ideally for inserting multiple)
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

        function read(string $query, string $search="", array $values=array()): array { // New read function that can handle both searching and reading
            $response = array();
            try {
                $stmt = $this->conn->prepare($query);
                if ($search !="") {$stmt->bindValue(':search', '%' . $search . '%');}
                if (count($values)==0) {$stmt->execute();}
                else {$stmt->execute($values);}
                if ($stmt->rowCount()>0){
                    $response = $stmt->fetchAll();
                    if (count($response)==1) {$response=$response[0];}
                } 
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            };
            return $response;
        }

        // TODO: Add other general database functions as the project requires
        // Create functions for inserting (individual), updating, and deleting, and selecting (should return an associate array)
    }

    class Products extends Database {

        function createTable(){
            global $create_products;
            return $this->execSingleQueryNoData($create_products);
        }

        function createProducts(array $data): int { // TODO: Generalize (with conditions and default variables) to insert one or many products (do not accept any missing data)
            global $insert_product;
            return $this->execMultiQueryWithData($insert_product, $data);
        }

        function searchProducts($field,$search){
            $query = "SELECT * FROM product WHERE $field LIKE CONCAT('%',:search,'%')";
            return $this->read($query,$search);
            
        }
        function readProducts(){
            $query = "SELECT * FROM product";
            return $this->read($query);
        }
        // TODO: Add specific functionality on top of the generic function for each of the generic functions from the parent Database handler (PDO wrapper) class (i.e. class above)
    }

    class Supplier extends Database {
        function create(bool $table=False): int{
            $success = 0;
            if ($table){
                global $create_suppliers;
                $success = $this->execSingleQueryNoData($create_suppliers);
            }
            return $success;
        }

        function search($field,$search){
            $query = "SELECT * FROM supplier WHERE $field LIKE CONCAT('%',:search,'%')"; // Left as is because of the use of ($field). I (HS) dont belive this would work if we placed it in queries.php
            return $this->read($query,$search);            
        }

        function show(){
            global $read_all_suppliers;
            return $this->read($read_all_suppliers);
        }
        
    }

?>