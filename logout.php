<?php
require "./munich.class.php";
require "./connect.class.php";
$connect = new DbConnect();
$munich = new RCode\Resource\Munich($connect->connect());

if($munich->logout()){
    header("Location:index.php");
}
?>