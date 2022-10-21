<?php
if (isset($_SESSION['login']) && $_SESSION['username'] != 'admin') {
    echo '<script>window.location="../index.php"</script>';
}
include "../function/connect.php";
include('function/head.php');
include "function/slide.php";
include "function/navbar.php";
$result = mysqli_query($con, "SELECT * FROM tb_contact WHERE id = '$_GET[id]'");
$fetch = mysqli_fetch_array($result);
?>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h1 class="text-center">การติดต่อ</h1>
            <hr>
            <p>ชื่อ : <?= $fetch['contact_name']; ?></p>
            <p>อีเมลล์ : <?= $fetch['contact_email']; ?></p>
            <p>เบอร์โทร : <?= $fetch['contact_phone']; ?></p>
            <p>รายละเอียดการติดต่อ : <?= $fetch['contact_description']; ?></p>
            <a href="contact.php" class="btn btn-primary col-12 mt-2">ย้อนกลับ</a>
        </div>
    </div>
</div>
<?php include('function/footer.php'); ?>