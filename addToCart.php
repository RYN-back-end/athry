<?php
require('system/helper.php');
checkLogin();

if (isset($_GET['id'])) {
    $selectIfExists = runQuery("SELECT * FROM `cart` WHERE tour_id ='{$_GET['id']}' AND `status` = 'new' AND `client_id`='{$_SESSION['user']['client_id']}'");
    if ($selectIfExists->num_rows > 0) {
        header("location: detailsViewTours.php?id={$_GET['id']}&error=لقد قمت بالحجز مسبقاً");
        die();
    }
    $tour = runQuery("SELECT * FROM `tours` WHERE tour_id ='{$_GET['id']}'")->fetch_assoc();
    $insertSql = "INSERT INTO cart (`client_id`,`tour_id`,`price`,`from_date`,`to_date`,`person_no`,`guide_id`) VALUES ('{$_SESSION['user']['client_id']}','{$_GET['id']}','{$tour['price']}','{$tour['from_date']}','{$tour['to_date']}','{$tour['person_no']}','{$tour['Guide_id']}')";
    runQuery($insertSql);
    header("location: cart.php?success=تم الإضافة بنجاح");
    die();
}
