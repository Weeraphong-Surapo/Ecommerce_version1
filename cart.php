<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['login'])) {
    echo "<script>alert('กรุณา login ก่อน')</script>";
    echo "<script>window.location='login.php'</script>";
} else {
    include "function/connect.php";

    if (isset($_POST['add_to_cart'])) {
        $result = mysqli_query($con, "SELECT * FROM tb_shop WHERE id = '$_POST[id]'");
        $fetch = mysqli_fetch_array($result);
        if ($_POST['qty'] > $fetch['count']) {
            echo '<script>alert("สินค้าในสต็อกไม่พอ")</script>';
            echo '<script>window.location="detail.php?id=' . $fetch['id'] . '"</script>';
        }
        if ($_SESSION['shopping_cart']) {
            $item_arry_id = array_column($_SESSION['shopping_cart'], 'item_id');
            if (!in_array($_POST['id'], $item_arry_id)) {
                $count = count($_SESSION['shopping_cart']);
                $item_arry = array(
                    'item_id' => $_POST['id'],
                    'item_name' => $_POST['name'],
                    'item_delivery' => $_POST['delivery'],
                    'item_img' => $_POST['img'],
                    'item_price' => $_POST['price'],
                    'item_quantity' => $_POST['qty']
                );
                $_SESSION['shopping_cart'][$count] = $item_arry;
                echo '<script>alert("เพิ่มสินค้าลงในตะกร้าแล้ว")</scrip>';
                header('location:cart.php');
            } else {
                echo '<script>alert("มีสินค้านี้ในตะกร้าแล้ว")</script>';
                echo "<script>window.location='index.php'</script>";
            }
        } else {
            $item_arry = array(
                'item_id' => $_POST['id'],
                'item_name' => $_POST['name'],
                'item_delivery' => $_POST['delivery'],
                'item_img' => $_POST['img'],
                'item_price' => $_POST['price'],
                'item_quantity' => $_POST['qty']
            );
            $add_cart = $_SESSION['shopping_cart'][0] = $item_arry;
            if ($add_cart) {
                echo '<script>alert("เพิ่มสินค้าลงในตะกร้าแล้ว")</script>';
                echo '<script>window.location="cart.php"</script>';
            }
        }
    }
}
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'del') {
        foreach ($_SESSION['shopping_cart'] as $keys => $values) {
            if ($values['item_id'] == $_GET['id']) {
                unset($_SESSION['shopping_cart'][$keys]);
            }
        }
    }
}
?>
<?php include "function/header.php"; ?>

<!--main area-->
<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="index.php" class="link">หน้าหลัก</a></li>
                <li class="item-link"><span>ตะกร้า</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            <?php
            if (!empty($_SESSION['shopping_cart'])) {
                $total = 0;
                $i = 1;
                $delivery = 0;
                $sum_price = 0;
                foreach ($_SESSION['shopping_cart'] as $key => $values) {
            ?>
            <div class="wrap-iten-in-cart">
                <h3 class="box-title">ชื่อสินค้า</h3>
                <ul class="products-cart">
                    <?php
                            $delivery += $values['item_delivery'];
                            $total += ($values['item_quantity'] * $values['item_price']) + $values['item_delivery'];
                            $sum_price +=  ($values['item_quantity'] * $values['item_price']);
                            ?>

                    <li class="pr-cart-item">
                        <div class="product-image">
                            <figure><img src="<?= $values['item_img']; ?>" alt="" id="cart_img"></figure>
                        </div>
                        <div class="product-name">
                            <a class="link-to-product" href="#"><?= $values['item_name']; ?></a>
                        </div>
                        <div class="price-field produtc-price">
                            <p class="price">฿<?= number_format($values['item_price']); ?></p>
                        </div>
                        <div class="quantity" align="center">
                            <p class="price">x <?= $values['item_quantity']; ?></p>
                        </div>
                        <div class="price-field sub-total">
                            <p>฿<?php echo number_format($values['item_quantity'] * $values['item_price']); ?> บาท
                            </p>
                        </div>
                        <div class="delete">

                            <a href="?action=del&id=<?= $values['item_id']; ?>"><i class='fas fa-trash-alt'
                                    style='font-size:24px;color:red'></i></a>
                        </div>
                    </li>
                    <?php } ?>

                    <?php
                        $_SESSION['sum_price_product'] = $sum_price;
                        $_SESSION['delivery'] = $delivery;
                        $_SESSION['sum_price'] = $total;
                        ?>


                </ul>
            </div>
        </div>
        <div class="summary">
            <div class="order-summary">
                <h4 class="title-box">สรุปคำสั่งซื้อ</h4>
                <p class="summary-info"><span class="title">ยอดรวม</span><b class="index">฿
                        <?php echo number_format($_SESSION['sum_price_product'], 2); ?>
                        บาท</b>
                </p>
                <p class="summary-info"><span class="title">การส่งสินค้า</span><b class="index">฿
                        <?=  isset($_GET['c']) ? $_SESSION['delivery'] : $_SESSION['delivery']; ?>
                        บาท</b>
                </p>
                <p class="summary-info total-info "><span class="title">ราคารวม</span><b class="index">฿
                        <?php echo number_format($_SESSION['sum_price'], 2); ?>
                        บาท</b>
                </p>
            </div>
            <div class="checkout-info">
                <label class="checkbox-field">
                </label>
                <a class="btn btn-checkout" href="checkout.php">Check out</a>
                <!-- <a class="link-to-shop" href="shop.html">ซื้อ สินค้า เพิ่มเติมคลิก<i
                            class="fa fa-arrow-circle-right" aria-hidden="true"></i></a> -->
            </div>
            <!-- <div class="update-clear">
                    <a class="btn btn-clear" href="#">ลบสินค้าใน ตะกร้า</a>

                </div> -->
        </div>
        <?php } else { ?>
        <h1 class="text-center border">ไม่มีสินค้าในตะกร้า</h1>
        <?php } ?>

    </div>
    <!--end main content area-->
    </div>
    <!--end container-->

</main>
<!--main area-->

<!--footer area-->
<?php include "function/footer.php"; ?>