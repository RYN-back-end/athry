<?php
if (session_status() == PHP_SESSION_NONE) {
    // If session is not started, start the session
    session_start();
}
?>
<header class="absolute top-0">
    <div class="container">
        <nav class="d-flex items-center justify-between py-2"><a href="index.php" class="logo"> <img
                        src="./assets/images/logo-ZIv9wrFv_Z1PmHf8.webp" alt="logo for Gift Genius " class="img-cover"
                        loading="eager" width="736" height="712" decoding="async"> </a>
            <button class="btn icon-nav-base" type="button" aria-label="open menu">
                <span></span><span></span><span></span></button>
            <ul class="d-flex items-center link-list normalMenu">
                <li class="nav-items pr-12"><a class="fw-700 nav-link  relative" href="index.php"> الرئيسية </a></li>
                <li class="nav-items pr-12"><a class="fw-700 nav-link  relative" href="AboutUs.html"> من نحن </a></li>
                <li class="nav-items pr-12"><a class="fw-700 nav-link  relative" href="TouristView.php"> المعالم
                        السياحية </a></li>
                <li class="nav-items pr-12"><a class="fw-700 nav-link  relative" href="ViewTours.php"> الجولات
                        السياحية </a></li>
                <li class="nav-items pr-12"><a class="fw-700 nav-link  relative" href="cart.html"> جدول الرحلات </a>
                </li>
            </ul>
            <?php
            if (isset($_SESSION['guide']) && isset($_SESSION['guide']['loggedin'])) {
                ?>
                <button class="btn btn-popup nav-button round-6" type="button" aria-label="Auth page"><a
                            href="guide/index.php"
                            class="py-6 px-14 fw-700 fs-18">لوحة التحكم</a></button>

                <button class="btn btn-popup nav-button round-6" type="button" aria-label="Auth page"><a
                            href="logout.php"
                            class="py-6 px-14 fw-700 fs-18">تسجيل الخروج</a></button>
                <?php
            } elseif (isset($_SESSION['user']) && isset($_SESSION['user']['loggedin'])) {

                ?>
                <button class="btn btn-popup nav-button round-6" type="button" aria-label="Auth page"><a
                            href="logout.php"
                            class="py-6 px-14 fw-700 fs-18">تسجيل الخروج</a></button>
                <?php
            }else{

            ?>
            <button class="btn btn-popup nav-button round-6" type="button" aria-label="Auth page"><a
                        href="Auth.html"
                        class="py-6 px-14 fw-700 fs-18">إنصم إلينا</a></button>
            <?php
            }

            ?>
        </nav>
    </div>
</header>
