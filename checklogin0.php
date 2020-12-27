<?php
//print_r($_POST);
//exit();
session_start();
include("backend/connections.php");
$m_user = $_POST['m_user'];
$m_pass = hash("sha256", $_POST['m_pass']);

$sql = "SELECT * FROM tbl_member 
                  WHERE  m_user='" . $m_user . "' 
                  AND  m_pass='" . $m_pass . "' ";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) == 1) {
  $row = mysqli_fetch_array($result);

  $_SESSION["userm_id"] = $row["member_id"];
  $_SESSION["m_name"] = $row["m_name"];


  if ($_SESSION["userm_id"] != '') {

    Header("Location: index_member.php");
  }
} else {
  echo "<script>";
  echo "alert(\" user หรือ  password ไม่ถูกต้อง\");";
  echo "window.history.back()";
  echo "</script>";
}
