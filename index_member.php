<?php session_start();?>
<?php include('h_member.php');?>
<body style="font-family: 'Mali', cursive;">
<div class="container">
<img src="logo.png" width="200" height="100">
<!-- Search form -->
<form class="form-inline active-purple-3 active-purple-4 tt" action="index.php" method="GET">
  <i class="fas fa-search" aria-hidden="true"></i>
  <input class="form-control form-control-sm ml-3 w-75" type="Search" placeholder="Search"
    aria-label="Search" name="q">
</form>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v8.0" nonce="LT7xbe4m"></script>
<style>


.active-purple-2 input[type=text]:focus:not([readonly]) {
  border-bottom: 1px solid #ce93d8;
  box-shadow: 0 1px 0 0 #ce93d8;
}
.active-purple input[type=text] {
  border-bottom: 1px solid #ce93d8;
  box-shadow: 0 1px 0 0 #ce93d8;
}

.active-purple .fa, .active-purple-2 .fa {
  color: #ce93d8;
}

.tt{
    float: right;
    padding-top: 5px;
    padding-bottom: 5px;
    margin-top: 30px;
  }


</style>

</div>
<h4><marquee  scrollamount="10" style="color: red;">New !! สะดุดรักยัยแฟนเช่า เล่มที่ 14 มาแล้ววันนี้ </marquee></h4>
    <?php include('navbar_member.php');?>
    

  
    
      
   <div class="row">
    <div class="col-sm-2 ml-5">
    <div class="fb-page" data-href="https://www.facebook.com/MunichCartoon" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/MunichCartoon" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/MunichCartoon"></a></blockquote></div></div>



    <div class="col-sm-2"><div class="col-md-10">

      <?php include('menu_member.php'); ?>

        
          </div></div>

          <div class="col-sm"><?php 
          $act = (isset($_GET['act']) ? $_GET['act'] : '');
          $q = (isset($_GET['q']) ? $_GET['q'] : '');
          if($act == 'showbytype'){
            include('show_product_type_member.php');
          }elseif($q!=''){
            include('show_product_q_member.php');
          }else{
          include('show_product_member.php');
          }
          ?>
            
          </div>

        </div>

</div>
   

   
</body>
</html>