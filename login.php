<?php
if (!isset($_SESSION)) {
    session_start();
}
include "function/header.php"; ?>
<!--main area-->
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="index.php" class="link">หน้าหลัก</a></li>
                <li class="item-link"><span>เข้าสู่ระบบ</span></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                <div class=" main-content-area">
                    <div class="wrap-login-item ">
                        <div class="login-form form-item form-stl">
                            <form name="frm-login" action="function/check_login.php" method="POST">
                                <fieldset class="wrap-title">
                                    <h3 class="form-title">ลงชื่อเข้าใช้บัญชีของคุณ</h3>
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-login-uname">ที่อยู่อีเมล:</label>
                                    <input type="text" id="frm-login-uname" name="email"
                                        placeholder="พิมพ์ที่อยู่อีเมลของคุณ">
                                    <?php if (isset($_SESSION['error'])) {
                                        echo '<div class="text-danger" style="margin-top: 8px;">' . $_SESSION['error']
                                        . '</div>'; unset($_SESSION['error']);
                                    } ?>
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-login-pass">รหัสผ่าน:</label>
                                    <input type="password" id="frm-login-pass" name="pass" placeholder="************">
                                    <?php if (isset($_SESSION['error_pass'])) {
                                        echo '<div class="text-danger" style="margin-top: 8px;">' . $_SESSION['error_pass'] . '</div>';
                                        unset($_SESSION['error_pass']);
                                    } ?>
                                </fieldset>
                                <input type="submit" class="btn btn-submit" value="เข้าสู่ระบบ" name="login">
                            </form>
                        </div>
                    </div>
                </div>
                <!--end main products area-->
            </div>
        </div>
        <!--end row-->

    </div>
    <!--end container-->

</main>
<!--main area-->

<!--footer area-->
<?php include "function/footer.php"; ?>