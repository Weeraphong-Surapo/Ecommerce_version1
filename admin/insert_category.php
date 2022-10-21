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
<div class="container">
    <form action="" method="post">
        <?= isset($_SESSION['success']) ? "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>" : "";
            unset($_SESSION["success"]); ?>
        <br>
        <div class="card p-5">
            <div class="container">
                <h1 class="text-center">เพิ่มประเภทสินค้า</h1>
                <div class="mb-2">
                    <label for="">ประเภทสินค้า</label>
                    <input type="text" name="category" class="form-control" placeholder="enter category" required>
                </div>
                <button type="submit" name="upload" class="btn btn-primary">เพิ่มประเภทสินค้า</button>
            </div>
        </div>
    </form>
</div>
<?php

    if (isset($_POST['upload'])) {
        $name = $_POST['category'];

        $sql = "INSERT INTO `tb_category` (`id`, `category_name`) VALUES (NULL, '$name')";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            echo "error";
        }else{
            echo '<script>window.location="show_category.php"</script>';
            $_SESSION['success'] = "เพิ่มประเภทสินค้าเรียบร้อย";
        }
    }
    ?>
<?php include('function/footer.php'); ?>
<?php } ?>