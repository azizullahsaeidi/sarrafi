<?php
 $title="برگه رسید وجه"; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
 include("../includes/extra_file/convert_num_to_word.php");
include("alert_messages.php");
$query=mysql_query("select * from province order by pro_id ",$con);
$year=jdate("Y");
$serial_query=mysql_query("select box_serial_no from box where box_type='a' and box_date like '$year-%' order by box_id desc limit 0,1",$con);
$serial_row=mysql_fetch_assoc($serial_query);
$serial_number=$serial_row['box_serial_no']+1;
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
		<a href="../controller/box_query.php?cur=<?php echo get_currency_id('cur_id'); ?>&box_arrive_temp=true" target="_blank">
			<span class="btn btn-primary pull-left">آخرین برگ رسید وجه </span></a>
		<?php }}
		?>
		</div>
			<div class="span7 add_table" style="margin-right:173px;">
				<table class="table_setting">
				<form action="../controller/box_query.php" method="post" id="bank_and_box">
					<tr> <th colspan='2' id=""><h3>برگه رسید وجه </h3></th></tr>
					<tr>
						<td class='label_align'>شماره رسید وجه: </td>
						<td class='input_align'><input type="text" class='text-center' name="box_serial_fa" readonly value="<?php echo $box_serial; ?>"  ></td>
						<td class='input_align'><input type="hidden" class='text-center' name="box_arrive_serial_no" readonly value="<?php echo $serial_number; ?>"  ></td>
					</tr>
					<tr>
						<td class="label_align">مبلغ:</td>
						<td class="input_align">
							<input type="number" id="anbar_unit_price" lang='fa' class="number_amount_ajax" min="1" name="arrive_number_amount" placeholder="مبلغ" required="">
							
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
						<td class='label_align'>مورد دریافت: </td>

						<td  style='text-align:right;'>
							<select style='width:248px;margin-bottom:0px;' name='kind' id='bank_acount_number'>
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
						<td class='label_align'>توضیحات: </td>
						<td class='input_align'>
							<input type="text" name='discription' required lang='fa'  placeholder="توضیحات">
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