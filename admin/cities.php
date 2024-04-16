<?php
require('../system/helper.php');
checkAdminLogin();
$selectCitiesSql = 'SELECT * FROM cities order by city_id DESC';
$selectCitiesResult = runQuery($selectCitiesSql);


if ( isset($_POST['method'])) {
    if ($_POST['method'] == 'create' && isset($_POST['city_name'])) {
        $sql = "INSERT INTO `cities` (`city_name`) VALUES ('{$_POST['city_name']}')";
        runQuery($sql);
        header('Location: cities.php');
        die();
    } if ($_POST['method'] == 'edit' && isset($_POST['city_name']) && isset($_POST['city_id'])) {
        $sql = "UPDATE `cities` SET `city_name` = '{$_POST['city_name']}'";
        runQuery($sql);
        header('Location: cities.php');
        die();
    }
}
if (isset($_GET['method']) || isset($_POST['method'])) {
    if ($_GET['method'] == 'delete' && isset($_GET['id'])) {
        $deleteSql = "DELETE FROM `cities` WHERE `city_id` = {$_GET['id']}";
        runQuery($deleteSql);
        header('Location: cities.php');
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
    <title>اثري | المدن</title>
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
                <li class="breadcrumb-item active">المدن</li>
            </ol>

            <ul class="app-actions">
                <li>
                    <button class="btn btn-info" data-toggle="modal" data-target="#createModal"><i
                                class="icon-plus"></i></button>
                </li>

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
                                        <th>تعديل</th>
                                        <th>حذف</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($selectCitiesResult->num_rows > 0) {
                                        while ($row = $selectCitiesResult->fetCh_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['city_id'] ?></td>
                                                <td><?php echo $row['city_name'] ?></td>
                                                <td><button class="btn btn-info"  data-toggle="modal" data-target="#editModal<?php echo $row['city_id'] ?>">تعديل</button></td>
                                                <td>
                                                    <a href="?method=delete&id=<?php echo $row['city_id'] ?>"
                                                       class="btn btn-danger">حذف</a>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="editModal<?php echo $row['city_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">تعديل مدينة</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="" id="CreateForm">
                                                                <input type="hidden" value="edit" name="method">
                                                                <input type="hidden" value="<?php echo $row['city_id'] ?>" name="city_id">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">الإسم</label>
                                                                    <input type="text" class="form-control" name="city_name" required value="<?php echo $row['city_name'] ?>" id="exampleInputEmail1"
                                                                           aria-describedby="emailHelp" placeholder="اسم المدينة">
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                                            <button type="submit" class="btn btn-primary" form="CreateForm">حفظ</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">إضافة مدينة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="CreateForm">
                            <input type="hidden" value="create" name="method">
                            <div class="form-group">
                                <label for="exampleInputEmail1">الإسم</label>
                                <input type="text" class="form-control" required name="city_name" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="اسم المدينة">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary" form="CreateForm">حفظ</button>
                    </div>
                </div>
            </div>
        </div>

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