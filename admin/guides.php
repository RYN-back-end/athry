<?php
require('../system/helper.php');
checkAdminLogin();
$selectGuidesSql = 'SELECT * FROM guides order by guide_id DESC';
$selectGuidesResult = runQuery($selectGuidesSql);

if (isset($_GET['method'])){
    if ($_GET['method']=='delete' && isset($_GET['id'])){
        $deleteSql = "DELETE FROM `guides` WHERE `guide_id` = {$_GET['id']}";
        runQuery($deleteSql);
        header('Location: guides.php');
        die();
    }

    if ($_GET['method']=='active' && isset($_GET['id']) && isset($_GET['active'])){
        $deleteSql = "UPDATE `guides` SET `active` = {$_GET['active']} WHERE `guide_id` = {$_GET['id']}";
        runQuery($deleteSql);
        header('Location: guides.php');
        die();
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
    <title>اثري | المرشدين</title>
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


<!-- *************
    ************ Header section end *************
************* -->


<div class="container-fluid">


    <?php
    include 'layout/inc/sidebar.php';
    ?>


    <!-- *************
        ************ Main container start *************
    ************* -->
    <div class="main-container">


        <!-- Page header start -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">الرئيسية</li>
                <li class="breadcrumb-item active">المرشدين</li>
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
                                        <th>الاسم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>رقم الهاتف</th>
                                        <th>الملف</th>
                                        <th>الحالة</th>
                                        <th>حذف</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($selectGuidesResult->num_rows > 0) {
                                        while ($row = $selectGuidesResult->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['guide_id'] ?></td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td><?php echo $row['mail'] ?></td>
                                                <td><?php echo $row['phone'] ?></td>
                                                <td><a href="../<?php echo $row['pdf'] ?>" target="_blank"> <img src="assets/pdf.png"  style="width: 80px;height: 80px"></a></td>
                                                <td>
                                                    <?php
                                                    if ($row['active'] == 2) {
                                                        ?>
                                                        <a href="?method=active&id=<?php echo $row['guide_id'] ?>&active=1"
                                                           class="btn btn-info">قبول</a>
                                                        <a href="?method=active&id=<?php echo $row['guide_id'] ?>&active=0"
                                                           class="btn btn-warning">رفض</a>

                                                        <?php
                                                    } else {
                                                        if ($row['active'] == 0) {
                                                            $title = "مرفوض";
                                                            $class = "warning";
                                                        } else {
                                                            $title = "مقبول";
                                                            $class = "success";
                                                        }
                                                        ?>
                                                        <span class="btn btn-<?php echo $class; ?>"><?php echo $title; ?></span>

                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="?method=delete&id=<?php echo $row['guide_id'] ?>"
                                                       class="btn btn-danger">حذف</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </tbody>
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