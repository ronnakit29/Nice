<?php
require "./munich.class.php";
require "./connect.class.php";
$connect = new DbConnect();
$munich = new RCode\Resource\Munich($connect->connect());

$munich->changeCart($_POST["cart_id"],$_POST["qty"]);
echo $munich->numOfCart();