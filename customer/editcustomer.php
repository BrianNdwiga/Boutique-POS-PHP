<?php

include('../config/config.php');

if (isset($_POST['editcustomer'])) {
    $id = $_POST['id'];
    $customer_name = mysqli_real_escape_string($db, $_POST['customer_name']);
    $phone_number = mysqli_real_escape_string($db, $_POST['phone_number']);
    $added_date = mysqli_real_escape_string($db, $_POST['added_date']);

    mysqli_query($db, "UPDATE customer SET customer_name='$customer_name', phone_number='$phone_number' ,added_date='$added_date' WHERE customer_id='$id'");

    header("Location:customer.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];
    $result = mysqli_query($db, "SELECT * FROM customer WHERE customer_id=" . $_GET['id']);

    $row = mysqli_fetch_array($result);

    if ($row) {

        $id = $row['customer_id'];
        $customer_name = $row['customer_name'];
        $phone_number = $row['phone_number'];
        $added_date = $row['added_date'];
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
        <a class="back" href="../customer/customer.php">
            <i class="fas fa-arrow-left"></i>
            Back to Customers Page
        </a>
        <br>
        <h1 style="padding: 10px; text-align:center;">Edit Records</h1>
        <form method="post" action="editcustomer.php">
            <div class="form-group">
                <input class="form-control" type="hidden" name="id" value="<?php echo $id; ?>">
                <label class="form-check-label" for="inlineFormCheck">
                   Customer Name :
                </label>
                <input type="text" name="customer_name" class="form-control" value="<?php echo $customer_name; ?>" />
                <label class="form-check-label" for="inlineFormCheck">
                    Phone Number :
                </label>
                <input type="text" name="phone_number" class="form-control" value="<?php echo $phone_number ?>" />
                <label class="form-check-label" for="inlineFormCheck">
                    Added Date :
                </label>
                <input type="date" name="added_date" class="form-control" value="<?php echo $added_date; ?>" />
                <br>
                <button type="submit" class="btn btn-lg btn-block btn-info" name="editcustomer">Edit Records</button>
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