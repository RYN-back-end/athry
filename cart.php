<?php
require('system/helper.php');
checkLogin();


$selectCartSql = "SELECT *  FROM `cart` WHERE `status` = 'new'AND `client_id`='{$_SESSION['user']['client_id']}'";
$selectCartResult = runQuery($selectCartSql);
$selectCartSumSql = "SELECT SUM(price) AS total_price  FROM `cart` WHERE `status` = 'new'AND `client_id`='{$_SESSION['user']['client_id']}'";
$selectCartSumResult = runQuery($selectCartSumSql);
$cartItems = [];
if ($selectCartResult->num_rows > 0) {
    while ($row = $selectCartResult->fetch_assoc()) {
        $gide = runQuery("SELECT * FROM `guides` WHERE `guide_id` ='{$row['guide_id']}'")->fetch_assoc();
        $row['guide'] = $gide;
        $cartItems[] = $row;
    }
}
if (isset($_GET['id']) && isset($_GET['status']) && in_array($_GET['status'] ?? '', ['confirmed', 'cancel'])) {
    if ($_GET['status'] == 'cancel') {
        runQuery("DELETE FROM `cart` WHERE id = '{$_GET['id']}'");
        header("location: cart.php?success=تم الإلغاء بنجاح");
        die();
    } elseif ($_GET['status'] == 'confirmed') {
        header("location: payment.php?id={$_GET['id']}&success=بإنتظار تأكيد الدفع");
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
    <title>Asre | تفاصيل المعالم السياحية</title>
    <link rel="stylesheet" href="./assets/css/AboutUs-B-4qtAMl.css"/>
    <link rel="stylesheet" href="./assets/css/ControlBook-BH5HrU0m.css"/>
    <script type="module" src="./assets/js/hoisted-C_1GnFOu.js"></script>
</head>
<body>
<?php
include "layout/inc/header.php";
?>
<main> <!-- bread cumb -->
    <section class="breadcrumb d-flex items-center justify-center relative overflow-hidden">
        <div class="img_Container absolute"></div>
        <div class="container"><h1 class="title capitalize pb-5 text-center fs-r-36 fw-700 line-normal"> جدول الرحلات
                <span id="userName"></span></h1>
            <ul class="d-flex items-center justify-center relative">
                <li class="linkPage"> جدول الرحلات</li>
                <li class="separator"></li>
                <li class="defPage "><a href="index.php" class=""> الصفحة الرئيسية </a></li>
            </ul>
        </div>
    </section>
    <section class="cart">
        <div class="mainHeading text-center"><h2 class="fs-36 fw-700 d-inline-block relative">تاكيد الحجز</h2></div>
        <div class="container">
            <table>
                <thead>
                <tr>
                    <td>اسم المرشد</td>
                    <td>بداية الرحلة</td>
                    <td>نهاية الرحلة</td>
                    <td>عدد الافراد</td>
                    <td>التكلفة</td>
                </tr>
                </thead>
                <tbody>
                <?php
                if (isset($cartItems[0]['guide'])) {
                    foreach ($cartItems as $cartItem) {
                        ?>
                        <tr>
                            <td> <?php echo $cartItem['guide']['name'] ?? "" ?></td>
                            <td><?php echo $cartItem['from_date'] ?></td>
                            <td><?php echo $cartItem['to_date'] ?></td>
                            <td> <?php echo $cartItem['person_no'] ?></td>
                            <td> <?php echo $cartItem['price'] ?> ر.س</td>
                            <td>
                                <a href="?id=<?php echo $cartItem['id'] ?>&status=confirmed"
                                   class="btn btn-popup py-3 px-6 round-6 sure" type="button" aria-label="تاكيد الحجز">
                                    تاكيد
                                </a>
                            </td>
                            <td>
                                <a href="?id=<?php echo $cartItem['id'] ?>&status=cancel"
                                   class="btn btn-popup py-3 px-6 round-6 delete" type="button"
                                   aria-label="الغاء الحجز">
                                    الغاء
                                </a>
                            </td>
                        </tr>

                        <?php
                    }
                    ?>
                    <tr>
                        <td colspan="5">الإجمالى</td>
                        <td colspan="2"><?php echo $selectCartSumResult->fetch_assoc()['total_price'] ?? 0 ?> ر.س</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </section> <!-- <CartDetails title=" حجوزات سابقة" isSure={false}/> --> </main>
<?php
include "layout/inc/footer.php";
include "layout/inc/toastr.php";
?>
</body>
</html>