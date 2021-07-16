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
$item_name = "";
$item_price    = "";


// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'boutique_pos');
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Add item
if (isset($_POST['add'])) {
  // receive all input values from the form
  echo "connect";
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $description = mysqli_real_escape_string($db, $_POST['description']);
  $price = mysqli_real_escape_string($db, $_POST['price']);
  $quantity = mysqli_real_escape_string($db, $_POST['quantity']);

  $query = "INSERT INTO products ( name, description,price,quantity,created) 
  			  VALUES('$name','$description','$price','$quantity', NOW() )";
  if (mysqli_query($db, $query)) {
    echo "<script>alert('Successfully stored');</script>";
  } else {
    echo "<script>alert('Something wrong!!!');</script>";
  }
  header('location: product.php');
}
?>
