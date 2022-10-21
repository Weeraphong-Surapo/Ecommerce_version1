<?php include "function/connect.php"; ?>
<?php include "function/header.php"; ?>

<!--main area-->
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="index.php" class="link">หน้าหลัก</a></li>
                <li class="item-link"><span>สินค้าทั้งหมด</span></li>
            </ul>
        </div>
        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

                <div class="banner-shop">
                    <a href="#" class="banner-link">
                        <figure><img src="assets/images/shop-banner.jpg" alt=""></figure>
                    </a>
                </div>

                <div class="wrap-shop-control">

                    <h1 class="shop-title">สินค้า</h1>

                    <div class="wrap-right">

                        <div class="sort-item orderby ">
                            <select name="orderby" class="use-chosen">
                                <option value="menu_order" selected="selected">ราคาจากน้อย & จากมาก</option>
                            </select>
                        </div>




                    </div>

                </div>
                <!--end wrap shop control-->

                <div class="row">

                    <ul class="product-list grid-products equal-container">
                        <?php
                        isset($_GET['search']) ? $search = $_GET['search'] : $search = "";
                        if (!empty($search)) {
                            $search_product = mysqli_query($con, "SELECT * FROM tb_shop WHERE name LIKE '%$search%'");
                            $num_row = mysqli_num_rows($search_product);
                            if ($num_row >= 1) {
                                while ($row = mysqli_fetch_array($search_product)) { ?>
                        <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                            <div class="product product-style-3 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="detail.php?id=<?= $row['id']; ?>">
                                        <figure><img src="<?= $row['img']; ?>" alt="" style="width: 100vh;"
                                                id="img_category">
                                        </figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="detail.php?id=<?= $row['id']; ?>" class="product-name"><span>
                                            <?= $row['name']; ?></span></a>
                                    <div><span class=" product-price">
                                            <?= $row['count'] > 0 ? '<span class="text-success mt-2">' . 'มีในสต็อก ' . $row['count'] . ' ชิ้น' . '</span>' : '<span class="text-danger">' . 'สินค้าหมด' . '</span>'; ?>
                                        </span></div>
                                    <div class="wrap-price"><span class="product-price">
                                            ฿<?= number_format($row['price']); ?></span></div>
                                    <a href="detail.php?id=<?= $row['id']; ?>" class="btn add-to-cart">ดูรายละเอียด</a>
                                </div>
                            </div>
                        </li>
                        <?php }
                            } else {
                                echo "<div class='alert h1 text-center col-12' >ไม่พบสินค้าที่ค้นหา</div>";
                            }
                        } else { ?>
                        <?php
                            if (isset($_GET['paginate'])) {
                                $page = $_GET['paginate'];
                            } else {
                                $page = 1;
                            }

                            $num_per_page = 30;
                            $start_from = ($page - 1) * 30;

                            $query = "SELECT * FROM tb_shop LIMIT $start_from,$num_per_page";
                            $result = mysqli_query($con, $query);
                            foreach ($result as $data) {
                            ?>
                        <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                            <div class="product product-style-3 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="detail.php?id=<?= $data['id']; ?>"
                                        title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="<?= $data['img']; ?>" alt="" style="width: 100vh;"
                                                id="img_category">
                                        </figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="detail.php?id=<?= $data['id']; ?>" class="product-name"><span>
                                            <?= $data['name']; ?></span></a>
                                    <div><span class=" product-price">
                                            <?= $data['count'] > 0 ? '<span class="text-success mt-2">' . 'มีในสต็อก ' . $data['count'] . ' ชิ้น' . '</span>' : '<span class="text-danger">' . 'สินค้าหมด' . '</span>'; ?>
                                        </span></div>
                                    <div class="wrap-price"><span class="product-price">
                                            ฿<?= number_format($data['price']); ?></span></div>
                                    <a href="detail.php?id=<?= $data['id']; ?>" class="btn add-to-cart">ดูรายละเอียด</a>
                                </div>
                            </div>
                        </li>
                        <?php } ?>

                    </ul>

                </div>
                <?php

                            $pr_query = "select * from tb_shop ";
                            $pr_result = mysqli_query($con, $pr_query);
                            $total_record = mysqli_num_rows($pr_result);

                            $total_page = ceil($total_record / $num_per_page);
                ?>
                <nav aria-label="Page navigation example mt-2">
                    <ul class="pagination" style="display: flex; justify-content: center;">
                        <?php
                            if ($page > 1) {
                                echo "<li class='page-item'><a class='page' href='shop.php?paginate=" . ($page - 1) . "' class='page-link''>หน้าก่อน</a></li>";
                            } ?>

                        <?php
                            for ($i = 1; $i < $total_page; $i++) {
                                echo "<li class='page-item'><a class='page' href='shop.php?paginate=" . $i . "' class='page-link''>$i</a></li>";
                            } ?>
                        <?php
                            if ($i > $page) {
                                echo "<li class='page-item'><a class='page' href='shop.php?paginate=" . ($page + 1) . "' class='page-link''>หน้าถัดไป</a></li>";
                            } ?>
                    </ul>
                </nav>


            </div>
            <!--end main products area-->

            <?php include "function/listcategory.php"; ?>
            <!-- Categories widget-->


            <div class="widget mercado-widget widget-product">
                <h2 class="widget-title">สินค้าเพิ่มเติม</h2>
                <div class="widget-content">
                    <ul class="products">
                        <?php
                            $sql = "SELECT * FROM tb_shop ORDER BY id DESC LIMIT 5";
                            $result = mysqli_query($con, $sql);
                            foreach ($result as $data) {
                        ?>
                        <li class="product-item">
                            <div class="product product-widget-style">
                                <div class="thumbnnail">
                                    <a href="detail.php?id=<?= $data['id']; ?>"
                                        title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                        <figure><img src="<?= $data['img'] ?>" alt="">
                                        </figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="detail.php?id=<?= $data['id']; ?>"
                                        class="product-name"><span><?= $data['name'] ?></span></a>
                                    <div class="wrap-price"><span
                                            class="product-price">฿<?= number_format($data['price']) ?></span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php } ?>

                    </ul>
                </div>
            </div><!-- brand widget-->

        </div>
        <!--end sitebar-->

    </div>
    <!--end row-->

    </div>
    <!--end container-->
    <?php } ?>

</main>
<!--main area-->

<?php include "function/footer.php"; ?>