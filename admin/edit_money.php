<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['login']) && $_SESSION['username'] != 'admin') {
    echo '<script>window.location="../index.php"</script>';
}
include "function/head.php";
include "function/slide.php";
include "function/navbar.php";
include "../function/connect.php";
$result = mysqli_query($con, "SELECT * FROM tb_money WHERE id = '$_GET[id]'");
$fetch = mysqli_fetch_array($result);
?>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h1>แก้ไขบัญชี</h1>
            <hr>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $fetch['id']; ?>">
                <div class="mb-2">
                    <label for="">ชื่อบัญชี</label>
                    <input type="text" name="name_money" class="form-control" value="<?= $fetch['name']; ?>">
                </div>
                <div class="mb-2">
                    <label for="">เลขที่บัญชี</label>
                    <input type="text" name="money_number" class="form-control" value="<?= $fetch['money_number']; ?>">
                </div>
                <div class="mb-3">
                    <label for="">รูปภาพธานาคาร</label><br>
                    <input type="hidden" name="old_img" value="<?= $fetch['money_img']; ?>">
                    <img src="<?= $fetch['money_img']; ?>" width="100px" height="100px" alt=""><br><br>
                    <label for="">เปลี่ยนรูป</label>
                    <input type="file" name="file" class="form-control">
                </div>
                <input type="submit" value="อัพเดต" name="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['money_number'];
    $old_img = $_POST['old_img'];

    $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $folder = "../assets/images/money_online/";

    /* make file name in lower case */
    $new_file_name = strtolower($file);
    /* make file name in lower case */

    $final_file = str_replace(' ', '-', $new_file_name);
    $newname = 'assets/images/money_online/' . $final_file;
    $old_img = $_POST['old_img'];
    if (move_uploaded_file($file_loc, $folder . $final_file)) {
        $update = mysqli_query($con, "UPDATE `tb_money` SET `money_number`='$_POST[money_number]',`money_img`='$newname',name='$_POST[name_money]' WHERE id ='$_POST[id]'");
        if ($update) {
            echo $newname;
            unlink($old_img);
            $_SESSION['success'] = "อัพเดตเรียบร้อย";
            echo '<script>window.location="money_online.php"</script>';
        } else {
            echo "error";
        }
    } else {
        $update = mysqli_query($con, "UPDATE `tb_money` SET `money_number`='$_POST[money_number]',`money_img`='$old_img',name='$_POST[name_money]' WHERE id ='$_POST[id]'");
        $_SESSION['success'] = "อัพเดตเรียบร้อย";
        echo '<script>window.location="money_online.php"</script>';
    }
}
?>
<?php include 'footer.php'; ?>