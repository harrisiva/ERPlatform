<?php
    declare(strict_types=1);
    require "queries.php"; 

    // NOTE: Not sure if we should be closing the conn inside every function. I think this decision is based on how I (HS) set up the login system and how a user shares the session.

    class Database { // Our PDO Wrapper (Simplifies CRUD operations)
        // Properties (SAVE THE HARDCODED DATA AS ENV VARIABLES AND THEN LOAD THEM UP)
        public $conn;
        private string $host='mydb.cbbhaex7aera.us-east-2.rds.amazonaws.com';
        private string $db_name='CP476_Project';
        private string $username='admin';
        private string $password='cp476-%uni';
        // Constructor that establishes the SQL connection and sets the conn property. 
        // If the connection fails, exit() is called.

        function __construct() {
            $dsn = "mysql:host=$this->host;dbname=$this->db_name;charset=utf8mb4";
            $options = [
            PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
            ];
            try {
                $this->conn = new PDO($dsn, $this->username, $this->password, $options);
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

        function execMultiQueryWithData(string $statement, array $data): int { // prepare and execute multiple query satements with data in them (ideally for inserting multiple but can also be used to execute single (by passing in data in a multi-dimensional array))
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

        function read(string $query, string $search="", array $values=array()): array { // New read function that can handle both searching and reading (with response)
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

        function delete (string $query, int $id){
            $success = 0;
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id',$id, PDO::PARAM_INT);
            $stmt->execute();

            //returns the # of affected rows (i.e. if a row is deleted)
            if ($stmt->rowCount()>=1){
                $success = 1;
            }
        
           return $success;
        }

        
        function insert (string $query, array $data){
            $success = 0;
            try{
                $stmt = $this->conn-> prepare($query);
                $stmt -> execute($data);
                $success = 1;
            }catch (PDOException $e) {
                $success = "Error: " . $e->getMessage();

            };
            return $success;
        }
        
        function update(string $query,array $data){
            $success = 0;
            try{
                $stmt = $this->conn->prepare($query);
                $stmt->execute($data);
                if ($stmt->rowCount() > 0) {
                    $success = 1;
                }
            } catch (PDOException $e){
                echo "Error:". $e->getMessage();
            }
            return $success;
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

        function deleteProducts(int $id){
            $query = "DELETE FROM product where productID= :id";
            //$query = "DELETE FROM product where productID= $id";
            $success = $this->delete($query, $id);
            return ($success);
        }

        function insertProduct (array $data){
            global $insert_product;
            $success = $this->insert($insert_product, $data);
            return $success;

        }

        function updateSupplier(array $data) {
            // extract field value of id from array
            $productID = $data['id'];
            unset($data['id']);
        
            
            $query = "UPDATE product SET ";
            $updates = []; // stores column name
            $values = []; // corresponding value to column

            // loops through data array to check if field has any data entry by user
            foreach ($data as $column => $value) {
               // if field has data entered, updates and values append the new values and respective column
                if ($value !== "") {
                    $updates[] = "$column = ?";
                    $values[] = $value;
                }
            }
        
            // checks if any field has been updated by user
            // if it has, then joins array of user filled column names and values using , parser and converts into a string
            if (!empty($updates)) {
                $query .= implode(", ", $updates) . " WHERE productID = ?";
                $values[] = $productID;
                return $this->update($query, $values);
            }
            
            // no updates made by user
            return false; 
        }

        
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
        
        function deleteSuppliers(int $id){
            $query = "DELETE FROM supplier where supplierID= :id";
            $success = $this->delete($query, $id);
            return $success;
        }

        function insertSupplier (array $data){
            $query = "INSERT INTO supplier (supplierID, supplierName, address, phone, email) VALUES (:supplierID,  :supplierName, :address, :phone, :email)";

            $success = $this->insert($query, $data);
            return $success;

        }

        function updateSupplier(array $data) {
            // extract field value of id from array
            $supplierID = $data['id'];
            unset($data['id']);
        
            
            $query = "UPDATE supplier SET ";
            $updates = []; // stores column name
            $values = []; // corresponding value to column

            // loops through data array to check if field has any data entry by user
            foreach ($data as $column => $value) {
               // if field has data entered, updates and values append the new values and respective column
                if ($value !== "") {
                    $updates[] = "$column = ?";
                    $values[] = $value;
                }
            }
        
            // checks if any field has been updated by user
            // if it has, then joins array of user filled column names and values using , parser and converts into a string
            if (!empty($updates)) {
                $query .= implode(", ", $updates) . " WHERE supplierID = ?";
                $values[] = $supplierID;
                return $this->update($query, $values);
            }
            
            // no updates made by user
            return false; 
        }
        
    }

?>

