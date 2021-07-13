<?php

include('../config/config.php');

if (isset($_POST['editcustomer'])) {
    $id = $_POST['id'];
    $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $created = mysqli_real_escape_string($db, $_POST['created']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $address = mysqli_real_escape_string($db, $_POST['address']);

    mysqli_query($db, "UPDATE customers SET first_name='$first_name',last_name='$last_name', phone='$phone' ,created='$created',email='$email',address='$address' WHERE id='$id'");

    header("Location:customer.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];
    $result = mysqli_query($db, "SELECT * FROM customers WHERE id=" . $_GET['id']);

    $row = mysqli_fetch_array($result);

    if ($row) {

        $id = $row['id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $phone = $row['phone'];
        $email = $row['email'];
        $created = $row['created'];
        $address = $row['address'];
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
                <div class="form-row">
                    <div class="col-6">
                        <label class="form-check-label" for="inlineFormCheck">
                            First Name :
                        </label>
                        <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>" />
                    </div>
                    <div class="col-6">
                        <label class="form-check-label" for="inlineFormCheck">
                            Last Name :
                        </label>
                        <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-check-label" for="inlineFormCheck">
                            Phone Number :
                        </label>
                        <input type="tel" name="phone" class="form-control" value="<?php echo $phone ?>" />
                    </div>
                    <div class="col-6">
                        <label class="form-check-label" for="inlineFormCheck">
                            Address :
                        </label>
                        <input type="address" name="address" class="form-control" value="<?php echo $address; ?>" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label class="form-check-label" for="inlineFormCheck">
                            Email :
                        </label>
                        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" readonly />
                    </div>
                    <div class="col-6">
                        <label class="form-check-label" for="inlineFormCheck">
                            Date :
                        </label>
                        <input type="text" name="created" class="form-control" value="<?php echo $created; ?>" readonly />
                    </div>
                </div>
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

    .form-check-label {
        padding: 10px;
    }
</style>

</html>