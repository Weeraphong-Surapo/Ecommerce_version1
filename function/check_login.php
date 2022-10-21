<?php
if (!isset($_SESSION)) {
    session_start();
}
include "connect.php";
if(isset($_POST['login'])){
    $password = $_POST['pass'];
    $chck_email = mysqli_query($con,"SELECT * FROM tb_users WHERE email = '$_POST[email]'");
    if(mysqli_num_rows($chck_email) == 0){
        $_SESSION['error'] = 'ไม่มีชื่อผู้ใช้นี้ในระบบ';
        header('location:../login.php');    
    }else{
        $check = mysqli_query($con,"SELECT * FROM tb_users WHERE email = '$_POST[email]'");
        $pas = mysqli_fetch_array($check);
        $pass = $pas['password'];
        $check_pass = hash('sha512',$password);
        if($check_pass !== $pass){
            $_SESSION['error_pass'] = 'รหัสผ่านไม่ถูกต้อง';
            header('location:../login.php');
            echo $check_pass;
            echo "<br>";
            echo $password;
        }else{
            $check_lavel = mysqli_query($con,"SELECT * FROM tb_users WHERE email = '$_POST[email]' AND password = '$check_pass'");
            $fetch = mysqli_fetch_array($check_lavel);
            if(mysqli_num_rows($check_lavel) == 1){
                if($fetch['lavel'] == "admin"){
                    $_SESSION['admin_id'] = $fetch['id'];
                    $_SESSION['img'] = $fetch['img'];
                    $_SESSION['username'] = "admin";
                    $_SESSION['name'] = $fetch['name'];
                    $_SESSION['login'] = true;
                    echo '<script>window.location="../admin/index.php"</script>';
                }else{
                    $_SESSION['user_id'] = $fetch['id'];
                    $_SESSION['img'] = $fetch['img'];
                    $_SESSION['username'] = "user";
                    $_SESSION['name'] = $fetch['name'];
                    $_SESSION['login'] = true;
                    echo '<script>window.location="../index.php"</script>';
                }
            }
        }
    }
}
?>