<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['login']) && $_SESSION['username'] != 'admin') {
    echo '<script>window.location="../index.php"</script>';
} else {
    include "../function/connect.php";
    include('function/head.php');
    include "swal.php";
    include "function/slide.php";
    include "function/navbar.php";
?>
<div class="container">
    <br>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card p-5">
            <div class="container">
                <h1 class="text-center">เพิ่มสินค้า</h1>
                <div class="mb-2">
                    <select name="category" id="" class="form-select">
                        <?php
                            $result = mysqli_query($con, "SELECT * FROM tb_category");
                            foreach ($result as $category) {
                            ?>
                        <option value="<?= $category['id']; ?>"><?= $category['category_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="name"><strong>ชื่อสินค้า</strong></label>
                    <input type="text" placeholder="Enter name" name="product_name" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label for="detail"><strong>รายละเอียด</strong></label>
                    <input type="text" placeholder="Enter detail" name="detail" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label for="price"><strong>ราคา</strong></label>
                    <input type="number" placeholder="Enter Price" name="price" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label for="price"><strong>จำนวนในสต็อก</strong></label>
                    <input type="number" placeholder="Enter quantity" name="qty" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label for="price"><strong>ค่าการจัดส่ง</strong></label>
                    <input type="number" placeholder="Enter delivery" name="delivery" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="">รูปภาพ หลัก</label>
                    <input type="file" name="file" class="form-control" />
                </div>



                <button type="submit" name="upload" class="btn btn-primary">เพิ่มสินค้า</button>
            </div>
        </div>
    </form>
</div>
</div>
<?php

    if (isset($_POST['upload'])) {
        $name = $_POST['product_name'];
        $detail = $_POST['detail'];
        $price = $_POST['price'];
        $delivery = $_POST['delivery'];
        $category = $_POST['category'];
        $qty = $_POST['qty'];

        $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
        $file_loc = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];
        $folder = "../assets/images/upload/";


        /* make file name in lower case */
        $new_file_name = strtolower($file);

        /* make file name in lower case */

        $final_file = str_replace(' ', '-', $new_file_name);
        $newname = 'assets/images/upload/' . $final_file;


        $sql = "INSERT INTO `tb_shop` (`id`, `img`, `name`, `description`, `price`, `delivery`,`count`,`category`) VALUES (NULL, '$newname', '$name', '$detail', '$price', '$delivery','$qty','$category')";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            echo "error<br>";
            echo $sql;
        }
        if (move_uploaded_file($file_loc, $folder . $final_file)) {
            $_SESSION['success'] = "เพิ่มสินค้าเรียบร้อย";
            echo $use->Swal('success','เพิ่มสินค้าเรียบร้อย','','product.php');
        } else {

            echo "Error.Please try again55";
        }
        
    }
    ?>
<?php include('function/footer.php'); ?>
<?php } ?>