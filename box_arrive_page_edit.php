<?php
 $title="ویرایش برگه رسید وجه "; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
 include("../includes/extra_file/convert_num_to_word.php");
include("alert_messages.php");
//$query=mysql_query("select * from province order by pro_id ",$con);
$box_id=$_GET['box_id'];
$cur=$_GET['cur']; 
if (isset($_GET['type'])=='a') {
	$year=$_GET['year'];
}else{
$year=jdate("Y");
}
//$year=$_GET['year'];
$query=mysql_query("select * from box where box_id=$box_id and box_date like '$year-%'",$con);
$row=mysql_fetch_assoc($query);extract($row);

$serial_number=$box_serial_no;
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
		<?php full_alert_message(); ?>
		</div>
			<div class="span7 add_table" style="margin-right:173px;">
				<table class="table_setting">
				<form action="../controller/box_query.php" method="post">
					<tr> <th colspan='2' id=""><h3>ویرایش برگه رسید وجه </h3></th></tr>
					<tr>
						<td class='label_align'>سریال رسید وجه: </td>
						<td class='input_align'><input type="text" class='text-center' name="box_serial_fa" readonly value="<?php echo $box_serial; ?>"  ></td>
						<td class='input_align'><input type="hidden" class='text-center' name="edit_box_arrive_serial_no" readonly value="<?php echo $serial_number; ?>"  ></td>
					</tr>
					<tr>
						<td class="label_align">مقدار به عدد:</td>
						<td class="input_align">
							<input type="number" id="anbar_unit_price"  class="number_amount_ajax" min="1" name="edit_arrive_number_amount" value="<?php echo $box_amount; ?>" required="">
							
							<input type="text" name="currency_name" id="rased_currency_name" value="<?php echo get_currency_id('cur_name'); ?>"  disabled >
							<input type="hidden" name="currency_id"  value="<?php echo get_currency_id('cur_id'); ?>"  >
						</td>
					</tr>
					<tr>
						<td class='label_align'>مقدار به حروف: </td>
						<td class='input_align'>
							<textarea name='alpha_amount' required  id="alpha_number_ajax" style="width:248px;margin-bottom:0px;" readonly>
								<?php echo convert_number_to_words($box_amount); ?>
							</textarea>
							
						</td>
					</tr>
					
					
					<tr>
						<td class='label_align'>مورد دریافت: </td>

						<td  style='text-align:right;'>
							<select style='width:248px;margin-bottom:0px;' name='edit_kind'>
							<?php if ($box_reciever_name=='help_people') {
								echo "<option value='help_people' selected>کمک مردمی</option>";
							}else{
								echo "<option value='help_people'>کمک مردمی</option>";
							}
							if ($box_reciever_name=='wojohat') {
								echo "<option value='wojohat' selected>وجوهات امانی</option>";
							}else{
								echo "<option value='wojohat'>وجوهات امانی</option>";
							}
							if ($box_reciever_name=='sale') {
								echo "<option value='sale' selected>فروش</option>";
							}else{
								echo "<option value='sale'>فروش</option>";
							}
							if ($box_reciever_name=='study') {
								echo "<option value='study' selected>وصول مطالبات</option>";
							}else{
								echo "<option value='study'>وصول مطالبات</option>";
							}
							if ($box_reciever_name=='borrow') {
								echo "<option value='borrow' selected>وام</option>";
							}else{
								echo "<option value='borrow'>وام</option>";
							}
							if ($box_reciever_name=='orphan') {
								echo "<option value='orphan' selected>ایتام</option>";
							}else{
								echo "<option value='orphan'>ایتام</option>";
							}
							if ($box_reciever_name=='other') {
								echo "<option value='other' selected>اعتبارات</option>";
							}else{
								echo "<option value='other'>اعتبارات</option>";
							} ?>
								
								
							</select>
								
						</td>
					</tr>
					<tr>
						<td class='label_align'>توضیحات: </td>
						<td class='input_align'>
							<input type="text" name='edit_discription' required lang='fa' value="<?php echo $box_reason; ?>"  placeholder="توضیحات">
					<?php 
					if (isset($_GET['type'])=='a') {
						$box_id     	= $_GET['box_id'];
						$type    				= $_GET['type'];
						$currency_id    		= $_GET['cur'];
						$year  					= $_GET['year'];
						$s_n_f  				= $_GET['s_n_f'];
						$s_n_t  				= $_GET['s_n_t'];

					echo "<input type='hidden' name='edit_box_id'   value='$box_id'>";
					echo "<input type='hidden' name='type'   value='$type'>";
					echo "<input type='hidden' name='year'   value='$year'>";
					echo "<input type='hidden' name='cur'   value='$currency_id'>";
					echo "<input type='hidden' name='s_n_f'   value='$s_n_f'>";
					echo "<input type='hidden' name='s_n_t'   value='$s_n_t'>";

					}else{ ?>

							<input type="hidden" name='edit_box_id' required  value="<?php echo $box_id; ?>">
					<?php 	}
					?>
								
						</td>
					</tr>
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
						<input type="submit" class='btn btn-primary' value="تائید" id="just_submit">
						</td>
					</tr>
					
					
					</form>	
				</table>
			</div>
			</div>
			
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	