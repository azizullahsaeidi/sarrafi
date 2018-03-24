<?php
 $title="مقدار اولیه";
include("../includes/connection.php");
include("../includes/header.php"); 
include("../includes/extra_file/convert_num_to_word.php");
include("alert_messages.php");
$cur_id=$_GET['cur'];
$bank_id=$_GET['first_time_bank_id'];
$year=jdate("Y");
$f_t_query=mysql_query("select ban_id, bank_account_number,bank_check_number,bank_amount,bank_reason from bank where ban_id=$bank_id",$con);
$f_t_row=mysql_fetch_assoc($f_t_query);extract($f_t_row);

?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php full_alert_message(); ?>
		</div>
			<div class="span7 add_table" style="margin-right:167px;padding-top:2px;padding-bottom:2px;">
				<table class="table_setting" id="bank_cash_padding">
				<form action="../controller/bank_query.php" method="post" id='cash_and_check'>
					<tr> <th colspan='2' id=""><h3 style='margin:0px;'>ویرایش اول دوره</h3></th></tr>
					
					<tr>
						<td class='label_align'>نام بانک: </td>
						<td class='input_align'>
							<input type="text" name='bank_cash_name' value="<?php echo $bank_check_number; ?>" required  readonly >		
						</td>
					</tr>
					<tr>
						<td class='label_align'> حساب بانکی: </td>
						<td class='input_align'>
							
							<input type="text" name='bank_cash_acount_number' value="<?php echo $bank_account_number; ?>" required  readonly  >
						</td>
					</tr>
					<tr>
						<td class="label_align">مبلغ :</td>
						<td class="input_align">
							<input type="number" id="anbar_unit_price"  value="<?php echo $bank_amount; ?>"  lang='fa' class="number_amount_ajax" min="1" name="first_cash_amount_edit" placeholder="مبلغ به عدد" required="">
							<input type="text" name="currency_name" id="rased_currency_name" value="<?php echo get_currency_id('cur_name'); ?>"  disabled >
							<input type="hidden" name="currency_id"  value="<?php echo get_currency_id('cur_id'); ?>"  >
							<input type="hidden" name="bank_id"  value="<?php echo $bank_id; ?>"  >
						</td>
					</tr>
					<tr>
						<td class='label_align'>مبلغ به حروف: </td>
						<td class='input_align'>
							<textarea name='alpha_amount' required placeholder='مبلغ به حروف' id="alpha_number_ajax" style="width:248px;margin-bottom:0px;" readonly>
							<?php echo convert_number_to_words($bank_amount); ?> 
							</textarea>
						</td>
					</tr>
					
					<tr>
						<td class='label_align'>توضیحات: </td>
						<td class='input_align'>
							<input type="text" name='first_description_edit' required lang='fa'  p value="<?php echo $bank_reason; ?>" >
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