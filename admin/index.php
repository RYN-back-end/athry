<?php
require('../system/helper.php');
checkAdminLogin();

$selectCartSql = "SELECT *,SUM(price) AS total_price  FROM `cart` WHERE `status` = 'confirmed'";
$selectCartResult = runQuery($selectCartSql);
$cartItems = [];
if ($selectCartResult->num_rows > 0) {
    while ($row = $selectCartResult->fetch_assoc()) {
        $client = runQuery("SELECT * FROM `clients` WHERE `client_id` ='{$row['client_id']}'")->fetch_assoc();
        $row['client'] = $client;
        $gide = runQuery("SELECT * FROM `guides` WHERE `guide_id` ='{$row['guide_id']}'")->fetch_assoc();
        $row['guide'] = $gide;
        $cartItems[] = $row;
    }
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
    <title>اثري | الحجوزات</title>
    <?php
    include 'layout/assets/css.php';
    ?>

</head>
<body>

<?php
include 'layout/inc/header.php';
?>
<!-- Screen overlay start -->
<div class="screen-overlay"></div>
<!-- Screen overlay end -->

<div class="container-fluid">


    <?php
    include 'layout/inc/sidebar.php';
    ?>

    <div class="main-container">


        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">الرئيسية</li>
                <li class="breadcrumb-item active">الحجوزات</li>
            </ol>

            <ul class="app-actions">
                <!--                <li>-->
                <!--                    <button class="btn btn-info"><i class="icon-plus"></i></button>-->
                <!--                </li>-->

            </ul>
        </div>
        <!-- Page header end -->


        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <td>اسم المرشد</td>
                                        <td>اسم العميل</td>
                                        <td>بداية الرحلة</td>
                                        <td>نهاية الرحلة</td>
                                        <td>عدد الافراد</td>
                                        <td>التكلفة</td>

                                    </tr>
                                    </thead>
                                    <?php
                                    if (isset($cartItems[0]['client'])) {
                                        foreach ($cartItems as $cartItem) {
                                            ?>
                                            <tr>
                                                <td> <?php echo $cartItem['id'] ?></td>
                                                <td> <?php echo $cartItem['guide']['name'] ?? "" ?></td>
                                                <td> <?php echo $cartItem['client']['name'] ?? "" ?></td>
                                                <td><?php echo $cartItem['from_date'] ?></td>
                                                <td><?php echo $cartItem['to_date'] ?></td>
                                                <td> <?php echo $cartItem['person_no'] ?></td>
                                                <td> <?php echo $cartItem['price'] ?> ر.س</td>
                                            </tr>

                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="6">الإجمالى</td>
                                            <td colspan="2"><?php echo $cartItem['total_price'] ?? 0 ?> ر.س</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- Content wrapper end -->


    </div>
    <!-- *************
        ************ Main container end *************
    ************* -->
    <?php
    include 'layout/inc/footer.php';
    ?>

</div>

<?php
include 'layout/assets/js.php';
?>
</body>
</html>