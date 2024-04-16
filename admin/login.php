<?php
require('../system/helper.php');
checkAdminLogin();
if (isset($_POST['email']) && isset($_POST['password'])) {
    $sql = "SELECT * FROM `admins` WHERE `email` =  '{$_POST['email']}'";
    $data = runQuery($sql);
    if ($data->num_rows > 0) {
        $row = $data->fetch_assoc();
        if (password_verify($_POST['password'], $row['password'])) {
            $_SESSION['admin']['id'] = $row['id'];
            $_SESSION['admin']['name'] = $row['name'];
            $_SESSION['admin']['email'] = $row['email'];
            $_SESSION['admin']['loggedin'] = true;
            header('Location: index.php');
        } else {
            header('Location: login.php?error=The Password Is Wrong');
        }
    } else {
        header('Location: login.php?error=The Email Is Invalid');
    }
    die();
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap4 Dashboard Template">
    <meta name="author" content="ParkerThemes">
    <link rel="shortcut icon" href="../assets/images/logo-ZIv9wrFv_Z1PmHf8.webp"/>

    <!-- Title -->
    <title>اثري | تسجيل الدخول</title>
    <!-- *************
        ************ Common Css Files *************
    ************ -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <!-- Master CSS -->
    <link rel="stylesheet" href="assets/css/main.css"/>

</head>

<body class="authentication">

<!-- Container start -->
<div class="container">

    <form action="" method="post">
        <div class="row justify-content-md-center">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="login-screen">
                    <div class="login-box">
                        <a href="#" class="login-logo">
                            <img src="../assets/images/logo-ZIv9wrFv_Z1PmHf8.webp" alt="اثري"/>
                        </a>
                        <h5>مرحباً بك مره اخري,<br/>قم بتسجيل الدخول الى اثري.</h5>
                        <div class="form-group">
                            <input type="text" required name="email" class="form-control"
                                   placeholder="البريد الإلكتروني"/>
                        </div>
                        <div class="form-group">
                            <input type="password" required name="password" class="form-control"
                                   placeholder="كلمة المرور"/>
                        </div>
                        <div class="actions mb-4">
                            <button type="submit" class="btn btn-primary">تسجيل الدخول</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
<!-- Container end -->

</body>
</html>