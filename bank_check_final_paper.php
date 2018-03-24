<?php

 $title="بهادار"; ?>
<?php include("../includes/connection.php"); ?>
<div id="giver_person_div" style="width: 100%; height: 100%;position: fixed; background-color: #000; opacity: 0.9;z-index: 30;display: none">
		
		<div style="margin: 200px auto;margin-right: 400px;">
			<table>
				<tr>
					<th style="color:#fff">نام گیرنده:</th>
					<th>
						<input type="text" name='giver_person' required id='giver_p' style="margin-bottom: 0px;height: 26px">
						<input type="hidden" name='giver_serial' id='giver_p_serial' value="<?php echo $_GET['s_n']; ?>" style="margin-bottom: 0px;height: 26px">
						<input type="hidden" name='giver_type' id='giver_p_type' value="check_r" style="margin-bottom: 0px;height: 26px">
					</th>
					<th><input type="button" value="تائید" id="confirm_giver_name"></th>
				</tr>
			</table>
		</div>
	</div>
<?php include("../includes/header.php"); 
 include("../includes/extra_file/convert_num_to_word.php");
include("alert_messages.php");
//$box_id=$_GET['box_id'];
$s_n=$_GET['s_n'];
$cur=$_GET['cur']; 
if(isset($_GET['year'])) {
$year=$_GET['year'];
}else{
	$year=jdate("Y");
}
$query=mysql_query("select * from bank_check where check_serial_no=$s_n and check_cur_id=$cur and check_date like '$year-%'",$con);
$giver_query=mysql_query("select g_person from giver_person where g_serial=$s_n and  g_type='check_r' and g_year = $year",$con);
if(mysql_num_rows($query)>0){
$row=mysql_fetch_assoc($query);extract($row);
//$name=explode("/", $box_reciever_name);
$number= en2f_number(number_format($check_amount));
$box_serial=0;
$check_exp_date=en2f_number($check_exp_date);
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
		<?php $real_year=explode("-", $check_date);
		//echo jdate("Y"); 
		if($real_year[0]==jdate("Y")){
			if (!isset($_GET['no_edit'])) { ?>
		<a href="bank_check_edit.php?cur=<?php echo $cur;?>&check_id=<?php echo $check_id;?>" >
			<span class="btn btn-primary pull-left" style="padding:6px 14px; margin-left:5px;">ویرایش <l class="icon icon-edit icon-white" style="margin-top:3px;"></l></span>
		</a>
		<a href="../controller/bank_check_query.php?cur=<?php echo $cur;?>&s_n=<?php echo $s_n;?>&check_id_for_delete=<?php echo $check_id;?>" onClick="return confirm('آیا حاضر به حذف این برگ هستید؟')">
			<span class="btn btn-primary pull-left" style="padding:6px 14px; margin-left:5px;">حذف <l class="icon icon-trash icon-white" style="margin-top:3px;"></l></span>
		</a>
		<?php }} if(isset($_GET['no_edit'])){ ?>
			<span onClick="window.close();" class="btn btn-primary pull-right" style="padding:6px 14px;">بسته <l class="icon icon-remove icon-white" style="margin-top:3px;"></l></span>
		<?php 	} ?>
		</div>

			<div class="span10 add_table"  id='payment_paper'>
				<table class="table_setting"   style="width:100%">
					
					<tr> 
					 	<th colspan='1' rowspan="2" style="width: 25%;text-align: right">
					 		
					 		<img src='../images/committee_logo.png' style='width:70px;padding:2px;'>
					 	</th>
					 	<th colspan='6'><h4 style='height:35px;margin:5px;font-size: 22px'>دفتر نمایندگی کمیته امداد امام خمینی (ره) در افغانستان</h4></th>
					 	<th colspan='1'></th>
					</tr>
					<tr> 
						
					 	<th colspan='6'><b>برگ رسید وجه </b></th>
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
					 	<td colspan='2' style="text-align: right;padding-right: 10px;">
					 	<b>نام پرداخت کننده:</b>	
					 	<?php if(mysql_num_rows($giver_query)>0){
					 		$row=mysql_fetch_assoc($giver_query);
					 		echo "<span>";
					 		echo $row['g_person'];
					 		echo "</span>";
					 	}else{ ?>
					 	<span class="icon icon-edit" style="margin-top: 3px" id="giver_person_edit"></span>
					 	<span id='p_m'></span> 
					 	<?php } ?>
					 	</td>
						
					 	<th colspan='4' >تاریخ: <?php echo en2f_number(jdate("Y/m/d")); ?></th>
					 	<td colspan='2' style="text-align:right;padding-right:20px;border:1px solid #000;"><b>تاریخ:</b> <span style='font-size:10px;'>................................................</span></td>
					 	
					</tr>
				</table>
				
				<table class="table_setting" border="1" style="width:100%">
					<tr> 
					 	<td colspan='3' style='width:35%;text-align:right;padding-right:3px;'>
					 		<input type="checkbox"    style='margin-left:3px;'>
					 		<b style="margin-left:20px;">نقدی</b><b>مبلغ به عدد: </b> <?php echo $number; ?> « <?php echo get_currency_id('cur_name'); ?> »</td>
					 	
					 	<td colspan='5' style='width:75%;text-align:right'> <b>به حروف: </b> <?php echo convert_number_to_words($check_amount); ?>« <?php echo get_currency_id('cur_name'); ?> »</td>
					</tr>
					<tr> 
					 	<td colspan='2' style='width:25%;text-align:right;padding-right:3px;'><input type='checkbox'   > <b>واریز به حساب بانک: </b> <?php //echo $name[0];; ?></td>
					 	<td colspan='2' style='width:25%;text-align:right'><b>شماره حساب: </b> <?php //echo $name[0];; ?></td>
					 	<td colspan='2' style='width:25%;text-align:right'><b>طی رسید شماره: </b> <?php //echo $name[0];; ?></td>
					 	<td colspan='2' style='width:25%;text-align:right'><b>مورخ: </b> <?php //echo $name[0];; ?></td>
					</tr>
				</table>
				<table class="table_setting" border='1' id='payment_request_paper_details'  style="width:100%">
					<tr> 
					 	<td colspan='8'><b><input type='checkbox'  checked> اسناد بهادار</b></td>
					 	
					</tr>
					<tr> 
					 	<th colspan='1' style="width:5%;">ردیف</th>
					 	<th colspan='1' style="width:13%;">نوع سند</th>
					 	<th colspan='1' style="width:13%;">شماره سند</th>
					 	<th colspan='1' style="width:13%;">سر رسید</th>
					 	<th colspan='1' style="width:20%;">نام بانک</th>
					 	<th colspan='2'>مبلغ</th>
					 	<th colspan='1' style="width:13%;">واحد پول</th>
					</tr>
					<tr> 
					 	<td colspan='1'><?php echo en2f_number(1); ?></td>
					 	<td colspan='1'> <?php echo $check_doc_type; ?> </td>
					 	<td colspan='1'> <?php echo $check_doc_no; ?> </td>
					 	<td colspan='1'> <?php echo $check_exp_date; ?> </td>
					 	<td colspan='1'> <?php echo $check_bank_name; ?> </td>
					 	<td colspan='2'> <?php echo $number; ?> </td>
					 	<td colspan='1'> <?php echo get_currency_id('cur_name'); ?> </td>
					</tr>
					<tr> 
					 	<td colspan='1'><?php echo en2f_number(2); ?></td>
					 	<td colspan='1'> </td>
					 	<td colspan='1'> </td>
					 	<td colspan='1'> </td>
					 	<td colspan='1'> </td>
					 	<td colspan='2'></td>
					 	<td colspan='1'> </td>
					</tr>
					
				</table>
				<table class="table_setting"  style="width:100%">
					<tr style="height:40px;"> 
					 	<td colspan='8' style='width:100%;text-align:right;padding-right:30px;'><b>مورد دریافت: </b> 

					 		کمک مردمی: 
					 		<?php if ($check_reason=='help_people') {
					 			echo "<input type='checkbox' checked style='margin-left:20px;'  >";
					 		}else{
					 			echo "<input type='checkbox' style='margin-left:20px;'  >";
					 		}?>
					 		وجوهات امانی:
					 		<?php if ($check_reason=='wojohat') {
					 			echo "<input type='checkbox' checked style='margin-left:20px;'  >";
					 		}else{
					 			echo "<input type='checkbox' style='margin-left:20px;'  >";
					 		}?> 
					 		فروش:
					 		<?php if ($check_reason=='sale') {
					 			echo "<input type='checkbox' checked style='margin-left:20px;'  >";
					 		}else{
					 			echo "<input type='checkbox' style='margin-left:20px;'  >";
					 		}?> 
					 		وصول مطالعات:
					 		<?php if ($check_reason=='study') {
					 			echo "<input type='checkbox' checked style='margin-left:20px;'  >";
					 		}else{
					 			echo "<input type='checkbox' style='margin-left:20px;'  >";
					 		}?> 
					 		وام:
					 		<?php if ($check_reason=='borrow') {
					 			echo "<input type='checkbox' checked style='margin-left:20px;'  >";
					 		}else{
					 			echo "<input type='checkbox' style='margin-left:20px;'  >";
					 		}?> 
					 		ایتام:
					 		<?php if ($check_reason=='orphan') {
					 			echo "<input type='checkbox' checked style='margin-left:20px;'  >";
					 		}else{
					 			echo "<input type='checkbox' style='margin-left:20px;'  >";
					 		}?> 
					 		اعتبارات:
					 		<?php if ($check_reason=='other') {
					 			echo "<input type='checkbox' checked style='margin-left:20px;'  >";
					 		}else{
					 			echo "<input type='checkbox' style='margin-left:20px;'  >";
					 		}?>
					 	</td>
					</tr>
					<tr> 
					 	<td colspan='8' style='width:75%;text-align:right;padding-right:30px;'> <b>توضیحات: </b> <?php echo $check_desc; ?></td>
					</tr>
					<tr style="height:40px;"> 
					 	<td colspan='5' style='width:60%;text-align:right;padding-right:30px;'><b>تهیه کننده: </b> <?php //echo $name[1];; ?></td>
					 	
					 	<td colspan='3' style='width:40%;text-align:right'> <b>تصویب کننده: </b> </td>
					</tr>
				</table>
				<?php if (!isset($_GET['no_edit'])) { ?>
				<table class="table_setting">
				<form action="../controller/bank_check_query.php" method="post" id="payment_paper">
					
					
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset my_print' style='text-align:left;'>
							<input type="hidden" class='text-center' name="arrive_serial" readonly value="<?php echo $s_n; ?>"  >
							<input type="hidden" name="bank_check_currency_id"  value="<?php echo get_currency_id('cur_id'); ?>"  >
							<input type="hidden" name="box_arrive_id_payment"  value="<?php echo $check_id; ?>"  >
						<input type="submit" class='btn btn-primary' id="just_submit" value="تائید">
						</td>
					</tr>
					
					
					</form>	
				</table>
				<?php } ?>
			</div>
			</div>
			
		<!-- End of Content -->
<?php } include_once("../includes/footer.php"); ?>	