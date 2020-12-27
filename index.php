<?php

require "./munich.class.php";
require "./connect.class.php";
$connect = new DbConnect();
$munich = new RCode\Resource\Munich($connect->connect());

?>
<?php include('h.php'); ?>

<body style="font-family: 'Mali', cursive;">
  <div class="container">
    <img src="logo.png" width="200" height="100">
    <!-- Search form -->
    <form class="form-inline active-purple-3 active-purple-4 tt" action="index.php" method="GET">
      <i class="fas fa-search" aria-hidden="true"></i>
      <input class="form-control form-control-sm ml-3 w-75" type="Search" placeholder="Search" aria-label="Search" name="q">
    </form>
    <div id="fb-root"></div>
    

  </div>
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

<div class="container-fluid">
    <div class="row">
    <div class="col-sm-2 ml-5">
      <div class="fb-page" data-href="https://www.facebook.com/MunichCartoon" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
        <blockquote cite="https://www.facebook.com/MunichCartoon" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/MunichCartoon"></a></blockquote>
      </div>
    </div>



    <div class="col-sm-2">
      <div class="col-md-10">

        <?php include('menu.php'); ?>


      </div>
    </div>

    <div class="col-sm"><?php
                        $act = (isset($_GET['act']) ? $_GET['act'] : '');
                        $q = (isset($_GET['q']) ? $_GET['q'] : '');
                        if ($act == 'showbytype') {
                          include('show_product_type.php');
                        } elseif ($q != '') {
                          include('show_product_q.php');
                        } else {
                          include('show_product.php');
                        }
                        ?>

    </div>

  </div>

</div>

  </div>



</body>

</html>