<?php
require('system/helper.php');
checkLogin();

if (isset($_POST['tour_id'])) {
    $selectIfExists = runQuery("SELECT * FROM `cart` WHERE tour_id ='{$_POST['tour_id']}' AND `status` = 'new' AND `client_id`='{$_SESSION['user']['client_id']}'");
    if ($selectIfExists->num_rows > 0) {
        header("location: detailsViewTours.php?id={$_POST['tour_id']}&error=لقد قمت بالحجز مسبقاً");
        die();
    }
    $tour = runQuery("SELECT * FROM `tours` WHERE tour_id ='{$_POST['tour_id']}'")->fetch_assoc();
    $price = ($_POST['person_no'] ?? 0) * ($tour['price'] ?? 0);
    $insertSql = "INSERT INTO cart (`client_id`,`tour_id`,`price`,`from_date`,`to_date`,`person_no`,`guide_id`) VALUES ('{$_SESSION['user']['client_id']}','{$_POST['tour_id']}','{$price}','{$tour['from_date']}','{$tour['to_date']}','{$_POST['person_no']}','{$tour['Guide_id']}')";
    runQuery($insertSql);
    $prevNumber = ($tour['person_no']??0) - ($_POST['person_no']??0);
    $prevNumber = $prevNumber<0?0:$prevNumber;
    $prevPerSql = "UPDATE `tours` SET `person_no` ={$prevNumber} WHERE `tour_id` ='{$_POST['tour_id']}'";
    runQuery($prevPerSql);
    header("location: cart.php?success=تم الإضافة بنجاح");
    die();
}
