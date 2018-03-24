<?php

 $title="شرح اعتبار "; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
 include("../includes/extra_file/convert_num_to_word.php");
include("alert_messages.php");
$types='';
$box_id=$_GET['s_n'];
$year=jdate("Y");
$query=mysql_query("select * from province order by pro_id ",$con);
$serial_query=mysql_query("select count(r_box_id) r_box_id from box_reason where r_box_id=$box_id and type='box' and year='$year' order by r_box_id desc limit 1",$con);
$serial_row=mysql_fetch_assoc($serial_query);
$serial_number=$serial_row['r_box_id'];

?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php alert_messages(); ?>
		<a href="final_box_payment_request_paper.php?s_n=<?php echo $box_id; ?>&cur=<?php echo $_GET['cur']; ?>">
			<span class="btn btn-primary pull-left" style="padding:6px 14px;">نمایش <l class="icon icon-play icon-white" style="margin-top:2px;"></l></span>
		</a>
		</div>
			<div class="span7 add_table" style="margin-right:173px;">
				<table class="table_setting">
				<form action="../controller/box_query.php" method="post">
					<tr> <th colspan='2' id=""><h3>برگه درخواست مجوز پرداخت</h3></th></tr>
					<tr>
						<td class='label_align'>ردیف	: </td>
						<td class='input_align'><input type="text" class='text-center' name="reason_box_serial_fa" readonly value="<?php echo " ".en2f_number($serial_number+1); ?>"  ></td>
						<td class='input_align'>
							<input type="hidden" class='text-center' name="reason_box_serial_no" readonly value="<?php echo $serial_number+1; ?>"  >
							
						</td>
					</tr>
					
					
					
					<tr>
						<td class='label_align'>شرح اعتبار - هزینه: </td>

						<td class='input_align'>
							<input type="text" name='payment_reason' lang='fa'   placeholder='شرح اعتبار - هزینه' required>
							
						</td>
					</tr>
					<tr>
						<td class="label_align">مبلغ:</td>
						<td class="input_align">
							<input type="number" id="anbar_unit_price" lang='fa' class="number_amount_ajax" min="1" name="amount" placeholder="مبلغ" required="">
							
							<input type="text" name="currency_name"  id="rased_currency_name" value="<?php echo get_currency_id('cur_name'); ?>"  disabled >
							<input type="hidden" name="currency_id"  value="<?php echo get_currency_id('cur_id'); ?>"   >
						</td>
					</tr>
					<tr>
						<td class='label_align'>ملاحظات: </td>
						<td class='input_align'><input type="text" lang='fa' name="comment" placeholder="ملاحظات" required></td>
						<td class='input_align'><input type="hidden" name="box_serial_no" value="<?php echo $_GET['s_n']; ?>"></td>
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