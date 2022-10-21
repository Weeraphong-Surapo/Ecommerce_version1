<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['login']) && $_SESSION['username'] != 'admin') {
    echo '<script>window.location="../index.php"</script>';
} else {
    include "../function/connect.php";
    include('function/head.php');
    include "function/slide.php";
    include "function/navbar.php";
?>
<?php
    if (isset($_GET['action']) && $_GET['action'] == "edit") {
        $edit = mysqli_query($con, "SELECT * FROM tb_shop WHERE id = '$_GET[id]'");
        $fetch = mysqli_fetch_array($edit);
    ?>
<div class="container mt-4">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $fetch['id']; ?>">
        <div class="card p-5">
            <div class="container">
                <h1 class="text-center">แก้ไขสินค้า</h1>
                <div class="mb-2">
                    <select name="category_edit" id="" class="form-select">
                        <?php
                                $result_category = mysqli_query($con, "SELECT * FROM tb_category WHERE id = '$_GET[category]'");
                                $result_category2 = mysqli_fetch_array($result_category); ?>
                        <option value="<?= $result_category2['id']; ?>"><?= $result_category2['category_name']; ?>
                        </option>
                        <?php
                                $category_show = mysqli_query($con, "SELECT * FROM tb_category WHERE id != '$_GET[category]'");
                                foreach ($category_show as $category) {
                                ?>
                        <option value="<?= $category['id']; ?>"><?= $category['category_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="name"><strong>ชื่อสินค้า</strong></label>
                    <input type="text" placeholder="Enter name" name="product_name" class="form-control"
                        value="<?= $fetch['name']; ?>" required>
                </div>
                <div class="mb-2">
                    <label for="detail"><strong>รายละเอียด</strong></label>
                    <input type="text" placeholder="Enter detail" name="detail" class="form-control"
                        value="<?= $fetch['description']; ?>" required>
                </div>
                <div class="mb-2">
                    <label for="price"><strong>ราคา</strong></label>
                    <input type="number" placeholder="Enter Price" name="price" class="form-control"
                        value="<?= $fetch['price']; ?>" required>
                </div>
                <div class="mb-2">
                    <label for="price"><strong>จำนวน</strong></label>
                    <input type="number" placeholder="Enter qty" name="qty" class="form-control"
                        value="<?= $fetch['count']; ?>" required>
                </div>
                <div class="mb-2">
                    <label for="price"><strong>ค่าการจัดส่ง</strong></label>
                    <input type="number" placeholder="Enter delivery" name="delivery" class="form-control"
                        value="<?= $fetch['delivery']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="">รูปภาพ หลัก</label>
                    <input type="file" name="file" class="form-control" />
                    <input type="hidden" name="old_img" value="<?= $fetch['img']; ?>">
                </div>
            </div>


            <button type="submit" name="upload" class="btn btn-primary mt-2">อัพเดต</button>
        </div>
</div>
</form>
</div>
</div>
<?php } ?>
<?php

    if (isset($_POST['upload'])) {
        $id = $_POST['id'];
        $name = $_POST['product_name'];
        $detail = $_POST['detail'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $delivery = $_POST['delivery'];
        $category = $_POST['category_edit'];
        $old_img = $_POST['old_img'];

        $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
        $file_loc = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];
        $folder = "../assets/images/upload/";


        /* make file name in lower case */
        $new_file_name = strtolower($file);
        /* make file name in lower case */

        $final_file = str_replace(' ', '-', $new_file_name);
        $newname = '../assets/images/upload/' . $final_file;

        $old_img = $_POST['old_img'];
        if (move_uploaded_file($file_loc, $folder . $final_file)) {
            $update = mysqli_query($con, "UPDATE `tb_shop` SET `img` = '$newname', `name` = '$name', `description` = '$detail', `price` = '$price', `delivery` = '$delivery', `count` = $qty , `category` = '$category' WHERE `tb_shop`.`id` = $id");
            if ($update) {
                unlink($old_img);
                $_SESSION['success'] = "อัพเดตเรียบร้อย";
                echo '<script>window.location="product.php"</script>';
            } else {
                echo "error";
            }
        } else {
            $update = mysqli_query($con, "UPDATE `tb_shop` SET `img` = '$old_img', `name` = '$name', `description` = '$detail', `price` = '$price', `delivery` = '$delivery',`count` = $qty ,`category` = '$category' WHERE `tb_shop`.`id` = $id");
            $_SESSION['success'] = "อัพเดตเรียบร้อย";
            echo '<script>window.location="product.php"</script>';
        }
    }
    ?>
<?php require('function/footer.php'); ?>
<?php } ?>