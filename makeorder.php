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


// initializing variables
// $customer_name = "";
// $product    = "";


// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'inventorymanagement');
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

// Add item
if (isset($_POST['makeOrder'])) {
  // receive all input values from the form
  echo "connect";
  $product_name=mysqli_real_escape_string($db, $_POST['product_name']);
  $order_quantity=mysqli_real_escape_string($db, $_POST['order_quantity']);
  $order_date=mysqli_real_escape_string($db, $_POST['order_date']);
  $pickup_location=mysqli_real_escape_string($db, $_POST['pickup_location']);
  $client_name=mysqli_real_escape_string($db, $_POST['client_name']);
  $tel_number=mysqli_real_escape_string($db, $_POST['tel_number']);
  $made_by=mysqli_real_escape_string($db, $_POST['made_by']);
  
    $query = "INSERT INTO orders (product_name,order_quantity,order_date,pickup_location,client_name,tel_number,made_by) 
  			  VALUES('$product_name','$order_quantity','$order_date','$pickup_location','$client_name','$tel_number','$made_by')";
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
