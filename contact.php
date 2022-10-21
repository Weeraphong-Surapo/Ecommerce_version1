<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['login'])) {
    echo '<script>alert("กรุณาเข้าสู่ระบบก่อน")</script>';
    echo '<script>window.location="login.php"</script>';
}
include "function/connect.php";
include "function/header.php"; ?>
<!--main area-->
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="index.php" class="link">หน้าหลัก</a></li>
                <li class="item-link"><span>ติดต่อ</span></li>
            </ul>
        </div>
        <div class="row">
            <div class=" main-content-area">
                <div class="wrap-contacts ">
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="contact-box contact-form">
                            <h2 class="box-title">ฝากข้อความ</h2>
                            <form action="#" method="POST" name="frm-contact">

                                <label for="name">ชื่อ<span>*</span></label>
                                <input type="text" value="" id="name" name="name">

                                <label for="email">อีเมลล์<span>*</span></label>
                                <input type="text" value="" id="email" name="email">

                                <label for="phone">เบอร์โทร</label>
                                <input type="text" value="" id="phone" name="phone">

                                <label for="comment">การติดต่อ</label>
                                <textarea name="comment" id="comment"></textarea>

                                <input type="submit" name="submit" value="ติดต่อ">

                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="contact-box contact-info">
                            <div class="wrap-map">
                                <div class="mercado-google-maps" id="az-google-maps57341d9e51968" data-hue=""
                                    data-lightness="1" data-map-style="2" data-saturation="-100"
                                    data-modify-coloring="false" data-title_maps="Kute themes"
                                    data-phone="088-465 9965 02" data-email="kutethemes@gmail.com"
                                    data-address="Z115 TP. Thai Nguyen" data-longitude="-0.120850"
                                    data-latitude="51.508742" data-pin-icon="" data-zoom="16" data-map-type="ROADMAP"
                                    data-map-height="263">
                                </div>
                            </div>
                            <h2 class="box-title">รายระเอียดการติดต่อ</h2>
                            <div class="wrap-icon-box">

                                <div class="icon-box-item">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <div class="right-info">
                                        <b>อีเมลล์</b>
                                        <p>weeraphong61045@gmail.com</p>
                                    </div>
                                </div>

                                <div class="icon-box-item">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <div class="right-info">
                                        <b>เบอร์โทร</b>
                                        <p>092-556-2767</p>
                                    </div>
                                </div>

                                <div class="icon-box-item">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <div class="right-info">
                                        <b>Mail Office</b>
                                        <p>Sed ut perspiciatis unde omnis<br />Street Name, Los Angeles</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end main products area-->

        </div>
        <!--end row-->

    </div>
    <!--end container-->

</main>
<!--main area-->
<?php
if (isset($_POST['submit'])) {
    $contact = mysqli_query($con, "INSERT INTO `tb_contact`(`id`, `contact_name`, `contact_phone`, `contact_email`,  `contact_description`, `user_id`) VALUES (NULL,'$_POST[name]','$_POST[phone]','$_POST[email]','$_POST[comment]','$_SESSION[user_id]')");
    if (!$contact) {
        echo "try again";
        echo $_POST['Name'];
    } else {
        echo '<script>window.location="thankyou.php?p=contact"</script>';
    }
}
?>
<!--footer area-->
<?php include "function/footer.php"; ?>