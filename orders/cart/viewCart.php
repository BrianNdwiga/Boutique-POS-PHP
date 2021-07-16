<?php
// Initialize shopping cart class 
include_once 'Cart.class.php';
$cart = new Cart;
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

    <script>
        function updateCartItem(obj, id) {
            $.get("cartAction.php", {
                action: "updateCartItem",
                id: id,
                qty: obj.value
            }, function(data) {
                if (data == 'ok') {
                    location.reload();
                } else {
                    alert('Cart update failed, please try again.');
                }
            });
        }
    </script>
</head>

<body>
    <div class="card">
        <div class="card-header">
        <h2 style="text-align: center;">Shopping Cart</h2>
        </div>
        <div id="cardBody" class="card-body">
        <div class="container">
        <div class="row">
            <div class="cart">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="45%">Product</th>
                                    <th width="10%">Price</th>
                                    <th width="15%">Quantity</th>
                                    <th class="text-right" width="20%">Total</th>
                                    <th width="10%"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($cart->total_items() > 0) {
                                    // Get cart items from session 
                                    $cartItems = $cart->contents();
                                    foreach ($cartItems as $item) {
                                ?>
                                        <tr>
                                            <td><?php echo $item["name"]; ?></td>
                                            <td><?php echo '$' . $item["price"] . ' USD'; ?></td>
                                            <td><input class="form-control" type="number" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')" /></td>
                                            <td class="text-right"><?php echo '$' . $item["subtotal"] . ' USD'; ?></td>
                                            <td class="text-right"><button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')?window.location.href='cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>':false;"><i class="fa fa-trash"></i> </button> </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="5">
                                            <p>Your cart is empty.....</p>
                                        </td>
                                    <?php } ?>
                                    <?php if ($cart->total_items() > 0) { ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><strong>Cart Total</strong></td>
                                        <td class="text-right"><strong><?php echo '$' . $cart->total() . ' USD'; ?></strong></td>
                                        <td></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col mb-2">
                    <div class="row">
                        <div class="col-sm-12  col-md-6">
                            <a href="index.php" class="btn btn-block btn-light">Continue Shopping</a>
                        </div>
                        <div class="col-sm-12 col-md-6 text-right">
                            <?php if ($cart->total_items() > 0) { ?>
                                <a href="checkout.php" class="btn btn-lg btn-block btn-primary">Checkout</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
        <div class="card-footer">
            <a class="back" href="order.php">
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
