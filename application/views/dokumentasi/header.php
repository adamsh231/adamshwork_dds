<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Deteksi Dini Stunting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>DDS - <?php echo strtoupper($title) ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>loginv2/images/icons/download.png" />

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url() ?>uza/style.css">
    <link href="<?php echo base_url(); ?>sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <style>
        * {
            /* border: 1px solid red; */
        }
    </style>

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="wrapper">
            <div class="cssload-loader"></div>
        </div>
    </div>

    <!-- ***** Top Search Area Start ***** -->
    <div class="top-search-area">
        <!-- Search Modal -->
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <!-- Close Button -->
                        <button type="button" class="btn close-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                        <!-- Form -->
                        <form action="index.html" method="post">
                            <input type="search" name="top-search-bar" class="form-control" placeholder="Search and hit enter...">
                            <button type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Top Search Area End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area">
        <!-- Main Header Start -->
        <div class="main-header-area">
            <div class="classy-nav-container breakpoint-off">
                <!-- Classy Menu -->
                <nav class="classy-navbar justify-content-between" id="uzaNav">

                    <!-- Logo -->
                    <a class="nav-brand" href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>uza/img/core-img/baby-girl.png" alt=""></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">
                        <!-- Menu Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <!-- Get A Quote -->
                            <div class="<?php if ($title == "superadmin") {
                                            echo "btn uza-btn btn-2";
                                        } ?> get-a-quote ml-4 mr-3">
                                <a href="<?php echo base_url() ?>index.php/DDS/index/superadmin" class="btn uza-btn <?php if ($title == "superadmin") {
                                                                                                                        echo "disabled";
                                                                                                                    } ?>">Super Admin</a>
                            </div>

                            <!-- Get A Quote -->
                            <div class="<?php if ($title == "admin") {
                                            echo "btn uza-btn btn-2";
                                        } ?> get-a-quote ml-4 mr-3">
                                <a href="<?php echo base_url() ?>index.php/DDS/index/admin" class="btn uza-btn <?php if ($title == "admin") {
                                                                                                                    echo "disabled";
                                                                                                                } ?>">Admin</a>
                            </div>

                            <!-- Get A Quote -->
                            <div class="<?php if ($title == "user") {
                                            echo "btn uza-btn btn-2";
                                        } ?> get-a-quote ml-4 mr-3">
                                <a href="<?php echo base_url() ?>index.php/DDS/index/user" class="btn uza-btn <?php if ($title == "user") {
                                                                                                                    echo "disabled";
                                                                                                                } ?>">User</a>
                            </div>

                            <!-- Get A Quote -->
                            <div class="ml-3 mr-4">
                                <a href="<?php echo base_url() ?>" class="btn uza-btn btn-3">Halaman Utama</a>
                            </div>

                        </div>
                        <!-- Nav End -->

                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->