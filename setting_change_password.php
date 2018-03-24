<?php $title="تغییر رمز عبور"; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
	  include("alert_messages.php");
?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php if(isset($_GET['cur_opt'])){ 
			if($_GET['cur_opt']=='true'){ ?>
				<div class="alert alert-success" id=''><span class='text-right red_color' >توجه! </span> رمز عبور موفقانه تغییر نمود.</div>
		<?php } elseif($_GET['cur_opt']=='false'){ ?>
				<div class="alert alert-danger" ><span class='text-right red_color' >توجه! </span> شما موفق به تغییر رمز عبور نشدید.</div>
		<?php }} ?>
				
		</div>
			<div class="span11 messages text-center">
				<table class="table_setting "style="width:50%;margin-right:222px">
				<form action="../controller/setting_query.php" method="post" enctype="multipart/form-data">
					<tr> <th colspan='2'><h3 style="margin-right: 50px;">تغییر رمز عبور</h3></th></tr>
					<tr>
						<td class='label_align'>رمز عبور فعلی:</td>
						<td class='input_align'><input type="password"  name="add_cur_pass" placeholder="رمز عبور فعلی" required></td>
					</tr>
					<tr>
						<td class='label_align'>رمز عبور جدید:</td>	
						<td class='input_align'><input type="password"  name="add_new_pass" placeholder="رمز عبور جدید" required></td>
					</tr>
					<tr>
						<td class='label_align'>تائید رمز عبور :</td>
						<td class='input_align'><input type="password"  name="add_confirm" placeholder="  تائید رمز عبور" required></td>
					</tr>
					
					
					
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
						<input type="submit" class='btn btn-primary' value="تائید">
						<input type="reset" class='btn btn-primary'  value="پاک کردن">
						</td>

						
					</tr>
					
					</form>	
				</table>
			</div>
			</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	