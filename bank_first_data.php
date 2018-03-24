<?php
 $title="مقدار اولیه";
include("../includes/connection.php");
include("../includes/header.php"); 
include("../includes/extra_file/convert_num_to_word.php");
include("alert_messages.php");
$cur_id=$_GET['cur'];
$year=jdate("Y");
$ba_query=mysql_query("select * from bank_account where bank_account_type=$cur_id;",$con);
$f_t_query=mysql_query("select ban_id, bank_account_number,bank_check_number,bank_amount,bank_reason from bank where bank_cur_id =$cur_id and bank_reciever_name='f_t_insert'",$con);


?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php full_alert_message(); ?>
		</div>
			<div class="span5 add_table" style="padding-top:2px;padding-bottom:2px;">
				<table class="table_setting" id="bank_cash_padding">
				<form action="../controller/bank_query.php" method="post" id='cash_and_check'>
					<tr> <th colspan='2' id=""><h3 style='margin-right:80px;'>اول دوره</h3></th></tr>
					
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
							<input type="number" id="anbar_unit_price" lang='fa' class="number_amount_ajax" min="1" name="first_cash_amount" placeholder="مبلغ به عدد" required="">
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
						<td class='label_align'>توضیحات: </td>
						<td class='input_align'>
							<input type="text" name='first_description' required lang='fa'  placeholder="توضیحات">
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
			<div class="span5 show_table" style="overflow: scroll;">
				<table class="table_setting" border="1">
				
					<tr> <th colspan='5'>لیست اول دوره</th></tr>
					<tr>
						<th>بانک</th>
						
						<th>شماره حساب</th>
						<th>مبلغ</th>
						<th>شرح</th>
						<th>ویرایش</th>

					</tr>

					<?php
					if(mysql_num_rows($f_t_query)>0){
					 while($row=mysql_fetch_assoc($f_t_query)){ 
					
					extract($row);
					echo "<tr>";
						
						
						echo "<td > $bank_check_number </td>";
						echo "<td > $bank_account_number </td>";
						echo "<td >";
						echo en2f_number(number_format($bank_amount))."</td>";
						echo "<td > $bank_reason </td>";
						?>
						<td> <a href="bank_first_data_edit.php?first_time_bank_id=<?php echo $ban_id;?>&cur=<?php get_currency_id('cur_id');  ?>"><span class='icon icon-edit '></span></a></td>
						</tr>
					<?php }}else{
						echo "<tr><th colspan='5'>مقدار اولیه موجود نیست.</th></tr>";
						}?>
					
				
				</table>

		</div>
		</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	