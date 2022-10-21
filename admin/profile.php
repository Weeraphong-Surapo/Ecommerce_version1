<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['login']) && $_SESSION['username'] != 'admin') {
    echo '<script>window.location="../index.php"</script>';
} else {
    include "function/head.php";
    include "function/slide.php";
    include "function/navbar.php";
    include "../function/connect.php";
    $detail_admin = mysqli_query($con, "SELECT * FROM tb_users WHERE id = '$_SESSION[admin_id]'");
    $fetch = mysqli_fetch_array($detail_admin);
?>
<div class="container mt-5">
    <div class="card p-4 shadow-lg">
        <h1 class="text-center">ข้อมูลส่วนตัว</h1>
        <div class="card-body">
            <?= isset($_SESSION['success']) ? "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>" : "";
                unset($_SESSION["success"]); ?>
            <center>
                <img src="../<?= $fetch['img']; ?>" style="border-radius: 100%;" width="170px" height="170px" alt="">
            </center>
            <br>
            <p>ชื่อ : <?= $fetch['name']; ?></p>
            <p>อีเมล์ : <?= $fetch['email'];?></p>
            <p>ที่อยู่ : <?= $fetch['address']; ?></p>
            <p>เบอร์โทร : <?= $fetch['tel']; ?></p>
            <p>สถานะ : <?= $fetch['lavel']; ?></p>
            <a href="edit_profile.php?id=<?= $fetch['id']; ?>" class="btn btn-primary">แก้ไขข้อมูลส่วนตัว</a>
        </div>
    </div>
</div>
<?php include('function/footer.php'); ?>
<?php } ?>