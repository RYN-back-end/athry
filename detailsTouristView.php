<?php
require('system/helper.php');

$selectlandmarksSql = "SELECT `landmarks`.`landmark_id`, `landmarks`.`landmark_name`, `landmarks`.`landmark_site`, `landmarks`.`file`, `landmarks`.`description`, `cities`.`city_name` FROM `landmarks` , `cities` WHERE `landmarks`.`city_id` = `cities`.`city_id`  and landmark_id ={$_GET['id']}";
$selectlandmarksResult = runQuery($selectlandmarksSql);
$rowlandmark = $selectlandmarksResult->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Astro description">
    <meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <meta name="generator" content="Astro v4.4.7">
    <title>Asre | تفاصيل المعالم السياحية</title><!-- <Font /> -->
    <link rel="stylesheet" href="./assets/css/AboutUs-B-4qtAMl.css"/>
    <link rel="stylesheet" href="./assets/css/detailsTouristView-jw-muYGv.css"/>
    <script type="module" src="./assets/js/hoisted-C_1GnFOu.js">
    </script>
</head>
<body>
<header class="absolute top-0">
    <div class="container">
        <nav class="d-flex items-center justify-between py-2"><a href="/" class="logo"> <img
                        src="./assets/images/logo-ZIv9wrFv_Z1PmHf8.webp" alt="logo for Gift Genius " class="img-cover"
                        loading="eager" width="736" height="712" decoding="async"> </a>
            <button class="btn icon-nav-base" type="button" aria-label="open menu">
                <span></span><span></span><span></span></button>
            <ul class="d-flex items-center link-list normalMenu">
                <li class="nav-items pr-12"><a class="fw-700 nav-link  relative" href="/"> الرئيسية </a></li>
                <li class="nav-items pr-12"><a class="fw-700 nav-link  relative" href="AboutUs.html"> من نحن </a></li>
                <li class="nav-items pr-12"><a class="fw-700 nav-link  relative" href="TouristView.php"> المعالم
                        السياحية </a></li>
                <li class="nav-items pr-12"><a class="fw-700 nav-link  relative" href="ViewTours.html"> الجولات
                        السياحية </a></li>
                <li class="nav-items pr-12"><a class="fw-700 nav-link  relative" href="cart.html"> جدول الرحلات </a>
                </li>
            </ul>
            <button class="btn btn-popup nav-button round-6" type="button" aria-label="Auth page"><a href="Auth.html"
                                                                                                     class="py-6 px-14 fw-700 fs-18">انضم
                    الينا</a></button>
        </nav>
    </div>
</header>
<main> <!-- bread cumb -->
    <section class="breadcrumb d-flex items-center justify-center relative overflow-hidden">
        <div class="img_Container absolute"></div>
        <div class="container"><h1 class="title capitalize pb-5 text-center fs-r-36 fw-700 line-normal"> تفاصيل المعالم
                السياحية <span id="userName"></span></h1>
            <ul class="d-flex items-center justify-center relative">
                <li class="linkPage"> تفاصيل المعالم السياحية</li>
                <li class="separator"></li>
                <li class="defPage "><a href="/" class=""> الصفحة الرئيسية </a></li>
            </ul>
        </div>
    </section>
    <section class="detailsSection">
        <div class="container">
            <div class="row"> <!-- right-side -->
                <div class="col-6-lg col-12-md col-12-sm row-right">
                    <div class="right-side">
                        <div class="d-flex items-center mb-6">
                            <p class="title fs-18 fw-500">اسم المعلم:</p>
                            <p class="des name fs-24 fw-700"><?php echo $rowlandmark['landmark_name'] ?></p>
                        </div>
                        <div class="d-flex items-start mb-6">
                            <p class="title fs-18 fw-500">وصف:</p>
                            <p class="des overview fs-18">
                                <?php echo $rowlandmark['description'] ?>
                            </p></div>
                        <div class="d-flex items-center mb-6">
                            <p class="title fs-18 fw-500">مكان:</p>
                            <p class="des fw-600 fs-20"><?php echo $rowlandmark['landmark_site'] ?></</p> </div>
                        <div class="d-flex items-center mb-6">
                            <p class="title fs-18 fw-500">المدينة:</p>
                            <p class="des fw-600 fs-20"><?php echo $rowlandmark['city_name'] ?></</p> </div>
                        <div class="d-flex items-center justify-center mx-auto mt-14">
                            <button class="btn btn-popup  round-6" type="button" aria-label="احجز الان">
                                <a href="/" class="py-6 px-12 fs-18 fw-700"> احجز الان</a></button>
                        </div>
                    </div>
                </div> <!-- left-side -->
                <div class="col-6-lg col-12-md col-12-sm row-left">
                    <div class="left-side">
                        <div class="img-container round-6 relative">
                            <img src="<?php echo $rowlandmark['file'] ?>" alt="صورة المعلم" class="round-6" width="1456"
                                 height="832" loading="lazy" decoding="async"></div>
                    </div>
                </div> <!-- end row --> </div>
        </div>
    </section>
</main>
<footer>
    <div class="container d-flex items-start justify-between">
        <div class="footer-ul about-us"><p class="title fs-24 fw-700">من نحن</p>
            <p class="dec line-relaxed fs-16">
                نحن نقدم لك احدث العروض السياحية التي تناسب جميع الفئات بافضل
                الاسعار
            </p>
        </div> <!--  -->
        <div class="footer-ul contact-us"><p class="title fs-24 fw-700">تواصل معانا</p>
            <p class="dec line-relaxed fs-16">
                تطبيق الويب المثالي لاستكشاف العالم من حولك ومعرفة الماضي الخصاص بالحضارت المختلفة
            </p></div> <!--  -->
        <div class="footer-ul news"><p class="title fs-24 fw-700">اخر الاحداث</p>
            <p class="dec line-relaxed fs-16">
                يمكنك الوثوق بنا، فنحن نرسل العروض فقط، وليس بريدًا عشوائيًا واحدًا
            </p>
            <form action="/">
                <div class="from-group relative mt-7"><input type="email" placeholder="البريد الالكتروني"
                                                             class="round-4 pr-5">
                    <button class="btn  btn-popup sendEmails round-4 px-9  top-0 left-0" type="submit"
                            aria-label="send email">
                        <svg width="1em" height="1em" viewBox="0 0 32 32" data-icon="arrow-left">
                            <symbol id="ai:local:arrow-left">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M10 6 2 16l8 10M2 16h28"/>
                            </symbol>
                            <use xlink:href="#ai:local:arrow-left"></use>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</footer>
</body>
</html>