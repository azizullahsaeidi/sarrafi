<?php
 $title="برگه درخواست مجوز پرداخت "; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
 include("../includes/extra_file/convert_num_to_word.php");
include("alert_messages.php");
$date=jdate('Y');
$cur_id=$_GET['cur'];



	

$ba_query=mysql_query("select * from bank_account where bank_account_type=$cur_id;",$con);
$serial_query=mysql_query("select bank_serial_no from bank where bank_type='bank_e' and bank_date like '$date-%' order by ban_id desc limit 0,1",$con);
$serial_row=mysql_fetch_assoc($serial_query);
$serial_number=$serial_row['bank_serial_no']+1;
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
		<?php full_alert_message(); 
		if (!isset($_GET['opt'])) { 
		if ($serial_number>1) { 
			echo "<div class='alert alert-danger' id='alert_messages' style='width:700px;padding:4px 20px;'><span class='text-right ' >توجه! </span> آیا حاضر به ایجاد برگ جدید هستید؟</div>";?>
		<a href="../controller/bank_query.php?s_n=<?php echo $serial_number-1; ?>&cur=<?php echo $cur_id; ?>&extract_temp=true" target="_blank">
			<span class="btn btn-primary pull-left">آخرین برگه مجوز </span></a>
		<?php }}
		?>

		</div>
			<div class="span7 add_table" style="margin-right:173px;">
				<table class="table_setting">
				<form action="../controller/bank_query.php" method="post" id="bank_and_box">
					<tr> <th colspan='2' id=""><h3>برگه مجوز صدور چک</h3></th></tr>
					<tr>
						<td class='label_align'>شماره صدور چک: </td>
						<td class='input_align'><input type="text" class='text-center' name="bank_serial_fa" readonly value="<?php echo $box_serial; ?>"  ></td>
						<td class='input_align'><input type="hidden" class='text-center' name="bank_serial_no" readonly value="<?php echo $serial_number; ?>"  ></td>
					</tr>
					<tr>
						<td class='label_align'>انتخاب حساب بانکی: </td>

						<td class='input_align'>
							
							<select name="bank" id="bank_acount_number_id" >
								<option value='none'>انتخاب حساب بانکی</option>
								<?php

									while ($ad_row=mysql_fetch_array($ba_query)) { extract($ad_row);
									echo "<option value='$account_number'>";
									echo $bank_name." ------- ".$bank_branch;
									echo "</option>";
									}
								 ?>
							</select>
								
						</td>
					</tr>
					<tr>
						<td class='label_align'>شماره حساب بانکی: </td>

						<td class='input_align'>
							<input type="text" name='bank_acount_number' id="bank_acount_number_value" required  readonly  placeholder="شماره حساب بانکی ">
								
						</td>
					</tr>
					<tr>
						<td class="label_align">مبلغ:</td>
						<td class="input_align">
							<input type="number" id="box_amount_number" lang='fa' class="number_amount_ajax" min="1" name="bank_amount" placeholder="مبلغ به عدد" required="">
							
							<input type="text" name="currency_name" id="rased_currency_name" value="<?php echo get_currency_id('cur_name'); ?>"  disabled >
							<input type="hidden" name="currency_id" id='currency_id' value="<?php echo get_currency_id('cur_id'); ?>"  >
						</td>
					</tr>
					<tr>
						<td class='label_align'>مبلغ به حروف: </td>
						<td class='input_align'>
							<textarea name='alpha_amount' required placeholder='مبلغ به حروف' id="alpha_number_ajax" style="width:248px;margin-bottom:0px;" readonly>
							</textarea>
							
						</td>
					</tr>
					<tr>
						<td class='label_align'>مانده نزد بانک: </td>
						<td class='input_align'>
							<input disabled type="text" name="r_p" id="remain_amount_p"  >
							<input type="hidden" lang='fa'  name="bank_trust_person"  id="exist_box_amount">
						</td>
					</tr>
					<tr>
						<td class='label_align'>در وجه: </td>
						<td class='input_align'><input type="text" lang='fa' id="box_trust_persion" name="bank_trust_person" placeholder="در وجه" required></td>
					</tr>
					
					<tr>
						<td class='label_align'>شماره چک: </td>

						<td class='input_align'>
							<input type="text" name='bank_check_number' required lang='fa'  placeholder="شماره چک ">
								
						</td>
					</tr>
					
					<tr>
						<td class='label_align'>بابت: </td>

						<td class='input_align'>
							<input type="text" name='bank_reason' required lang='fa'  placeholder="بابت ">
								
						</td>
					</tr>
					<tr>
						<td class='label_align'>تحویل گیرنده وجه: </td>

						<td class='input_align'>
							<input type="text" name='bank_payment_taker' required lang='fa'  placeholder="تحویل گیرنده وجه ">
							<input type="hidden" value="<?php echo jdate("Y/m/d"); ?>" name='dates'>
								
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
			
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	