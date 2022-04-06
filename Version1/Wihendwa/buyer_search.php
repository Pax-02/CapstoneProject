<?php 

session_start();
include('includes/log_check.php');
include('includes/functions.php');

$output='';

if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.html');
}

?>


<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Buyer user</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/BuyerIndex.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> 
    </head>
    <body>
        <header>
            <img class="logo" src="images/logo.png" style="width:50px;height:50px;">
            <ul class="option_links">
            <?php if (isset($_SESSION["user"])): ?>
                <li><a href="buyer_index.php">View product</li>
                <li><a href="bought_product.php">Bought product</li>
                
                <?php endif ?>
                
            </ul>
            <Strong><a href="#">User: <?php echo $_SESSION['user']; ?></Strong>
            <Strong><a href="seller_index.php?logout="1">Log out<Strong>
            
        </header>

        
        <footer>
			<a href="#">
            <form method="POST" action="buyer_search.php">
                <input type="search" name="search-button" placeholder="Search product...">
                <i class="fa fa-search"></i>

            </form>
            <div id=product-view>
                <?php
                    if (isset($_POST['search-button'])){
                        $keysearch=$_POST['search-button'];
                        $conn = DBConnect($GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass'], $GLOBALS['dbname']);
                        $query= "SELECT * FROM products WHERE product_name LIKE '%$keysearch%'";
                        $result=mysqli_query($conn,$query);
                        $count=mysqli_num_rows($result);
                    
                        if ($count==0){
                            $output="There is no such product";
                            print ($output);
                        }
                    
                        else{

                            while ($row = mysqli_fetch_array($result)) {
                            print "<div id='img_div'>";
                                print "<div class=product-box>";

                                    print "<h2>".$row['product_name']."</h2>";
                                    print "<a href='#'><img src='uploads/".$row['image']."' >";
                                    print "<h3>"."Product description"."</h3>";
                                    print "<p>".$row['product_description']."</p>";
                                    print "<h3>"."Product price"."</h3>";
                                    print "<span>".$row['product_price']."Rwf"."</span>";
                                    print "<a href='buyer_index.php?buy_product='1'><span>Buy product<spam>";
                                    
                                print "</div>";

                            print "</div>";

                            

                        }                
                            
                    
                        }
                    
                    
                    }
            ?>
            

            </div>





            
            


            
        </footer>


                
            
    
    <script src="./seller_index.js"></script>
    </body>
</html>