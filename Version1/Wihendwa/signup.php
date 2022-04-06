<?php

include('includes/register.php');

$seller_status="unchecked";
$buyer_status="unchecked";

if (isset($_POST['submit'])){

    $selected_customer=$_POST['customer_type'];

    if ($selected_customer=="Buyer"){
        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $phone_number=$_POST['phone_number'];
        $location=$_POST['location']; 
        $username=$_POST['username'];
        $password=$_POST['password'];
        $confirm_password=$_POST['confirm-password'];
        if ($password==$confirm_password){
            RegisterBuyers($first_name,$last_name,$phone_number,$location, $username, $password,$confirm_password);
        }
        else{
            print("Confirm password doesn't much password");
        }
        
        

    }

    else if($selected_customer=="seller"){

        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $phone_number=$_POST['phone_number'];
        $location=$_POST['location']; 
        $username=$_POST['username'];
        $password=$_POST['password'];
        $confirm_password=$_POST['confirm-password'];
        if ($password==$confirm_password){
            RegisterSellers($first_name,$last_name,$phone_number,$location, $username, $password,$confirm_password);

        }
        else{
            print("Confirm password doesn't much password");
        }
    }
        
    else{
        print("Sorry can't create account! Need to choose account type.");
    } 
    

}   
?>