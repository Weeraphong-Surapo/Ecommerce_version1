<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'swal.php';
if (!isset($_SESSION['login'])) {
    echo $use->Swal('warning','กรุณา login ก่อน','','login.php');
} else {
    include "function/connect.php";
    include 'swal.php';
    if (isset($_POST['add_to_like'])) {
        if (isset($_SESSION['shopping_like'])) {
            $item_arry_id = array_column($_SESSION['shopping_cart'], 'item_id');
            if (!in_array($_POST['id'], $item_arry_id)) {
                $count = count($_SESSION['shopping_like']);
                $item_arry = array(
                    'item_id' => $_POST['id'],
                    'item_name' => $_POST['name'],
                    'item_img' => $_POST['img'],
                );
                $_SESSION['shopping_like'][$count] = $item_arry;
                echo $use->Swal('success','เพิ่มสินค้าที่ชอบแล้ว','','like.php');
            } else {
                echo $use->Swal('success','มีสินค้านี้ในสิ่งที่ชอบแล้ว','','like.php');
            }
        } else {
            $item_arry = array(
                'item_id' => $_POST['id'],
                'item_name' => $_POST['name'],
                'item_img' => $_POST['img'],
            );
            $add_cart = $_SESSION['shopping_like'][0] = $item_arry;
            if ($add_cart) {
                echo $use->Swal('success','เพิ่มสินค้าที่ชอบแล้ว','','like.php');
            }
        }
    }
}
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'del') {
        foreach ($_SESSION['shopping_like'] as $keys => $values) {
            if ($values['item_id'] == $_GET['id']) {
                unset($_SESSION['shopping_like'][$keys]);
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
                <li class="item-link"><span>สิ่งที่ชอบ</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            <?php
            if (!empty($_SESSION['shopping_like'])) {
                $total = 0;
                $i = 1;
                $delivery = 0;
                $sum_price = 0;
                foreach ($_SESSION['shopping_like'] as $key => $values) {
            ?>
            <div class="wrap-iten-in-cart">
                <h3 class="box-title">ชื่อสินค้า</h3>
                <ul class="products-cart">

                    <li class="pr-cart-item">
                        <a href="detail.php?id=<?= $values['item_id']; ?>">
                            <div class="product-image">
                                <figure><img src="<?= $values['item_img']; ?>" alt="" id="cart_img">
                                </figure>
                            </div>
                        </a>
                        <div class="product-name">
                            <a class="link-to-product"
                                href="detail.php?id=<?= $values['item_id']; ?>"><?= $values['item_name']; ?></a>
                        </div>
                        <div class="delete">

                            <a href="?action=del&id=<?= $values['item_id']; ?>"><i class='fas fa-trash-alt'
                                    style='font-size:24px;color:red'></i></a>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php } else { ?>
        <h1 class="text-center border">ไม่มีสินค้าที่ชอบ</h1>
        <?php } ?>

    </div>
    <!--end main content area-->
    </div>
    <!--end container-->

</main>
<!--main area-->

<!--footer area-->
<?php include "function/footer.php"; ?>