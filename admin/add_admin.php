<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['login']) && $_SESSION['username'] != 'admin') {
    echo '<script>window.location="../index.php"</script>';
} else {
    include "../function/connect.php";
    include "swal.php";
    include('function/head.php');
    include "function/slide.php";
    include "function/navbar.php"; ?>
<div class="container">
    <div class="card p-4 mt-3 shadow-lg">
        <div class="card-body">
            <h1 class="text-center">เพิ่มผู้ดูแล</h1>
            <hr class="bg-primary">
            <form action="" method="post" enctype="multipart/form-data">
                <center>
                    <img id="blah" src="#" alt="your image" style="border-radius: 100%;" width="130px" height="130px" />
                </center>
                <input accept="image/*" type='file' id="imgInp" name="file" class="form-control mb-2" required>
                <div class="mb-2">
                    <label for="">อีเมลล์</label>
                    <input type="email" name="email" class="form-control" required placeholder="อีเมลล์">
                </div>
                <div class="mb-2">
                    <label for="">รหัสผ่าน</label>
                    <input type="password" name="pass" class="form-control" required placeholder="รหัสผ่านเข้าระบบ">
                </div>
                <hr class="bg-primary">
                <div class="mb-2">
                    <label for="">ชื่อ - นามสกุล</label>
                    <input type="text" name="name" class="form-control" required placeholder="ชื่อ - นามสกุลผู้ใช้">
                </div>
                <div class="mb-2">
                    <label for="">ที่อยู่</label>
                    <input type="text" name="address" class="form-control" required placeholder="ที่อยู่">
                </div>
                <div class="mb-4">
                    <label for="">เบอร์โทร</label>
                    <input type="text" name="tel" class="form-control" required placeholder="เบอร์โทร">
                </div>
                <input type="submit" name="add_admin" value="เพิ่มผู้ดูลแล" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
<?php
    if (isset($_POST['add_admin'])) {
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];

        $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
        $file_loc = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];
        $folder = "../assets/images/img_admin/";


        /* make file name in lower case */
        $new_file_name = strtolower($file);
        /* make file name in lower case */

        $final_file = str_replace(' ', '-', $new_file_name);
        $newname = 'assets/images/img_admin/' . $final_file;

        $check = mysqli_query($con, "SELECT * FROM tb_users WHERE email = '$email'");
        if (mysqli_num_rows($check) >= 1) {
            echo "<script>alert('email นี้มีในระบบแล้ว')</script>";
        } else {
            $password_md5 = hash('sha512', $pass);
            $sql = "INSERT INTO `tb_users`(`id`, `email`, `password`, `tel`, `name`, `address`, `img`, `lavel`) VALUES (NULL,'$email','$password_md5','$tel','$name','$address','$newname','admin')";
            $result = mysqli_query($con, $sql);
            if (!$result) {
                echo "error";
            }
            if (move_uploaded_file($file_loc, $folder . $final_file)) {
                $_SESSION['success'] = "เพิ่มผู้ดูแลเรียบร้อย";
                echo $use->Swal('success','เพิ่มผู้ดูแลเรียบร้อย','','admin.php');
            } else {
                echo "Error.Please try again55";
            }
        }
    }
    ?>
<script>
imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
    }
}
</script>
<?php require('function/footer.php'); ?>
<?php } ?>