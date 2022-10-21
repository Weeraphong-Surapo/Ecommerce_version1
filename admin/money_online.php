<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['login']) && $_SESSION['username'] != 'admin') {
    echo '<script>window.location="../index.php"</script>';
}
include "../function/connect.php";
include('function/head.php');
include "function/slide.php";
include "function/navbar.php";
?>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h1>ช่องทางการชำระเงิน</h1>
            <?= isset($_SESSION['success']) ? "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>" : '';
            unset($_SESSION['success']); ?>
            <?= isset($_SESSION['delete']) ? "<div class='alert alert-danger'>" . $_SESSION['delete'] . "</div>" : '';
            unset($_SESSION['delete']); ?>

            <hr>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                เพิ่มช่องทางขำระเงิน
            </button>
            <br>
            <hr>
            <?php
            $money = mysqli_query($con, "SELECT * FROM tb_money");
            foreach ($money as $data) {
            ?>
            <p>ชื่อบัญชี : <?= $data['name']; ?></p>
            <img src="<?= $data['money_img']; ?>" width="70px" height="50px">
            <span class="ms-3"><?= $data['money_number']; ?></span>
            <div class="btn-group ms-5">
                <a href="edit_money.php?id=<?= $data['id']; ?>" class="btn btn-sm btn-primary">แก้ไข</a>
                <a href="?id=<?= $data['id']; ?>&action=del" class="btn btn-sm btn-danger"
                    onclick="confirmdelete(event)">ลบ</a>
            </div>
            <hr>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">เพิ่มช่องทางการชำระเงิน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-2">
                        <label for="">รูปภาพ</label>
                        <input type="file" name="file" id="" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="">ชื่อบัญชี</label>
                        <input type="text" name="name_money" id="" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="">เลขบัญชี</label>
                        <input type="text" name="number_money" name="submit" id="" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                <button type="submit" name="submitt" class="btn btn-primary">เพิ่มบัญชี</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST['submitt'])) {
    $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $folder = "../assets/images/money_online/";
    $old_img = $_POST['old_img'];


    /* make file name in lower case */
    $new_file_name = strtolower($file);
    /* make file name in lower case */

    $final_file = str_replace(' ', '-', $new_file_name);
    $newname = '../assets/images/money_online/' . $final_file;
    if (move_uploaded_file($file_loc, $folder . $final_file)) {

        $insert = mysqli_query($con, "INSERT INTO tb_money(money_number,money_img,name) VALUES('$_POST[number_money]','$newname','$_POST[name_money]')");
        $_SESSION['success'] = "เพิ่มบัญชีเรียบร้อย";
        echo '<script>window.location="money_online.php"</script>';
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'del') {
    $del = mysqli_query($con, "DELETE FROM tb_money WHERE id = '$_GET[id]'");
    if (!$del) {
        echo "error";
    } else {
        $_SESSION['delete'] = "ลบเรียบร้อย";
        echo '<script>window.location="money_online.php"</script>';
    }
}
?>
<?php require('function/footer.php'); ?>