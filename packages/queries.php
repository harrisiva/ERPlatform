<?php 

// Create Queries
$create_suppliers = " CREATE TABLE supplier (
    supplierID int UNIQUE PRIMARY KEY,
    supplierName varchar(45) NOT NULL,
    address varchar(45),
    phone varchar(45),
    email varchar(45)
);";

$create_products = "CREATE TABLE products (
    productID INT PRIMARY KEY,
    supplierID INT NOT NULL,
    productName VARCHAR(45) NOT NULL,
    description VARCHAR(100),
    price FLOAT,
    quantity INT,
    status CHAR(1),
    FOREIGN KEY (supplierID) REFERENCES supplier (supplierID) ON DELETE CASCADE ON UPDATE CASCADE
);";

// Insert Queries
$insert_product = "INSERT INTO product (productID, productName, description, price, quantity, status, supplierID) VALUES (:productID, :productName, :description, :price, :quantity, :status, :supplierID)";


// Search Queries


?>