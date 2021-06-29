<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>Add Customer</title>
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
        <h1 style="padding: 10px; text-align:center;">Add Customers</h1>
        <form method="post" action="addcustomer.php">
            <div class="form-group">
                <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="customer_name" placeholder="Customer Name" required>
                <input type="tel" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="phone_number" id="phone" min="1" max="" placeholder="Phone Number" required>
                <input type="date" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="added_date" placeholder="Date" required>
                <button type="submit" class="btn btn-info btn-lg btn-block mb-2" name="addCustomer"> Add Customer</button>
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