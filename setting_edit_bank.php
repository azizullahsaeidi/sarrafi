<?php $title="ساختن میدر جدید "; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
	  include("alert_messages.php");
$query=mysql_query("select * from currency",$con);
if(isset($_GET['edit_bank_id'])){
	$bank_id = $_GET['edit_bank_id'];
	$bank_query=mysql_query("select * from bank_account where bank_id=$bank_id",$con);
	$bank_row=mysql_fetch_assoc($bank_query);extract($bank_row);
}
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
					<tr> <th colspan='2'><h3>حساب بانکی جدید</h3></th></tr>
					<tr>
						<td class='label_align'>نام بانک:</td>
						<td class='input_align'><input type="text" lang='fa' value="<?php echo $bank_name; ?>" name="edit_bank_name"  required></td>
					</tr>
					<tr>
						<td class='label_align'>شعبه بانک:</td>	
						<td class='input_align'><input type="text" lang='fa' value="<?php echo $bank_branch; ?>" name="edit_branch_name"  required></td>
					</tr>
					<tr>
						<td class='label_align'>شماره حساب بانکی:</td>
						<td class='input_align'><input type="text" lang='fa' value="<?php echo $account_number; ?>" name="edit_bank_account_number"  required></td>
					</tr>
					
					<tr>
						<td class='label_align'>نوعیت حساب:</td>
						<td class='input_align'>
							<select name='edit_account_type' required> 
								<option value='type'>انتخاب نوعیت حساب </option>
								<?php while ($row=mysql_fetch_assoc($query)) {
									extract($row);
									if($cur_id==$bank_account_type){

									echo "<option value='$cur_id' selected>$cur_name </option>";
									continue;
									}else{
										echo "<option value='$cur_id' >$cur_name </option>";
									}
								}?>
							</select>
						</td>
					</tr>
					
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
						<input type="hidden" name="bank_id" value="<?php echo $_GET['edit_bank_id'];?>">
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