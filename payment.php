<?php
require "./munich.class.php";
require "./connect.class.php";
$connect = new DbConnect();
$munich = new RCode\Resource\Munich($connect->connect());
if (isset($_GET["transaction"])) {
    if ($_GET["transaction"] == 'step1') {
        $numRand = randNum();
        if($munich->payment($numRand, $munich->priceOfCart()))
        {
            header("Location:order.php?order_id=".$numRand);
        }else{
            $_SESSION["msg_error"] = "กรุณาชำระเงินออเดอร์คงค้าง";
        }
    }
}
function randNum($num = 20)
{
    $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $rand = "";
    for ($i = 1; $i <= $num; $i++) {
        $rand .= $str[rand(0, strlen($str) - 1)];
    }
    return $rand;
}
?>
<!DOCTYPE html>

<head>
    <title>ระบบร้านค้าออนไลน์</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <title></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mali&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c7ccdf28a9.js" crossorigin="anonymous"></script>
    <style>
        div.polaroid {
            width: 80%;
            background-color: white;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            margin-bottom: 25px;
        }

        div.container_di {
            text-align: center;
            padding: 10px 20px;
        }
    </style>
</head>

<body style="font-family: 'Mali', cursive;">
    <div class="container">
        <img src="logo.png" width="200" height="100"></div>
    <h4>
        <marquee scrollamount="10" style="color: red;">New !! สะดุดรักยัยแฟนเช่า เล่มที่ 14 มาแล้ววันนี้ </marquee>
    </h4>

    <?php
    if ($munich->getProfile() != false) {
        include('navbar_member.php');
    } else {
        include('navbar2.php');
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="container" style="margin-top: 50px">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-right">
                            </div>
                            <hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ภาพประกอบ</th>
                                        <th>ชื่อหนังสือ</th>
                                        <th class="text-right">จำนวน</th>
                                        <th class="text-right">ราคา</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $myCart = $munich->myCart();
                                    while ($row = $myCart->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td scope="row"><img width="70" src="./backend/p_img/<?php echo $row["p_img"] ?>" alt=""></td>
                                            <td><a href="product_detail.php?id=<?php echo $row["p_id"] ?>"></a><?php echo $row["p_name"] ?></td>
                                            <td width="150" class="text-right"><?php echo $row["cart_qty"] ?></td>
                                            <td width="150" class="text-right">฿ <?php echo number_format($row["cart_qty"] * $row["price"], 2, ".", ",") ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="4" class="text-right">
                                            <h4>รวมเป็นเงิน <b>฿ <?php echo number_format($munich->priceOfCart(), 2, ".", ",") ?></b></h4>
                                        </td>
                                    </tr>
                                    <?php if ($munich->numOfCart() < 1) { ?>
                                        <tr>
                                            <td colspan="4">ไม่มีสินค้าในตะกร้า</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="text-right">
                                <a name="payment" id="payment" class="btn btn-primary" href="payment.php?transaction=step1" role="button">ดำเนินการต่อ</a>
                                        <?php if(isset($_SESSION["msg_error"])){ ?><p class="py-3 text-danger"><?php echo $_SESSION["msg_error"] ?></p> <?php } ?>
                            </div>
                        </div>
                        <p>
                            <div class="addthis_inline_share_toolbox_sf2w" style="margin-left: 400px"></div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script>
    // console.log($("#btn_cart").attr("data-id"));
    $(document).ready(function() {
        $(".cart_qty").on("change", function() {
            var cart_id = $(".cart_qty").attr("data-id");
            var value = $(".cart_qty").val();
            $.ajax({
                url: 'changeCart.php',
                method: 'post',
                data: {
                    cart_id: cart_id,
                    qty: value
                },
                success: (data) => {
                    $("#num_of_cart").html(data);
                }
            })
        })
    })
</script>
<?php $_SESSION["msg_error"] = "" ?>