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
    $result = mysqli_query($con, "SELECT * FROM tb_category WHERE id  = '$_GET[id]'");
    $fetch = mysqli_fetch_array($result);
?>
<div class="container mt-4">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $fetch['id'];?>">
        <div class="card p-5 shadow-lg">
            <div class="container">
                <h1 class="text-center">แก้ไขประเภทสินค้า</h1>
                <div class="mb-2">
                    <label for="">ประเภทสินค้า</label>
                    <input type="text" name="category" class="form-control" value="<?= $fetch['category_name']; ?>"
                        placeholder="enter category">
                </div>
                <button type="submit" name="update" class="btn btn-info">อัพเดต</button>
            </div>
        </div>
    </form>
</div>
<?php

    if (isset($_POST['update'])) {
        $name = $_POST['category'];
            $update = mysqli_query($con, "UPDATE `tb_category` SET `category_name`='$name' WHERE id = '$_POST[id]'");
            if ($update) {
                $_SESSION['success'] = "อัพเดตเรียบร้อย";
                echo '<script>window.location="show_category.php"</script>';
            } else {
                echo "error";
            }
    }
    ?>
<?php include('function/footer.php'); ?>
<?php } ?>