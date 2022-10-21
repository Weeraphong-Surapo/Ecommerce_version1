<?php
if (!isset($_SESSION)) {
    session_start();
}
include "function/connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/chosen.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.0.46/css/materialdesignicons.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/color-01.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <style>
    #img_category {
        height: 210px !important;
    }

    .border {
        border: 1px solid red;
        padding: 15px;
    }

    .page-item .page:hover {
        background-color: red;
        color: white;
    }

    #img_show {
        height: 370px !important;
    }

    #img_show_index {
        width: 100% !important;
    }

    #cart_img {
        max-width: 100px !important;
        height: 100px !important;
    }

    #img_online {
        width: 70px !important;
        height: 70px !important;
    }

    #img-show-cart {
        width: 100px;
    }
    </style>
</head>

<body class="home-page home-01 ">

    <!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>

    <!--header-->
    <header id="header" class="header header-style-1">
        <div class="container-fluid">
            <div class="row">
                <div class="topbar-menu-area">
                    <div class="container">
                        <div class="topbar-menu left-menu">
                            <ul>
                                <li class="menu-item">
                                    <a title="Hotline: (+123) 456 789" href="#"><span
                                            class="icon label-before fa fa-mobile"></span>เบอร์โทร: (092-556-2767)</a>
                                </li>
                            </ul>
                        </div>
                        <?php if (!isset($_SESSION['login'])) { ?>
                        <div class="topbar-menu right-menu">
                            <ul>
                                <li class="menu-item"><a title="Register or Login" href="login.php">เข้าสู่ระบบ</a>
                                </li>
                                <li class="menu-item"><a title="Register or Login" href="register.php">สมัครสมาชิก</a>
                                </li>
                            </ul>
                        </div>
                        <?php } else { ?>
                        <div class="topbar-menu right-menu">
                            <ul>
                                <li class="menu-item">สวัสดีคุณ :
                                    <?= isset($_SESSION['name']) ? $_SESSION['name'] : ""; ?></li>
                                <li class="menu-item"><a title="logout" href="function/logout.php"> /
                                        &nbsp;&nbsp;&nbsp;&nbsp;ออกจากระบบ</a>
                                </li>
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="container">
                    <div class="mid-section main-info-area">

                        <div class="wrap-logo-top left-section">
                            <a href="index.php" class="link-to-home"><img src="assets/images/logo_shop.png"
                                    alt="mercado"></a>
                        </div>

                        <div class="wrap-search center-section">
                            <div class="wrap-search-form">
                                <form action="shop.php" id="form-search-top" method="get">
                                    <input type="text" name="search" placeholder="ค้นหาสินค้า">
                                    <button form="form-search-top" type="submit"><i class="fa fa-search"
                                            aria-hidden="true"></i></button>
                                    <?php if (!isset($_GET['category_id'])) { ?>
                                    <div class="wrap-list-cate">
                                        <a href="" class="link-control">ประเภทสินค้า</a>
                                        <ul class="list-cate">
                                            <li class="level-0">ประเภทสินค้าทั้งหมด</li>
                                            <?php
                                                $sql = "SELECT * FROM tb_category";
                                                $result = mysqli_query($con, $sql);
                                                foreach ($result as $data) {
                                                ?>
                                            <a href="category_show.php?category_id=<?= $data['id']; ?>">
                                                <li class="level-1"><?= $data['category_name'] ?>
                                                </li>
                                            </a>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>

                        <div class="wrap-icon right-section">
                            <div class="wrap-icon-section wishlist">
                                <a href="like.php" class="link-direction">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                    <div class="left-info">
                                        <?php
                                        $count_like = 0;
                                        if (isset($_SESSION['shopping_like'])) {
                                            $count_like = count($_SESSION['shopping_like']);
                                        } ?>
                                        <span class="index"><?= $count_like; ?> ชิ้น</span>
                                        <span class="title">สิ่งที่ชอบ</span>
                                    </div>
                                </a>
                            </div>
                            <div class="wrap-icon-section minicart">
                                <a href="cart.php" class="link-direction">
                                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                    <div class="left-info">
                                        <?php
                                        $count = 0;
                                        if (isset($_SESSION['shopping_cart'])) {
                                            $count = count($_SESSION['shopping_cart']);
                                        } ?>
                                        <span class="index"><?= $count; ?> ชิ้น</span>
                                        <span class="title">ตะกร้า</span>
                                    </div>
                                </a>
                            </div>
                            <div class="wrap-icon-section show-up-after-1024">
                                <a href="#" class="mobile-navigation">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="nav-section header-sticky">

                    <div class="primary-nav-section">
                        <div class="container">
                            <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu">
                                <li class="menu-item home-icon">
                                    <a href="index.php" class="link-term mercado-item-title"><i class="fa fa-home"
                                            aria-hidden="true"></i></a>
                                </li>
                                <li class="menu-item">
                                    <a href="about-us.php" class="link-term mercado-item-title">เกี่ยวกับเรา</a>
                                </li>
                                <li class="menu-item">
                                    <a href="shop.php" class="link-term mercado-item-title">สินค้า</a>
                                </li>
                                <li class="menu-item">
                                    <a href="cart.php" class="link-term mercado-item-title">ตะกร้าสินค้า</a>
                                </li>
                                <li class="menu-item">
                                    <a href="my_order.php" class="link-term mercado-item-title">ประวัติการซื้อ</a>
                                </li>
                                <li class="menu-item">
                                    <a href="contact.php" class="link-term mercado-item-title">ติดต่อเรา</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>