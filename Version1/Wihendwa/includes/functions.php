<?php
require_once 'db_connect.php';
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "bathan@02";
$dbname = "Wesell";


function InsertProduct($image,$product_name,$product_price,$product_description,$username){
    $conn = DBConnect($GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass'], $GLOBALS['dbname']);
    $query= "INSERT INTO products(image,product_name,product_description,product_price,username)"
    ."values('$image','$product_name','$product_description','$product_price','$username')";
    // insert data in the database
    $result=mysqli_query($conn,$query);
    
}

function RetreiveProducts($username){
    $conn = DBConnect($GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass'], $GLOBALS['dbname']);
    $query= "SELECT * FROM products WHERE username='$username'";
    $result=mysqli_query($conn,$query);
}

?>