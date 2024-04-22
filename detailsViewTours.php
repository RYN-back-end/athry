<?php
require('system/helper.php');

$selectTourSql = "SELECT * FROM `tours` WHERE `tour_id` = '{$_GET['id']}'";
$selectTourResult = runQuery($selectTourSql);

$tour = $selectTourResult->fetch_assoc();

$selectGuideSql = "SELECT * FROM `guides` WHERE `guide_id` = '{$tour['Guide_id']}'";
$selectGuideResult = runQuery($selectGuideSql);
$guide = $selectGuideResult->fetch_assoc();

$selectLandMarksSql = "SELECT * FROM `tour_details` WHERE `tour_id` = '{$_GET['id']}'";
$selectLandMarksResult = runQuery($selectLandMarksSql);

?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Astro description">
    <meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <meta name="generator" content="Astro v4.4.7">
    <title>Asre | تفاصيل الجولات السياحية</title><!-- <Font /> -->
    <link rel="stylesheet" href="./assets/css/AboutUs-B-4qtAMl.css"/>
    <link rel="stylesheet" href="./assets/css/detailsTouristView-jw-muYGv.css"/>
    <script type="module" src="./assets/js/hoisted-C_1GnFOu.js"></script>
</head>
<body>
<?php
include "layout/inc/header.php";
?>
<main> <!-- bread cumb -->
    <section class="breadcrumb d-flex items-center justify-center relative overflow-hidden">
        <div class="img_Container absolute"></div>
        <div class="container"><h1 class="title capitalize pb-5 text-center fs-r-36 fw-700 line-normal"> تفاصيل الجولات
                السياحية <span id="userName"></span></h1>
            <ul class="d-flex items-center justify-center relative">
                <li class="linkPage"> تفاصيل الجولات السياحية</li>
                <li class="separator"></li>
                <li class="defPage "><a href="/" class=""> الصفحة الرئيسية </a></li>
            </ul>
        </div>
    </section>
    <section class="detailsSection">
        <div class="container">
            <div class="row"> <!-- right-side -->
                <div class="col-5-lg col-12-md col-12-sm row-right">
                    <div class="right-side">
                        <div class="d-flex items-center mb-6"><p class="title fs-18 fw-500">اسم المرشد:</p>
                            <p class="des name fs-24 fw-700"><?php echo $guide['name'] ?></p></div>
                        <div class="d-flex items-center mb-6"><p class="title fs-18 fw-500">بداية الجولة:</p>
                            <p class="des fw-600 fs-20"><?php echo $tour['from_date'] ?></p></div>
                        <div class="d-flex items-center mb-6"><p class="title fs-18 fw-500">نهاية الجولة:</p>
                            <p class="des fw-600 fs-20"><?php echo $tour['to_date'] ?></p></div>
                        <div class="d-flex items-center mb-6"><p class="title fs-18 fw-500">عدد الافراد:</p>
                            <p class="des fw-600 fs-24">4</p></div>
                        <div class="d-flex items-center mb-6"><p class="title fs-18 fw-500">التكلفة:</p>
                            <p class="des price fs-24 fw-700">
                                <?php echo $tour['price'] ?>
                                <span class="fs-16 fw-500">ر.س</span></p></div>
                        <div class="mt-14">
                            <button class="btn btn-popup  round-6" type="button" aria-label="احجز الان"><a
                                        href="cart.html" class="py-6 px-12 fs-18 fw-700"> احجز الان</a></button>
                        </div>
                    </div>
                </div> <!-- left-side -->
                <div class="col-7-lg col-12-md col-12-sm row-left">
                    <div class="left-side">
                        <div class="full-img-container round-6 relative d-flex items-center gap-y-5">

                            <?php
                            if ($selectLandMarksResult->num_rows > 0) {
                                while ($row22 = $selectLandMarksResult->fetch_assoc()) {
                                    $oneLAndMark = runQuery("SELECT * FROM `landmarks` WHERE `landmark_id` = '{$row22['landmark_id']}'")->fetch_assoc();
                                    ?>
                                    <div class="">
                                        <a href="detailsTouristView.php?id=<?php echo $row22['landmark_id'] ?>">

                                            <img
                                                    src="<?php echo $oneLAndMark['file'] ?>" alt="صورة المعلم"
                                                    class="round-6 mb-5" width="1456" height="832" loading="lazy"
                                                    decoding="async"> </a></div>
                                    <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div> <!-- end row --> </div>
        </div>
    </section>
</main>
<?php
include "layout/inc/footer.php";
include "layout/inc/toastr.php";
?>
</body>
</html>