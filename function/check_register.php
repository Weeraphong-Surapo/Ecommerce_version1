<?php
include "connect.php";
include "swal.php";
if(isset($_POST['register'])){
    $pass = $_POST['password'];
    $c_pass = $_POST['c_password'];
    if($pass !== $c_pass){
        echo $use->Swal('warning','รหัสผ่านไม่ตรงกัน','','../register.php');
    }else{
        $cheeck = mysqli_query($con,"SELECT * FROM tb_users WHERE email = '$_POST[email]'");
        if(mysqli_num_rows($cheeck) >= 1){
            echo $use->Swal('warning','Email มีผู้ใช้งานแล้ว','','../register.php');
        }else{
            $password_md5 = hash('sha512', $pass);
            $insert_user = mysqli_query($con,"INSERT INTO tb_users(name,email,password,lavel) VALUES('$_POST[name]','$_POST[email]','$password_md5','user')");
            echo $use->Swal('warning','สมัครสมาชิกสำเร็จ','','../login.php');
        }
    }
}

?>