<?php
require('../system/helper.php');
checkAdminLogin();
$selectLandMarksSql = 'SELECT * FROM landmarks order by landmark_id DESC';
$selectLandMarksResult = runQuery($selectLandMarksSql);
$sqlCitiesAll = "SELECT * FROM cities";
$countAllCitiesResult = runQuery($sqlCitiesAll);
$cities = [];
while ($cityRow = $countAllCitiesResult->fetch_assoc()) {
    $cities[] = $cityRow;
}

if (isset($_POST['type']) && isset($_POST['landmark_id']) && $_POST['type'] == 'edit') {
    $updateSql = "UPDATE landmarks SET `landmark_name` = '{$_POST['landmark_name']}' ,`landmark_site` = '{$_POST['landmark_site']}' 
                     
                     ,`description` = '{$_POST['description']}' ,  `city_id` = '{$_POST['city_id']}' ";

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
            header("Location: landmarks.php?error=The image size must be less than 2MB");
        }
        if (move_uploaded_file($file_tmp, "../uploads/landmarks/" . $file_name)) {
            $imagePath = "uploads/landmarks/" . $file_name;
            $updateSql .= ", `file` = '{$imagePath}'";
        }
    }
    $updateSql .= "WHERE `landmark_id` = '{$_POST['landmark_id']}'";

    runQuery($updateSql);
    header("Location: landmarks.php");
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
            header("Location: landmarks.php?error=The image size must be less than 2MB");
        }
        if (move_uploaded_file($file_tmp, "../uploads/landmarks/". $file_name)) {
            $imagePath = "uploads/landmarks/" . $file_name;
        }
    }
    

    $insertSql = "INSERT INTO `landmarks`(`landmark_name`, `landmark_site`, `description`, `city_id`,  `file`) VALUES ('{$_POST['landmark_name']}','{$_POST['landmark_site']}','{$_POST['description']}','{$_POST['city_id']}','{$imagePath}')";
    runQuery($insertSql);
    header("Location: landmarks.php");
}

if (isset($_GET['method']) && $_GET['method'] == 'DELETE' && isset($_GET['id'])) {
    $deleteID = $_GET['id'];
    $sql = "DELETE FROM landmarks WHERE landmark_id = '{$deleteID}'";
    runQuery($sql);
    header('Location: landmarks.php');
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
                <li>
                    <button class="btn btn-info" data-toggle="modal" data-target="#createModal"><i
                                class="icon-plus"></i> اضافة معلم جديد</button>
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
                                        <th>الوصف</th>
                                        <th>الموقع</th>
                                        <th>المدينة</th>
                                        <th>الصورة</th>
										<th>تعديل</th>
                                        <th>حذف</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($selectLandMarksResult->num_rows > 0) {
                                        while ($row = $selectLandMarksResult->fetCh_assoc()) {
											$selectCitySql = "SELECT * FROM cities where city_id = '{$row['city_id']}'";
                        $selectCityResult = runQuery($selectCitySql);
                                            ?>
                                            <tr>
											 	 	 		
                                                <td><?php echo $row['landmark_id'] ?></td>
                                                <td><?php echo $row['landmark_name'] ?></td>
                                                <td><?php echo $row['description'] ?></td>
                                                <td><?php echo $row['landmark_site'] ?></td>
												<th><?php echo $selectCityResult->fetch_assoc()['city_name'] ?? '' ?></th>
                                                <td><img src="../<?php echo $row['file'] ?>"  style="width: 80px;height: 80px"  ></td>
                                                
                                               <td><button class="btn btn-info"  data-toggle="modal" data-target="#editModal<?php echo $row['landmark_id'] ?>">تعديل</button></td>
                                                <td>
                                                    <a href="?method=DELETE&id=<?php echo $row['landmark_id'] ?>"
                                                       class="btn btn-danger">حذف</a>
                                                </td>
                                            </tr> 

											<div class="modal fade" id="editModal<?php echo $row['landmark_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">تحديث معلم</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="" id="editForm<?php echo $row['landmark_id'] ?>" enctype="multipart/form-data">
                                                                 <input type="hidden" name="type" value="edit">
                                                                 <input type="hidden" name="landmark_id"   value="<?php echo $row['landmark_id'] ?>">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">الإسم</label>
                                                                    <input type="text" class="form-control" name="landmark_name" required value="<?php echo $row['landmark_name'] ?>" id="exampleInputEmail1"
                                                                           aria-describedby="emailHelp" placeholder="اسم المعلم">
                                                                </div>
																
																<div class="form-group">
                                                                    <label for="exampleInputEmail1">الوصف</label>
                                                                    <textarea  class="form-control" name="description" required  id="exampleInputEmail1"
                                                                           aria-describedby="emailHelp" placeholder="الوصف"> <?php echo $row['description'] ?> </textarea>
                                                                </div>
																
																
																<div class="form-group">
                                                                    <label for="exampleInputEmail1">الموقع</label>
                                                                    <input type="text" class="form-control" name="landmark_site" required value="<?php echo $row['landmark_site'] ?>" id="exampleInputEmail1"
                                                                           aria-describedby="emailHelp" placeholder="الموقع">
                                                                </div>
																
																<div class="form-group">
                                                                    <label for="exampleInputEmail1">المدينة</label>
                                                                     <select class="form-control" name="city_id" required>
                                                            <?php
                                                            if ($countAllCitiesResult->num_rows > 0) {
                                                                foreach ($cities ?? [] as $rowCity) {
                                                                    ?>
                                                                    <option value="<?php echo $rowCity['city_id'] ?? '' ?>" <?php echo $rowCity['city_id'] == $row['city_id'] ? 'selected' : '' ?> ><?php echo $rowCity['city_name'] ?? '' ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                                </div>
																
																<div class="form-group">
                                                                    <label for="exampleInputEmail1">الصورة</label>
                                                                    
														           <input name="image" type="file"  class="form-control">
                                                                </div>
																
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                                            <button type="submit" class="btn btn-primary" form="editForm<?php echo $row['landmark_id'] ?>">حفظ</button>
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
  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">إضافة معلم</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="CreateForm" enctype="multipart/form-data">
                            <input type="hidden" name="type" value="create" >
                            <div class="form-group">
                                <label for="exampleInputEmail1">اسم المعلم</label>
                                <input type="text" class="form-control" required name="landmark_name" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="اسم المعلم">
                            </div>
							
							  <div class="form-group">
                                <label for="exampleInputEmail1">الوصف</label>
                                <textarea class="form-control" required name="description" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="الوصف"> </textarea>
                            </div>
							
							  <div class="form-group">
                                <label for="exampleInputEmail1">الموقع</label>
                                <input type="text" class="form-control" required name="landmark_site" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="الموقع">
                            </div>
							
							  <div class="form-group">
                                <label for="exampleInputEmail1">المدينة <?php echo $countAllCitiesResult->num_rows; ?></label>
								 
                                    <select class="form-control" name="city_id" required>
                                        <?php
                                        if ($countAllCitiesResult->num_rows > 0) {
                                            foreach ($cities ?? [] as $rowCity) {
                                                ?>
                                                <option value="<?php echo $rowCity['city_id'] ?? '' ?>"><?php echo $rowCity['city_name'] ?? '' ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                            </div>
							
							  <div class="form-group">
                                <label for="exampleInputEmail1">الصورة</label>
                                <input type="file" class="form-control" required name="image" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" >
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