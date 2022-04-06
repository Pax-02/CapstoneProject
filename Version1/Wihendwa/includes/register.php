
<?php

require_once 'db_connect.php';

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "bathan@02";
$dbname = "Wesell";


function RegisterBuyers($first_name,$last_name,$phone_number,$location, $username, $password,$confirm_password) {
    $conn = DBConnect($GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass'], $GLOBALS['dbname']);
    $hashedpassword = HashWithMD5($password);
    $hashedconfirm_password=HashWithMD5($confirm_password);


    $query = "INSERT INTO register_buyers (first_name,last_name,phone_number,location,username, password,confirm_password) "
            . "VALUES('$first_name','$last_name','$phone_number','$location', '$username', '$hashedpassword','$hashedconfirm_password')";

    $result = mysqli_query($conn, $query);
    if ($result) {
        header('location: login.html');
    } else {
        echo "Could not insert record! " . mysqli_error($conn);
    }
}
function RegisterSellers($first_name,$last_name,$phone_number,$location, $username, $password,$confirm_password) {
    $conn = DBConnect($GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass'], $GLOBALS['dbname']);
    $hashedpassword = HashWithMD5($password);
    $hashedconfirm_password=HashWithMD5($confirm_password);

    $query = "INSERT INTO register_sellers (first_name,last_name,phone_number,location,username, password,confirm_password) "
            . "VALUES('$first_name','$last_name','$phone_number','$location', '$username', '$hashedpassword','$hashedconfirm_password')";

    $result = mysqli_query($conn, $query);
    if ($result) {
        header('location: login.html');
    } else {
        echo "Could not insert record! " . mysqli_error($conn);
    }
}

function HashWithMD5($text) {
    $hashedpassword = MD5($text);
    return $hashedpassword;
}



?>



