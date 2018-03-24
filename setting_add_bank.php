<?php $title="ساختن میدر جدید"; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
	  include("alert_messages.php");
$query=mysql_query("select * from currency",$con);
?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php add_admin_alert(); ?>
		<a href="setting_bank.php">
			<span class="btn btn-primary pull-left">برگشت <l class="icon-arrow-left icon-white" style="margin-top: 3px;padding-right: 5px;"></l></span>
		</a>		
		</div>
			<div class="span11 messages text-center">
				<table class="table_setting "style="width:50%;margin-right:222px">
				<form action="../controller/setting_query.php" method="post" enctype="multipart/form-data">
					<tr> <th colspan='2'><h3 style="padding-right:60px;">حساب بانکی جدید</h3></th></tr>
					<tr>
						<td class='label_align'>نام بانک:</td>
						<td class='input_align'><input type="text" lang='fa' name="add_bank_name" placeholder="نام بانک" required></td>
					</tr>
					<tr>
						<td class='label_align'>شعبه بانک:</td>	
						<td class='input_align'><input type="text" lang='fa' name="add_branch_name" placeholder="شعبه بانک" required></td>
					</tr>
					<tr>
						<td class='label_align'>شماره حساب بانکی:</td>
						<td class='input_align'><input type="text" lang='fa' name="add_bank_account_number" placeholder="شماره حساب بانکی" required></td>
					</tr>
					
					<tr>
						<td class='label_align'>واحد پولی:</td>
						<td class='input_align'>
							<select name='add_account_type' required> 
								<option value='type'>انتخاب واحد پولی </option>
								<?php while ($row=mysql_fetch_assoc($query)) {
									extract($row);
									echo "<option value='$cur_id'>$cur_name </option>";
								}?>
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