<?php
 $title="برگه رسید وجه"; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
 include("../includes/extra_file/convert_num_to_word.php");
include("alert_messages.php");
$box_id=$_GET['first_time_box_id'];
$f_t_query=mysql_query("select box_id,box_amount,box_reason from box where box_reciever_name ='f_t_insert' and box_id=$box_id ",$con);
$row=mysql_fetch_assoc($f_t_query);extract($row);
$year=jdate("Y");


?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php full_alert_message(); ?>
		</div>
			<div class="span7 add_table" style="margin-right: 168px;">
				<table class="table_setting">
				<form action="../controller/box_query.php" method="post" id="bank_and_box">
					<tr> <th colspan='2' id=""><h3>ویرایش اول دوره</h3></th></tr>
					
					<tr>
						<td class="label_align">مبلغ:</td>
						<td class="input_align">
							<input type="number" id="anbar_unit_price" lang='fa' class="number_amount_ajax" min="1" name="first_arrive_number_amount_edit" value="<?php echo $box_amount; ?>" required="">
							
							<input type="text" name="currency_name" id="rased_currency_name" value="<?php echo get_currency_id('cur_name'); ?>"  disabled >
							<input type="hidden" name="currency_id"  value="<?php echo get_currency_id('cur_id'); ?>"  >
							<input type="hidden" name="box_id"  value="<?php  echo $box_id; ?>"  >
						</td>
					</tr>
					<tr>
						<td class='label_align'>مبلغ به حروف: </td>
						<td class='input_align'>
							<textarea name='first_alpha_amount' required id="alpha_number_ajax" style="width:248px;margin-bottom:0px;" readonly>
							<?php echo  convert_number_to_words($box_amount); ?>

							</textarea>
							
						</td>
					</tr>
					
					
					
					<tr>
						<td class='label_align'>توضیحات: </td>
						<td class='input_align'>
							<input type="text" name='first_discription' required lang='fa'  value="<?php echo $box_reason; ?>">
								
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