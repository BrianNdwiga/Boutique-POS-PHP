<?php
include('../../config/config.php');

?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
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
        <h2 style="text-align: center;">Add Products to Cart</h2>
        </div>
        <div id="cardBody" class="card-body">
                <?php
                include('./index.php');
                ?>
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