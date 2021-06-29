<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['first_name']);
    unset($_SESSION['last_name']);
    header("location: table.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="Inventmng/srtdash/assets/bootstrap.min.css">
</head>

<body>

    <div class="content">
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="error success">
                <h3>
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>

        <!-- logged in user information -->

    </div>
    <script>
        src = "srtdash/assets/js/vendor/jquery-2.2.4.min.js"
    </script>
    <script>
        src = "srtdash/assets/js/vendor/modernizr-2.8.3.min.js"
    </script>
</body>

</html>



<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>srtdash - ICO Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu" style="width: 20%;">
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
                            <li class="active">
                                <a href="index.php" aria-expanded="true"><i class="ti-dashboard"></i><span>Home</span></a>
                            </li>
                            <li>
                                <a href="order.php" aria-expanded="true"><i class="fa fa-table"></i>
                                    <span>Orders</span></a>
                            </li>
                            <li>
                                <a href="table.php" aria-expanded="true"><i class="fa fa-table"></i>
                                    <span>Item Records</span></a>
                            </li>
                            <li>
                                <a href="customer.php" aria-expanded="true"><i class="ti-user"></i><span>Customers</span></a>
                            </li>
                        </ul>
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
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['username'] ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">

                                <a class="dropdown-item" href="index.php?logout='1'">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div>

                <?php if (isset($_SESSION['first_name'])) : ?>
                    <h2 style="text-align:center; padding: 10px;"> Welcome, <strong><?php echo $_SESSION['first_name'];
                                                                                    echo " ";
                                                                                    echo $_SESSION['last_name']; ?></strong></h2>

                <?php endif ?>
                <div class="fill">
                    <ul class="card-wrapper">
                        <a href="table.php">
                            <li class="card">
                                <img src='https://images.unsplash.com/photo-1479064555552-3ef4979f8908?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mzd8fHByb2R1Y3RzfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' alt=''>
                                <h3 style="text-align: center;">Products</h3>
                            </li>
                        </a>
                            <li class="card">
                                <img src='https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTN8fGhhcHB5JTIwY3VzdG9tZXJ8ZW58MHx8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' alt=''>
                                <h3 style="text-align: center;"><a href="">Customers</a></h3>
                            </li>
                            <li class="card">
                                <img src='https://images.unsplash.com/photo-1499083097717-a156f85f0516?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NDR8fGN1c3RvbWVyc3xlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80' alt=''>
                                <h3 style="text-align: center;"><a href="">Orders</a></h3>
                            </li>
                    </ul>
                </div>
            </div>



        </div>

        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright Partho Bala. All right reserved. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
    <div class="offset-area">
        <div class="offset-close"><i class="ti-close"></i></div>
        <ul class="nav offset-menu-tab">
            <li><a class="active" data-toggle="tab" href="#activity">Activity</a></li>
            <li><a data-toggle="tab" href="#settings">Settings</a></li>
        </ul>


        <!-- offset area end -->
        <!-- jquery latest version -->
        <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
        <!-- bootstrap 4 js -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script>
        <script src="assets/js/jquery.slicknav.min.js"></script>

        <!-- start chart js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
        <!-- start highcharts js -->
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <!-- start zingchart js -->
        <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
        <script>
            zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
            ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
        </script>
        <!-- all line chart activation -->
        <script src="assets/js/line-chart.js"></script>
        <!-- all pie chart -->
        <script src="assets/js/pie-chart.js"></script>
        <!-- others plugins -->
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/scripts.js"></script>
</body>
<style>
    .card {
        --card-gradient: rgba(0, 0, 0, 0.8);
        --card-gradient: #5e9ad9, #e271ad;
        --card-blend-mode: overlay;
        background-color: #fff;
        border-radius: 0.5rem;
        box-shadow: 0.05rem 0.1rem 0.3rem -0.03rem rgba(0, 0, 0, 0.45);
        padding-bottom: 1rem;
        background-image: linear-gradient(var(--card-gradient), white max(9.5rem, 27vh));
        overflow: hidden;
    }

    .card img {
        border-radius: 0.5rem 0.5rem 0 0;
        width: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        max-height: max(10rem, 30vh);
        aspect-ratio: 4/3;
        mix-blend-mode: var(--card-blend-mode);
    }

    .card img~* {
        margin-left: 1rem;
        margin-right: 1rem;
    }

    .card> :last-child {
        margin-bottom: 0;
    }

    .card:hover,
    .card:focus-within {
        --card-gradient: #24a9d5 max(8.5rem, 20vh);
    }

    /* Additional demo display styles */
    * {
        box-sizing: border-box;
    }

    .fill {
        display: grid;
        justify-items: center;
        margin: 1rem;
        padding: 1rem;
        line-height: 1.5;
        font-family: -apple-system, BlinkMacSystemFont, avenir next, avenir, helvetica neue, helvetica, Ubuntu, roboto, noto, segoe ui, arial, sans-serif;
        color: #444;
        background-color: #F3F8FB;
    }

    .card h3 {
        margin-top: 1rem;
        font-size: 1.25rem;
    }

    .card a {
        color: inherit;
    }

    .card-wrapper {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(30ch, 1fr));
        grid-gap: 1.5rem;
        max-width: 100vw;
        width: 120ch;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .user-profile {
        border-radius: 0.8em;
    }
</style>

</html>