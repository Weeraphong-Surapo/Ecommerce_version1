<?php include "function/connect.php"; ?>
<?php include "function/header.php"; ?>
<?php include "function/slider.php"; ?>

<!--BANNER-->
<div class="wrap-banner style-twin-default">
    <div class="banner-item">
        <a href="#" class="link-banner banner-effect-1">
            <figure><img src="assets/images/home-1-banner-1.jpg" alt="" width="580" height="190"></figure>
        </a>
    </div>
    <div class="banner-item">
        <a href="#" class="link-banner banner-effect-1">
            <figure><img src="assets/images/home-1-banner-2.jpg" alt="" width="580" height="190"></figure>
        </a>
    </div>
</div>


<!--On Sale-->




<!--Latest Products-->
<div class="wrap-show-advance-info-box style-1">
    <h3 class="title-box">สินค้าล่าสุด</h3>
    <div class="wrap-top-banner">
        <a href="#" class="link-banner banner-effect-2">
            <figure><img src="assets/images/digital-electronic-banner.jpg" width="1170" height="240" alt="">
            </figure>
        </a>
    </div>

    <div class="row">

        <ul class="product-list grid-products equal-container">
            <?php
            if (isset($_GET['paginate'])) {
                $page = $_GET['paginate'];
            } else {
                $page = 1;
            }

            $num_per_page = 21;
            $start_from = ($page - 1) * 21;

            $query = "SELECT * FROM tb_shop LIMIT $start_from,$num_per_page";
            $result = mysqli_query($con, $query);
            foreach ($result as $data) {
            ?>
            <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                <div class="product product-style-3 equal-elem ">
                    <div class="product-thumnail">
                        <a href="detail.php?id=<?= $data['id']; ?>">
                            <figure><img src="<?= $data['img']; ?>" alt="" style="width: 100vh;" id="img_category">
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
            echo "<li class='page-item'><a class='page' href='index.php?paginate=" . ($page - 1) . "' class='page-link''>หน้าก่อน</a></li>";
        } ?>

        <?php
        for ($i = 1; $i < $total_page; $i++) {
            echo "<li class='page-item'><a class='page' href='index.php?paginate=" . $i . "' class='page-link''>$i</a></li>";
        } ?>
        <?php
        if ($i > $page) {
            echo "<li class='page-item'><a class='page' href='index.php?paginate=" . ($page + 1) . "' class='page-link''>หน้าถัดไป</a></li>";
        } ?>
    </ul>
    <a href=""></a>
</nav>

</div>

</main>
<?php include "function/footer.php"; ?>