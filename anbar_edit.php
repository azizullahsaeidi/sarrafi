<?php 
	//session_start(); if(!isset($_SESSION['user_login'])) { header("Location:login.php?login=false");  }
if (isset($_GET['anbar_edit'])) {
	//$setting_currency_id=$_GET['setting_currency_id'];
	$title='ویرایش واحد پول';
}

?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); ?>
	<!-- Begining of Content -->
		<div class="content">
			
		<div class='span11 messages'>
			<?php if(isset($_GET['opt']))
			{
				if($_GET['opt']=='false')
				{ 
					echo "<div class='alert alert-danger' id='alert_messages'><span class='text-right red_color' >ببخشید! </span> ویرایش صورت نگرفت.</div>";
				}
			} ?>
			<?php if (isset($_GET['anbar_edit'])) {
				$anbar_edit=(int)$_GET['anbar_edit'];
				$query=mysql_query("select * from anbar where anbar_code=$anbar_edit",$con);
				$row=mysql_fetch_assoc($query);extract($row);
			?>
			<a href="anbar.php">
				<span class="btn btn-primary pull-left">برگشت <l class="icon-arrow-left icon-white" style="margin-top: 3px;padding-right: 5px;"></l></span>
			</a>		
		</div>
			<div class="span11 messages text-center">
				<table class="table_setting "style="width:50%;margin-right:222px">
				<form action="../controller/anbar_query.php" method="post">
					<tr> <th colspan='2' id="form_title_center"><h4>ویرایش انبار</h4></th></tr>
					<tr>
						<td class='label_align'>نام انبار:</td>
						<td class='input_align'><input type="text" value="<?php echo $anbar_name; ?>" name="edit_anbar_name"  required></td>
					</tr>
					<tr>
						<td class='label_align'>کد انبار:</td>
						<td class='input_align'><input type="number" min='1' max='99' value="<?php echo $anbar_code; ?>" name="edit_anbar_code"  required></td>
					</tr>
					
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
						<input type="hidden" value="<?php echo $anbar_id; ?>" name="anbar_id"> 
						<input type="submit" class='btn btn-primary ' id="just_submit" value="تائید">
						</td>
					</tr>
					</form>	
				</table>
			<?php } ?>
			</div>
			</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	