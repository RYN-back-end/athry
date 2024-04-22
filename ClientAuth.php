<?php
require('system/helper.php');
checkLogin();
if (isset($_POST['type'])) {
    if ($_POST['type'] == 'register') {

        if (isset($_POST['mail']) && isset($_POST['password'])) {
            $sql = "SELECT * FROM `clients` WHERE `mail` =  '{$_POST['mail']}'";
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $insertSql = "INSERT INTO `clients`(`name`,`mail`,`phone`,`password`) VALUES ('{$_POST['name']}','{$_POST['mail']}','{$_POST['phone']}','$password')";
            runQuery($insertSql);
            $getLastIdSql = "SELECT * FROM `clients` order by client_id DESC";
            $result = runQuery($getLastIdSql);
            $row = $result->fetch_assoc();

            $_SESSION['user']['client_id'] = $row['client_id'];
            $_SESSION['user']['name'] = $row['name'];
            $_SESSION['user']['image'] = $row['image'];
            $_SESSION['user']['mail'] = $row['mail'];
            $_SESSION['user']['phone'] = $row['phone'];
            $_SESSION['user']['loggedin'] = true;
            header('Location: index.php');
            die();
        }
    } elseif ($_POST['type'] == 'login') {
        if (isset($_POST['mail']) && isset($_POST['password'])) {
            $sql = "SELECT * FROM `clients` WHERE `mail` =  '{$_POST['mail']}'";
            $data = runQuery($sql);
            if ($data->num_rows > 0) {
                $row = $data->fetch_assoc();
                if (password_verify($_POST['password'], $row['password'])) {

                    if ($row['active'] == 0) {
                        header('Location: ClientAuth.php?error=لقد تم رفض تسجيلك');
                        die();
                    } elseif ($row['active'] == 2) {
                        header('Location: ClientAuth.php?error=تم التسجيل بإنتظار قبول مدير النظام');
                        die();
                    }

                    $_SESSION['user']['client_id'] = $row['client_id'];
                    $_SESSION['user']['name'] = $row['name'];
                    $_SESSION['user']['image'] = $row['image'];
                    $_SESSION['user']['mail'] = $row['mail'];
                    $_SESSION['user']['phone'] = $row['phone'];
                    $_SESSION['user']['loggedin'] = true;
                    header('Location: index.php');
                } else {
                    header('Location: ClientAuth.php?error=The Password Is Wrong');
                }
                die();
            } else {
                header('Location: ClientAuth.php?error=The Email Is Invalid');
            }
            die();
        }
    } else {
        header('Location: ClientAuth.php');
        die();
    }
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
    <title>اثري | register</title><!-- <Font /> -->
    <link rel="stylesheet" href="./assets/css/AboutUs-B-4qtAMl.css"/>
    <link rel="stylesheet" href="./assets/css/AdminAuth-Deu25Omq.css"/>
    <script type="module" src="./assets/js/hoisted-b9mKTGxa.js"></script>
</head>
<body>
<?php
include "layout/inc/header.php";
?>
<main class="relative Main">
    <div class="imgContainer absolute"><img src="./assets/images/asre-cnAquRBy_ZfACzo.webp" alt="bg" class="img-cover"
                                            loading="eager" width="1200" height="800" decoding="async"></div>
    <div class="container d-flex items-start justify-center mt-14 AuthMain">
        <section class="slideAuth relative mx-auto">
            <div class="d-flex items-start overflow-hidden" id="container">
                <div class="signIn Form" style="display: none;">

                    <form action="" method="post"><h1 class="text-center fs-r-30 fw-800 mb-8 line-relaxed">تسجيل
                            الدخول</h1>
                        <input type="hidden" name="type" value="login">

                        <div class="formGroup relative mb-7"><input type="email" name="mail"
                                                                    id="userEmailLogin" class="round-4 pr-5" required>
                            <label for="mail" class="absolute top-50 right-5">البريد الالكتروني</label>
                            <p class="error"></p></div>
                        <div class="formGroup relative mb-7"><input type="password" name="password"
                                                                    id="userPasswordLogin" class="round-4 pr-5"
                                                                    required> <label for="password"
                                                                                     class="absolute top-50 right-5">كلمة
                                المرور</label>
                            <p class="error"></p></div>
                        <button class="btn mt-8 btn-popup px-10 py-5 round-6 fs-18 d-flex items-center justify-center mx-auto"
                                type="submit" aria-label="sign in">
                            تسجيل الدخول
                        </button>
                        <p class="text-center mt-6 fs-14 changeResponsive">
                            ليس لديك حساب؟ <span class="fw-800 signInBtn"> أنشئ حسابك</span></p></form>
                </div>
                <div class="signUp Form pt-14">
                    <form action="" method="post"><h1 class="text-center fs-r-30 fw-800 mb-6 line-relaxed">أنشئ
                            حسابك</h1>
                        <input type="hidden" name="type" value="register">
                        <div class="formGroup relative mb-7"><input type="text" name="name" id="userName"
                                                                    class="round-4 pr-5" required> <label for="name"
                                                                                                          class="absolute top-50 right-5">الاسم
                                بالكامل</label>
                            <p class="error"></p></div>
                        <div class="formGroup relative mb-7"><input type="email" name="mail" id="userEmail"
                                                                    class="round-4 pr-5" required> <label
                                    for="mail" class="absolute top-50 right-5">البريد الالكتروني</label>
                            <p class="error"></p></div>
                        <div class="formGroup relative mb-7"><input type="number" name="phone" id="userPhone"
                                                                    class="round-4 pr-5" required> <label
                                    for="phone" class="absolute top-50 right-5">رقم الهاتف</label>
                            <p class="error"></p></div>
                        <div class="formGroup relative mb-7"><input type="password" name="password"
                                                                    id="password" class="round-4 pr-5" required>
                            <label for="userPassword" class="absolute top-50 right-5">كلمة المرور</label>
                            <p class="error"></p></div>
                        <button class="btn mt-5 btn-popup px-10 py-5 round-6 fs-18 d-flex items-center justify-center mx-auto"
                                type="submit" aria-label="sign in">
                            التسجيل
                        </button>
                        <p class="text-center mt-6 fs-14 changeResponsive">
                            هل لديك حساب؟ <span class="fw-800 signUpBtn">تسجيل الدخول</span></p></form>
                </div>
                <div class="toggle absolute right-0">
                    <div class="togglePanel toggleLeft active text-center relative overflow-hidden"><h1
                                class="fs-r-36 fw-800 line-relaxed"> انضم الينا </h1>
                        <p class="fw-500 line-relaxed py-6 px-14">اختر جولاتك بعناية واستمتع بزيارة المعالم السياحية</p>

                        <button class="btn mt-5 btn-popup px-10 py-5 round-6 fs-18 " type="button"
                                aria-label="تسجيل الدخول" id="Login"> تسجيل الدخول
                        </button>
                    </div> <!-- right -->
                    <div class="togglePanel toggleRight text-center relative overflow-hidden"><h1
                                class="fs-r-36 fw-800 line-relaxed"> مرحبا بعودتك </h1>
                        <p class="fw-500 line-relaxed py-6 px-14">اختر جولاتك بعناية واستمتع بزيارة المعالم السياحية</p>
                        <button class="btn mt-5 btn-popup px-10 py-5 round-6 fs-18 " type="button"
                                aria-label="انضم الينا" id="Register"> انضم الينا
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<?php
include "layout/inc/footer.php";
?>
</body>
</html>