<?php
require "./munich.class.php";
require "./connect.class.php";
$connect = new DbConnect();
$munich = new RCode\Resource\Munich($connect->connect());
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
                                <a name="payment" id="payment" class="btn btn-primary" href="payment.php" role="button">ชำระเงิน</a>
                            </div>
                            <hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>รูป</th>
                                        <th>ชื่อหนังสือ</th>
                                        <th>ต่อชิ้น</th>
                                        <th>จำนวนในตะกร้า</th>
                                        <!-- <th>ราคา</th> -->
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $myCart = $munich->myCart();
                                    while ($row = $myCart->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td scope="row"><img width="70" src="./backend/p_img/<?php echo $row["p_img"] ?>" alt=""></td>
                                            <td><a href="product_detail.php?id=<?php echo $row["p_id"] ?>"></a><?php echo $row["p_name"] ?></td>
                                            <td id="main_price" data-id="<?php echo $row["cart_id"] ?>"><?php echo number_format($row["price"], 2, ".", ",") ?></td>
                                            <td width="150"><input class="form-control cart_qty" min="1" data-id="<?php echo $row["cart_id"] ?>" type="number" name="cart_qty" id="cart_qty" value="<?php echo $row["cart_qty"] ?>"></td>
                                            <!-- <td id="price" data-id="<?php echo $row["cart_id"] ?>"><?php echo number_format($row["price"], 2, ".", ",") ?></td> -->
                                            <td><a class="btn btn-danger" href="delCart.php?id=<?php echo $row["cart_id"] ?>" role="button">ลบสินค้า</a></td>
                                        </tr>
                                    <?php }
                                    if ($munich->numOfCart() < 1) { ?>
                                        <tr>
                                            <td colspan="4">ไม่มีสินค้าในตะกร้า</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
            var cart_id = $(this).attr("data-id");
            var value = $(".cart_qty").val();
            $.ajax({
                url: 'changeCart.php',
                method: 'post',
                data: {
                    cart_id: cart_id,
                    qty: value
                },
                success: (data) => {
                    // var main_price = $("#main_price[data-id=" + cart_id + "]");
                    // console.log(main_price);
                    var cart_data_id = $("#price[data-id=" + cart_id + "]");
                    // cart_data_id[0].innerHTML = number_format(parseFloat(main_price) * parseFloat(value), 2, '.', ',');
                    // alert(cart_data_id);
                    $("#num_of_cart").html(data);

                }
            })
        })
    });

    function number_format(number, decimals, dec_point, thousands_sep) {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>