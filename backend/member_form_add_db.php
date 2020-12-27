<?php
include('connections.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
  //สร้างตัวแปรเก็บค่าที่รับมาจากฟอร์ม
  $m_user = $_POST["m_user"];
  $m_pass = $_POST["m_pass"];
  $m_title = $_POST["m_title"];
  $m_name = $_POST["m_name"];
  $m_sex = $_POST["m_sex"];
  $m_email = $_POST["m_email"];
  $m_homenum = $_POST["m_homenum"];
  $m_district = $_POST["m_district"];
  $m_hgroup = $_POST["m_hgroup"];
  $m_povine = $_POST["m_povine"];
  $m_pcode = $_POST["m_pcode"];
  $m_tel = $_POST["m_tel"];
  $m_num = $_POST["m_num"];
  $m_address = $_POST["m_address"];
  //เพิ่มเข้าไปในฐานข้อมูล
  $sql = "INSERT INTO tbl_member(m_user, m_pass, m_title, m_name, m_sex, m_email, m_homenum, m_district, m_hgroup, m_povine, m_pcode, m_tel, m_num, m_address)
       VALUES('$m_user', '$m_pass', '$m_title', '$m_name', '$m_sex', '$m_email', '$m_homenum', '$m_district', '$m_hgroup', '$m_povine', '$m_pcode', '$m_tel', '$m_num', '$m_address')";

  $result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
  
  //ปิดการเชื่อมต่อ database
  mysqli_close($con);
  //จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
  
  if($result){
  echo "<script type='text/javascript'>";
  echo "alert('Register Succesfuly');";
  echo "window.location = 'member.php'; ";
  echo "</script>";
  }
  else{
  echo "<script type='text/javascript'>";
  echo "alert('Error back to register again');";
  echo "</script>";
}
?>