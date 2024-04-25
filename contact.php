<?php
require('system/helper.php');

if (isset($_POST['name'])) {
   $insertSql = "INSERT INTO `contacts` (`name`,`email`,`subject`,`text`) VALUES ('{$_POST['name']}','{$_POST['email']}','{$_POST['subject']}','{$_POST['text']}')";
   runQuery($insertSql);
   header('location:contact.php?success=تم الإرسال بنجاح');
   die();
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Astro description">
    <meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <meta name="generator" content="Astro v4.4.7">
    <title>Asre | من نحن </title><!-- <Font /> -->
    <link rel="stylesheet" href="./assets/css/AboutUs-B-4qtAMl.css"/>
    <link rel="stylesheet" href="./assets/css/AboutUs-D8lAkVIF.css"/>
    <script type="module" src="./assets/js/hoisted-C_1GnFOu.js"></script>

    <style>
        .bord {
            border-width: 5px;
            border-style: solid;
            border-color: #8a6143;
            border-height: 15px;
            margin: 10px 20px;
            padding: 20px;
            margin: 50PX;

        }

        input[type=text], textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }


        .container1 {
            background-color: #8a6143;
            border-radius: 10px;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;

            width: 300px;

            justify-content: center;

        }

    </style>
</head>

<body>

<?php
include "layout/inc/header.php";
?>
<main>
    <section class="breadcrumb relative overflow-hidden">
        <div class="img_Container absolute"></div>
        <div class="container">
            <h1 class="title capitalize pb-5 text-center fs-r-36 fw-700 line-normal"> تواصل معانا
                <span id="userName"></span></h1>
            <ul class="d-flex items-center  relative">
                <li class="defPage "><a href="index.php" class=""> الصفحة الرئيسية </a></li>
                <li class="separator"></li>
                <li class="linkPage"> تواصل معانا</li>
            </ul>
        </div>
    </section>

    <h1 class="title capitalize pb-5 text-center fs-r-36 fw-700 line-normal">ارسل اقترحاتك واستفساراتك</h1>
    <form action="" method="post" class=bord>
        <h3><label> الاسم بالكامل</label>
            <input type="text" placeholder="الاسم" required name="name"><br>
            <label> البريد الالكتروني</label>
            <input type="text" placeholder="البريد الالكتروني" required name="email"><br>

            <label> موضوع الرسالة</label>
            <input type="text" placeholder="موضوع الرسالة" name="subject"><br>

            <label> محتوى الرسالة</label>
            <textarea placeholder="اترك رسالتك" required name="text">

</textarea>

        </h3>

        <div style="width: 100%;">

            <button class="container1" type="submit" style="margin-right: 40%" aria-label="contact us">
                ارسل رسالتك
            </button>

        </div>

    </form>
    <?php
    include "layout/inc/footer.php";
    include "layout/inc/toastr.php";
    ?>
</body>
</html>