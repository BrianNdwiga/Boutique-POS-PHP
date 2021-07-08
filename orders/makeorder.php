<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<?php
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'inventorymanagement');
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

// Add item
if (isset($_POST['makeOrder'])) {
  // receive all input values from the form
  // echo "connect";
  // $product_name=mysqli_real_escape_string($db, $_POST['product_name']);
  // $total_price=mysqli_real_escape_string($db, $_POST['total_price']);
  $order_date=mysqli_real_escape_string($db, $_POST['order_date']);
  $pickup_location=mysqli_real_escape_string($db, $_POST['pickup_location']);
  $customer_id=mysqli_real_escape_string($db, $_POST['customer_id']);
  $served_by=mysqli_real_escape_string($db, $_POST['served_by']);
  
    $query = "INSERT INTO orders (order_date,pickup_location,customer_id,served_by) 
  			  VALUES('$order_date','$pickup_location','$customer_id','$served_by')";
      if(mysqli_query($db, $query))
      {
      // echo "<script>alert('Successfully stored ;');</script>";	
    }
    else{
        echo"<script>alert('Something wrong!!!');</script>";
    }
  	header('location: order.php');
  
}

// Add item
if (isset($_POST['cartdetails'])) {
  // receive all input values from the form
  $product_id=mysqli_real_escape_string($db, $_POST['product_id']);
  $amount=mysqli_real_escape_string($db, $_POST['amount']);
  $order_quantity=mysqli_real_escape_string($db, $_POST['order_quantity']);
  $order_id = mysqli_real_escape_string($db, $_POST['order_id']);
    $query = "INSERT INTO order_details (product_id,amount,order_quantity,order_id) 
  			  VALUES('$product_id','$amount','$order_quantity','$order_id')";
      if(mysqli_query($db, $query))
      {
      echo "<script>alert('Successfully stored');</script>";	
    }
    else{
        echo"<script>alert('Something wrong!!!');</script>";
    }
  	
  	header('location: order.php');
  
}
?>
