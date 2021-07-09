<?php 

include('../config/config.php');

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];
    $result = mysqli_query($db, "SELECT o.order_id,amount,product_name,pickup_location,price,order_quantity,order_date,served_by,customer_name FROM order_details AS od JOIN orders AS o ON o.order_id= od.order_id JOIN product AS p ON p.product_id=od.product_id JOIN customer AS c ON c.customer_id = o.customer_id AND o.order_id = " . $_GET['id']);

    $row = mysqli_fetch_array($result);

    if ($row) {

        $id = $row['order_id'];
        $customer_name = $row['customer_name'];
        $product_name = $row['product_name'];
        $order_quantity = $row['order_quantity'];
        $price = $row['price'];
        $amount = $row['amount'];
        $pickup_location = $row['pickup_location'];
    } else {
        echo "No results!";
    }
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>Order Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <a class="back" href="order.php">
            <i class="fas fa-arrow-left"></i>
            Back to Products Page
        </a>
        <br>
        <h1 style="padding: 10px; text-align:center;">Specific Order Details</h1>
        <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Product Name</th>
      <th scope="col">Order Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Total Price</th>
      <th scope="col">Pickup Location</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><?php echo $id; ?></th>
      <td><?php echo $customer_name; ?></td>
      <td><?php echo $product_name; ?></td>
      <td><?php echo $order_quantity; ?></td>
      <td><?php echo $price; ?></td>
      <td><?php echo $amount; ?></td>
      <td><?php echo $pickup_location; ?></td>
    </tr>
  </tbody>
</table>

    </div>
</body>
<style>
    .container {
        margin: 8em;
        place-content: center;
        justify-content: center;
        font: 16px;
    }

    .back {
        background-color: #8345F8;
        padding: 10px;
        border-radius: 1em;
        color: #fff;
        cursor: pointer;
    }

    .back:hover {
        background-color: #7798AB;
        color: white;
        text-decoration: none;
    }
</style>

</html>