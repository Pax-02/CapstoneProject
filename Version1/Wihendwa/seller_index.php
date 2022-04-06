
<?php 

session_start();
include('includes/log_check.php');
include('includes/functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.html');
}



if (isset($_POST['upload'])){
    // get image name
    $image = $_FILES['image']['name'];
    // path to store the images
    $target=dirname(__FILE__)."/uploads/".$image;
    
    $product_name=$_POST['product_name'];
    $product_price=$_POST['product_price'];
    $product_description=$_POST['product_description'];
    $username=$_SESSION['user'];
    InsertProduct($image,$product_name,$product_price,$product_description,$username);
    // put the file in images
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
        
    }else{
        $msg = "Failed to upload image";
        
    }

    
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
    </head>
    <body>
        <header>
            <img class="logo" src="images/logo.png" style="width:50px;height:50px;">
            <ul class="option_links">
            <?php if (isset($_SESSION["user"])): ?>
                <li><a href="myproduct.php">My product</li>
                <li><a href="#">Sold Product</li>
                
                <?php endif ?>
                
            </ul>
            <Strong><a href="#">User: <?php echo $_SESSION['user']; ?></Strong>
            <Strong><a href="seller_index.php?logout="1">Log out<Strong>
            
        </header>

        
        <footer>
            <div class="click-me">
                <a href="#"><button id="button">Add Product</button>
            </div>
            <div class=pop-out>
                <div class="upload-product">
                <div class="close">+</div>
                </div>
                <div id="content">
                    <form class="box" method="post" action="seller_index.php" enctype="multipart/form-data">
                        
                        <input type="hidden" name="size" value="1000000">
                    
                            
                        <div class="inputs">
                            <h1>Sell your Product</h1>
                            <input type="file" name="image">
                            <input type="TEXT" name="product_name" placeholder="Product Name" required >
                            <input type="number" name="product_price" placeholder="price" min="100" max="1000000" required >
                            <textarea name="product_description" cols="40" rows="4" minlength="20" maxlength="300" placeholder="Product details in few lines"required></textarea> 
                            <input type="submit" name="upload" value="Submit">
                        </div>
                    </form>
                </div>

            </div>
        </footer>


                
            
    
    <script src="./seller_index.js"></script>
    </body>
</html>