<?php
require('../system/helper.php');
checkGuideLogin();
$selectLandMarksSql = 'SELECT * FROM landmarks order by landmark_id DESC';
$selectLandMarksResult = runQuery($selectLandMarksSql);

$landmarks = [];
while ($landmarkRow = $selectLandMarksResult->fetch_assoc()) {
    $landmarks[] = $landmarkRow;
}

$selectToursSql = "SELECT * FROM tours WHERE `Guide_id` = '{$_SESSION['guide']['guide_id']}' order by tour_id DESC";
$selectToursResult = runQuery($selectToursSql);

$tours = [];
while ($tourRow = $selectToursResult->fetch_assoc()) {
    $tours[] = $tourRow;
}


if (isset($_POST['type']) && isset($_POST['tour_id']) && $_POST['type'] == 'edit') {
    $updateSql = "UPDATE `tours` SET `name` = '{$_POST['name']}' ,`price` = '{$_POST['price']}' 
                     
                     ,`person_no` = '{$_POST['person_no']}' ,  `from_date` = '{$_POST['from_date']}' ,  `to_date` = '{$_POST['to_date']}' ";

    if (isset($_POST['image'])) {
    }

    $imagePath = "";
    if (isset($_FILES['image']) && $_FILES['image']) {
        $errors = array();
        $file_name = (time() * 2) . '.jpg';
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        if ($file_size > 2097152) {
            header("Location: tours.php?error=The image size must be less than 2MB");
        }
        if (move_uploaded_file($file_tmp, "../uploads/tours/" . $file_name)) {
            $imagePath = "uploads/tours/" . $file_name;
            $updateSql .= ", `image` = '{$imagePath}'";
        }
    }
    $updateSql .= "WHERE `tour_id` = '{$_POST['tour_id']}'";
    runQuery($updateSql);

    $deleteAllTourDetailsSql = "DELETE FROM `tour_details` WHERE `tour_id`='{$_POST['tour_id']}'";
    runQuery($deleteAllTourDetailsSql);

    foreach ($_POST['landmarks'] ?? [] as $landmark) {
        $insertSql = "INSERT INTO `tour_details`(`landmark_id`, `tour_id`) VALUES ('{$landmark}','{$_POST['tour_id']}')";
        runQuery($insertSql);
    }

    header("Location: tours.php");
}

if (isset($_POST['type']) && $_POST['type'] == 'create') {


    $imagePath = "";
    if (isset($_FILES['image']) && $_FILES['image']) {
        $errors = array();
        $file_name = (time() * 2) . '.jpg';
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        if ($file_size > 2097152) {
            header("Location: tours.php?error=The image size must be less than 2MB");
        }
        if (move_uploaded_file($file_tmp, "../uploads/tours/" . $file_name)) {
            $imagePath = "uploads/tours/" . $file_name;
        }
    }


    $insertSql = "INSERT INTO `tours`(`name`, `price`, `person_no`, `from_date`,  `to_date`,`Guide_id`,`image`) VALUES ('{$_POST['name']}','{$_POST['price']}','{$_POST['person_no']}','{$_POST['from_date']}','{$_POST['to_date']}','{$_SESSION['guide']['guide_id']}','{$imagePath}')";
    runQuery($insertSql);

    $getLastIdSql = "SELECT * FROM `tours` order by tour_id  DESC";
    $resultLast = runQuery($getLastIdSql);

    $lastId = $resultLast->fetch_assoc()['tour_id'];
    foreach ($_POST['landmarks'] ?? [] as $landmark) {
        $insertSql = "INSERT INTO `tour_details`(`landmark_id`, `tour_id`) VALUES ('{$landmark}','{$lastId}')";
        runQuery($insertSql);
    }
    header("Location: tours.php");
}

if (isset($_GET['method']) && $_GET['method'] == 'DELETE' && isset($_GET['id'])) {
    $deleteID = $_GET['id'];
    $sql = "DELETE FROM tours WHERE tour_id = '{$deleteID}'";
    runQuery($sql);
    header('Location: tours.php');
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
    <title>اثري | الجولات السياحية</title>
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
                <li class="breadcrumb-item active">الجولات السياحية</li>
            </ol>

            <ul class="app-actions">
                <li>
                    <button class="btn btn-info" data-toggle="modal" data-target="#createModal"><i
                                class="icon-plus"></i> اضافة جولة جديدة
                    </button>
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
                                        <th>السعر</th>
                                        <th>عدد الأفراد</th>
                                        <th>من تاريخ</th>
                                        <th>الى تاريخ</th>
                                        <th>الصورة</th>
                                        <th>تعديل</th>
                                        <th>حذف</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($tours as $row) {
                                        ?>
                                        <tr>

                                            <td><?php echo $row['tour_id'] ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['price'] ?></td>
                                            <td><?php echo $row['person_no'] ?></td>
                                            <td><?php echo $row['from_date'] ?></td>
                                            <td><?php echo $row['to_date'] ?></td>
                                            <td><img src="../<?php echo $row['image'] ?>"
                                                     style="width: 80px;height: 80px"></td>

                                            <td>
                                                <button class="btn btn-info" data-toggle="modal"
                                                        data-target="#editModal<?php echo $row['tour_id'] ?>">تعديل
                                                </button>
                                            </td>
                                            <td>
                                                <a href="?method=DELETE&id=<?php echo $row['tour_id'] ?>"
                                                   class="btn btn-danger">حذف</a>
                                            </td>
                                        </tr>

                                        <?php
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
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">إضافة جولة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="CreateForm" enctype="multipart/form-data">
                            <input type="hidden" name="type" value="create">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">اسم الجولة</label>
                                        <input type="text" class="form-control" required name="name"
                                               id="exampleInputEmail1"
                                               aria-describedby="emailHelp" placeholder="اسم الجولة">
                                    </div>
                                </div>
                                <div class="col-4">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">السعر</label>
                                        <input type="number" class="form-control" required name="price"
                                               aria-describedby="emailHelp" placeholder="السعر">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">عدد الأشخاص</label>
                                        <input type="number" class="form-control" required name="person_no"
                                               aria-describedby="emailHelp" placeholder="عدد الأشخاص">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">من تاريخ</label>
                                        <input type="date" class="form-control" required name="from_date"
                                               aria-describedby="emailHelp" placeholder="من تاريخ">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">إلى تاريخ</label>
                                        <input type="date" class="form-control" required name="to_date"
                                               aria-describedby="emailHelp" placeholder="إلى تاريخ">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الصورة</label>
                                        <input type="file" class="form-control" required name="image"
                                               id="exampleInputEmail1"
                                               aria-describedby="emailHelp">
                                    </div>
                                </div>

                                <div class="table-responsive-md col-sm-6">
                                    <table class="table table-striped-table-bordered table-hover table-checkable table-"
                                           id="tbl_posts">
                                        <thead>
                                        <tr>

                                            <th>#</th>
                                            <th>المعلم</th>
                                            <th>
                                                <a class="btn btn-info add-record click" data-added="0"><i
                                                            class="icon-plus" style="color: white"></i></a>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbl_posts_body">
                                        <tr id="rec-1" class="MainDivs">
                                            <td><span class="sn">1</span>.</td>
                                            <td>
                                                <select class="form-control" name="landmarks[]" required>
                                                    <option value="" disabled selected>إختر المعلم</option>
                                                    <?php
                                                    foreach ($landmarks as $oneLAndMark) {
                                                        ?>
                                                        <option value="<?php echo $oneLAndMark['landmark_id']; ?>"><?php echo $oneLAndMark['landmark_name']; ?></option>
                                                        <?php

                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td><a class="btn btn-danger delete-record click" data-id="1"><i
                                                            style="color: white" class="icon-trash"></i></a></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>

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
        foreach ($tours as $row) {
            $detailsSql = "SELECT * FROM `tour_details` WHERE `tour_id` = '{$row['tour_id']}'";
            $detailsResult = runQuery($detailsSql);
            $details = [];
            if ($detailsResult->num_rows > 0) {
                while ($detailRow = $detailsResult->fetch_assoc()) {
                    $details[] = $detailRow;
                }
            }
            ?>
            <div class="modal fade" id="editModal<?php echo $row['tour_id'] ?>"
                 tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تعديل
                                جولة</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="" id="editForm<?php echo $row['tour_id'] ?>"
                                  enctype="multipart/form-data">
                                <input type="hidden" name="type" value="edit">
                                <input type="hidden" name="tour_id" value="<?php echo $row['tour_id'] ?>">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">اسم
                                                الجولة</label>
                                            <input type="text" class="form-control"
                                                   required name="name"
                                                   id="exampleInputEmail1"
                                                   aria-describedby="emailHelp"
                                                   placeholder="اسم الجولة" value="<?php echo $row['name'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-4">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">السعر</label>
                                            <input type="number" class="form-control"
                                                   required name="price"
                                                   aria-describedby="emailHelp"
                                                   placeholder="السعر" value="<?php echo $row['price'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">عدد
                                                الأشخاص</label>
                                            <input type="number" class="form-control"
                                                   required name="person_no"
                                                   aria-describedby="emailHelp"
                                                   placeholder="عدد الأشخاص" value="<?php echo $row['person_no'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">من
                                                تاريخ</label>
                                            <input type="date" class="form-control"
                                                   required name="from_date"
                                                   aria-describedby="emailHelp"
                                                   placeholder="من تاريخ" value="<?php echo $row['from_date'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">إلى
                                                تاريخ</label>
                                            <input type="date" class="form-control"
                                                   required name="to_date"
                                                   aria-describedby="emailHelp"
                                                   placeholder="إلى تاريخ" value="<?php echo $row['to_date'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">الصورة</label>
                                            <input type="file" class="form-control"
                                                   name="image"
                                                   id="exampleInputEmail1"
                                                   aria-describedby="emailHelp">
                                        </div>
                                    </div>

                                    <div class="table-responsive-md col-sm-6">
                                        <table class="table table-striped-table-bordered table-hover table-checkable"
                                               id="tbl_posts2">
                                            <thead>
                                            <tr>

                                                <th>#</th>
                                                <th>المعلم</th>
                                                <th>
                                                    <a class="btn btn-info add-record2 click"
                                                       data-added="0"><i
                                                                class="icon-plus"
                                                                style="color: white"></i></a>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbl_posts_body2">
                                            <?php
                                            foreach ($details as $key=>$detail) {
                                                ?>
                                                <tr id="rec-2-<?php echo $key+1;?>" class="MainDivs">
                                                    <td><span class="sn2"><?php echo $key+1;?></span>.</td>
                                                    <td>
                                                        <select class="form-control"
                                                                name="landmarks[]" required>
                                                            <option value="" disabled
                                                                    selected>إختر المعلم
                                                            </option>
                                                            <?php
                                                            foreach ($landmarks as $oneLAndMark) {
                                                                $selected = "";
                                                                if ($oneLAndMark['landmark_id'] == $detail['landmark_id']){
                                                                    $selected = "selected";
                                                                }
                                                                ?>
                                                                <option value="<?php echo $oneLAndMark['landmark_id']; ?>" <?php echo $selected;?> ><?php echo $oneLAndMark['landmark_name']; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-danger delete-record2 click"
                                                           data-id="<?php echo $key+1;?>"><i
                                                                    style="color: white"
                                                                    class="icon-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">اغلاق
                            </button>
                            <button type="submit" class="btn btn-primary"
                                    form="editForm<?php echo $row['tour_id'] ?>">حفظ
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>
    </div>

    <div style="display:none;">
        <table id="sample_table">
            <tr id="" class="MainDivs">
                <td><span class="sn "></span>.</td>
                <td>
                    <select class="form-control" name="landmarks[]" required>
                        <option value="" disabled selected>إختر المعلم</option>
                        <?php
                        foreach ($landmarks as $oneLAndMark) {
                            ?>
                            <option value="<?php echo $oneLAndMark['landmark_id']; ?>"><?php echo $oneLAndMark['landmark_name']; ?></option>
                            <?php

                        }
                        ?>
                    </select>
                </td>
                <td><a class="btn btn-danger delete-record newStyleBtn" data-id="1"><i style="color: white"
                                                                                       class="icon-trash"></i></a></td>
            </tr>
        </table>
        <table id="sample_table2">
            <tr id="" class="MainDivs">
                <td><span class="sn2 "></span>.</td>
                <td>
                    <select class="form-control" name="landmarks[]" required>
                        <option value="" disabled selected>إختر المعلم</option>
                        <?php
                        foreach ($landmarks as $oneLAndMark) {
                            ?>
                            <option value="<?php echo $oneLAndMark['landmark_id']; ?>"><?php echo $oneLAndMark['landmark_name']; ?></option>
                            <?php

                        }
                        ?>
                    </select>
                </td>
                <td><a class="btn btn-danger delete-record2 newStyleBtn" data-id="1"><i style="color: white"
                                                                                       class="icon-trash"></i></a></td>
            </tr>
        </table>
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
<script>
    jQuery(document).delegate('a.add-record', 'click', function (e) {
        e.preventDefault();
        var content = jQuery('#sample_table tr'),
            size = jQuery('#tbl_posts >tbody >tr').length + 1,
            element = null,
            element = content.clone();
        element.attr('id', 'rec-' + size);
        element.find('.delete-record').attr('data-id', size);
        element.find('.manager-name').attr('name', `managers[${size - 1}][name]`);
        element.find('.manager-job').attr('name', `managers[${size - 1}][job]`);
        element.find('.manager-phone').attr('name', `managers[${size - 1}][phone]`);
        element.appendTo('#tbl_posts_body');
        element.find('.sn').html(size);
    });
    jQuery(document).delegate('a.delete-record', 'click', function (e) {
        e.preventDefault();
        // var didConfirm = confirm("Are you sure You want to delete");
        // if (didConfirm == true) {
        var id = jQuery(this).attr('data-id');
        var targetDiv = jQuery(this).attr('targetDiv');
        if ($('.sn').length > 2) {
            jQuery('#rec-' + id).remove();
            $('#tbl_posts_body tr').each(function (index) {
                $(this).find('span.sn').html(index + 1);
            });
            return true;
        } else {
            toastr.error('you can`t delete')
            return true;
        }
        // } else {
        //   return false;
        // }
    });


    jQuery(document).delegate('a.add-record2', 'click', function (e) {
        e.preventDefault();
        var content = jQuery('#sample_table2 tr'),
            size = jQuery('#tbl_posts2 >tbody >tr').length + 1,
            element = null,
            element = content.clone();
        element.attr('id', 'rec-2-' + size);
        element.find('.delete-record').attr('data-id', size);
        element.find('.manager-name').attr('name', `managers[${size - 1}][name]`);
        element.find('.manager-job').attr('name', `managers[${size - 1}][job]`);
        element.find('.manager-phone').attr('name', `managers[${size - 1}][phone]`);
        element.appendTo('#tbl_posts_body2');
        element.find('.sn2').html(size);
    });
    jQuery(document).delegate('a.delete-record2', 'click', function (e) {
        e.preventDefault();
        alert('ss')
        // var didConfirm = confirm("Are you sure You want to delete");
        // if (didConfirm == true) {
        var id = jQuery(this).attr('data-id');
        var targetDiv = jQuery(this).attr('targetDiv');
        console.log($('.sn2').length)
        if ($('.sn2').length > 2) {
            jQuery('#rec-2-' + id).remove();
            $('#tbl_posts_body2 tr').each(function (index) {
                $(this).find('span.sn2').html(index + 1);
            });
            return true;
        } else {
            toastr.error('you can`t delete')
            return true;
        }
        // } else {
        //   return false;
        // }
    });
</script>


</body>
</html>