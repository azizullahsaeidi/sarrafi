<?php

 $title="ویرایش برگه درخواست مجوز پرداخت "; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
 include("../includes/extra_file/convert_num_to_word.php");
include("alert_messages.php");
$box_id=$_GET['box_id'];
$s_n=$_GET['s_n'];
$cur=$_GET['cur'];
$query=mysql_query("select * from box where box_id=$box_id and box_type='e'",$con);
$row=mysql_fetch_assoc($query);extract($row);
$name=explode("/", $box_reciever_name);
?>
	<!-- Begining of Content -->
		<div class="content">
			<div class="span11 messages">
				<a href="final_box_payment_request_paper.php?s_n=<?php echo $s_n; ?>&cur=<?php echo $cur; ?>">
			<span class="btn btn-primary pull-left" style="padding:6px 14px;">برگشت <l class="icon icon-arrow-left icon-white" style="margin-top:3px;"></l></span>
		</a>
		</div>

			<div class="span7 add_table" style="margin-right:173px;">
				<table class="table_setting">
				<form action="../controller/box_query.php" method="post">
					<tr> <th colspan='2' id=""><h3>برگه درخواست مجوز پرداخت</h3></th></tr>
					<tr>
						<td class='label_align'>شماره صدوق: </td>
						<td class='input_align'><input type="text" class='text-center' name="box_serial_fa" readonly value="<?php echo " ".en2f_number($s_n); ?>"  ></td>
						<td class='input_align'><input type="hidden" class='text-center' name="serial_no_edit" readonly value="<?php echo $s_n; ?>"  ></td>
					</tr>
					<tr>
						<td class="label_align">مقدار به عدد:</td>
						<td class="input_align">
							<input type="number" id="anbar_unit_price" class="number_amount_ajax" min="1" name="number_amount_edit" value="<?php echo $box_amount; ?>" required="">
							<input type="text" name="currency_name" id="rased_currency_name" value="<?php echo get_currency_id('cur_name'); ?>"  disabled >
							<input type="hidden" name="currency_id"  value="<?php echo get_currency_id('cur_id'); ?>"  >
							<input type="hidden" name="box_id"  value="<?php echo $box_id; ?>"  >
							<?php 
							if (isset($_GET['type'])) {
								$type=$_GET['type'];
							echo "<input type='hidden' name='type'  value='$type'>";
							}
							?>
						</td>
					</tr>
					<tr>
						<td class='label_align'>مقدار به حروف: </td>
						<td class='input_align'>
							<textarea name='alpha_amount' required value="" id="alpha_number_ajax" style="width:248px;margin-bottom:0px;" readonly>
								<?php  echo convert_number_to_words((int)$box_amount); ?>
							</textarea>
							
						</td>
					</tr>
					<tr>

						<td class='label_align'>در وجه: </td>
						<td class='input_align'><input type="text" lang='fa' name="trust_person_edit" value="<?php echo $name[0]; ?>" required></td>
					</tr>
					<tr>
						<td class='label_align'>بابت: </td>

						<td class='input_align'>
							<input type="text" name='reason_edit' required lang='fa' value="<?php echo $box_reason; ?>">
								
						</td>
					</tr>
					<tr>
						<td class='label_align'>تحویل گرینده وجه: </td>

						<td class='input_align'>
							<input type="text" name='payment_taker_edit' required lang='fa' value="<?php echo $name[1]; ?>">
								
						</td>
					</tr>
					
					<tr>
						<td class='label_align'> 
					
						<?php 
							if (isset($_GET['serial_type'])=='e') {
								$serial_type    		= $_GET['serial_type'];
								$year  					= $_GET['year'];
								$s_n_f  				= $_GET['s_n_f'];
								$s_n_t  				= $_GET['s_n_t'];
							echo "<input type='hidden' name='serial_type'   value='$serial_type'>";
							echo "<input type='hidden' name='year'   value='$year'>";
							echo "<input type='hidden' name='s_n_f'   value='$s_n_f'>";
							echo "<input type='hidden' name='s_n_t'   value='$s_n_t'>";

							}
						 ?>
						</td>
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