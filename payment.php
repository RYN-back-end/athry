<?php
require('system/helper.php');
checkLogin();

if (isset($_POST['id'])) {
    $insertSql = "INSERT INTO `payments` (`pay_name`,`pay_no`,`valid_date`,`cvv`,`client_id`) VALUES ('{$_POST['name']}','{$_POST['number']}','{$_POST['year']}-{$_POST['month']}','{$_POST['cvv']}','{$_SESSION['user']['client_id']}')";
    runQuery($insertSql);
    runQuery("UPDATE `cart` SET `status`='confirmed'  WHERE id = '{$_GET['id']}'");
    header("location: PreviousBook.php?id={$_GET['id']}&success=تم تأكيد الدفع");
}

if (!isset($_GET['id'])) {
    header("location: cart.php?error=هناك خطأ ما");
}
?>
<!Doctype>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Astro description">
    <meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <meta name="generator" content="Astro v4.4.7">
    <title>Asre | الدفع</title><!-- <Font /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
</head>
<style>
    .gradient-custom {
        background: radial-gradient(50% 123.47% at 50% 50%, #00ff94 0%, #720059 100%),
        linear-gradient(121.28deg, #669600 0%, #ff0000 100%),
        linear-gradient(360deg, #0029ff 0%, #8fff00 100%),
        radial-gradient(100% 164.72% at 100% 100%, #6100ff 0%, #00ff57 100%),
        radial-gradient(100% 148.07% at 0% 0%, #fff500 0%, #51d500 100%);
        background-blend-mode: screen, color-dodge, overlay, difference, normal;
    }
</style>
<body dir="rtl">
<section class="gradient-custom">
    <div class="container" style="height: 100%;">
        <div class="row d-flex justify-content-center py-5">
            <div class="col-md-7 col-lg-5 col-xl-5">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" id="cardNumber" name="number" class="form-control form-control-lg"
                                                   size="17" required
                                                   placeholder="1234 5678 9012 3457" minlength="19" maxlength="19"/>
                                            <label class="form-label" for="typeText">رقم البطاقة</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" id="name" name="name" class="form-control form-control-lg" required
                                               placeholder="اسم صاحب البطاقة"/>
                                        <label class="form-label" for="name">اسم صاحب البطاقة</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <input type="text" id="year" name="year" class="form-control form-control-lg" maxlength="4"
                                               minlength="4"
                                               required
                                               placeholder="السنة"/>
                                        <label class="form-label" for="year">السنة</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <input type="text" id="month" name="month" class="form-control form-control-lg" maxlength="2"
                                               minlength="2"
                                               placeholder="الشهر"/>
                                        <label class="form-label" for="month">الشهر</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <input type="number" id="cvv" name="cvv" class="form-control form-control-lg" maxlength="3"
                                               minlength="3"
                                               placeholder="cvv"/>
                                        <label class="form-label" for="cvv">cvv</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pb-2">
                                <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-info btn-lg btn-rounded">
                                    دفع
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#cardNumber').on('input', function () {
            var cardNumber = $(this).val().replace(/ /g, ''); // إزالة المسافات إذا كانت موجودة
            var formattedCardNumber = '';
            for (var i = 0; i < cardNumber.length; i++) {
                if (i % 4 === 0 && i !== 0) {
                    formattedCardNumber += ' '; // إضافة مسافة كل 4 أرقام
                }
                formattedCardNumber += cardNumber[i];
            }
            $(this).val(formattedCardNumber);
        });
    });
</script>
</body>
</html>