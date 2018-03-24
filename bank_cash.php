<?php
 $title="برگه رسید وجه «نقد»";
include("../includes/connection.php");
include("../includes/header.php"); 
include("../includes/extra_file/convert_num_to_word.php");
include("alert_messages.php");
$cur_id=$_GET['cur'];
$year=jdate("Y");
$ba_query=mysql_query("select * from bank_account where bank_account_type=$cur_id;",$con);
$serial_query=mysql_query("select bank_serial_no from bank where bank_type='bank_a' and bank_date like '$year-%'  order by ban_id desc limit 0,1",$con);
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
		<a href="../controller/bank_query.php?cur=<?php echo get_currency_id('cur_id'); ?>&s_n=<?php echo $serial_row['bank_serial_no']; ?>&bank_arrive_temp=true" target="_blank">
			<span class="btn btn-primary pull-left">آخرین برگ رسید وجه </span></a>
		<?php }} ?>
		</div>
			<div class="span7 add_table" style="margin-right:173px;padding-top:2px;padding-bottom:2px;">
				<table class="table_setting" id="bank_cash_padding">
				<form action="../controller/bank_query.php" method="post" id='cash_and_check'>
					<tr> <th colspan='2' id=""><h3 style='margin:0px;'>برگه رسید وجه «نقد»</h3></th></tr>
					<tr>
						<td class='label_align'>شماره  رسید وجه: </td>
						<td class='input_align'><input type="text" class='text-center' name="box_serial_fa" readonly value="<?php echo $box_serial; ?>"  ></td>
						<td class='input_align'><input type="hidden" class='text-center' name="cash_serial_no" readonly value="<?php echo $serial_number; ?>"  ></td>
					</tr>
					<tr>
						<td class='label_align'>نام بانک: </td>
						<td class='input_align'>
							<select name="_bank_cash_name" id="bank_acount_number">
								<option value='none'>انتخاب حساب بانکی</option>
								<?php
									while ($ad_row=mysql_fetch_array($ba_query)) { extract($ad_row);
									echo "<option value='$account_number' id='$account_number'>";
									echo $bank_name." / ".$bank_branch;
									echo "</option>";
									}
								 ?>
							</select>	
						</td>
					</tr>
					<tr>
						<td class='label_align'> حساب بانکی: </td>
						<td class='input_align'>
							<input type="hidden" name='bank_cash_name' id="bank_acount_name_value" required  readonly  placeholder="شماره حساب بانکی ">
							<input type="text" name='bank_cash_acount_number' id="bank_acount_number_value" required  readonly  placeholder="شماره حساب بانکی ">
						</td>
					</tr>
					<tr>
						<td class="label_align">مبلغ :</td>
						<td class="input_align">
							<input type="number" id="anbar_unit_price" lang='fa' class="number_amount_ajax" min="1" name="cash_amount" placeholder="مبلغ به عدد" required="">
							<input type="text" name="currency_name" id="rased_currency_name" value="<?php echo get_currency_id('cur_name'); ?>"  disabled >
							<input type="hidden" name="currency_id"  value="<?php echo get_currency_id('cur_id'); ?>"  >
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
						<td class='label_align'>طی رسید شماره: </td>
						<td class='input_align' >
							<input type="text" name='bank_cash_do_no' required onkeydown="javascript:maskInput()"  placeholder="طی رسید شماره">
						</td>
					</tr>
					<tr>
						<td class='label_align'>مورد دریافت: </td>
						<td  style='text-align:right;'>
							<select style='width:248px;margin-bottom:0px;' name='kind' id="kind">
								<option value="none">انتخاب مورد دریافت</option>
								<option value="help_people">کمک مردمی</option>
								<option value="wojohat">وجوهات امانی</option>
								<option value="sale">فروش</option>
								<option value="study">وصول مطالبات</option>
								<option value="borrow">وام</option>
								<option value="orphan">ایتام</option>
								<option value="other">اعتبارات</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class='label_align'>مورخ: </td>
						<td class='input_align' dir='ltr'>
							<input type="text" name='cash_em_date' id="check_expiration_date" required   placeholder="مورخ">
						</td>
					</tr>
					<tr>
						<td class='label_align'>توضیحات: </td>
						<td class='input_align'>
							<input type="text" name='description' required lang='fa'  placeholder="توضیحات">
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
			</div>
		<!-- End of Content -->
	<?php include_once("../includes/footer.php"); ?>	