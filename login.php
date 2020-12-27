<?php
require "./munich.class.php";
require "./connect.class.php";
$connect = new DbConnect();
$munich = new RCode\Resource\Munich($connect->connect());
if (isset($_POST["btn_login"])) {
    if ($munich->login($_POST["user_username"], $_POST["user_password"])) {
        header("Location: index.php");
    } else {
        $_SESSION["msg_err"] = "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง";
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

<body style="font-family: Mali, cursive;background: linear-gradient(to top,rgb(202,239,255),#fff);min-height: 100vh;">
    <div>
        <div class="container py-5">
            <div class="row">
                <div class="col-sm-11 col-md-7 col-lg-6 col-xl-5 mx-auto">
                    <div class="card border-0">
                        <div class="card-body text-center shadow">
                            <a href="index.php">
                                <img class="img-fluid" src="assets/img/logo.png">
                            </a>
                            <h3 class="card-title">เข้าสู่ระบบ</h3>
                            <h6 class="text-muted card-subtitle mb-2">เข้าสู่ระบบสมาชิก Munich Cartoon</h6>
                            <hr>
                            <form action="login.php" method="post">
                                <div class="form-group"><input class="shadow-sm form-control" type="text" name="user_username" placeholder="ชื่อผู้ใช้งาน / Username"></div>
                                <div class="form-group"><input class="shadow-sm form-control" type="password" name="user_password" placeholder="รหัสผ่าน / Password"></div><button class="btn btn-dark" name="btn_login" type="submit">เข้าสู่ระบบ</button>
                                <?php if (isset($_SESSION["msg_err"])) {
                                    if ($_SESSION["msg_err"] != "") { ?><p class="text-danger my-3"><?php echo $_SESSION["msg_err"] ?></p><?php }
                                                                                                                                        } ?>
                            </form>
                            <hr>
                            <p class="mt-3">ยังไม่มีบัญชีผู้ใช้&nbsp;<a href="register.php">สมัครสมาชิก</a>&nbsp;</p>
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