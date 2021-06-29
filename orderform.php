<?php
include('config.php');

$conn = new mysqli("localhost", "root", "", "inventorymanagement");
$sql = "SELECT customer_name,product_name,phone_number FROM product, customer ";
$result = $conn->query($sql);

if ($result->num_rows >  0) {


    while ($row = $result->fetch_assoc()) {
        $customer_name = $row['customer_name'];
        $product_name = $row['product_name'];
        $phone_number = $row['phone_number'];
    }
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>Add Customer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <a class="back" href="order.php">
            <i class="fas fa-arrow-left"></i>
            Back to Orders Page
        </a>
        <br>
        <h3 style="padding: 10px; text-align:center;">Add Orders</h3>
        <form method="post" action="makeorder.php">
            <div class="form-group">
                <div class="form-row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Customer Name : </label>
                        <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="client_name" id="client_name" min="1" max="" placeholder="Customer Name" required>
                        <datalist id="datalistOptions">
                            <option value="<?php echo $customer_name; ?>">
                        </datalist>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Customer Phone Number : </label>
                        <input type="tel" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="tel_number" id="phone_number" min="1" max="" placeholder="Phone Number" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Product Name : </label>
                        <select class="custom-select" aria-label="Default select example" name="product_name">
                            <option selected>Open this select menu</option>
                            <option value="<?php echo $product_name; ?>"><?php echo $product_name; ?></option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label"> Quantity : </label>
                        <input type="number" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="quantity" placeholder="Quantity" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Order Price : </label>
                        <input type="number" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="order_price" placeholder="Order Price" required>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Order Date : </label>
                        <input type="date" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="order_date" id="order_date" min="1" max="" placeholder="Order Date" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-info btn-lg btn-block mb-2" name="makeOrder"> Make Order </button>
        </form>
    </div>
</body>
<style>
    .container {
        padding: 80px;
        place-content: center;
        justify-content: center;
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