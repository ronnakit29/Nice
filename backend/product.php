<script src="https://kit.fontawesome.com/c7ccdf28a9.js" crossorigin="anonymous"></script>
<!DOCTYPE html>
<html>

<head>
  <?php include('h.php');
  error_reporting(error_reporting() & ~E_NOTICE); ?>

  <head>

  <body style="font-family: 'Mali', cursive;">
    <?php include('navbar.php'); ?>
    <div class="container">

      <p></p><br>
      <h2>
        <center>จัดการระบบ <i class="fas fa-tools"></i></center>
      </h2><br>
      <div class="row">
        <div class="col-md-3">
          <!-- Left side column. contains the logo and sidebar -->

          <?php include('menu_left.php'); ?>
          <!-- Content Wrapper. Contains page content -->
        </div>

        <div class="col-md-8">
          <a href="product.php?act=add" class="btn-info btn-sm"> เพิ่ม </a>
          <p></p>
          <?php
          $act = $_GET['act'];
          if ($act == 'add') {
            include('product_form_add.php');
          } elseif ($act == 'edit') {
            include('product_form_edit.php');
          } else {
            include('product_list.php');
          }
          ?>
        </div>

      </div>
    </div>
  </body>

</html>