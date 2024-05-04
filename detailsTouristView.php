<?php
require('system/helper.php');

$selectlandmarksSql = "SELECT `landmarks`.`landmark_id`, `landmarks`.`type`, `landmarks`.`landmark_name`, `landmarks`.`landmark_site`, `landmarks`.`file`, `landmarks`.`description`, `cities`.`city_name` FROM `landmarks` , `cities` WHERE `landmarks`.`city_id` = `cities`.`city_id`  and landmark_id ={$_GET['id']}";
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
<?php
include "layout/inc/header.php";
?>
<main> <!-- bread cumb -->
    <section class="breadcrumb d-flex items-center justify-center relative overflow-hidden">
        <div class="img_Container absolute"></div>
        <div class="container"><h1 class="title capitalize pb-5 text-center fs-r-36 fw-700 line-normal"> تفاصيل المعالم
                السياحية <span id="userName"></span></h1>
            <ul class="d-flex items-center justify-center relative">
                <li class="linkPage"> تفاصيل المعالم السياحية</li>
                <li class="separator"></li>
                <li class="defPage "><a href="index.php" class=""> الصفحة الرئيسية </a></li>
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
                    </div>
                </div> <!-- left-side -->
                <div class="col-6-lg col-12-md col-12-sm row-left">
                    <div class="left-side">
                        <div class="img-container round-6 relative">
                            <?php
                            if ($rowlandmark['type'] == 'image') {
                                ?>
                                <img src="<?php echo $rowlandmark['file'] ?>" alt="صورة المعلم" class="round-6"
                                     width="1456"
                                     height="832" loading="lazy" decoding="async">
                                <?php
                            } elseif ($rowlandmark['type'] == 'video') {
                                ?>
                                <video class="round-6" width="1456" height="832" controls>
                                    <source src="<?php echo $rowlandmark['file'] ?>" type="video/mp4">
                                </video>
                                <?php
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