<?php

include('config.php');


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];
    $result = mysqli_query($db, 
    "SELECT order_id,customer_name, tel_number, added_date, o.product_name,order_quantity,order_date,(order_quantity*p.price) AS total_price FROM customer AS c JOIN orders As o JOIN product AS p ON phone_number= tel_number OR customer_name = client_name WHERE customer_id=" . $_GET['id'] );

    $row = mysqli_fetch_array($result);

    if ($row) {

        $id = $row['order_id'];
        $customer_name = $row['customer_name'];
        $phone_number = $row['tel_number'];
        $added_date = $row['added_date'];

        $product_name = $row['product_name'];
        $order_quantity = $row['order_quantity'];
        $order_date = $row['order_date'];
        $total_price = $row['total_price'];
    } else {
        echo "No results!";
    }
}
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>Edit Item</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <a class="back" href="customer.php">
            <i class="fas fa-arrow-left"></i>
            Back to Customers Page
        </a>
        <br>
        <h1 style="padding: 10px; text-align:center;"><?php echo $customer_name; ?>'s Orders</h1>
        <h2>Details</h2>
        <h4>Name : <?php echo $customer_name; ?></h4>
        <h4>Phone Number : <?php echo $phone_number; ?></h4>
        <h4>Created on : <?php echo $added_date; ?></h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Order Quantity</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Total Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><?php echo $id; ?></th>
                    <td><?php echo $product_name; ?></td>
                    <td><?php echo $order_quantity; ?></td>
                    <td><?php echo $order_date; ?></td>
                    <td><?php echo $total_price; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
<style>
    .container {
        padding: 30px;
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