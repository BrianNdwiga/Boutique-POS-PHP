<?php

include('config.php');


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];
    $result = mysqli_query($db, "SELECT * FROM customer JOIN orders ON phone_number= tel_number OR customer_name = client_name WHERE customer_id=" . $_GET['id'] );

    $row = mysqli_fetch_array($result);

    if ($row) {

        $id = $row['order_id'];
        $customer_name = $row['customer_name'];
        $product_name = $row['product_name'];
        $quantity = $row['quantity'];
        $order_date = $row['order_date'];
        $order_price = $row['order_price'];
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
            Back to Products Page
        </a>
        <br>
        <h1 style="padding: 10px; text-align:center;"><?php echo $customer_name; ?>'s Orders</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Date Added</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Order Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><?php echo $id; ?></th>
                    <td><?php echo $product_name; ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td><?php echo $order_date; ?></td>
                    <td><?php echo $order_price; ?></td>
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