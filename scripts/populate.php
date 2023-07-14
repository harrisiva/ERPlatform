<?php 

// A script that populates a SQL Database given text files

// ProductID, ProductName, Description, Price, Quantity, Status, Supplier ID (Foreign ID)

/* SQL Statement to prepare for products
INSERT INTO table_name (column1, column2, column3, ...)
VALUES (value1, value2, value3, ...);
*/ 

$test = array(
    array("vlaue", "vlaue2"),
    array("vlauer", "vlaue2"),
);

foreach ($test as $item) {
    echo $item[0] . '<br>';
};


?>