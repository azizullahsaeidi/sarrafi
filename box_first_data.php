<?php
 $title="برگه رسید وجه"; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
 include("../includes/extra_file/convert_num_to_word.php");
include("alert_messages.php");
$query=mysql_query("select * from province order by pro_id ",$con);
$cur_id=$_GET['cur'];
$f_t_query=mysql_query("select box_id,box_amount,box_reason from box where box_reciever_name ='f_t_insert' and box_cur_id=$cur_id",$con);
$year=jdate("Y");


?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php full_alert_message(); ?>
		</div>
			<div class="span6 add_table" style="">
				<table class="table_setting">
				<form action="../controller/box_query.php" method="post" id="bank_and_box">
					<tr> <th colspan='2' id=""><h3 style="margin-right: 60px;">اول دوره</h3></th></tr>
					
					<tr>
						<td class="label_align">مبلغ:</td>
						<td class="input_align">
							<input type="number" id="anbar_unit_price" lang='fa' class="number_amount_ajax" min="1" name="first_arrive_number_amount" placeholder="مبلغ" required="">
							
							<input type="text" name="currency_name" id="rased_currency_name" value="<?php echo get_currency_id('cur_name'); ?>"  disabled >
							<input type="hidden" name="currency_id"  value="<?php echo get_currency_id('cur_id'); ?>"  >
						</td>
					</tr>
					<tr>
						<td class='label_align'>مبلغ به حروف: </td>
						<td class='input_align'>
							<textarea name='first_alpha_amount' required placeholder='مبلغ به حروف' id="alpha_number_ajax" style="width:248px;margin-bottom:0px;" readonly>
							</textarea>
							
						</td>
					</tr>
					
					
					
					<tr>
						<td class='label_align'>توضیحات: </td>
						<td class='input_align'>
							<input type="text" name='first_discription' required lang='fa'  placeholder="توضیحات">
								
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
			<div class="span4 show_table">
				<table class="table_setting" border="1">
				
					<tr> <th colspan='3'>لیست اول دوره</th></tr>
					<tr>
						<th>مقدار</th>
						<th>شرح</th>
						
						<th>ویرایش</th>

					</tr>

					<?php
					if(mysql_num_rows($f_t_query)>0){
					 while($row=mysql_fetch_assoc($f_t_query)){ 
					
					extract($row);
					echo "<tr>";
						
						echo "<td >";
						echo en2f_number(number_format($box_amount))."</td>";
						echo "<td > $box_reason </td>";
						?>
						<td> <a href="box_first_data_edit.php?first_time_box_id=<?php echo $box_id;?>&cur=<?php get_currency_id('cur_id');  ?>"><span class='icon icon-edit '></span></a></td>
						</tr>
					<?php }}else{
						echo "<tr><th colspan='3'>مقدار اولیه موجود نیست.</th></tr>";
						}?>
					
				
				</table>

		</div>
		</div>
			
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	