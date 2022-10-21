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
    ?>
<div class="container mt-5">
    <div class="container">
        <div class="card p-4 shadow-lg">
            <h1 class="text-center">ข้อมูลส่วนตัว</h1>
            <div class="card-body">
                <center>
                    <img src="../<?= $_SESSION['img']; ?>" style="border-radius: 100%;" width="170px" height="170px"
                        alt="">
                </center>
                <br>
                <?php
                    $detail_admin = mysqli_query($con, "SELECT * FROM tb_users WHERE id = '$_SESSION[admin_id]'");
                    $fetch = mysqli_fetch_array($detail_admin);
                    ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="old_img" value="<?= $fetch['img']; ?>">
                    <input accept="image/*" type='file' id="imgInp" name="file" class="form-control mb-2">
                    <p class="mt-2">ชื่อ :</p>
                    <input type="text" name="name" value="<?= $fetch['name'] ?>" class="form-control" id="">
                    <p class="mt-2">อีเมลล์ :</p>
                    <input type="email" name="email" value="<?= $fetch['email'] ?>" class="form-control" id="">
                    <p class="mt-2">ที่อยู่ :</p>
                    <input type="text" name="address" value="<?= $fetch['address'] ?>" class="form-control" id="">
                    <p class="mt-2">เบอร์โทร :</p>
                    <input type="text" name="tel" value="<?= $fetch['tel'] ?>" class="form-control" id="">
                    <p class="mt-2">สถานะ : </p>
                    <input type="text" name="" disabled value="<?= $fetch['lavel']; ?>" class="form-control" id="">
                    <input type="hidden" name="img" value="<?= $fetch['img']; ?>">
                    <input type="hidden" name="id" value="<?= $fetch['id']; ?>">
                    <div class="mt-3">
                        <input type="submit" class="btn btn-primary" name="submit" value="อัพเดต">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
        if (isset($_POST['submit'])) {
            $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
            $file_loc = $_FILES['file']['tmp_name'];
            $file_size = $_FILES['file']['size'];
            $file_type = $_FILES['file']['type'];
            $folder = "../assets/images/upload/";
            $old_img = $_POST['old_img'];


            /* make file name in lower case */
            $new_file_name = strtolower($file);
            /* make file name in lower case */

            $final_file = str_replace(' ', '-', $new_file_name);
            $newname = 'assets/images/upload/' . $final_file;
            if (move_uploaded_file($file_loc, $folder . $final_file)) {
                $update = mysqli_query($con, "UPDATE `tb_users` SET `email`='$_POST[email]',`tel`='$_POST[tel]',`name`='$_POST[name]',`address`='$_POST[address]',`img`='$newname' WHERE id =  '$_POST[id]'");
                unlink($old_img);
                $_SESSION['success'] = "อัพเดตโปรไฟล์เรียบร้อย";
                echo '<script>window.location="profile.php"</script>';
            } else {
                $update = mysqli_query($con, "UPDATE `tb_users` SET `email`='$_POST[email]',`tel`='$_POST[tel]',`name`='$_POST[name]',`address`='$_POST[address]',`img`='$old_img' WHERE id =  '$_POST[id]'");
                $_SESSION['success'] = "อัพเดตโปรไฟล์เรียบร้อย";
                echo '<script>window.location="profile.php"</script>';
            }
        }
        ?>
    <?php include('function/footer.php');
} ?>