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
<style>
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 3; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 10% auto; /* 10% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 35%; /* Could be more or less, depending on screen size */
        border-radius: 10px; /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Box shadow */
    }

    /* Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

</style>

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
                <li class="defPage "><a href="index.php" class=""> الصفحة الرئيسية </a></li>
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
                        <div class="d-flex items-center mb-6"><p class="title fs-18 fw-500">عدد الافراد المتاحين:</p>
                            <p class="des fw-600 fs-24"><?php echo $tour['person_no'] ?></p></div>
                        <div class="d-flex items-center mb-6"><p class="title fs-18 fw-500">التكلفة:</p>
                            <p class="des price fs-24 fw-700">
                                <?php echo $tour['price'] ?>
                                <span class="fs-16 fw-500">ر.س</span></p></div>
                        <div class="mt-14">
                            <button class="btn btn-popup  round-6 openModal" data-modal="myModal" type="button"
                                    aria-label="إضافة لجدول الرحلات"><a
                                        class="py-6 px-12 fs-18 fw-700 openModal" data-modal="myModal"> إضافة لجدول
                                    الرحلات</a></button>
                        </div>
                        <div id="myModal" class="modal" style="display: none">

                            <span class="close">&times;</span>

                            <div class="modal-content">
                                <form action="addToCart.php" method="post">
                                    <input type="hidden" name="tour_id"
                                           value="<?php echo $tour['tour_id'] ?>">


                                    <div class="col-12-lg col-12-md col-12-sm">
                                        <div class="formGroup relative mb-7 d-flex">
                                            <label for="startHouer" class="">عدد الأشخاص</label> <input
                                                    type="number" name="person_no"
                                                    max="<?php echo $tour['person_no'] ?>" min="1" required
                                                    style="width: 100%"
                                                    id="startHouer"
                                                    class="round-4 pr-5 pl-5 undefined"
                                                    placeholder="عدد الأشخاص"></div>
                                    </div>

                                    <div class="d-flex items-center justify-center mx-auto pt-14">
                                        <button class="btn btn-popup  round-6 openModal" data-modal="myModal"
                                                type="submit" aria-label="إضافة لجدول الرحلات"><a
                                                    class="py-6 px-12 fs-18 fw-700 openModal" data-modal="myModal">
                                                إضافة لجدول الرحلات</a></button>
                                    </div>
                                </form>

                            </div>

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

                                            <?php
                                            if ($oneLAndMark['type'] == 'image') {
                                                ?>
                                                <img src="<?php echo $oneLAndMark['file'] ?>" alt="صورة المعلم"
                                                     class="round-6"
                                                     width="1456"
                                                     height="832" loading="lazy" decoding="async">
                                                <?php
                                            } elseif ($oneLAndMark['type'] == 'video') {
                                                ?>
                                                <video class="round-6" width="1456" height="832" controls>
                                                    <source src="<?php echo $oneLAndMark['file'] ?>" type="video/mp4">
                                                </video>
                                                <?php
                                            }
                                            ?>


                                        </a>


                                    </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    var activeModal = null;
    $(document).on('click', '.openModal', function () {
        $('.modal').css('display', 'none')
        var modal = $(this).data('modal');
        $(`#${modal}`).css('display', 'block')
        activeModal = document.getElementById(`${modal}`);
    })

    window.onclick = function (event) {
        if (event.target == activeModal) {
            activeModal.style.display = "none";
        }
    }
</script>
</body>
</html>