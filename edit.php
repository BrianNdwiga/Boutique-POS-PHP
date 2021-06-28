<?php

include('config.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($db, $_POST['product_name']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $quant = mysqli_real_escape_string($db, $_POST['quantity']);

    mysqli_query($db, "UPDATE product SET product_name='$name', price='$price' ,quantity='$quant' WHERE product_id='$id'");

    header("Location:table.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];
    $result = mysqli_query($db, "SELECT * FROM product WHERE product_id=" . $_GET['id']);

    $row = mysqli_fetch_array($result);

    if ($row) {

        $id = $row['product_id'];
        $name = $row['product_name'];
        $price = $row['price'];
        $quant = $row['quantity'];
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
            Back to Products Page
        </a>
        <br>
        <h1 style="padding: 10px; text-align:center;">Edit Records</h1>
        <form method="post" action="edit.php">
            <div class="form-group">
                <input class="form-control" type="hidden" name="id" value="<?php echo $id; ?>">
                <label class="form-check-label" for="inlineFormCheck">
                    Name:
                </label>
                <input type="text" name="product_name" class="form-control" value="<?php echo $name; ?>" />
                <label class="form-check-label" for="inlineFormCheck">
                    Price:
                </label>
                <input type="text" name="price" class="form-control" value="<?php echo $price ?>" />
                <label class="form-check-label" for="inlineFormCheck">
                    Quantity
                </label>
                <input type="text" name="quantity" class="form-control" value="<?php echo $quant; ?>" />
                <br>
                <button type="submit" class="btn btn-lg btn-block btn-info" name="submit">Edit Records</button>
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