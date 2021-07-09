<?php
include('../config/config.php');

$conn = new mysqli("localhost", "root", "", "inventorymanagement");
$sql = "SELECT DISTINCT c.customer_name,c.customer_id,p.product_name,c.phone_number,p.price FROM product As p, customer AS c, orders As o";
$result = $conn->query($sql);
// $option = '';

if ($result->num_rows >  0) {
    while ($row = $result->fetch_assoc()) {
        // $customer_name = $row['customer_name'];
        $product_name = $row['product_name'];
        $phone_number = $row['phone_number'];
        $product_name = $row['product_name'];
        // $option = '<option value = "' . $row['customer_id'] . '">' . $row['customer_name'] . '</option>';
    }
}
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
            <div class="steps">
                <div class="step active">
                    <span>
                        1
                    </span>
                </div>
                <div class="step">
                    <span>
                        2
                    </span>
                </div>
            </div>
        </div>
        <div id="cardBody" class="card-body">
            <div class="tabs">
                <div id="first" class="tab">
                    <h3 style="padding: 10px; text-align:center;">Add Orders</h3>
                    <p id="successMessage">You submitted the form, good job!</p>
                    <form method="post" id="theForm" action="makeorder.php" target="_blank">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-group">
                                    <input type="hidden" value="<?php echo $_SESSION['username'] ?>" class="form-control mb-2 mr-sm-2" name="served_by">
                                </div>
                                <br>
                                <div class="col">
                                    <label for="exampleFormControlInput1" class="form-label">Customer Name : </label>
                                    <select class="form-control" name="customer_id">
                                        <option disabled selected>-- Select Customer --</option>
                                        <?php
                                        $records = mysqli_query($db, "SELECT customer_name,customer_id From customer");  // Use select query here 

                                        while ($data = mysqli_fetch_array($records)) {
                                            echo "<option value='" . $data['customer_id'] . "'>" . $data['customer_name'] . "</option>";  // displaying data in option menu
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <label for="exampleFormControlInput1" class="form-label">Pickup Location : </label>
                                    <select class="custom-select" id="inputGroupSelect01" name="pickup_location">
                                        <option selected>Choose pickup location...</option>
                                        <option value="Nairobi CBD">Nairobi CBD</option>
                                        <option value="Nakuru">Nakuru</option>
                                        <option value="Kikuyu">Kikuyu</option>
                                        <option value="Thika">Thika</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlInput1" class="form-label">Order Date : </label>
                                    <input type="date" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="order_date" id="order_date" min="1" max="" placeholder="Order Date" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-lg btn-block mb-2" name="makeOrder"> Make Order </button>
                    </form>
                </div>
            </div>
            <div id="second" class="tab">
                <?php
                include('cart.php');
                ?>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-info" id="prevBtn" onclick="next(-1)">Prev</button>
            <button class="btn btn-info" id="nextBtn" onclick="next(1)">Next</button>

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

    .card-header .steps {
        display: flex;
        column-count: 3;
        justify-content: center;
        align-items: center;
    }

    .card-header .steps .step {
        width: 100%;
        text-align: center;
        border-bottom: 1px solid #877cdf;
        line-height: 0.1em;
        margin: 10px 0 20px;
    }

    .card-header .steps .step span {
        padding: 10px 16px;
        border: 1px solid #877cdf;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0px 3px 0px 0px #877cdf;
    }

    .card-header .steps .step.active span {
        background: #A98BF9;
        color: white;
        border: 1px solid #A98BF9;
    }

    .card-body {
        padding: 16px;
        min-height: 250px;
        justify-items: center;
        align-items: center;
    }

    .card-body .tabs {
        width: 100%;
        height: 100%;
        justify-content: center;
        display: flex;
        align-items: center;
    }

    .card-body .tabs .tab {
        display: none;
    }

    .card-body .tabs .tab.active {
        display: block !important;
    }

    .card-footer {
        padding: 16px;
        border-top: 1px solid #d5d0d0;
    }

    .card-footer button {
        border-radius: 5px;
        padding: 15px 25px;
        width: 150px;
        margin: 10px auto;
        border: none;
        font-weight: 500;
        font-size: 16px;
    }

    .card-footer button:active {
        outline: none;
        transform: translate(0px, 5px);
        -webkit-transform: translate(0px, 5px);
        box-shadow: 0px 1px 0px 0px;
    }

    .back {
        background-color: #8345F8;
        padding: 10px;
        border-radius: 5px;
        float: right;
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
<script>
    var currentTab = 0;

    showTab(currentTab);

    function showTab(n) {


        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";

        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        fixStepIndicator(n)
    }

    function next(n) {
        var x = document.getElementsByClassName("tab");

        x[currentTab].style.display = "none";

        currentTab = currentTab + n;

        if (currentTab >= x.length) {

            return false;
        }

        showTab(currentTab);
    }

    function fixStepIndicator(n) {

        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }

        x[n].className += " active";
    }

    // on form submit
    var theSubmitButton = document.getElementById('formSubmit');

    theSubmitButton.onclick = function() {
        var theFormItself =
            document.getElementById('theForm');
        theFormItself.style.display = 'none';
        var theSuccessMessage =
            document.getElementById('successMessage');
        theSuccessMessage.style.display = 'block';
    }
</script>

</html>