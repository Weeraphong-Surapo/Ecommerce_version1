<?php
if (!isset($_SESSION)) {
    session_start();
} ?>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile border-bottom">
                <div class="nav-link flex-column">
                    <div class="nav-profile-image">
                        <img src="../<?= $_SESSION['img'] ?>" alt="profile" />
                        <!--change to offline or busy as needed-->

                    </div>
                </div>
                <ul id="ul-login">
                    <li><a href="profile.php">โปรไฟล์</a></li>
                    <li><a href="function/logout.php">ออกจากระบบ</a></li>
                </ul>
            </li>

            <li class="pt-2 pb-1">
                <span class="nav-item-head">เมณู</span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="mdi mdi-compass-outline menu-icon"></i>
                    <span class="menu-title">หน้าหลัก</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                    <span class="menu-title">จัดการสินค้า</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="product.php">สินค้าทั้งหมด</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="upload.php">เพิ่มสินค้า</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="insert_category.php">เพิ่มประเภทสินค้า</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="show_category.php">ประเภทสินค้า</a>
                        </li>
                    </ul>
                </div>

                <a class="nav-link" data-bs-toggle="collapse" href="#order" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                    <span class="menu-title">ออเดอร์ & จัดส่ง</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="order">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="check_order.php">รอตรวจสอบ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="order.php">ออเดอร์</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="delivery.php">ออเดอร์ที่จัดส่งแล้ว</a>
                        </li>
                    </ul>
                </div>


                <!-- dsf -->


            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin.php">
                    <i class="mdi mdi-account-box menu-icon"></i>
                    <span class="menu-title">ผู้ดูแลระบบ</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user.php">
                    <i class="mdi mdi-account-multiple menu-icon"></i>
                    <span class="menu-title">ผู้ใช้งานระบบ</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">
                    <i class="mdi mdi-message-text menu-icon"></i>
                    <span class="menu-title">ติดต่อ & รายงาน</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="money_online.php">
                    <i class="mdi mdi-bank menu-icon"></i>
                    <span class="menu-title">ช่องทางการชำระเงิน</span>
                </a>
            </li>

        </ul>
    </nav>