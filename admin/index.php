<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['login']) && $_SESSION['username'] != 'admin') {
    echo '<script>window.location="../index.php"</script>';
}
?>
<?php include "../function/connect.php"; ?>
<?php include "function/head.php"; ?>
<?php include "function/slide.php"; ?>
<?php include "function/navbar.php"; ?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper pb-0">
        <!-- first row starts here -->

        <!-- image card row starts here -->
        <div class="row">
            <div class="col-sm-4 stretch-card grid-margin">
                <div class="card shadow-lg">
                    <a href="check_order.php" id="card-item">
                        <div class="card-body px-3 text-dark">
                            <h5 class="font-weight-semibold"> ออเดอ์ที่ต้องตรวจสอบ </h5>
                            <?php
                            $order_check = mysqli_query($con, "SELECT * FROM tb_user_delivery WHERE status = '3'");
                            $num_row_order_check = mysqli_num_rows($order_check);
                            ?>
                            <div class="d-flex justify-content-between font-weight-semibold">
                                <p class="mb-0">
                                    <i class="mdi mdi-star star-color pe-1"></i><?= $num_row_order_check ?> รายการ
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-4 stretch-card grid-margin">
                <div class="card shadow-lg">
                    <a href="order.php" id="card-item">
                        <div class="card-body px-3 text-dark">
                            <h5 class="font-weight-semibold"> ออเดอร์ที่ต้องส่ง </h5>
                            <?php
                            $order = mysqli_query($con, "SELECT * FROM tb_user_delivery WHERE status = '0'");
                            $num_row_order = mysqli_num_rows($order);
                            ?>
                            <div class="d-flex justify-content-between font-weight-semibold">
                                <p class="mb-0">
                                    <i class="mdi mdi-star star-color pe-1"></i><?= $num_row_order; ?> รายการ
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-4 stretch-card grid-margin">
                <div class="card shadow-lg">
                    <a href="delivery.php" id="card-item">
                        <div class="card-body px-3 text-dark">
                            <h5 class="font-weight-semibold">ออเอร์ที่จัดส่งแล้ว</h5>
                            <?php
                            $delivery = mysqli_query($con, "SELECT * FROM tb_user_delivery WHERE status = '1'");
                            $num_row_delivery = mysqli_num_rows($delivery);
                            ?>
                            <div class="d-flex justify-content-between font-weight-semibold">
                                <p class="mb-0">
                                    <i class="mdi mdi-star star-color pe-1"></i><?= $num_row_delivery; ?> รายการ
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 stretch-card grid-margin">
                <div class="card shadow-lg">
                    <a href="" id="card-item">
                        <div class="card-body px-3 text-dark">
                            <h5 class="font-weight-semibold"> ยอดราคาขาย </h5>
                            <?php
                            $total = 0;
                            $money = mysqli_query($con, "SELECT * FROM tb_order ");
                            foreach ($money as $data) {
                                $total += ($data['price'] * $data['qty']);
                            }
                            ?>
                            <div class="d-flex justify-content-between font-weight-semibold">
                                <p class="mb-0">
                                    <i class="mdi mdi-star star-color pe-1"></i><?= number_format($total); ?> บาท
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-4 stretch-card grid-margin">
                <div class="card shadow-lg">
                    <a href="user.php" id="card-item">
                        <div class="card-body px-3 text-dark">
                            <h5 class="font-weight-semibold"> ผู้ใช้งานในระบบ</h5>
                            <?php
                            $contact = mysqli_query($con, "SELECT * FROM tb_users WHERE lavel = 'user'");
                            $num_row_contact = mysqli_num_rows($contact);
                            ?>
                            <div class="d-flex justify-content-between font-weight-semibold">
                                <p class="mb-0">
                                    <i class="mdi mdi-star star-color pe-1"></i><?= $num_row_contact; ?> บัญชี
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-4 stretch-card grid-margin">
                <div class="card shadow-lg">
                    <a href="admin.php" id="card-item">
                        <div class="card-body px-3 text-dark">
                            <h5 class="font-weight-semibold">จำนวนผู้ดูแลระบบ</h5>
                            <?php
                            $count_admin = mysqli_query($con, "SELECT * FROM tb_users WHERE lavel = 'admin'");
                            $all_admin = mysqli_num_rows($count_admin);
                            ?>
                            <div class="d-flex justify-content-between font-weight-semibold">
                                <p class="mb-0">
                                    <i class="mdi mdi-star star-color pe-1"><span></i><?= $all_admin ?> บัญชี</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-9 stretch-card grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-wrap">
                            <div>
                                <div class="card-title mb-0">Sales Revenue</div>
                                <h3 class="font-weight-bold mb-0">$32,409</h3>
                            </div>
                            <div>
                                <div class="d-flex flex-wrap pt-2 justify-content-between sales-header-right">
                                    <div class="d-flex me-5">
                                        <button type="button" class="btn btn-social-icon btn-outline-sales">
                                            <i class="mdi mdi-inbox-arrow-down"></i>
                                        </button>
                                        <div class="ps-2">
                                            <h4 class="mb-0 font-weight-semibold head-count"> $8,217 </h4>
                                            <span class="font-10 font-weight-semibold text-muted">TOTAL
                                                SALES</span>
                                        </div>
                                    </div>
                                    <div class="d-flex me-3 mt-2 mt-sm-0">
                                        <button type="button" class="btn btn-social-icon btn-outline-sales profit">
                                            <i class="mdi mdi-cash text-info"></i>
                                        </button>
                                        <div class="ps-2">
                                            <h4 class="mb-0 font-weight-semibold head-count"> 2,804 </h4>
                                            <span class="font-10 font-weight-semibold text-muted">TOTAL
                                                PROFIT</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted font-13 mt-2 mt-sm-0"> Your sales monitoring dashboard
                            template. <a class="text-muted font-13" href="#"><u>Learn more</u></a>
                        </p>
                        <div class="flot-chart-wrapper">
                            <div id="flotChart" class="flot-chart">
                                <canvas class="flot-base"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 stretch-card grid-margin">
                <div class="card card-img">
                    <div class="card-body d-flex align-items-center">
                        <div class="text-white">
                            <h1 class="font-20 font-weight-semibold mb-0"> Get premium </h1>
                            <h1 class="font-20 font-weight-semibold">account!</h1>
                            <p>to optimize your selling prodcut</p>
                            <p class="font-10 font-weight-semibold"> Enjoy the advantage of premium. </p>
                            <button class="btn bg-white font-12">Get Premium</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- table row starts here -->

        <!-- doughnut chart row starts -->
        <div class="row">
            <div class="col-sm-12 stretch-card grid-margin">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="card-title">Channel Sessions</div>
                                    <div class="d-flex flex-wrap">
                                        <div class="doughnut-wrapper w-50">
                                            <canvas id="doughnutChart1" width="100" height="100"></canvas>
                                        </div>
                                        <div id="doughnut-chart-legend"
                                            class="pl-lg-3 rounded-legend align-self-center flex-grow legend-vertical legend-bottom-left">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="card-title">News Sessions</div>
                                    <div class="d-flex flex-wrap">
                                        <div class="doughnut-wrapper w-50">
                                            <canvas id="doughnutChart2" width="100" height="100"></canvas>
                                        </div>
                                        <div id="doughnut-chart-legend2"
                                            class="pl-lg-3 rounded-legend align-self-center flex-grow legend-vertical legend-bottom-left">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="card-title">Device Sessions</div>
                                    <div class="d-flex flex-wrap">
                                        <div class="doughnut-wrapper w-50">
                                            <canvas id="doughnutChart3" width="100" height="100"></canvas>
                                        </div>
                                        <div id="doughnut-chart-legend3"
                                            class="pl-lg-3 rounded-legend align-self-center flex-grow legend-vertical legend-bottom-left">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- last row starts here -->


        <!-- content-wrapper ends -->
        <?php include "function/footer.php"; ?>