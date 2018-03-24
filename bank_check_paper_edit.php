<?php

 $title="ویرایش برگه درخواست مجوز پرداخت "; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
 include("../includes/extra_file/convert_num_to_word.php");
include("alert_messages.php");
$b_id=$_GET['bank_id'];
$s_n=$_GET['s_n'];
$cur=$_GET['cur'];
$ba_query=mysql_query("select * from bank_account where bank_account_type=$cur;",$con);
$query=mysql_query("SELECT * 
					from 
						bank,
						bank_account 
					where 
						ban_id=$b_id
	 					and bank_account_number=account_number",$con);
$row=mysql_fetch_assoc($query);extract($row);
$name=explode("/", $bank_reciever_name);
?>
	<!-- Begining of Content -->
		<div class="content">
			<div class="span11 messages">
				<a href="bank_final_check_paper.php?s_n=<?php echo $s_n; ?>&cur=<?php echo $cur; ?>">
			<span class="btn btn-primary pull-left" style="padding:6px 14px;">برگشت <l class="icon icon-arrow-left icon-white" style="margin-top:3px;"></l></span>
		</a>
		</div>

			<div class="span7 add_table" style="margin-right:173px;">
				<table class="table_setting">
				<form action="../controller/bank_query.php" method="post">
					<tr> <th colspan='2' id=""><h3>برگه مجوز صدور چک</h3></th></tr>
					<tr>
						<td class='label_align'>سریال: </td>
						<td class='input_align'><input type="text" class='text-center' name="bank_serial_fa" readonly value="<?php echo en2f_number($s_n); ?>"  ></td>
						<td class='input_align'><input type="hidden" class='text-center' name="edit_bank_serial_no" readonly value="<?php echo $s_n; ?>"  ></td>
					</tr>
					<tr>
						<td class="label_align">مقدار به عدد:</td>
						<td class="input_align">
							<input type="number" id="anbar_unit_price" value="<?php echo $bank_amount; ?>" class="number_amount_ajax" min="1" name="edit_bank_amount" placeholder="مقدار به عدد" required="">
							
							<input type="text" name="currency_name" id="rased_currency_name" value="<?php echo get_currency_id('cur_name'); ?>"  disabled >
							<input type="hidden" name="currency_id"  value="<?php echo get_currency_id('cur_id'); ?>"  >
						</td>
					</tr>
					<tr>
						<td class='label_align'>مقدار به حروف: </td>
						<td class='input_align'>
							<textarea name='alpha_amount' required placeholder='مقدار به حروف' id="alpha_number_ajax" style="width:248px;margin-bottom:0px;" readonly>
								<?php echo convert_number_to_words($bank_amount); ?>
							</textarea>
							
						</td>
					</tr>
					<tr>
						<td class='label_align'>در وجه: </td>
						<td class='input_align'><input type="text" lang='fa' value="<?php echo $name[0]; ?>" name="edit_bank_trust_person" placeholder="در وجه" required></td>
					</tr>
					<tr>
						<td class='label_align'>شماره چک: </td>

						<td class='input_align'>
							<input type="text" name='edit_bank_check_number' value="<?php echo $bank_check_number; ?>" required lang='fa'  placeholder="بابت ">
								
						</td>
					</tr>
					<tr>
						<td class='label_align'>انتخاب حساب بانکی: </td>

						<td class='input_align'>
							
							<select name="edit_bank" id="bank_acount_number">
								<option>انتخاب حساب بانکی</option>
								<?php

									while ($ad_row=mysql_fetch_array($ba_query)) { extract($ad_row);
										if ($account_number==$bank_account_number) {
											echo "<option value='$account_number' selected>";
											echo $bank_name." ------- ".$bank_branch;
											echo "</option>";
											continue;
										}else{
											echo "<option value='$account_number'>";
											echo $bank_name." ------- ".$bank_branch;
											echo "</option>";
											continue;
										}
									}
								 ?>
							</select>
								
						</td>
					</tr>
					<tr>
						<td class='label_align'>شماره حساب بانکی: </td>

						<td class='input_align'>
							<input type="text" name='edit_bank_acount_number' value="<?php echo $account_number; ?>" id="bank_acount_number_value" required  readonly  placeholder="شماره حساب بانکی ">
								
						</td>
					</tr>
					<tr>
						<td class='label_align'>بابت: </td>

						<td class='input_align'>
							<input type="text" name='edit_bank_reason' required lang='fa' value="<?php echo $bank_reason; ?>"  placeholder="بابت ">
								
						</td>
					</tr>
					<tr>
						<td class='label_align'>تحویل گرینده وجه: </td>

						<td class='input_align'>
							<input type="text" name='edit_bank_payment_taker' value="<?php echo $name[1]; ?>" required lang='fa'  placeholder="تحویل گرینده وجه ">
								
						</td>
					</tr>
					
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
						<?php 
							if (isset($_GET['type'])) {
								$type=$_GET['type'];
							echo "<input type='hidden' name='type'  value='$type'>";
							}

							if (isset($_GET['serial_type'])=='bank_e') {
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
						<input type="hidden" name="edit_ban_id" value="<?php echo $ban_id; ?>">
						<input type="submit" class='btn btn-primary' value="تائید" id='just_submit'>
						</td>
					</tr>
					
					
					</form>	
				</table>
			</div>
			</div>
			
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	