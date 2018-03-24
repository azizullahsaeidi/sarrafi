<?php

 $title="برگه صدور چک"; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
 include("../includes/extra_file/convert_num_to_word.php");
include("alert_messages.php");
$b_id=$_GET['bank_id'];
$s_n=$_GET['s_n'];
$cur=$_GET['cur'];
if($b_id >=1){
$query=mysql_query("SELECT * from bank,bank_account where ban_id=$b_id and bank_type='bank_e'
 and bank_cur_id=$cur and bank_account_number=account_number",$con);
if(mysql_num_rows($query)>0){
$row=mysql_fetch_assoc($query);extract($row);
$name=explode("/", $bank_reciever_name);
$number= en2f_number(number_format($bank_amount));
$box_serial=0;
$box_9=0;
$box_11=0;
if ($s_n<=9) {
	$box_9='00';
	$box_serial=$box_9.$s_n;
	$box_serial= en2f_number($box_serial);
}elseif ($s_n>=10 && $s_n <=99) {
	$box_11='0';
	$box_serial=$box_11.$s_n;
	$box_serial= en2f_number($box_serial);
}else{
	$box_serial=$s_n;
	$box_serial= en2f_number($box_serial);

}
?>
	<!-- Begining of Content -->
		<div class="content" >
			<div class="span11 messages my_print">
			<span onClick="window.print();" class="btn btn-primary pull-left" style="padding:6px 14px;">چاپ <l class="icon icon-print icon-white" style="margin-top:3px;"></l></span>
		<?php $real_year=explode("-", $bank_date);
		//echo jdate("Y"); 
		if($real_year[0]==jdate("Y")){
		if (!isset($_GET['no_edit'])) {
			# code...
		
		echo "<a href='bank_check_paper_edit.php?cur=$cur&s_n=$bank_serial_no&bank_id=$ban_id&type=final_edit'"; ?>
			<span class="btn btn-primary pull-left" style="padding:6px 14px; margin-left:5px;">ویرایش <l class="icon icon-edit icon-white" style="margin-top:3px;"></l></span>
		</a>
		<?php }
		} if(isset($_GET['no_edit'])){ ?>
			<span onClick="window.close();" class="btn btn-primary pull-right" style="padding:6px 14px;">بسته <l class="icon icon-remove icon-white" style="margin-top:3px;"></l></span>
		<?php 	} ?>
		</div>

			<div class="span10 add_table"  id='payment_paper'>
				<table class="table_setting"  style="width:100%">
					
					<tr> 
					 	<th colspan='1' rowspan="2" style="width: 25%;text-align: right">
					 		
					 		<img src='../images/committee_logo.png' style='width:70px;padding:2px;'>
					 	</th>
					 	<th colspan='6'><h4 style='height:35px;margin:5px;font-size: 22px'>دفتر نمایندگی کمیته امداد امام خمینی (ره) در افغانستان</h4></th>
					 	<th colspan='1'></th>
					</tr>
					<tr> 
						
					 	<th colspan='6'>برگ صدور چک</th>
					 	<th colspan='1'></th>
					 	
					 	
					</tr>
					

					<tr> 
					 	<th colspan='2' style="text-align:right;padding-right:10px;width:30%"></td>
						
					 	<th colspan='4' style="width:40%"></th>
					 	<td colspan='2' style="padding-left:10px;width:30%;border:1px solid #000;"><b>سند حسابداری</b></th>
					 	
					</tr>
					<tr> 
					 	<th colspan='2' style="text-align:right;padding-right:10px;width:30%">عنوان شاخه: <?php echo $province_row['pro_name'];	 ?></td>
						
					 	<th colspan='4' style="width:40%">شماره: <?php echo $box_serial; ?></th>
					 	<td colspan='2' style="text-align:right;padding-right:20px;width:30%;border:1px solid #000;"><b>شماره:</b><span style='font-size:10px;'>................................................</span> </th>
					 	
					</tr>
					<tr> 
					 	<th colspan='2'>	 </th>
						
					 	<th colspan='4' >تاریخ: <?php echo en2f_number(jdate("Y/m/d")); ?></th>
					 	<td colspan='2' style="text-align:right;padding-right:20px;border:1px solid #000;"><b>تاریخ:</b> <span style='font-size:10px;'>................................................</span></td>
					 	
					</tr>
				</table>
				<table class="table_setting" border="1" style="width:100%">
					<tr> 
					 	<td colspan='3' style='width:35%;text-align:right'><b>مبلغ به عدد: </b> <?php echo $number; ?> « <?php echo get_currency_id('cur_name'); ?> »</td>
					 	
					 	<td colspan='5' style='width:75%;text-align:right'> <b>به حروف: </b> <?php echo convert_number_to_words($bank_amount); ?></td>
					</tr>
					<tr> 
					 	<td colspan='3' style='width:35%;text-align:right'><b>در وجه: </b> <?php echo $name[0];; ?></td>
					 	
					 	<td colspan='5' style='width:75%;text-align:right'> <b>بابت: </b> <?php echo $bank_reason; ?></td>
					</tr>
					<tr> 
					 	<td colspan='8' style='width:100%;text-align:right;padding-right:30px;'><input type='checkbox' > وجه نقد</td>
					 	
					</tr>
					<tr> 
					 	
					 	<td colspan='8' style='width:20%;text-align:right;padding-right:30px;'>
					 		<input type='checkbox' checked> چک <b style='margin-right:15px;'>
					 		شماره:</b><b style='margin-right:3px;'>
					 		 « </b><?php echo $bank_check_number; ?>
					 		 <b style='margin-left:20px;'> » </b>
					 		<b>بانک:</b>  
					 		 <b style='margin-right:5px;'>« </b>
					 		 
					 		 <?php echo $bank_name; ?>
					 		 <b style='margin-left:20px;'> » </b>
					 		   
					 		  <b>شعبه:</b>
					 	  <b style='margin-right:5px;'> « </b>
					 	  <?php echo $bank_branch; ?> 
					 	  <b style='margin-left:20px;'> » </b>
					 	  <b>جاری:</b> 
					 	  <b style='margin-right:5px;'> « </b>
					 	  <?php echo $bank_account_number; ?>
					 	  <b style='margin-left:20px;'> » </b>

					 	</td>
					</tr>
					
				
					<tr> 
					 	<td colspan='3' style='width:50%;text-align:right;padding-right:20px;'><b>تهیه کننده: </b> </td>
					 	
					 	<td colspan='5' style='width:50%;text-align:right'> <b>تصویب کننده: </b> </td>
					</tr>
					
					
				</table>
				<table class="table_setting"  style="width:100%">
					<tr style="height:40px;"> 
					 	<td colspan='8' style='width:100%;text-align:right;padding-right:30px;'><b>دریافت مبلغ: </b> <?php echo $number; ?> « <?php echo get_currency_id('cur_name'); ?> » به شرح فوق تائید می گردد.</td>
					</tr>
					<tr style="height:40px;"> 
					 	<td colspan='3' style='width:40%;text-align:right;padding-right:30px;'><b>نام تحویل گیرنده وجه: </b> <?php echo $name[1];; ?></td>
					 	
					 	<td colspan='3' style='width:30%;text-align:right'> <b>امضاء: </b> </td>
					 	<td colspan='2' style='width:30%;text-align:right'> <b>تاریخ: </b> <?php echo en2f_number(jdate("Y/m/d")); ?></td>
					</tr>
				</table>
				<?php if (!isset($_GET['no_edit'])) { ?>				
				
				<table class="table_setting">
					<form action="../controller/bank_query.php" method="post" id="payment_paper">
						<tr>
							<td class='label_align'> </td>
							<td class='submit_reset my_print' style='text-align:left;'>
								<input type="hidden" class='text-center' name="bank_serial_number" readonly value="<?php echo $s_n; ?>"  >
								<input type="hidden" name="currency_id"  value="<?php echo get_currency_id('cur_id'); ?>"  >
								<input type="hidden" name="bank_id_check_order"  value="<?php echo $ban_id; ?>"  >
							<input type="submit" class='btn btn-primary' id="just_submit" value="تائید">
							</td>
						</tr>
					</form>	
				</table>
				<?php } ?>
			</div>
			</div>
			
		<!-- End of Content -->
<?php }} include_once("../includes/footer.php"); ?>	