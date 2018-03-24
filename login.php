<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title> ورود به سیستم</title>
  <link rel="stylesheet" href="../style/css/login_style.css">
  <script type="text/javascript" src="../script/jquery.js"></script>
  <script type="text/javascript" src="../script/jkblayout.min.js"></script>
</head>
<body>
  <section class="container">
    <div class="login">

      <h1>ورود به سیستم</h1>
      <form method="post" action="../controller/check_admin.php">


        <p id="error_msg_p">
          
          <img src="../images/committee_logo.jpg"></p>


        <p id="error_msg_p">
          <?php if (isset($_GET['login'])) {
            if ($_GET['login']=='failed') {
              echo "<span> نام کاربری یا رمز عبور شما اشتباه است.</span>";
            }elseif ($_GET['login']=='false') {
              echo "<span> نخست وارد سیستم شوید.</span>";
            }
          } ?>
          <input type="text" name="username"  value="" placeholder="نام کاربری" required="required"></p>
        <p><input type="password" name="password"  value="" placeholder="رمز عبور" required="required"></p>
        <p class="remember_me">
          
        </p>
        <p class="submit"><input type="submit" name="commit" value="ورود"></p>
      </form>
    </div>

  </section>

</body>
</html>
