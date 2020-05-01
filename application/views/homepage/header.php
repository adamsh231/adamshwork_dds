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

    <!-- <style>
    *{border:1px solid red;}
    </style> -->

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
                            <ul id="nav">
                                <li <?php if ($title == "homepage") {
                                        echo "class='current-item'";
                                    } ?>><a href="<?php echo base_url() ?>index.php/DDS/index">Home</a></li>
                                <li><a href="<?php echo base_url() ?>index.php/DDS/index/hitungcepat">Hitung Cepat</a></li>
                                <li><a href="<?php echo base_url() ?>index.php/DDS/index/artikel">Materi Stunting</a></li>
                                <li><a href="<?php echo base_url() ?>index.php/DDS/index/">Video Stunting</a></li>

                                <!-- <li><a href="#">Pages</a>
                                    <ul class="dropdown">
                                        <li <?php if ($title == "homepage") {
                                                echo "class='current-item'";
                                            } ?>><a href="<?php echo base_url() ?>index.php/DDS/index">- Home</a></li>
                                        <li <?php if ($title == "about") {
                                                echo "class='current-item'";
                                            } ?>><a href="<?php echo base_url() ?>index.php/DDS/index/about">- About</a></li>
                                        <li <?php if ($title == "services") {
                                                echo "class='current-item'";
                                            } ?>><a href="<?php echo base_url() ?>index.php/DDS/index/services">- Services</a></li>
                                        <li <?php if ($title == "portofolio") {
                                                echo "class='current-item'";
                                            } ?>><a href="<?php echo base_url() ?>index.php/DDS/index/portofolio">- Portfolio</a></li>
                                        <li <?php if ($title == "portofolioSingle") {
                                                echo "class='current-item'";
                                            } ?>><a href="<?php echo base_url() ?>index.php/DDS/index/portofolioSingle">- Single Portfolio</a></li>
                                        <li <?php if ($title == "blog") {
                                                echo "class='current-item'";
                                            } ?>><a href="<?php echo base_url() ?>index.php/DDS/index/blog">- Blog</a></li>
                                        <li <?php if ($title == "singleBlog") {
                                                echo "class='current-item'";
                                            } ?>><a href="<?php echo base_url() ?>index.php/DDS/index/singleBlog">- Blog Details</a></li>
                                        <li <?php if ($title == "contact") {
                                                echo "class='current-item'";
                                            } ?>><a href="<?php echo base_url() ?>index.php/DDS/index/contact">- Contact</a></li>
                                        <li><a href="#">- Dropdown</a>
                                            <ul class="dropdown">
                                                <li><a href="#">- Dropdown Item</a></li>
                                                <li><a href="#">- Dropdown Item</a>
                                                    <ul class="dropdown">
                                                        <li><a href="#">- Even Dropdown</a></li>
                                                        <li><a href="#">- Even Dropdown</a></li>
                                                        <li><a href="#">- Even Dropdown</a></li>
                                                        <li><a href="#">- Even Dropdown</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">- Dropdown Item</a></li>
                                                <li><a href="#">- Dropdown Item</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li <?php if ($title == "portofolio") {
                                        echo "class='current-item'";
                                    } ?>><a href="<?php echo base_url() ?>index.php/DDS/index/portofolio">Portfolio</a></li>
                                <li <?php if ($title == "about") {
                                        echo "class='current-item'";
                                    } ?>><a href="<?php echo base_url() ?>index.php/DDS/index/about">About</a></li>
                                <li><a href="#">Blog</a>
                                    <ul class="dropdown">
                                        <li <?php if ($title == "blog") {
                                                echo "class='current-item'";
                                            } ?>><a href="<?php echo base_url() ?>index.php/DDS/index/blog">- Blog</a></li>
                                        <li <?php if ($title == "singleBlog") {
                                                echo "class='current-item'";
                                            } ?>><a href="<?php echo base_url() ?>index.php/DDS/index/singleBlog">- Blog Details</a></li>
                                    </ul>
                                </li>
                                <li <?php if ($title == "contact") {
                                        echo "class='current-item'";
                                    } ?>><a href="<?php echo base_url() ?>index.php/DDS/index/contact">Contact</a></li> -->
                            </ul>

                            <!-- Get A Quote -->
                            <div class="get-a-quote ml-4 mr-3">
                                <a href="<?php echo base_url() ?>index.php/DDS/index/login" class="btn uza-btn">Login</a>
                            </div>

                            <!-- Login / Register -->
                            <!-- <div class="login-register-btn mx-3">
                                <a href="<?php echo base_url() ?>index.php/DDS/index/login">Login <span>/ Register</span></a>
                            </div> -->

                            <!-- Search Icon -->
                            <div class="search-icon" data-toggle="modal" data-target="#searchModal">
                                <i class="icon_search"></i>
                            </div>
                        </div>
                        <!-- Nav End -->

                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->