<style>
  .black {
    color: black;
  }
</style>
<nav class="navbar navbar-expand-lg sticky-top" style="background-color: #fff;border-bottom:3px solid #ffc107">
  <div class="container">
    <a class="navbar-brand" href="index.php" style="color: black;">> Munich <</a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav float-right">
            <li class="nav-item active">
              <a class="nav-link" href="#" style="color: black;">-----<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="myCart.php" style="color: black;">ตะกร้าของฉัน (<span id="num_of_cart"><?php echo $munich->numOfCart() ?></span>)</a>
            </li>
            <!-- Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" style="color: black;">
                <i class="fas fa-user"></i> <?php echo $munich->getProfile()->m_name . " " . $munich->getProfile()->m_surname; ?>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="me.php">แก้ไขข้อมูลส่วนตัว</a>
                <a class="dropdown-item" href="logout.php" onclick="return confirm('คุณต้องการออกจากระบบหรือไม่ ?')">ออกจากระบบ</a>
              </div>

            </li>

        </div>
  </div>
</nav>