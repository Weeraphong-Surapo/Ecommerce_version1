<?php
if (!isset($_SESSION)) {
    session_start();
}
include "function/connect.php";
include "function/header.php"; ?>

<!--main area-->
<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">หน้าหลัก</a></li>
                <li class="item-link"><span>ชำระเงิน</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            <div class="wrap-address-billing">
                <h3 class="box-title">ที่อยู่เรียกเก็บเงิน</h3>
                <form action="" method="POST" name="frm-billing" enctype="multipart/form-data">
                    <p class="row-in-form">
                        <label for="fname">ชื่อ - นามสกุล<span>*</span></label>
                        <input id="fname" type="text" name="fullname" value="" placeholder="ชื่อของคุณ" required>
                    </p>
                    <p class="row-in-form">
                        <label for="phone">เบอร์โทร<span>*</span></label>
                        <input id="phone" type="number" name="phone" value="" maxlength="10"
                            placeholder="รูปแบบ 10 หลัก" required>
                    </p>
                    <p class="row-in-form">
                        <label for="add">ที่อยู่:</label>
                        <input id="add" type="text" name="address" value="" placeholder="ถนนที่ / อพาร์ตเมนต์ / เลขที่"
                            required>
                    </p>
                    <p class="row-in-form">
                        <label for="country">จังหวัด<span>*</span></label>
                        <input id="country" type="text" name="country" value="" placeholder="จังหวัด" required>
                    </p>
                    <p class=" row-in-form">
                        <label for="city">เมือง<span>*</span></label>
                        <input id="city" type="text" name="city" value="" placeholder="ชื่อเมือง" required>
                    </p>
                    <p class="row-in-form">
                        <label for="zip-code">รหัสไปรษณีย์:</label>
                        <input id="zip-code" type="number" name="zip" value="" placeholder="รหัสไปรษณีย์ของคุณ"
                            required>
                    </p>
            </div>
            <div class="summary summary-checkout">
                <div class="summary-item payment-method col-6">
                    <h4 class="title-box">วิธีการชำระเงิน</h4>
                    <p class="summary-info"><span class="title">ชำระปลายทาง / โอนธนาคาร</span></p>
                    <div class="choose-payment-methods">
                        <label class="payment-method">
                            <input id="payment-method-bank" value="cod" type="radio" name="check">
                            <span>ชำระปลายทาง</span>
                        </label>
                    </div>
                    <div class="choose-payment-methods">
                        <label class="payment-method">
                            <input id="payment-method-bank" value="online" type="radio" data-bs-toggle="collapse"
                                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
                                name="check">
                            <span>โอนชำระธนาคาร</span>
                        </label>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <?php
                                $money = mysqli_query($con, "SELECT * FROM tb_money");
                                foreach ($money as $data) {
                                ?>
                                <p>ชื่อบัญชี : คุณ <?= $data['name']; ?></p>
                                <img src="admin/<?= $data['money_img']; ?>" id="img_online">
                                <span class="ms-3"><?= $data['money_number']; ?></span>
                                <hr>
                                <?php } ?>
                                <label for="">แนบสลิปเงิน</label>
                                <input type="file" name="file" class="form-control">
                            </div>
                        </div>

                    </div>
                    <p class="summary-info grand-total"><span>ราคารวมทั้งสิ้น</span> <span
                            class="grand-total-price"><?= number_format($_SESSION['sum_price']); ?> บาท</span>
                    </p>
                    <input class="btn btn-medium" type="submit" value="สั่งซื้อ" name="check_out">
                    </form>
                </div>
                <div class="summary-item shipping-method col-6">
                    <h4 class="title-box f-title">วิธีจัดส่ง</h4>
                    <p class="summary-info"><span class="title">ค่าการจัดส่งทั้งสิ้น</span></p>
                    <p class="summary-info"><span class="title">฿ <?= number_format($_SESSION['delivery']); ?>
                            บาท</span>
                    </p>
                </div>
            </div>


        </div>
        <!--end main content area-->
    </div>
    <!--end container-->

</main>
<!--main area-->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ชำระเงินธนาคาร</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                $money = mysqli_query($con, "SELECT * FROM tb_money");
                foreach ($money as $data) {
                ?>
                <p>ชื่อบัญชี : คุณ <?= $data['name']; ?></p>
                <img src="admin/<?= $data['money_img']; ?>" id="img_online">
                <span class="ms-3"><?= $data['money_number']; ?></span>
                <hr>
                <?php } ?>
                <label for="">แนบสลิปเงิน</label>
                <input type="file" name="file" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-primary" name="check_out">สั่งซื้อ</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php include "function/footer.php"; ?>

<?php
if (isset($_POST['check_out'])) {
    if ($_POST['check'] == '' and $_POST['check_online'] == '') {
        echo '<script>alert("เลือกการชำระเงิน")</script>';
    } else {
        if (isset($_POST['check']) && $_POST['check'] == "cod") {

            $user_id = $_SESSION['user_id'];

            /* make file name in lower case */
            $new_file_name = strtolower($file);
            /* make file name in lower case */

            $user2 = mysqli_query($con, "INSERT INTO `tb_user_delivery`(`order_id`, `user_id`, `name`, `address`, `tel`,`country`,`city`,`zip`, `status`) VALUES (NULL,$user_id,'$_POST[fullname]','$_POST[address]','$_POST[phone]','$_POST[country]' ,'$_POST[city]','$_POST[zip]','0')");
            $order_id = mysqli_insert_id($con);
            if ($user2) {
                foreach ($_SESSION['shopping_cart'] as $key => $values) {
                    $product_id = $values['item_id'];
                    $name = $values['item_name'];
                    $price = $values['item_price'];
                    $qty = $values['item_quantity'];
                    $delivery = $values['item_delivery'];
                    $name_address = $_POST['name'];
                    $address = $_POST['address'];
                    $tel = $_POST['tel'];
                    $order = mysqli_query($con, "INSERT INTO `tb_order`(`id`, `order_id`, `user_id`, `product`, `qty`, `price`, `delivery`) VALUES (NULL,$order_id,'$user_id','$name','$qty','$price',$delivery)");

                    $sql3 = "SELECT * FROM tb_shop where id = $product_id";
                    $query3 = mysqli_query($con, $sql3);
                    $row3 = mysqli_fetch_array($query3);
                    $count = mysqli_num_rows($query3);

                    //ตัดสต๊อก
                    for ($i = 0; $i < $count; $i++) {
                        $have =  $row3['count'];

                        $stc = $have - $qty;

                        $sql9 = "UPDATE tb_shop SET  
                       count = $stc
                       WHERE  id = $product_id ";
                        $query9 = mysqli_query($con, $sql9);
                    }
                }
                $sToken = "VJAKyKVgI4xWxuiNIVJKgYilSqrXAqKUPPnnP2A2pwY";
                $sMessage = "มีการสั่งออเดอร์\n";
                $sMessage .= "จากคุณ : " . $_POST['fullname'] . "\n";
                $sMessage .= "การชำระเงิน : " . 'ชำระปลายทาง' . "\n";
                $sMessage .= "เข้าดูออดเดอร์ : " . 'https://bigcwebsite.000webhostapp.com/login.php' . "\n";
                $imageFile = new CURLFile($folder_copy);
                // $sticker_package_id = '2';  // Package ID sticker
                $sticker_id = '34';    // ID sticker

                $data = array(
                    'message' => $sMessage,
                );


                $chOne = curl_init();
                curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
                curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($chOne, CURLOPT_POST, 1);
                curl_setopt($chOne, CURLOPT_POSTFIELDS, $data);
                $headers = array('Content-type: multipart/form-data', 'Authorization: Bearer ' . $sToken . '',);
                curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($chOne);

                if ($result) {
                    echo 'success';
                } else {
                    echo 'error';
                }


                unset($_SESSION['shopping_cart']);
                echo '<script>window.location="thankyou.php?p=order"</script>';
            }
        } else {
            $user_id = $_SESSION['user_id'];
            $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
            $file_loc = $_FILES['file']['tmp_name'];
            $file_size = $_FILES['file']['size'];
            $file_type = $_FILES['file']['type'];
            $folder = "assets/images/money/";

            /* make file name in lower case */
            $new_file_name = strtolower($file);
            /* make file name in lower case */

            $final_file = str_replace(' ', '-', $new_file_name);
            $newname = 'assets/images/money/' . $final_file;
            move_uploaded_file($file_loc, $folder . $final_file);
            $user = mysqli_query($con, "INSERT INTO `tb_user_delivery`(`order_id`, `user_id`, `name`, `address`, `tel`,`country`,`city`,`zip`, `money_img`, `status`) VALUES (NULL,$user_id,'$_POST[fullname]','$_POST[address]','$_POST[phone]','$_POST[country]' ,'$_POST[city]','$_POST[zip]', '$newname' ,'3')");
            $order_id = mysqli_insert_id($con);
            if ($user) {
                foreach ($_SESSION['shopping_cart'] as $key => $values) {
                    $product_id = $values['item_id'];
                    $name = $values['item_name'];
                    $price = $values['item_price'];
                    $qty = $values['item_quantity'];
                    $delivery = $values['item_delivery'];
                    $name_address = $_POST['name'];
                    $address = $_POST['address'];
                    $tel = $_POST['tel'];
                    $order = mysqli_query($con, "INSERT INTO `tb_order`(`id`, `order_id`, `user_id`, `product`, `qty`, `price`, `delivery`) VALUES (NULL,$order_id,'$user_id','$name','$qty','$price',$delivery)");


                    $sql3 = "SELECT * FROM tb_shop where id = $product_id";
                    $query3 = mysqli_query($con, $sql3);
                    $row3 = mysqli_fetch_array($query3);
                    $count = mysqli_num_rows($query3);

                    //ตัดสต๊อก
                    for ($i = 0; $i < $count; $i++) {
                        $have =  $row3['count'];

                        $stc = $have - $qty;

                        $sql9 = "UPDATE tb_shop SET  
                           count = $stc
                           WHERE  id = $product_id ";
                        $query9 = mysqli_query($con, $sql9);
                    }
                }
                unset($_SESSION['shopping_cart']);
                echo '<script>window.location="thankyou.php?p=order"</script>';
            }

            $sToken = "VJAKyKVgI4xWxuiNIVJKgYilSqrXAqKUPPnnP2A2pwY";
            $sMessage = "มีการสั่งออเดอร์\n";
            $sMessage .= "จากคุณ : " . $_POST['fullname'] . "\n";
            $sMessage .= "การชำระเงิน : " . 'โอนชำระธนาคาร' . "\n";
            $sMessage .= "เข้าดูออดเดอร์ : " . 'https://bigcwebsite.000webhostapp.com/login.php' . "\n";
            $imageFile = new CURLFile($folder_copy);
            // $sticker_package_id = '2';  // Package ID sticker
            $sticker_id = '34';    // ID sticker

            $data = array(
                'message' => $sMessage,
            );


            $chOne = curl_init();
            curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
            curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($chOne, CURLOPT_POST, 1);
            curl_setopt($chOne, CURLOPT_POSTFIELDS, $data);
            $headers = array('Content-type: multipart/form-data', 'Authorization: Bearer ' . $sToken . '',);
            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($chOne);

            if ($result) {
                echo 'success';
            } else {
                echo 'error';
            }

            mysqli_close($con);
        }

        error_reporting(0);
    }
}
?>