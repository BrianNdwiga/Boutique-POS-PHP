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

<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Point of Sale System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.ico">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/product/bootstrap.min.css">
    <link rel="stylesheet" href="product/../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->

    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.php">
                        <h2 style="color: white;">P.O.S.</h2>
                    </a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                    <ul class="metismenu" id="menu">
                            <li>
                                <a href="../index.php" aria-expanded="true"><i class="ti-dashboard"></i><span>Home</span></a>
                            </li>
                            <li>
                                <a href="../orders/order.php" aria-expanded="true"><i class="fa fa-shopping-cart"></i>
                                    <span>Orders</span></a>
                            </li>
                            <li  class="active">
                                <a href="../product/product.php" aria-expanded="true"><i class="fa fa-table"></i>
                                    <span>Item Records</span></a>
                            </li>
                            <li>
                                <a href="../customer/customer.php" aria-expanded="true"><i class="ti-user"></i><span>Customers</span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div>
                    </div>

                    <!-- profile info & task notification-->
                    <div class="col-md-6 col-sm-4 clearfix">

                    </div>
                </div>
            </div>

            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.php">Home</a></li>
                                <li><a href=""><span>Item Records</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="../assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['username']; ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="index.php?logout='1'">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="container">

                <h1 style="text-align:center">Add Item Here</h1>

                <body class="col-lg-12">
                    <form method="POST" class="form-inline" action="./additem.php" style="align-items: center; justify-content: center;">
                        <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="product_name" placeholder="product_name" required>
                        <input type="number" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="price" placeholder="price" required>
                        <input type="number" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="quantity" id="quantity" min="1" max="" placeholder="Quantity" required>
                        <button type="submit" class="btn btn-primary mb-2" name="add"><i class="fas fa-plus"></i> Add item</button>
                    </form>

                </body>
                <div class="main-content-inner">
                    <div class="row">

                        <!-- Contextual Classes start -->
                        <div class="col-lg-12 ">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Products</h4>
                                    <div class="single-table">
                                        <div class="table-responsive">
                                            <table class="table text-dark text-center">
                                                <thead class="text-uppercase">
                                                    <tr class="table-active">
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Quantity</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $conn = new mysqli("localhost", "root", "", "inventorymanagement");
                                                    $sql = "SELECT * FROM `product`;";
                                                    $result = $conn->query($sql);
                                                    $count = 0;
                                                    if ($result->num_rows >  0) {

                                                        while ($row = $result->fetch_assoc()) {
                                                            $count = $count + 1;
                                                    ?>
                                                            <tr>
                                                                <th><?php echo $count ?></th>
                                                                <th><?php echo $row["product_name"] ?></th>
                                                                <th><?php echo $row["price"]  ?></th>
                                                                <th><?php echo $row["quantity"]  ?></th>
                                                                <th>
                                                                    <a href="up" Edit</a><a href="../product/editproduct.php?id=<?php echo $row["product_id"] ?>" style="color:#7798AB; padding-right: 10px"><i class="fas fa-edit"></i> Edit </a>
                                                                    <a href="up" Edit</a><a href="../product/deleteproduct.php?id=<?php echo $row["product_id"] ?>" style="color:red;"><i class="fas fa-trash-alt"></i> Delete</a>
                                                                </th>
                                                            </tr>
                                                    <?php

                                                        }
                                                    }

                                                    ?>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                            </div>
                        </div>
                        <html>

                        <head>
                            <title>Add Item</title>
                            <link rel="stylesheet" type="text/css" href="style.css">
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
                        </head>

                        </html>
                    </div>
                    <!-- page container area end -->
                    <!-- offset area start -->

                    <!-- offset area end -->
                    <!-- jquery latest version -->
                    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
                    <!-- bootstrap 4 js -->
                    <script src="../assets/js/popper.min.js"></script>
                    <script src="../assets/js/bootstrap.min.js"></script>
                    <script src="../assets/js/owl.carousel.min.js"></script>
                    <script src="../assets/js/metisMenu.min.js"></script>
                    <script src="../assets/js/jquery.slimscroll.min.js"></script>
                    <script src="../assets/js/jquery.slicknav.min.js"></script>

                    <!-- others plugins -->
                    <script src="../assets/js/plugins.js"></script>
                    <script src="../assets/js/scripts.js"></script>
</body>
<style>
    th {
        text-align: center;
    }

    a:hover {
        text-decoration: none;
    }

    .user-profile {
        border-radius: 0.8em;
    }
</style>

</html>