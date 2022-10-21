<?php
include "function/connect.php";
include "function/header.php";

$sql = "SELECT * FROM tb_shop WHERE id = '$_GET[id]'";
$detail = mysqli_query($con, $sql);
$fetch = mysqli_fetch_array($detail);
?>

<!--main area-->
<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="shop.php" class="link">หน้าหลัก</a></li>
                <li class="item-link"><span>รายละเอียด</span></li>
            </ul>
        </div>
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-content-area">
                <div class="wrap-product-detail">
                    <div class="detail-media">
                        <div class="product-gallery">
                            <img src="<?= $fetch['img']; ?>" style="height: 370px;" alt="product thumbnail" id="img_show">
                        </div>
                    </div>
                    <div class="detail-info">
                        <div class="product-rating">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <h2 class="product-name">
                            <?= $fetch['name']; ?></h2>

                        <div class="wrap-price"><span
                                class="product-price">฿<?= number_format($fetch['price']) ?></span>
                        </div>
                        <div class="stock-info in-stock">
                            <p class="availability">จำนวนในสต็อก: <b><?= $fetch['count']; ?> ชิ้น</b></p>
                            <form action="like.php" method="post" class="">
                                <input type="hidden" name="id" value="<?= $fetch['id']; ?>">
                                <input type="hidden" name="name" value="<?= $fetch['name']; ?>">
                                <input type="hidden" name="img" value="<?= $fetch['img']; ?>">
                                <div class="wrap-butons">
                                    <button type="submit" name="add_to_like" style="margin-top: -30px;"
                                        class="btn add-to-cart"><span class="mdi mdi-heart"></span></button>
                                </div>
                            </form>
                        </div>
                        <form action="cart.php" method="post" class="mt-2">
                            <input type="hidden" name="id" value="<?= $fetch['id']; ?>">
                            <input type="number" name="qty" class="form-control text-center" value="1"
                                style="width: 20%;" min="1">
                            <input type="hidden" name="name" value="<?= $fetch['name']; ?>">
                            <input type="hidden" name="delivery" value="<?= $fetch['delivery']; ?>">
                            <input type="hidden" name="price" value="<?= $fetch['price']; ?>">
                            <input type="hidden" name="img" value="<?= $fetch['img']; ?>">
                            <div class="wrap-butons">

                                <input type="submit" value="เพิ่มใส่ตะกร้า" class="btn add-to-cart" name="add_to_cart">
                            </div>
                        </form>

                    </div>
                    <div class="advance-info">
                        <div class="tab-control normal">
                            <a href="#description" class="tab-control-item active">description</a>

                        </div>
                        <div class="tab-contents">
                            <div class="tab-content-item active" id="description">
                                <p><?= $fetch['description'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end main products area-->



        </div>
        <!--end row-->

    </div>
    <!--end container-->

</main>
<!--main area-->

<!--footer area-->
<?php include "function/footer.php"; ?>