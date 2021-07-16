
<?php 
// Initialize shopping cart class 
include_once 'Cart.class.php'; 
$cart = new Cart; 
 
// Include the database config file 
require_once 'dbConfig.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>PHP Shopping Cart</title>
<meta charset="utf-8">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
</head>
<body>
<div class="container">
	
    <!-- Cart basket -->
    <div class="cart-view">
        <a href="viewCart.php" title="View Cart"><i class="icart"></i> (<?php echo ($cart->total_items() > 0)?$cart->total_items().' Items':'Empty'; ?>)</a>
    </div>
    
    <!-- Product list -->
    <div class="row col-lg-12">
        <?php 
        // Get products from database 
        $result = $db->query("SELECT * FROM products ORDER BY product_id DESC LIMIT 20"); 
        if($result->num_rows > 0){  
            while($row = $result->fetch_assoc()){ 
        ?>
        <div class="card col-lg-3" style="height:12em;margin-bottom:10px;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row["name"]; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Price: <?php echo '$'.$row["price"].' USD'; ?></h6>
                <p class="card-text"><?php echo $row["description"]; ?></p>
                <a href="./cartAction.php?action=addToCart&id=<?php echo $row["product_id"]; ?>" class="btn btn-primary">Add to Cart</a>
            </div>
        </div>
        <?php } }else{ ?>
        <p>Product(s) not found.....</p>
        <?php } ?>
    </div>
</div>
</body>
</html>