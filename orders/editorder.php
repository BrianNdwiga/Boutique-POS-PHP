<?php

include('../config/config.php');

if (isset($_POST['editorder'])) {
    $id = $_POST['id'];
    $order_quantity = $_POST['order_quantity'];
    $product_name = mysqli_real_escape_string($db, $_POST['product_name']);
    $amount = mysqli_real_escape_string($db, $item_price = $item["order_quantity"] * $item["price"]);
    $pickup_location = mysqli_real_escape_string($db, $_POST['pickup_location']);
    $order_date = mysqli_real_escape_string($db, $_POST['order_date']);

    mysqli_query($db, "UPDATE orders o JOIN order_details od SET od.order_quantity='$order_quantity',product_id='$product_name',pickup_location='$pickup_location',order_date='$order_date' WHERE o.order_id='$id' AND WHERE od.order_id = '$id");

    header("Location:order.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];
    $result = mysqli_query($db, "SELECT o.order_id,product_name,p.product_id,pickup_location,price,order_quantity,amount,order_date,served_by,customer_name FROM order_details AS od JOIN orders AS o ON o.order_id= od.order_id JOIN product AS p ON p.product_id=od.product_id JOIN customer AS c ON c.customer_id = o.customer_id AND o.order_id = " . $_GET['id']);

    $row = mysqli_fetch_array($result);

    if ($row) {

        $id = $row['order_id'];
        $customer_name = $row['customer_name'];
        $product_name = $row['product_name'];
        $order_quantity = $row['order_quantity'];
        $price = $row['price'];
        $amount = $row['amount'];
        $order_date = $row['order_date'];
        $pickup_location = $row['pickup_location'];
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
        <a class="back" href="order.php">
            <i class="fas fa-arrow-left"></i>
            Back to orders Page
        </a>
        <br>
        <h1 style="padding: 10px; text-align:center;">Edit Records</h1>
        <form method="post" action="editorder.php">
            <div class="form-group">
            <div class="form-group" style="display: none;">
                <input type="text" value="<?php echo $id; ?>" class="form-control mb-2 mr-sm-2" name="id">
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Customer Name : </label>
                        <input type="text" class="form-control mb-2 mr-sm-2" value="<?php echo $customer_name; ?>" name="client_id" id="customer_name" min="1" max="" placeholder="Customer Name" required readonly>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Product Name : </label>
                        <select class="form-control" name="product_name" required>
                                        <option disabled selected value="<?php echo $product_id; ?>"> <?php echo $product_name; ?> </option>
                                        <?php
                                        $records = mysqli_query($db, "SELECT product_name,product_id,quantity FROM product");

                                        while ($data = mysqli_fetch_array($records)) {
                                            echo "<option value='" . $data['product_id'] . "'>" . $data['product_name'] . " Remaining - ". $data['quantity'] . "</option>";  // displaying data in option menu
                                        }
                                        ?>
                                    </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label"> Order Quantity : </label>
                        <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" value="<?php echo $order_quantity; ?>" name="order_quantity" placeholder="order_quantity" required>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label"> Amount : </label>
                        <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" value="<?php echo $price*$order_quantity; ?>" name="amount" placeholder="Amount" required readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Pickup Location : </label>
                        <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" value="<?php echo $pickup_location; ?>" name="pickup_location" placeholder="Quantity" required>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Order Date : </label>
                        <input type="date" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" value="<?php echo $order_date; ?>" name="order_date" id="order_date" min="1" max="" placeholder="Order Date" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-info btn-lg btn-block mb-2" name="editorder"> Edit Order </button>
        </form>
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