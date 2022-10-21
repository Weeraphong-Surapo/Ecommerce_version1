<?php include "function/header.php"; ?>

<!--main area-->
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">หน้าหลัก</a></li>
                <li class="item-link"><span>สมัครสมาชิก</span></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                <div class=" main-content-area">
                    <div class="wrap-login-item ">
                        <div class="register-form form-item ">
                            <form class="form-stl" action="function/check_register.php" name="frm-login" method="post">
                                <fieldset class="wrap-title">
                                    <h3 class="form-title">สร้างบัญชี</h3>
                                    <h4 class="form-subtitle">ข้อมูลส่วนตัว</h4>
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-reg-lname">ชื่อ*</label>
                                    <input type="text" id="frm-reg-lname" name="name" placeholder="ชื่อ*" required>
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="frm-reg-email">ที่อยู่อีเมลล์*</label>
                                    <input type="email" id="frm-reg-email" name="email" placeholder="ที่อยู่อีเมลล์"
                                        required>
                                </fieldset>

                                <fieldset class="wrap-title">
                                    <h3 class="form-title">ข้อมูลการเข้าสู่ระบบ</h3>
                                </fieldset>
                                <fieldset class="wrap-input item-width-in-half left-item ">
                                    <label for="frm-reg-pass">รหัสผ่าน *</label>
                                    <input type="password" id="frm-reg-pass" name="password" placeholder="รหัสผ่าน"
                                        required>
                                </fieldset>
                                <fieldset class="wrap-input item-width-in-half ">
                                    <label for="frm-reg-cfpass">ยืนยันรหัสผ่าน *</label>
                                    <input type="password" id="frm-reg-cfpass" name="c_password"
                                        placeholder="ยืนยันรหัสผ่าน" required>
                                </fieldset>
                                <input type="submit" class="btn btn-sign" value="สมัครสมาชิก" name="register">
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