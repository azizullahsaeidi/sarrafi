<?php

 $title="برگه درخواست مجوز پرداخت"; 
include("../includes/connection.php");
include("../includes/header.php"); 
include("../includes/extra_file/convert_num_to_word.php");
include("alert_messages.php");
$box_id=$_GET['s_n'];
$cur_id=$_GET['cur'];
//var_dump($box_id);die;
$year=jdate("Y");
$box_query=mysql_query("select * from box where box_serial_no=$box_id and box_type='e' and box_date like '$year-%' and box_cur_id=$cur_id",$con);
$reason_box_query=mysql_query("select * from box_reason where r_box_id=$box_id and type='box' and year='$year'",$con);
$row=mysql_fetch_assoc($box_query);extract($row);
$box_serial=0;
$box_9=0;
$box_11=0;
if ($box_serial_no<=9) {
	$box_9='00';
	$box_serial=$box_9.$box_serial_no;
}elseif ($box_serial_no>=10 && $box_serial_no <=99) {
	$box_11='0';
	$box_serial=$box_11.$box_serial_no;
}else{
	$box_serial=$box_serial_no;
}



?>
	<!-- Begining of Content -->
		<div class="content">
			<div class='span11 search_area'>

			<span class="btn btn-primary">شماره برگه پرداخت: <?php echo en2f_number($box_serial);  ?></span>
			<span class="btn btn-primary">واحد پولی: <?php echo get_currency_id('cur_name');  ?></span>
			
		
		<form method="post" action="../controller/box_query.php" style="display:inline" class="pull-left" id="sodor_mojawej_pardakhat">
			<input type="hidden" name="box_serial_no_for_payment" value="<?php echo $box_serial_no;?>">
			<input type="hidden" name="box_id" value="<?php echo $box_id;?>">
			<input type="hidden" name="box_cur_id_for_payment" value="<?php echo get_currency_id('cur_id');?>">
			<input type="submit" class="btn btn-primary pull-left"  style="margin-right:2px;" value="صدور برگه پرداخت وجه نقد">
		</form>
			<span onClick="window.print();" class="btn btn-primary pull-left ">چاپ <l class='icon icon-print icon-white' style='margin-top:3px'></l></span>
			
		</div>
		
			<div class="span10 add_table"  id='payment_request_paper'>
				<?php
					if (mysql_num_rows($box_query)>0) { $i=1;
						//echo "greate";
						$last_total=0;
					
					$alpha_amount=convert_number_to_words($box_amount);
					$de_date=en2f_number($box_date);
					$i_count=en2f_number($i);
					$box_amount=en2f_number(number_format($box_amount));
					$name=explode("/", $box_reciever_name);
				 ?>
				<table class="table_setting" border="" style="width:100%">
					<tr> 
						<th colspan='2' rowspan='3'><?php echo "<img src='../images/committee_logo.jpg' style='height:90px;margin:5px 0px;'>"; ?></th>
					 	<th colspan='4'>بسمه تعالی</th>
					 	<th>شماره:</th>
					 	<th><?php echo en2f_number($box_serial); ?></th>
					</tr>
					<tr> 
						
					 	<th colspan='4'>دفتر نمایندگی کمیته امداد امام خمینی (ره) در افغانستان</th>
					 	<th>تاریخ:</th>
					 	<th><?php echo en2f_number(jdate("Y/m/d"));	 ?></th>
					</tr>
					<tr> 
						
					 	<th colspan='4'>برگ درخواست وجه و مجوز پرداخت</th>
					 	<th colspan='1'>واحد پول</th>
					 	<th colspan='1'><?php echo get_currency_id('cur_name'); ?></th>
					 	
					</tr>
				</table>
				<table class="table_setting" border="1" style="width:100%">
					<tr> 
					 	<th colspan='5' style='text-align:right;width:75%'>رئیس محترم دفتر نمایندگی کمیته امداد امام خمینی (ره) در افغانستان</th>
					 	<th colspan='3' style='text-align:left;padding-left:5px;width:25%'>
					 		<?php
					 		if(!isset($_GET['temp'])){
					 			echo "<a class='my_print' href='box_payment_request_paper_edit.php?cur=$cur_id&box_id=$box_id&s_n=$box_serial_no'>
					 			<span class='btn btn-primary'>ویرایش <l class='icon icon-edit icon-white' style='margin-top:3px'></l></span></a>";
					 		 ?>
					 		 <a class="my_print" href='../controller/box_query.php?box_id=<?php echo $box_id;?>&s_n=<?php echo $box_serial_no;?>&cur=<?php echo $cur_id;?>' onClick="return confirm('آیا حاضر به حذف این مورد هستید؟')">
					 		 	<span class='btn btn-primary admin_icon_trash'>حذف <l class='icon icon-trash icon-white' style='margin-top:2px'></l></span></a>
					 		 <?php } ?>
					 	</th>
					</tr>
					<tr> 
					 	<th colspan='8' style='text-align:right; '>سلام علیکم</th>
					</tr>
					<tr> 
					 	<td colspan='8' style='text-align:right;padding-right:10px;'>احتراماً خواهشمند است دستور فرمایند مبلغ به عدد: <?php echo $box_amount;  ?>« <?php echo get_currency_id('cur_name'); ?> »</td>
					 	
					</tr>
					<tr> 
					 	<td colspan='8' style='text-align:right;padding-right:10px;width:10%'><b style='margin-left:30px;'>به حروف:</b> 
					 		<?php echo $alpha_amount; ?><b style="margin-right:10px;">«</b> <?php echo get_currency_id('cur_name'); ?> <b style="margin-left:30px;">»</b>  را از محل اعتبار تنخواه <b style="margin:0px 30px;">در وجه</b> « <?php  echo $name[0]; ?> »</td>

					 	
					</tr>
					<tr> 
					 	<td colspan='3' style='text-align:right;padding-right:10px;'>
					 		<b style="margin-left:30px;">بابت:</b> <b>« </b> <?php echo $box_reason; ?><b style="margin-left:50px;"> »</b>به شرح ذیل پرداخت نمایند.</td>
					 	
					 	<td colspan='5' style='text-align:right;padding-right:10px;'></td>
					 	
					 	
					</tr>

					
					<?php } ?>
				</table>
				
			
				<table class="table_setting" border="1" id="payment_request_paper_details" style="width:100%;">
				
					<tr>
						<th>ردیف</th>
						<th>شرح اعتبار - هزینه</th>
						<th>مبلغ</th>
						<th>ملاحظات</th>
						<th class="my_print">ویرایش</th>
						<th class="my_print">حذف</th>
						
						
					</tr>
					<?php if (mysql_num_rows($box_query)>0) { $i=1;
						$count=mysql_num_rows($reason_box_query);
						$extract_row=7-$count;
						$strar_r=7-$extract_row;
						$total_count=0;
						while ($reason_row=mysql_fetch_assoc($reason_box_query)) {
							extract($reason_row);
							$last_total=0;
							$i_count=en2f_number($i);
							$amount=en2f_number(number_format($r_amount));
							
					echo 	"<tr  id='$r_id'>";
								echo "<td> $i_count 		</td>";
								echo "<td> $r_details 	</td>";
								echo "<td> $amount 	</td>";
								$i++; echo "<td> $comment </td>";
								$total_count+=$r_amount;
								echo "<td class='my_print' > <a href='box_payment_request_paper_reason_edit.php?cur=$cur_id&reason_id=$r_id&s_n=$r_box_id'><span class='icon icon-edit'></span></a> </td>";?>
								<td class="my_print payment_reason" id="<?php echo $r_id; ?>"  > <span class='icon icon-trash admin_icon_trash'></span></td>
							</tr>
					
					<?php }
					$total_c=en2f_number(number_format($total_count));
					for ($i=$strar_r+1; $i <=7 ; $i++) { 
						echo "<tr>";
						$r_i=en2f_number($i);
						echo "<td>$r_i</td>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td class='my_print'></td>";
						echo "<td class='my_print'></td>";
						echo "</tr>";
					}
					?>
					<tr> 
						<th colspan='2'>جمع کل</th>
						<th colspan='1'><?php echo $total_c; ?></th>
						<th colspan='3' style='background-color:grey;'></th>
					</tr>
				<?PHP }else{?>
						<tr> <th colspan='11'>فعلن هیچ دیتا در سیستم موجود نیست.</th></tr>
					<?php } ?>
				</table>
				<table class="table_setting" border="1" style="width:100%">
					
					<tr style='height:50px;'> 
					 	<th colspan='4' style='text-align:right;padding-right:30px;'>واحد درخواست کننده: </th>
					 
					 	<th colspan='4' style='text-align:left;padding-left:5px;'>نام و نام خانوادگی: ............................  امضاء </th>
					</tr>
				</table>
				<table class="table_setting" border="1" style="width:100%">
					<tr> 
						
					 	<th colspan='4' style='text-align:right;'>کارشناس مسؤل محترم اداری و مالی دفتر نمایندگی:</th>
					 	<th colspan='4'></th>
					 	
					</tr>
					<tr > 
					 	<td colspan='8' style='text-align:right;'>لطفاً  رسیدگی های لازم را بعمل آورده و طبق قوانین و مقرارت مربوطه در صورت تامین اعتبار از محل ریز برنامه فوق پرداخت گردد.: </td>
					 
					</tr>
					<tr style='height:50px;'> 
					 	<td colspan='4' style='text-align:right;'></td>
					 	<th colspan='4' style='text-align:left;padding-left:5px;'>رئیس دفتر نمایندگی: ............................  امضاء</th>
					 	
					 
					</tr>
				</table>
				<table class="table_setting" border="1" style="width:100%">
					<tr> 
						
					 	<th colspan='5' style='text-align:right;'>صندوقدار محترم:</th>
					 	<th colspan='3'></th>
					 	
					</tr>
					<tr > 
					 	<td colspan='8' style='text-align:right;'>لطفاً با رسیدگی های  بعمل آمده نسبت به پرداخت مبلغ :
					 	 <?php echo $box_amount;?> « <?php echo  get_currency_id('cur_name');?> » به شرح جدول فوق با صدور چک از </td>
					 
					</tr>
					<tr > 
					 	<td colspan='8' style='text-align:right;'>از جاری ......................... بانک  ......................... شعبه
					 	  ......................... و یا
					 	 پرداخت نقدی اقدام نمایید.</td>
					 
					</tr>
					<tr style='height:50px;'> 
					 	<td colspan='5' style='text-align:right;'></td>
					 	<th colspan='3' style='text-align:left;padding-left:5px;'>کارشناس مسؤل اداری و مالی: ............................ امضاء</th>
					 	
					 
					</tr>
				</table>
				<table class="table_setting" border="1" style="width:100%">
					<tr> 
						
					 	<td colspan='8' style='text-align:right;'>احتراماً مبلغ <?php echo $box_amount; ?> « <?php echo get_currency_id('cur_name');
					 	 ?> » طی برگ پرداخت شماره « <?php echo en2f_number($box_serial);  ?> » مورخه <?php echo en2f_number(jdate("Y/m/d")); ?> </td>
					 	
					 	
					</tr>
					<tr> 
					 	<td colspan='8' style='text-align:right;'>به صورت نقد ,
					 	 طی چک  شماره .................. از بانک ............. شعبه 
					 	 ............... جاری .............. در </td>
					</tr>
					<tr> 
					 	<td colspan='8' style='text-align:right;'> وجه « <?php echo $name[1];?> » پرداخت گردید.</td>
					</tr>
					
					<tr style='height:50px;'> 
					 	<th colspan='4' >تحویل گیرنده وجه: .............................امضاء </th>
					 	
					 	<th colspan='4' style=''>صندوقدار:................................ امضاء</th>
					 
					</tr>
				</table>
			</div>
			</div>

			
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	