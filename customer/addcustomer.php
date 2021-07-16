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
$db = mysqli_connect('localhost', 'root', '', 'boutique_pos');
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

// Add item
if (isset($_POST['addCustomer'])) {
  // receive all input values from the form
  echo "connect";
  $customer_name=mysqli_real_escape_string($db, $_POST['customer_name']);
  $added_date=mysqli_real_escape_string($db, $_POST['added_date']);
  $phone_number=mysqli_real_escape_string($db, $_POST['phone_number']);
  
    $query = "INSERT INTO customer (customer_name,added_date,phone_number) 
  			  VALUES('$customer_name','$added_date','$phone_number')";
      if(mysqli_query($db, $query))
      {
      echo "<script>alert('Successfully stored');</script>";
				
    }
    else{
        echo"<script>alert('Somthing wrong!!!');</script>";
    }
  	
  	header('location: customer.php');
  
}
?>
