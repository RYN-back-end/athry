<?php
require('system/helper.php');

$selectToursSql = 'SELECT * FROM `tours` order by `tour_id` DESC';
$selectToursResult = runQuery($selectToursSql);

?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Astro description">
    <meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <meta name="generator" content="Astro v4.4.7">
    <title>Asre | عرض الجولات السياحية</title><!-- <Font /> -->
    <link rel="stylesheet" href="./assets/css/AboutUs-B-4qtAMl.css"/>
    <link rel="stylesheet" href="./assets/css/ViewTours-lDOnhjy2.css"/>
    <script type="module" src="./assets/js/hoisted-Wapajti4.js"></script>
</head>
<body>
<?php
include "layout/inc/header.php";
?>
<main> <!-- bread cumb -->
    <section class="breadcrumb d-flex items-center justify-center relative overflow-hidden">
        <div class="img_Container absolute"></div>
        <div class="container"><h1 class="title capitalize pb-5 text-center fs-r-36 fw-700 line-normal"> عرض الجولات
                السياحية <span id="userName"></span></h1>
            <ul class="d-flex items-center justify-center relative">
                <li class="linkPage"> عرض الجولات السياحية</li>
                <li class="separator"></li>
                <li class="defPage "><a href="index.php" class=""> الصفحة الرئيسية </a></li>
            </ul>
        </div>
    </section>
    <section class="tours">
        <div class="container">
            <div class="top-tours d-flex items-center justify-between"><h2 class="fs-r-30 fw-700">عرض الجولات
                    السياحية</h2>
                <button class="btn btn-popup search-btn py-6 px-12 round-6 fs-18 fw-700 " type="button"
                        aria-label="open-search-model" id="openSearch">
                    ابحث عن جولاتك
                </button>
            </div>
            <div class="form-container">
                <form action="" class="relative"><h4 class="text-center fs-r-30 fw-700 pb-10">احجز جولتك</h4>
                    <div class="date mb-12 d-flex items-center"><p class="fs-18 fw-700">التاريخ</p>
                        <div class="form-group relative d-flex items-center mr-8"><label for="dateFrom">من</label>
                            <input type="text" name="dateFrom" placeholder=" تارخ بداية الرحلة " class="mr-3 pr-5"
                                   id="dateFrom"></div>
                        <div class="form-group relative d-flex items-center mr-8"><label for="dateFrom">الي</label>
                            <input type="text" name="dateTo" placeholder=" تارخ نهاية الرحلة " class="mr-3 pr-5"
                                   id="dateTo"></div>
                    </div>
                    <div class="userDetails mb-12 d-flex items-center">
                        <div class="form-group relative d-flex items-center mr-8"><label for="numberUser"
                                                                                         class="fs-18 fw-700">عدد
                                الافراد</label>
                            <div class="relative">
                                <button class="btn absolute more" type="button" aria-label="more user">
                                    +
                                </button>
                                <input type="text" name="numberUser" placeholder=" عدد الافراد " class="mr-3"
                                       id="numberUser" value="1">
                                <button class="btn absolute mins" type="button" aria-label="mins user">
                                    -
                                </button>
                            </div>
                        </div> <!-- cost -->
                        <div class="form-group relative d-flex items-center mr-8"><label for="cost"
                                                                                         class="pl-5 fs-18 fw-700">
                                التكلفة للفرد</label> <input type="text" name="cost" placeholder=" التكلفة للفرد "
                                                             class="mr-3 pr-5" id="cost" value="180" disabled> <span
                                    class="pr-5">ر.س</span></div>
                    </div>
                    <div class="form-group relative d-flex items-center mr-8 mb-12 city"><label for="city"
                                                                                                class="fs-18 fw-700">
                            المدينة</label> <input type="text" name="city" placeholder=" المدينة  " class="mr-3 pr-5"
                                                   id="city"></div>
                    <div class="d-flex items-center justify-center mx-auto">
                        <button class="btn btn-popup search-btn py-5 px-14 round-6 fs-18 fw-700" type="submit"
                                aria-label="searching">
                            بحث
                        </button>
                    </div>
                    <button class="btn btn-close py-6 px-6 absolute top-0 right-0" type="button"
                            aria-label="close model" id="closeMode">
                        <svg width="1em" height="1em" viewBox="0 0 24 24" data-icon="close">
                            <symbol id="ai:local:close">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M6 18 18 6m0 12L6 6"/>
                            </symbol>
                            <use xlink:href="#ai:local:close"></use>
                        </svg>
                    </button>
                </form>
            </div>
            <div class="row gap-row-1 gap-x-12">
                <?php if ($selectToursResult->num_rows > 0) {
                    while ($row = $selectToursResult->fetch_assoc()) {
                        ?>
                        <div class="col-4-lg col-6-md col-12-sm">
                            <a href="detailsViewTours.php?id=<?php echo $row['tour_id'] ?>">
                                <div class="card round-8">
                                    <div class="top"><img src="<?php echo $row['image'] ?>"
                                                          style="height: 240px;object-fit: contain"
                                                          alt="img for product"
                                                          class="img-cover" width="1456" height="832" loading="lazy"
                                                          decoding="async"></div>
                                    <div class="body">
                                        <div class="d-flex items-center justify-between pb-4"><h3
                                                    class="fw-700 fs-28"><?php echo $row['name'] ?></h3>
                                            <!--                                            <p class="place d-flex items-center fw-700 ">-->
                                            <!--                                                <svg width="24" height="24" viewBox="0 0 24 24" class="ml-1"-->
                                            <!--                                                     data-icon="location">-->
                                            <!--                                                    <symbol id="ai:local:location">-->
                                            <!--                                                        <path fill="currentColor"-->
                                            <!--                                                              d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7M7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9"/>-->
                                            <!--                                                        <circle cx="12" cy="9" r="2.5" fill="currentColor"/>-->
                                            <!--                                                    </symbol>-->
                                            <!--                                                    <use xlink:href="#ai:local:location"></use>-->
                                            <!--                                                </svg>-->
                                            <!--                                                الاقصر-->
                                            <!--                                            </p>-->
                                        </div>
                                        <!--                                        <p class="des fs-18 pb-4 fw-500 line-normal">-->
                                        <?php //echo $row['tour_id'] ?><!-- </p>-->
                                        <p class="price des fs-18 pb-8 fw-500">
                                            سعر الرحلة للفرد : <span><?php echo $row['price'] ?> ر.س </span></p>
                                        <button class="btn btn-popup booking-btn mb-2 py-5 round-6 mx-auto d-flex items-center justify-center fs-18 fw-500"
                                                type="button" aria-label="احجز الان"> احجز الان
                                        </button>
                                    </div> <!-- end --> </div>
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>
        </div>
    </section>
</main>
<?php
include "layout/inc/footer.php";
include "layout/inc/toastr.php";
?>
</body>
</html>