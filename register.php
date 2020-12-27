<?php
require "./munich.class.php";
require "./connect.class.php";
$connect = new DbConnect();
$munich = new RCode\Resource\Munich($connect->connect());

if (isset($_POST["btn_register"])) {
    if ($_POST["user_password"] == $_POST["confirm_password"]) {
        if ($_POST["user_email"] == $_POST["confirm_email"]) {
            if ($munich->register($_POST["user_username"], $_POST["user_password"], $_POST["user_name"], $_POST["user_surname"], $_POST["user_sex"], $_POST["user_email"])) {
                header("Location:login.php");
                $_SESSION["msg_err"] = "";
            } else {
                $_SESSION["msg_err"] = "มีผู้ใช้งานนี้แล้วในระบบ";
            }
        } else {
            $_SESSION["msg_err"] = "อีเมลล์ไม่ตรงกัน";
        }
    } else {
        $_SESSION["msg_err"] = "รหัสผ่านไม่ตรงกัน";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login And Register</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mali">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="font-family: Mali, cursive;background: linear-gradient(to top,rgb(202,239,255),#fff);">
    <div>
        <div class="container py-5">
            <div class="row">
                <div class="col-sm-11 col-md-7 col-lg-6 col-xl-5 mx-auto">
                    <div class="card border-0">
                        <div class="card-body text-center shadow">
                            <a href="index.php">
                                <img class="img-fluid" src="assets/img/logo.png">
                            </a>
                            <h3 class="card-title">สมัครสมาชิก</h3>
                            <h6 class="text-muted card-subtitle mb-2">สมัครสมาชิกกับ Munich Cartoon</h6>
                            <hr>
                            <form method="post" action="register.php">
                                <div class="form-group"><input class="shadow-sm form-control form-control" type="text" name="user_username" placeholder="ชื่อผู้ใช้งาน / Username"></div>
                                <div class="form-group"><input class="shadow-sm form-control form-control" type="password" name="user_password" placeholder="รหัสผ่าน / Password"></div>
                                <div class="form-group"><input class="shadow-sm form-control form-control" type="password" name="confirm_password" placeholder="ยืนยันรหัสผ่าน / Confirm Password"></div>
                                <div class="form-group"><input class="shadow-sm form-control form-control" type="text" name="user_name" placeholder="ชื่อจริง / Yourname"></div>
                                <div class="form-group"><input class="shadow-sm form-control form-control" type="text" name="user_surname" placeholder="นามสกุล / Surname"></div>
                                <div class="form-group">
                                    <div class="form-check text-left"><input class="form-check-input" type="radio" id="formCheck-1" name="user_sex" value="ชาย"><label class="form-check-label" for="formCheck-1">ชาย</label></div>
                                    <div class="form-check text-left"><input class="form-check-input" type="radio" id="formCheck-2" value="หญิง" name="user_sex"><label class="form-check-label" for="formCheck-2">หญิง</label></div>
                                </div>
                                <div class="form-group"><input class="shadow-sm form-control form-control" type="text" name="user_email" placeholder="อีเมลล์ / Email" inputmode="email"></div>
                                <div class="form-group"><input class="shadow-sm form-control form-control" type="text" name="confirm_email" placeholder="ยืนยันอีเมลล์ / Confirm Email" inputmode="email"></div><button class="btn btn-dark" name="btn_register" type="submit">ลงทะเบียน</button>
                                <?php if (isset($_SESSION["msg_err"])) {
                                    if ($_SESSION["msg_err"] != "") { ?><p class="text-danger my-3"><?php echo $_SESSION["msg_err"] ?></p><?php }
                                                                                                                                                                    } ?>
                            </form>
                            <hr>
                            <p class="mt-3">มีบัญชีแล้ว&nbsp;<a href="login.php">เข้าสู่ระบบ</a>&nbsp;</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
<?php unset($_SESSION["msg_err"]) ?>