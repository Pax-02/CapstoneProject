<?php

include('includes/log_check.php');

$seller_status="unchecked";
$buyer_status="unchecked";

if (isset($_POST['submit'])){

    $selected_customer=$_POST['customer_type'];

    if ($selected_customer=="Buyer"){
        $username=$_POST['username'];
        $password=$_POST['password'];
        CheckUserAndPaswdBuyer($username,$password);
        
        
        

    }

    else if($selected_customer=="seller"){

        $username=$_POST['username'];
        $password=$_POST['password'];
        CheckUserAndPaswdSeller($username,$password);
        
    }
        
    else{
        print("Sorry Need to choose account type to login in.");
    }
} 