<?php
 $title="برگه درخواست مجوز پرداخت "; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/cur_year.php"); ?>
<?php include("../includes/header.php"); 
 include("../includes/extra_file/convert_num_to_word.php");
include("alert_messages.php");
$date=jdate('Y');
$cur_id=$_GET['cur'];
$f_t_year=$y_year-1;
$add_amount_query=mysql_query("select sum(box_amount) add_box_amount from box where box_cur_id=$cur_id and box_status='a_perm' and  box_date  like '$date-%' ",$con);
$extract_amount_query=mysql_query("select sum(box_amount) extract_box_amount from box where box_cur_id=$cur_id and box_status='p_perm' and  box_date  like '$date-%' ",$con);

$add_query=mysql_query("select sum(box_amount) box_amount from box where box_cur_id=$cur_id and box_type='a' and box_status='a_perm' and box_date <= '$f_t_year-12-30'",$con);
$take_query=mysql_query("select sum(box_amount) box_amount from box where box_cur_id=$cur_id and box_type='e' and box_status='p_perm' and box_date <= '$f_t_year-12-30'",$con);
$add_row=mysql_fetch_assoc($add_query);
$take_row=mysql_fetch_assoc($take_query);
$add_value=$add_row['box_amount'];
$take_value=$take_row['box_amount'];
$f_value=$add_value-$take_value;


$remain_amount=0;
$add_amount_row=mysql_fetch_assoc($add_amount_query);
$extract_amount_row=mysql_fetch_assoc($extract_amount_query);
		$added_amount=$add_amount_row['add_box_amount'];
		$extract_amount=$extract_amount_row['extract_box_amount'];
//echo $exist_amount_row['box_amount'];

	 $remain_amount=$added_amount-$extract_amount;
	

$query=mysql_query("select * from province order by pro_id ",$con);
$serial_query=mysql_query("select box_serial_no from box where box_type='e' and box_date like '$date-%' order by box_id desc limit 0,1",$con);
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
			echo "<div class='alert alert-danger' id='alert_messages' style='width:700px;padding:4px 20px;'><span class='text-right ' >توجه! </span> آیا حاضر به ایجاد برگ جدید هستید؟</div>";
			?>

		<a href="../controller/box_query.php?s_n=<?php echo $serial_number-1; ?>&cur=<?php echo $cur_id; ?>&box_temp=true" target="_blank">
			<span class="btn btn-primary pull-left">آخرین برگه مجوز </span></a>
		<?php }}?>
		</div>
			<div class="span7 add_table" style="margin-right:173px;">
				<table class="table_setting">
				<form action="../controller/box_query.php" method="post">
					<tr> <th colspan='2' id=""><h3>برگه درخواست مجوز پرداخت</h3></th></tr>
					<tr>
						<td class='label_align'>شماره صندوق: </td>
						<td class='input_align'><input type="text" class='text-center' name="box_serial_fa" readonly value="<?php echo $box_serial; ?>"  ></td>
						<td class='input_align'><input type="hidden" class='text-center' name="box_serial_no" readonly value="<?php echo $serial_number; ?>"  ></td>
					</tr>
					<tr>
						<td class="label_align">مبلغ:</td>
						<td class="input_align">
							<input type="number" id="box_amount_number" lang='fa' class="number_amount_ajax" min="1" name="number_amount" placeholder="مبلغ" required="">
							
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
						<td class='label_align'>پول موجود در صندوق: </td>
						<td class='input_align'>
							<input disabled type="text" lang='fa' value="<?php echo en2f_number($remain_amount+$f_value); ?>">
							<input  type="hidden" value="<?php echo $remain_amount+$f_value; ?>" id='exist_box_amount'>
						</td>
					</tr>
					<tr>
						<td class='label_align'>در وجه: </td>
						<td class='input_align'><input type="text" id="box_trust_persion" lang='fa' name="trust_person" placeholder="در وجه" required></td>
					</tr>
					<tr>
						<td class='label_align'>بابت: </td>

						<td class='input_align'>
							<input type="text" name='reason' required lang='fa'  placeholder="بابت ">
								
						</td>
					</tr>
					<tr>
						<td class='label_align'>تحویل گیرنده وجه: </td>

						<td class='input_align'>
							<input type="text" name='payment_taker' required lang='fa'  placeholder="تحویل گیرنده وجه ">
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