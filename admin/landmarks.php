<?php
require('../system/helper.php');
checkAdminLogin();
$selectLandMarksSql = 'SELECT * FROM landmarks order by landmark_id DESC';
$selectLandMarksResult = runQuery($selectLandMarksSql);


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
    <link rel="shortCut icon" href="../assets/images/logo-ZIv9wrFv_Z1PmHf8.webp"/>

    <!-- Title -->
    <title>اثري | المعالم السياحية</title>
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
                <li class="breadcrumb-item active">المعالم السياحية</li>
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
                                        <th>الموقع الإلكتروني</th>
                                        <th>الملف</th>
                                        <th>الوصف</th>
                                        <th>الحالة</th>
                                        <th>حذف</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($selectClientsResult->num_rows > 0) {
                                        while ($row = $selectClientsResult->fetCh_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['client_id'] ?></td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td><?php echo $row['mail'] ?></td>
                                                <td><?php echo $row['phone'] ?></td>
                                                <td><img src="../<?php echo $row['image'] ?>"
                                                         style="width: 80px;height: 80px"
                                                         onclick="window.open(this.src)"></td>
                                                <td>
                                                    <?php
                                                    if ($row['active'] == 2) {
                                                        ?>
                                                        <a href="?method=active&id=<?php echo $row['client_id'] ?>&active=1"
                                                           class="btn btn-info">قبول</a>
                                                        <a href="?method=active&id=<?php echo $row['client_id'] ?>&active=0"
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
                                                    <a href="?method=delete&id=<?php echo $row['client_id'] ?>"
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