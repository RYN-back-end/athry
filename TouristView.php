<?php
require('system/helper.php');

$selectlandmarksSql = 'SELECT `landmarks`.`landmark_id`, `landmarks`.`landmark_name`, `landmarks`.`landmark_site`, `landmarks`.`file`, `landmarks`.`description`, `cities`.`city_name` FROM `landmarks` , `cities` WHERE `landmarks`.`city_id` = `cities`.`city_id`  order by `landmarks`.`landmark_id` DESC LIMIT 8';
$selectlandmarksResult = runQuery($selectlandmarksSql);

?>

<!DOCTYPE html><html lang="ar">
 <head>
 <meta charset="UTF-8">
 <meta name="description" content="Astro description">
 <meta name="viewport" content="width=device-width">
 <link rel="icon" type="image/svg+xml" href="favicon.svg">
 <meta name="generator" content="Astro v4.4.7">
 <title>Asre | عرض المعالم السياحية</title>
 <!-- <Font /> --><link rel="stylesheet" href="./assets/css/AboutUs-B-4qtAMl.css" />
<link rel="stylesheet" href="./assets/css/TouristView-B4EhKPX_.css" />
<script type="module" src="./assets/js/hoisted-C_1GnFOu.js">
</script>
</head>
 <body>
<?php
include "layout/inc/header.php";
?>
 <main>
 <!-- bread cumb --> 
 <section class="breadcrumb d-flex items-center justify-center relative overflow-hidden">
 <div class="img_Container absolute"></div> <div class="container">
 <h1 class="title capitalize pb-5 text-center fs-r-36 fw-700 line-normal">  عرض المعالم السياحية  <span id="userName"></span> </h1>
 <ul class="d-flex items-center justify-center relative"> 
 <li class="linkPage"> عرض المعالم السياحية </li> 
 <li class="separator"></li> <li class="defPage "> 
 <a href="/" class=""> الصفحة الرئيسية </a> </li>
 </ul>
 </div>
 </section> 
 <section class="tourist-view"> <div class="container">
 <!-- filter --> 
 <div class="filter-container d-flex items-center justify-between md-max-gap-x-5"> 
 <h2 class="fs-r-30 fw-700">المعالم السياحية</h2> <div class="filter-input d-flex items-center md-max-gap-x-5"> 
 <input type="text" placeholder="ادخل المدينة" name="" class="pr-5 round-6">
 <input type="text" placeholder="ادخل اسم المَعلم" name="" class="pr-5 round-6 md-mr-4"> 
 </div> 
 </div>
 
 
 
 <div class="row gap-row-1 gap-x-12">
  <?php if ($selectlandmarksResult->num_rows > 0) {
           while ($row = $selectlandmarksResult->fetch_assoc()) {
                        ?>
 <div class="col-4-lg col-6-md col-12-sm"> 
 <a href="detailsTouristView.php?id=<?php echo $row['landmark_id'] ?>"> 
 <div class="card round-8">
 <div class="top"> 
 <img src="<?php echo $row['file'] ?>" alt="img for product" class="img-cover" width="1456" height="832" loading="lazy" decoding="async"><a href="detailsTouristView.php?id=<?php echo $row['landmark_id'] ?>"> 
 </div> 
 
 <div class="body"> 
 <div class="d-flex items-center justify-between pb-4">
 <h3 class="fw-700 fs-28"><?php echo $row['landmark_name'] ?></h3> 
 <p class="place d-flex items-center fw-700 ">
 <svg width="24" height="24" viewBox="0 0 24 24" class="ml-1" data-icon="location">  
 <symbol id="ai:local:location">
 <path fill="currentColor" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7M7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9"/><circle cx="12" cy="9" r="2.5" fill="currentColor"/>
 </symbol><use xlink:href="#ai:local:location"></use>  
 </svg> <?php echo $row['city_name'] ?> </p> </div> 
 <p class="des fs-18 pb-4 fw-500 line-normal"><?php echo $row['description'] ?></p>  
 <button class="btn btn-popup booking-btn mb-2 py-5 round-6 mx-auto d-flex items-center justify-center fs-18 fw-500" type="button" aria-label="احجز الان"><a href="detailsTouristView.php?id=<?php echo $row['landmark_id'] ?>"> عرض التفاصيل </a> </button> 
 </div>
 <!-- end --> 
 </div>
 </a>
  <?php
                    }
                }
                ?>
 </div>
 
 </div> </div> </div> 
 
 </section> 
 </main>   <?php
include "layout/inc/footer.php";
?>
 </body>
 </html>