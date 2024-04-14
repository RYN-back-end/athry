<?php

require('system/helper.php');
checkLogin();

$_SESSION['user'] = [];
$_SESSION['guide'] = [];
header('Location: ClientAuth.php?success=تم تسجيل الخروج بنجاح');