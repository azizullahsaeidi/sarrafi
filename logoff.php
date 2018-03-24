<?php session_start(); if(!isset($_SESSION['user_login'])) { header("Location:login.php?login=false");  }
 include("../includes/connection.php");
 if(!isset($_GET['counter_id']))
{
header("location: ../controller/login_out_query.php");
  }else{
  $user_id=$_GET['counter_id'];
  $query=mysql_query("select ad_name,ad_lname,ad_username,ad_photo from admin where ad_id='$user_id'",$con);
  $row=mysql_fetch_assoc($query);extract($row);
  
  
    ?>

<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title> ورود به سیستم</title>
  <link rel="stylesheet" href="../style/css/login_style.css">
</head>
<body>
  <section class="container" style="margin-top:110px;">
    <div class="logoff login">

      <h1><?php echo $ad_name." ".$ad_lname; ?></h1>
      <form method="post" action="../controller/check_admin.php">
        <p id="error_msg_p">
          <?php if (isset($_GET['login'])) {
            if ($_GET['login']=='failed') {
              echo "<span>رمز عبور شما اشتباه است.</span>";
            }elseif ($_GET['login']=='false') {
              echo "<span> نخست وارد سیستم شوید.</span>";
            }
          } ?>
          <img src="../images/admin_profile_pic/<?php echo $ad_photo ?>"></p>
        <p><input type="password" name="logoff_password" value="" placeholder="رمز عبور" required="required" style="width:181px;">
          <input type='hidden' name="counter_id" value="<?php echo $_GET['counter_id']; ?>"> 
        </p>
        
        <p class="submit"><input type="submit" name="commit" value="ورود" style="width:175px;">
          <a href="../controller/login_out_query.php" onClick="return window.confirm('ببخشید! آیا نسخه پشتبانی از سیستم را گرفته اید؟');"><span style='color:red'>خروج</span></a>
        </p>
      </form>
    </div>

  </section>
 <?php 
}
?>
</body>
</html>

