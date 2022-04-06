<?php
require_once 'db_connect.php';

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "bathan@02";
$dbname = "Wesell";

function CheckUserAndPaswdBuyer($username,$password){
    
    $conn = DBConnect($GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass'], $GLOBALS['dbname']);
    $hashedpassword = HashWithMD5($password);
    $query="SELECT * FROM register_buyers Where username='$username' AND password='$hashedpassword'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);

    if ($count==1){
        session_start();
        $_SESSION['user']= $username;
        $_SESSION['sucess']="Loged in successfully";
        header("location: buyer_index.php");
    }
    else{
        echo("wrong credentials".mysqli_error($conn));
        header('location: login.html');

    }

}

function CheckUserAndPaswdSeller($username,$password){
    $conn = DBConnect($GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass'], $GLOBALS['dbname']);
    $hashedpassword = HashWithMD5($password);
    $query="SELECT * FROM register_sellers Where username='$username' And password='$hashedpassword'";
    $result = mysqli_query($conn, $query);
    // count the numbers of rows provided by the query
    $count = mysqli_num_rows($result);
    if ($count==1){
        session_start();
        $_SESSION['user']= $username;
        $_SESSION['sucess']="Loged in successfully";
        header("location: seller_index.php");
    }
    else{
        echo("wrong credentials".mysqli_error($conn));
        header('location: login.html');

    }
    
}

// Function to show if it has logged in

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}
// Log out Functiom

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.html");
}
function HashWithMD5($text) {
    $hashedpassword = MD5($text);
    return $hashedpassword;
}


?>