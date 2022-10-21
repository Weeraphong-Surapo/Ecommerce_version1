<?php
include "connect.php";
if(isset($_POST['register'])){
    $pass = $_POST['password'];
    $c_pass = $_POST['c_password'];
    if($pass !== $c_pass){
        echo '<script>alert("รหัสผ่านไม่ตรงกัน!!")</script>';
        echo '<script>window.location="../register.php"</script>';
    }else{
        $cheeck = mysqli_query($con,"SELECT * FROM tb_users WHERE email = '$_POST[email]'");
        if(mysqli_num_rows($cheeck) >= 1){
            echo '<script>alert("Email มีผู้ใช้งานแล้ว!!")</script>';
            echo '<script>window.location="../register.php"</script>';
        }else{
            $password_md5 = hash('sha512', $pass);
            $insert_user = mysqli_query($con,"INSERT INTO tb_users(name,email,password,lavel) VALUES('$_POST[name]','$_POST[email]','$password_md5','user')");
            echo '<script>alert("สมัครสมาชิกสำเร็จ!!")</script>';
            echo '<script>window.location="../login.php"</script>';
        }
    }
}

?>