<?php
if (!isset($_REQUEST['id'])) {
    header("Location: index.php");
}

// Include the database config file 
require_once 'dbConfig.php';

// Fetch order details from database 
$result = $db->query("SELECT r.*, c.first_name, c.last_name, c.email, c.phone FROM orders as r LEFT JOIN customers as c ON c.id = r.customer_id WHERE r.id = " . $_REQUEST['id']);

if ($result->num_rows > 0) {
    $orderInfo = $result->fetch_assoc();
} else {
    header("Location: index.php");
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>Make Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h2 style="text-align: center;">Order Status</h2>
        </div>
        <div id="cardBody" class="card-body">
            <div class="container">
                <div class="col-12">
                    <?php if (!empty($orderInfo)) { ?>
                        <div class="col-md-12">
                            <div class="alert alert-success">Your order has been placed successfully.</div>
                        </div>
                        <div class="hdr" style="padding-left: 20px;">
                            <h4>Order Info : </h4>
                        </div>
                        <!-- Order status & shipping info -->
                        <div class="row"  style="padding: 15px;">
                            <div class="col-lg-6 ord-addr-info">
                                <p><b>Reference ID: </b> #<?php echo $orderInfo['id']; ?></p>
                                <p><b>Total: </b> <?php echo '$' . $orderInfo['grand_total'] . ' USD'; ?></p>
                                <p><b>Placed On: </b> <?php echo $orderInfo['created']; ?></p>
                            </div>

                            <div class="col-lg-6 ord-addr-info">
                                <p><b>Buyer Name: </b> <?php echo $orderInfo['first_name'] . ' ' . $orderInfo['last_name']; ?></p>
                                <p><b>Email: </b> <?php echo $orderInfo['email']; ?></p>
                                <p><b>Phone: </b> <?php echo $orderInfo['phone']; ?></p>
                            </div>

                        </div>
                        <!-- Order items -->
                        <div class="row col-lg-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>QTY</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Get order items from the database 
                                    $result = $db->query("SELECT i.*, p.name, p.price FROM order_items as i LEFT JOIN products as p ON p.id = i.product_id WHERE i.order_id = " . $orderInfo['id']);
                                    if ($result->num_rows > 0) {
                                        while ($item = $result->fetch_assoc()) {
                                            $price = $item["price"];
                                            $quantity = $item["quantity"];
                                            $sub_total = ($price * $quantity);
                                    ?>
                                            <tr>
                                                <td><?php echo $item["name"]; ?></td>
                                                <td><?php echo '$' . $price . ' USD'; ?></td>
                                                <td><?php echo $quantity; ?></td>
                                                <td><?php echo '$' . $sub_total . ' USD'; ?></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-12">
                            <div class="alert alert-danger">Your order submission failed.</div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a class="back" href="../order.php">
                <i class="fas fa-arrow-left"></i>
                Back to Orders Page
            </a>
        </div>
    </div>
</body>

<style>
    body {
        background: #E8EBF5;
        flex: 1;
        align-items: center;
        justify-content: center;
        margin: 0;
        padding: 25px;
    }

    .card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 5px rgba(255, 255, 255, 0.04588);
    }

    .card-header {
        padding: 20px;
        border-bottom: 1px solid #d5d0d0;
    }

    .card-body {
        padding: 16px;
        min-height: 250px;
        justify-items: center;
        align-items: center;
    }

    .back {
        background-color: #8345F8;
        padding: 10px;
        border-radius: 5px;
        float: left;
        color: #fff;
        cursor: pointer;
    }

    .back:hover {
        background-color: #7798AB;
        color: white;
        text-decoration: none;
    }

    @media only screen and (max-width: 420px) {
        .card-footer button {
            width: 100%;
        }
    }
</style>


</html>