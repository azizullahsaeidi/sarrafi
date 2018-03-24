<?php

 $title="ویرایش "; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
 include("../includes/extra_file/convert_num_to_word.php");
include("alert_messages.php");
$r_id=$_GET['reason_id'];
$box_id=$_GET['s_n'];
//$query=mysql_query("select * from province order by pro_id ",$con);
$query=mysql_query("select * from box_reason where r_id=$r_id",$con);
$row=mysql_fetch_assoc($query);extract($row);
?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php alert_messages(); ?>
		<a href="final_box_payment_request_paper.php?s_n=<?php echo $box_id; ?>&cur=<?php echo $_GET['cur']; ?>">
			<span class="btn btn-primary pull-left" style="padding:6px 14px;">برگشت <l class="icon icon-arrow-left icon-white" style="margin-top:3px;"></l></span>
		</a>
		</div>
			<div class="span7 add_table" style="margin-right:173px;">
				<table class="table_setting">
				<form action="../controller/box_query.php" method="post">
					<tr> <th colspan='2' id=""><h3>ویرایش برگه درخواست مجوز پرداخت</h3></th></tr>
					
					
					<tr>
						<td class='label_align'>شرح اعتبار - هزینه: </td>

						<td class='input_align'>
							<input type="text" name="payment_reason_edit" lang='fa' value="<?php echo $r_details; ?>"> 
						</td>
					</tr>
					<tr>
						<td class="label_align">مبلغ:</td>
						<td class="input_align">
							<input type="number" id="anbar_unit_price" class="number_amount_ajax" min="1" name="amount_edit" value="<?php echo $r_amount; ?>" required="">
							
							<input type="text" name="currency_name" id="rased_currency_name" value="<?php echo get_currency_id('cur_name'); ?>"  disabled >
							<input type="hidden" name="currency_id"  value="<?php echo get_currency_id('cur_id'); ?>"   >
							<input type="hidden" name="serial_no"  value="<?php echo $box_id;  ?>"   >
							<input type="hidden" name="r_id"  value="<?php echo $r_id;  ?>"   >
							<?php if(isset($_GET['bank_type'])){?>
							<input type="hidden" name="bank_type"  value="<?php echo $_GET['bank_type'];  ?>"   >
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td class='label_align'>ملاحظات: </td>
						<td class='input_align'><input type="text" lang='fa' name="comment_edit" value="<?php echo $comment; ?>" required></td>
					</tr>
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
						<input type="submit" class='btn btn-primary' id="just_submit" value="تائید">
						</td>
					</tr>
					</form>	
				</table>
			</div>
			</div>
			
			
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	