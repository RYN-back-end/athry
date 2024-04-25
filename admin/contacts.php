<?php
require('../system/helper.php');
checkAdminLogin();
$selectContactsSql = 'SELECT * FROM `contacts` order by `id` DESC';
$selectContactsResult = runQuery($selectContactsSql);

if (isset($_GET['method']) || isset($_POST['method'])) {
    if ($_GET['method'] == 'delete' && isset($_GET['id'])) {
        $deleteSql = "DELETE FROM `contacts` WHERE `id` = {$_GET['id']}";
        runQuery($deleteSql);
        header('Location: contacts.php');
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
    <link rel="shortCut icon" href="../assets/images/logo-ZIv9wrFv_Z1PmHf8.webp"/>

    <!-- Title -->
    <title>اثري | رسائل تواصل معنا</title>
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
                <li class="breadcrumb-item active">رسائل تواصل معنا</li>
            </ol>

            <ul class="app-actions">


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
                                        <th>البريد الإلكترونى</th>
                                        <th>الموضوع</th>
                                        <th>المحتوي</th>
                                        <th>حذف</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($selectContactsResult->num_rows > 0) {
                                        while ($row = $selectContactsResult->fetCh_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['id'] ?></td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td><?php echo $row['subject'] ?></td>
                                                <td><?php echo $row['text'] ?></td>
                                                <td>
                                                    <a href="?method=delete&id=<?php echo $row['id'] ?>"
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
        <!-- Modal -->

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