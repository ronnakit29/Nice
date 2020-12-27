<?php
//1. เชื่อมต่อ database:
include('connections.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
$member_id = $_REQUEST["ID"];
//2. query ข้อมูลจากตาราง:
$sql = "SELECT * FROM tbl_member WHERE member_id='$member_id' ";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);
extract($row);
?>

<?php include('h.php');?>
<form  name="register" action="member_form_edit_db.php" method="POST" class="form-horizontal">

<input type="hidden" name="member_id" value="<?php echo  $member_id; ?>">
       <div class="form-group">
          <div class="col-sm-5" align="left">
            <input  name="m_user" type="text" required class="form-control" id="m_user" placeholder="Username" value="<?=$m_user;?>" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" minlength="2"  />
          </div>
      </div> 
        <div class="form-group">
          <div class="col-sm-5" align="left">
            <input  name="m_pass" type="pass" required class="form-control" id="m_pass" placeholder="Password" value="<?=$m_pass;?>" pattern="^[a-zA-Z0-9]+$" minlength="2" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-5" align="left">
            <input  name="m_title" type="text" required class="form-control" id="m_title" value="<?=$m_title;?>" placeholder="คำนำหน้า" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-5" align="left">
            <input  name="m_name" type="text" required class="form-control" id="m_name" value="<?=$m_name;?>" placeholder="ชื่อ-สกุล " />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-5" align="left">
            <input  name="m_sex" type="text" required class="form-control" id="m_sex" value="<?=$m_sex;?>" placeholder="เพศ " />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-5" align="left">
            <input  name="m_email" type="email" class="form-control" id="m_email" value="<?=$m_email;?>" placeholder=" อีเมล์ name@hotmail.com"/>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-5" align="left">
            <input  name="m_homenum" type="text" required class="form-control" id="m_homenum" value="<?=$m_homenum;?>" placeholder="บ้านเลขที่ " />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-5" align="left">
            <input  name="m_district" type="text" required class="form-control" id="m_district" value="<?=$m_district;?>" placeholder="ตำบล " />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-5" align="left">
            <input  name="m_hgroup" type="text" required class="form-control" id="m_hgroup" value="<?=$m_hgroup;?>" placeholder="อำเภอ " />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-5" align="left">
            <input  name="m_povine" type="text" required class="form-control" id="m_povine" value="<?=$m_povine;?>" placeholder="จังหวัด " />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-5" align="left">
            <input  name="m_pcode" type="text" required class="form-control" id="m_pcode" value="<?=$m_pcode;?>" placeholder="รหัสไปรษณีย์ " />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-5" align="left">
            <input  name="m_tel" type="text" class="form-control" id="m_tel"  value="<?=$m_tel;?>" placeholder="เบอร์โทรศัพท์" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-5" align="left">
            <input  name="m_num" type="text" required class="form-control" id="m_num" value="<?=$m_num;?>" placeholder="เลขบัตรประชาชน " />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-5" align="left">
            <textarea name="m_address" class="form-control" id="m_address" value="<?=$m_address;?>" required> <?php echo $m_address; ?> </textarea> 
          </div>
        </div>
      <div class="form-group">
          <div class="col-sm-5" align="right">
          <button type="submit" class="btn btn-success" id="btn"><span class="glyphicon glyphicon-ok"></span> บันทึก  </button>
          </div>     
      </div>
      </form>