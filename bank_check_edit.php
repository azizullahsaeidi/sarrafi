<?php
 $title="ویرایش برگه رسید وجه « بهادار » "; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
 include("../includes/extra_file/convert_num_to_word.php");
include("alert_messages.php");
$check_id=$_GET['check_id'];
$cur=$_GET['cur']; 

$query=mysql_query("select * from bank_check where check_id=$check_id",$con);
$row=mysql_fetch_assoc($query);extract($row);
$serial_number=$row['check_serial_no'];
$box_serial=0;
$box_9=0;
$box_11=0;
if ($serial_number<=9) {
	$box_9='00';
	$box_serial=$box_9.$serial_number;
	$box_serial= en2f_number($box_serial);
}elseif ($serial_number>=10 && $serial_number <=99) {
	$box_11='0';
	$box_serial=$box_11.$serial_number;
	$box_serial= en2f_number($box_serial);
}else{
	$box_serial=$serial_number;
	$box_serial= en2f_number($box_serial);

}

?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php full_alert_message(); ?>
		</div>
			<div class="span7 add_table" style="margin-right:173px;padding-top:2px;padding-bottom:2px;">
				<table class="table_setting">
				<form action="../controller/bank_check_query.php" method="post">
					<tr> <th colspan='2' id=""><h3 style='margin:0px;'>ویرایش برگه رسید وجه « بهادار »</h3></th></tr>
					<tr>
						<td class='label_align'>سریال رسید وجه: </td>
						<td class='input_align'><input type="text" class='text-center' name="box_serial_fa" readonly value="<?php echo $box_serial; ?>"  ></td>
						<td class='input_align'><input type="hidden" class='text-center' name="edit_check_serial_no" readonly value="<?php echo $serial_number; ?>"  ></td>
					</tr>
					<tr>
						<td class="label_align">مقدار به عدد:</td>
						<td class="input_align">
							<input type="number" id="anbar_unit_price" lang='fa' class="number_amount_ajax" min="1" name="edit_check_amount" value="<?php echo $check_amount; ?>" required="">
							
							<input type="text" name="currency_name" id="rased_currency_name" value="<?php echo get_currency_id('cur_name'); ?>"  disabled >
							<input type="hidden" name="currency_id"  value="<?php echo get_currency_id('cur_id'); ?>"  >
						</td>
					</tr>
					<tr>
						<td class='label_align'>مقدار به حروف: </td>
						<td class='input_align'>
							<textarea name='alpha_amount' required  id="alpha_number_ajax" style="width:248px;margin-bottom:0px;" readonly>
							<?php echo convert_number_to_words($check_amount); ?>
							</textarea>
							
						</td>
					</tr>
					
					
					
					<tr>
						<td class='label_align'>نوع سند: </td>
						<td class='input_align'>
							<input type="text" name='edit_check_type' value="<?php echo $check_doc_type; ?>" required lang='fa'  placeholder="نوع سند">
								
						</td>
					</tr>
					<tr>
						<td class='label_align'>شماره سند: </td>
						<td class='input_align' >
							<input type="text" name='edit_check_number' value="<?php echo $check_doc_no; ?>" required lang='fa'  placeholder="شماره سند">
								
						</td>
					</tr>
					<tr>
						<td class='label_align'>نام بانک: </td>
						<td class='input_align'>
							<input type="text" name='edit_bank_check_name' required lang='fa'  value="<?php echo $check_bank_name; ?>">
								
						</td>
					</tr>
					<tr>
						<td class='label_align'>مورد دریافت: </td>

						<td  style='text-align:right;'>
							<select style='width:248px;margin-bottom:0px;' name='edit_kind'>
							<?php if ($check_reason=='help_people') {
								echo "<option value='help_people' selected>کمک مردمی</option>";
							}else{
								echo "<option value='help_people'>کمک مردمی</option>";
							}
							if ($check_reason=='wojohat') {
								echo "<option value='wojohat' selected>وجوهات امانی</option>";
							}else{
								echo "<option value='wojohat'>وجوهات امانی</option>";
							}
							if ($check_reason=='sale') {
								echo "<option value='sale' selected>فروش</option>";
							}else{
								echo "<option value='sale'>فروش</option>";
							}
							if ($check_reason=='study') {
								echo "<option value='study' selected>وصول مطالعات</option>";
							}else{
								echo "<option value='study'>وصول مطالبات</option>";
							}
							if ($check_reason=='borrow') {
								echo "<option value='borrow' selected>وام</option>";
							}else{
								echo "<option value='borrow'>وام</option>";
							}
							if ($check_reason=='orphan') {
								echo "<option value='orphan' selected>ایتام</option>";
							}else{
								echo "<option value='orphan'>ایتام</option>";
							}
							if ($check_reason=='other') {
								echo "<option value='other' selected>اعتبارات</option>";
							}else{
								echo "<option value='other'>اعتبارات</option>";
							} ?>
							</select>
						</td>
					</tr>
					<tr>
						<td class='label_align'>سر رسید: </td>
						<td class='input_align' dir='ltr'>
							<input type="text" name='edit_exp_date' id="check_expiration_date" required   value="<?php echo $check_exp_date; ?>">
						</td>
					</tr>
					<tr>
						<td class='label_align'>توضیحات: </td>
						<td class='input_align'>
							<input type="text" name='edit_description' required lang='fa'  value="<?php echo $check_desc; ?>">
						</td>
					</tr>
					<tr>
						<td class='label_align'>
							<?php 
							if (isset($_GET['type'])=='check') {
								$type    		= $_GET['type'];
								$year  					= $_GET['year'];
								$s_n_f  				= $_GET['s_n_f'];
								$s_n_t  				= $_GET['s_n_t'];
							echo "<input type='hidden' name='type'   value='$type'>";
							echo "<input type='hidden' name='year'   value='$year'>";
							echo "<input type='hidden' name='s_n_f'   value='$s_n_f'>";
							echo "<input type='hidden' name='s_n_t'   value='$s_n_t'>";
							}
						 ?>
						</td>
						<td class='submit_reset'>
						<input type="hidden" name="bank_check_id"  value="<?php echo $check_id;?>">
						<input type="submit" class='btn btn-primary' value="تائید" id="just_submit">
						</td>
					</tr>
					</form>	
				</table>
			</div>
			</div>
			
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	