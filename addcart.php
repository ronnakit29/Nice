<?php
require "./munich.class.php";
require "./connect.class.php";
$connect = new DbConnect();
$munich = new RCode\Resource\Munich($connect->connect());

echo $munich->addCart($_POST["p_id"],1);
?>