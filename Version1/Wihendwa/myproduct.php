<?php
session_start();
include('includes/log_check.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.html');
}



?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Seller_user</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/SellerIndex.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    </head>
    <body>
        <header>
            <img class="logo" src="images/logo.png" style="width:50px;height:50px;">
            <ul class="option_links">
            <?php if (isset($_SESSION["user"])): ?>
                <li><a href="myproduct.php">My product</li>
                <li><a href="sold_product.php">Sold Product</li>
                <li><a href="seller_index.php">ADD Product</li>
                
                <?php endif ?>
                
            </ul>
            <Strong><a href="#">User: <?php echo $_SESSION['user']; ?></Strong>
            <Strong><a href="seller_index.php?logout="1">Log out<Strong>
            
        </header>

        <footer>
            <div id="product-view">
                <?php 
                    include('includes/functions.php');
                    $username=$_SESSION['user'];
                    $conn = DBConnect($GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass'], $GLOBALS['dbname']);
                    $query= "SELECT * FROM products WHERE username='$username' AND bought='0'";
                    $result=mysqli_query($conn,$query);
                    while ($row = mysqli_fetch_array($result)) {
                        print "<div id='img_div'>";
                            print "<a href='#'><div class=product-box>";
                                print "<h2>".$row['product_name']."</h2>";
                                print "<a href='#'><img src='uploads/".$row['image']."' >";
                                print "<h3>"."Product description"."</h3>";
                                print "<p>".$row['product_description']."</p>";
                                print "<h3>"."Product price"."</h3>";
                                print "<span>".$row['product_price']."Rwf"."</span>";
                                print "<a href='myproduct.php?remove_product='1'><span>remove product<spam>";
                                
                                if (isset($_GET['remove_product'])){
                                    $item=$row['product_id'];
                                    $conn = DBConnect($GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass'], $GLOBALS['dbname']);
                                    $query= "DELETE  FROM products WHERE product_id='$item'";
                                    $result=mysqli_query($conn,$query);

                                }
                                

                            print "</div>";

                        print "</div>";

                        

                      }                
                ?>
                    
            </div>
            
        </footer>

        <script src="./seller_index.js"></script>
    </body>
</html>

