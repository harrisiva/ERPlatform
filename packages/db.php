<?php
    declare(strict_types=1);
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

        function search($query, $search){
            try{
                $stmt = $this->conn->prepare($query);
                $stmt->bindValue(':search', '%' . $search . '%');
                $stmt->execute();
                $rValues = array();
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

        function delete ($query,$id){
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
            
           

    

        // TODO: Add other general database functions as the project requires
        // Create functions for inserting (individual), updating, and deleting, and selecting (should return an associate array)
    }

    class Products extends Database { 
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

        function deleteProducts($id){
            $query = "DELETE FROM product where productID= :id";
            //$query = "DELETE FROM product where productID= $id";
            $success = $this->delete($query, $id);
            return ($success);
        }
        // TODO: Add specific functionality on top of the generic function for each of the generic functions from the parent Database handler (PDO wrapper) class (i.e. class above)
    }

    class Supplier extends Database {
        function searchSuppliers($field,$search){
            $query = "SELECT * FROM supplier WHERE $field LIKE CONCAT('%',:search,'%')";
            return $this->search($query,$search);            
        }

        function readSuppliers(){
            $query = "SELECT * FROM supplier";
            return $this->read($query);
        }
        
        function deleteSuppliers($id){
            $query = "DELETE FROM supplier where supplierID= :id";
            //$query = "DELETE FROM product where productID= $id";
            $success = $this->delete($query, $id);
            return ($success);
        }
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
    array(0004, 'Product', 'Another Thing', 799.9, 50, 'B', 7890),
);
echo "Working <br>";
?>