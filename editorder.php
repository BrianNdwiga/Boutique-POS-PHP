<?php

include('config.php');

if (isset($_POST['editorder'])) {
    $id = $_POST['id'];
    $client_name = mysqli_real_escape_string($db, $_POST['client_name']);
    $tel_number = mysqli_real_escape_string($db, $_POST['tel_number']);
    $product_name = mysqli_real_escape_string($db, $_POST['product_name']);
    $order_quantity = mysqli_real_escape_string($db, $_POST['order_quantity']);
    $pickup_location = mysqli_real_escape_string($db, $_POST['pickup_location']);
    $order_date = mysqli_real_escape_string($db, $_POST['order_date']);

    mysqli_query($db, "UPDATE orders SET client_name='$client_name', tel_number='$tel_number' ,product_name='$product_name',order_quantity='$order_quantity',pickup_location='$pickup_location',order_date='$order_date' WHERE order_id='$id'");

    header("Location:order.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];
    $result = mysqli_query($db, "SELECT * FROM orders WHERE order_id=" . $_GET['id']);

    $row = mysqli_fetch_array($result);

    if ($row) {

        $id = $row['order_id'];
        $client_name = $row['client_name'];
        $tel_number = $row['tel_number'];
        $product_name = $row['product_name'];
        $order_quantity = $row['order_quantity'];
        $pickup_location = $row['pickup_location'];
        $order_date = $row['order_date'];
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
        <a class="back" href="table.php">
            <i class="fas fa-arrow-left"></i>
            Back to orders Page
        </a>
        <br>
        <h1 style="padding: 10px; text-align:center;">Edit Records</h1>
        <form method="post" action="editorder.php">
            <div class="form-group">
                <div class="form-row">
                <div class="form-group" style="display: none;">
                <input type="text" value="<?php echo $id; ?>" class="form-control mb-2 mr-sm-2" name="id">
                </div>
                <br>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Customer Name : </label>
                        <input type="text" class="form-control mb-2 mr-sm-2" value="<?php echo $client_name; ?>" name="client_name" id="client_name" min="1" max="" placeholder="Customer Name" required>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Customer Phone Number : </label>
                        <input type="tel" class="form-control mb-2 mr-sm-2" value="<?php echo $tel_number; ?>" name="tel_number" id="tel_number" min="1" max="" placeholder="Phone Number" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Product Name : </label>
                        <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" value="<?php echo $product_name; ?>" name="product_name" placeholder="Quantity" required>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label"> Quantity : </label>
                        <input type="number" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" value="<?php echo $order_quantity; ?>" name="order_quantity" placeholder="Quantity" required>
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