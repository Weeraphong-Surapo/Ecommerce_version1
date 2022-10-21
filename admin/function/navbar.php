<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-chevron-double-left"></span>
        </button>
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.html"></a>
        </div>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown d-none d-md-block">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="nav-profile-text"><?= $_SESSION['name'] ?> </div>
                </a>
                <div class="dropdown-menu center navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="edit_profile.php">
                        <i class="mdi mdi-account me-3"></i>ข้อมูลส่วนตัว</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="function/logout.php">
                        <i class="mdi mdi-logout me-3"></i>ออกจากระบบ</a>
                </div>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block me-4">
                <i class="mdi mdi-home-circle"></i>
            </li>
        </ul>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>