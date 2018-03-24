<?php $title="جستجو "; ?>
<?php include("../includes/connection.php"); ?>
<?php 
include("../includes/header.php"); 
include("alert_messages.php");
$current_year=date("Y");
if (isset($_GET['serial_num'])) {
$serial_no=$_GET['serial_num'];
}else
{
	$serial_no=0;
}
?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 search_area'>
		
			
		</div>
		<div class="span11 messages">
				<div class="span10 add_table" style="width:815px;">
				<table class="table_setting" >
				<form action="../controller/bank_query.php" method="post" id="bank_and_box">
					<tr> <th colspan='2' style="padding-left:80px;"><h3>جستجو بر اساس شماره رسید/برگ پرداخت</h3></th></tr>
					<tr>
						<td class='label_align'>واحد پولی:</td>
						<td class='input_align' style="direction:ltr">
							
							<input type="text" id="x-small-code" min="0" max='99' name="cur_name"  style="text-align:center" value="<?php echo get_currency_id('cur_name'); ?>" readonly required>
							<input type="hidden" id="x-small-code" min="0" max='99' name="bank_search_cur_id"  style="text-align:center" value="<?php echo get_currency_id('cur_id'); ?>" readonly required>
							<input type="hidden"  name="anbar_search"  style="text-align:center" value="search">
						</td>
					</tr>
					<tr>
						<td class='label_align'> انتخاب سال :</td>
						<td class='input_align'>
							
					<select id="bank_acount_number" class="search_anbar" name="bank_search_year">
						<option value='none'>انتخاب سال</option>
						<?php for($i=1395;$i<1421;$i++){
						 	$cur_year=jdate("Y");
							$year=en2f_number($i);
							if($i==$cur_year){
							echo "<option value='$i' selected>$year</option>";
							continue;
							}else{
							echo "<option value='$i' >$year</option>";
							}
						 } ?>
					
					</select>
							
						</td>
					</tr>
					<tr>
						<td class='label_align'> انتخاب رسید / برگ پرداخت :</td>
						<td class='input_align'>
							<select id="bank_acount_number" class="search_anbar" name="bank_search_type">
								<option value="none"> انتخاب رسید / برگ پرداخت </option>
								<option value='cash'>رسید وجه - نقد</option>
								<option value='check'>رسید وجه - بهادار</option>
								<option value='extract'>صدور چک</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class='label_align'>شماره رسید/برگ پرداخت از:</td>
						<td class='input_align' >
							
							<input type="number" id="" min="1" max='999' name="bank_search_serial_no_from"  style="text-align:center;width:107px;" required>
							<span style="margin: 0px 5px;">الی:</span><input type="number" id="" min="1" max='999' name="bank_search_serial_no_to"  style="text-align:center;width:107px;" required>
						</td>
					</tr>
					
					
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
							
						<input type="submit" class='btn btn-primary' value="جستجو" style="width:246px;">
						
						</td>
					</tr>
					
					
					</form>	
				</table>
			</div>
		</div>
		</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	