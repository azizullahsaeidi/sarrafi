<?php $title="ساختن میدر جدید "; 
include("../includes/connection.php"); 
include("../includes/header.php"); 
include("alert_messages.php");
$query=mysql_query("select * from currency",$con);
?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php add_admin_alert(); ?>
		<a href="admin.php">
			<span class="btn btn-primary pull-left">برگشت <l class="icon-arrow-left icon-white" style="margin-top: 3px;padding-right: 5px;"></l></span>
		</a>		
		</div>
			<div class="span11 messages text-center">
				<table class="table_setting "style="width:50%;margin-right:222px">
				<form action="../controller/admin_query.php" method="post" enctype="multipart/form-data">
					<tr> <th colspan='2'><h3>مدیر جدید</h3></th></tr>
					<tr>
						<td class='label_align'>نام مدیر:</td>
						<td class='input_align'><input type="text" lang='fa' name="add_ad_name" placeholder="نام" required></td>
					</tr>
					<tr>
						<td class='label_align'>تخلص مدیر:</td>	
						<td class='input_align'><input type="text" lang='fa' name="add_ad_lname" placeholder="تخلص" required></td>
					</tr>
					<tr>
						<td class='label_align'>نام کاربری:</td>
						<td class='input_align'><input type="text" lang='fa' name="add_ad_username" placeholder="نام کاربری به انگلیسی" required></td>
					</tr>
					<tr>
						<td class='label_align'>رمز عبور:</td>
						<td class='input_align'><input type="password" lang='fa' name="add_ad_password" placeholder="رمز عبور" required></td>
					</tr>
					<tr>
						<td class='label_align'>تائید رمز عبور:</td>
						<td class='input_align'><input type="password" lang='fa' name="add_ad_confirm" placeholder="تائید رمز عبور" required></td>
					</tr>
					<tr>
						<td class='label_align'>انتخاب عکس:</td>
						<td class='input_align'><input type="file" name='pic'></td>
					</tr>
					<tr>
						<td class='label_align'>تعیین صلاحیت:</td>
						<td class='input_align'>
							<select name='add_ad_status' required> 
								<option value='admin'>مدیر </option>
								<option value='anbar'>انبار </option>
								<option value='bank_sandoq'>صندوق و بانک</option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
						<input type="submit" class='btn btn-primary' value="ذخیره">
						<input type="reset" class='btn btn-primary'  value="پاک کردن">
						</td>

						
					</tr>
					
					</form>	
				</table>
			</div>
			</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	