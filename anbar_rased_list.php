<?php $title="برگه رسید انبار"; ?>
<?php include("../includes/connection.php"); ?>
<?php 
include("../includes/header.php"); 
include("alert_messages.php");
if (isset($_GET['serial_num'])) {
$serial_no=$_GET['serial_num'];
}else
{
	$serial_no=0;
}
$serial_no=$_GET['serial_num'];
$box_serial=0;
$box_9=0;
$cost_total=0;
$cur=$_GET['cur'];
$box_11=0;
if ($serial_no<=9) {
	$box_9='00';
	$box_serial=$box_9.$serial_no;
	$box_serial= en2f_number($box_serial);
}elseif ($serial_no>=10 && $serial_no <=99) {
	$box_11='0';
	$box_serial=$box_11.$serial_no;
	$box_serial= en2f_number($box_serial);
}else{
	$box_serial=$serial_no;
	$box_serial= en2f_number($box_serial);
}
$an_type=$_GET['type'];
$year=jdate("Y");

if (isset($_GET['year'])) {
	$y=$_GET['year'];
}
if (isset($_GET['anbar_search'])) {
	$y=$_GET['year'];
	$serial_num=$_GET['serial_num'];
	
	$query=mysql_query(
		"SELECT
			anbar_name,de_date,i_name,item_name,i_code,de_id,de_serial_no,de_quantity,unit_price,de_total_price,cur_name 
		from 
			anbar,item,item_details,currency,item_type
		where de_serial_no=$serial_no 
			and currency=cur_id 
			and denomination=item_id 
			and total_code=i_code 
			and i_id=item_f_id 
			and anbar.anbar_code=item.anbar_code 
			and de_reg_type='$an_type' 
			and currency=$cur 
			and de_date like '$y-%' " ,$con);
	$take_date=mysql_query("SELECT de_date from item_details where de_serial_no=$serial_no and de_reg_type='$an_type' and de_date like '$y-%' limit 1",$con);
}else{
	if (isset($_GET['status'])) {
		$y=jdate("Y");
		$query=mysql_query("SELECT anbar_name,de_date,i_name,item_name,i_code,de_id,de_serial_no,
			de_quantity,unit_price,de_total_price,cur_name from 
		anbar,item,item_details,currency,item_type where de_serial_no=$serial_no and currency=cur_id and 
		denomination=item_id and total_code=i_code and i_id=item_f_id  and anbar.anbar_code=item.anbar_code and de_reg_type='$an_type'  and de_date like '$y-%'" ,$con);
		$take_date=mysql_query("SELECT de_date from item_details where de_serial_no=$serial_no  and de_reg_type='$an_type' and de_date like '$y-%' ",$con);
		//var_dump($query);die;
	}else{
		//$year=jdate("Y");
		$query=mysql_query("SELECT anbar_name,de_date,i_name,item_name,i_code,de_id,de_serial_no,de_quantity,unit_price,de_total_price,cur_name from 
		anbar,item,item_details,currency,item_type where de_serial_no=$serial_no and currency=cur_id and 
		denomination=item_id and total_code=i_code and de_date like '$year%' AND i_id = item_f_id and i_id=item_f_id  and anbar.anbar_code=item.anbar_code and de_status='perm' and currency=$cur  and de_reg_type='$an_type'",$con);
		$take_date=mysql_query("SELECT de_date from item_details where de_serial_no=$serial_no and de_reg_type='$an_type' and de_date like '$year-%' ",$con);
	}
}
?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages my_print'>
		<?php alert_messages();?>
		<?php if (!isset($_GET['anbar_search'])) { ?>
		<a href="anbar_rased.php?type=<?php echo $_GET['type']; ?>&num=1&cur=<?php echo $_GET['cur']; ?>" onClick="return confirm('شما مطمئین هستید؟');">
			<span class="btn btn-primary pull-left" style="margin-top:5px;">
				بیل جدید<l class="icon-plus icon-white" style="margin-top: 3px;"></l>
			</span>
		</a>
		<?php } ?>
		<?php if (isset($_GET['anbar_search'])) { ?>
		<a href="anbar_search_option.php?cur=<?php echo $_GET['cur']; ?>">
			<span class="btn btn-primary" style="margin-top:5px;">
				<l class="icon-arrow-right icon-white" style="margin-top: 3px;margin-left:5px;"></l>برگشت
			</span>
		</a>
		<?php } if(isset($_GET['no_edit'])){ ?>
			<span onClick="window.close();" class="btn btn-primary pull-right" style="padding:6px 14px;">بسته <l class="icon icon-remove icon-white" style="margin-top:3px;"></l></span>
		<?php 	} ?>


			<span class="btn btn-primary pull-left" onClick="window.print();" id="action_btn" style="margin-top:5px;margin-left:3px;">
			 	چاپ بیل <l class="icon-print icon-white" style="margin-top: 3px;"></l>
			</span>
			<?php if (!isset($_GET['anbar_search']) && !isset($_GET['no_edit'])) { ?>
			<?php if (!isset($_GET['status'])) { ?>
			<form action="../controller/anbar_query.php" method="post">
				<input type='hidden' value="<?php echo $_GET['serial_num']; ?>" name="approve_bill">
				<input type='hidden' value="<?php echo $_GET['type']; ?>" name="reg_type">
				<input type='hidden' value="<?php echo $_GET['cur']; ?>" name="cur_id">
				<input type="submit" class="btn btn-primary pull-left" value="تائید بیل" id="action_btn" style="margin-top:5px;margin-left:3px;">
			</form>
			<?php } ?>
			<?php } ?>
		</div>
			<div  class="span11 messages payment_papers_margin_top" id='payment_papers'>
				<table class="table_setting"  style="width:100%;">
				
					<tr> 
					 	<th colspan='1' rowspan="2" style="width: 25%;text-align: right">
					 		
					 		<img src='../images/committee_logo.png' style='width:70px;padding:2px;'>
					 	</th>
					 	<th colspan='6'><h3 style='height:35px;margin:5px;'>دفتر نمایندگی کمیته امداد امام خمینی (ره) در افغانستان</h3></th>
					 	<th colspan='1'></th>
					</tr>
					<tr> 
						
					 	<th colspan='6'><h4 style=';margin:0px;'>
					 		<?php if ($_GET['type']=='h') {
					 			echo "برگ حواله انبار";
					 		}elseif ($_GET['type']=='r') {
					 			echo "برگ رسید انبار";
					 		}
					 		?>

					 	</h4>
					 	<th colspan='1'></th>
					 	</th>
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
					 	<th colspan='2' style="text-align: right;padding-right: 10px;">	 </th>
						<?php 
						$date='';
						if ($take_date) {
						$get_date = mysql_fetch_assoc($take_date);
						$date2 = $get_date['de_date'];
						$date1=explode('-', $date2);
						$date=$date1[0].'/'.$date1[1].'/'.$date1[2];
						}else{
							$date=jdate("Y/m/d");
						}

						?>
					 	<th colspan='4' >تاریخ: <?php echo en2f_number($date); ?></th>
					 	<td colspan='2' style="text-align:right;padding-right:20px;border:1px solid #000;"><b>تاریخ:</b> <span style='font-size:10px;'>................................................</span></td>
					 	
					</tr>
				</table>
				<table class="table_setting bold_tables_border" border="1">
				<thead>
					<tr>
						<th>ردیف</th>
						<th>کد کالا</th>
						<th>شرح کالا</th>
						<th>واحد شمارش</th>
						<th>مقدار</th>
						<th> فی</th>
						<th>مبلغ کل</th>
						<th>واحد پولی</th>

						<?php if (!isset($_GET['status'])) { ?>
						<th class='my_print'>ویرایش</th>
						<th class='my_print'>جذف</th>
						<?php } ?>
					</tr>
				</thead>
					<?php if (mysql_num_rows($query)>0) { $i=1;
						$count=mysql_num_rows($query);
						$last=10-$count;
						$remain=10-$last;
						echo "<tbody id='box_report'>";
						//$row = mysql_fetch_array($query);
					while($row=mysql_fetch_array($query)){ 
						//var_dump($row);
					extract($row);
					echo "<tr>";
					$i_n=en2f_number($i);
						echo "<td> $i_n 		</td>";
						$i++; 
						$i_code=en2f_number($i_code);
						$de_total_prices=$de_quantity*$unit_price;
						$de_quantity=en2f_number(number_format($de_quantity));
						$unit_price=en2f_number(number_format($unit_price));
						$total_price=en2f_number(number_format($de_total_prices));
						$cost_total+=$de_total_price;
						echo "<td> $i_code </td>";
						echo "<td> $i_name 		</td>";
						echo "<td> $item_name 	</td>";
						echo "<td> $de_quantity </td>";
						echo "<td> $unit_price </td>";
						echo "<td> $total_price </td>";
						echo "<td>";
						get_currency_id('cur_name');
						 echo "</td>";
						if (!isset($_GET['status']) ) {
							$types=$_GET['type'];
							 $real_year=explode("-", $de_date);
		//echo jdate("Y"); 
							
						echo "<td class='my_print'>"; 
						if($real_year[0]==jdate("Y")){
						echo "<a href='anbar_rased_edit.php?details_edit_id=$de_id&type=$types'><span class='icon icon-edit'></span></a>";
						} 
						 echo "</td>";?>
						<td class='my_print'> 
							<?php if($real_year[0]==jdate("Y")){ ?>
							<a href='../controller/anbar_query.php?details_delete_id=<?php echo $de_id?>&serial_num_delete=<?php echo $_GET['serial_num']; ?>&type=<?php echo $types?>&cur=<?php echo $_GET['cur']; ?>' onClick="return confirm('آیا حاضر به حذف این مورد هستید؟')"><span class='icon icon-trash admin_icon_trash'></span></a></td>
						<?php }} ?>
					</tr>
					
					<?php }
					echo "</tbody>";
					for ($i=$remain+1; $i <=10 ; $i++) { $p=en2f_number($i);?>
					<tr>
						<td><?php echo $p; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<?php if (!isset($_GET['status'])) { ?>
						<td class='my_print'></td>
						<td class='my_print'></td>
						<?php } ?>
					
					</tr>
				<?php }}else{?>
						<tr> <th colspan='12'>فعلن هیچ اطلاعات در سیستم موجود نیست.</th></tr>
					<?php } ?>
				</table>
				
				<table class="table_setting" style="width:100%;margin-top: 3px;">
					
					<tr > 
					 	<td colspan='6' style='width:75%;text-align:right;padding-right:30px;'> <b>توضیحات: </b>
					 		<span id="bill_desc" >
					 			<?php
					 			$serial_number=$_GET['serial_num'];
					 			$bill_type=$_GET['type'];
					 			
					 			
					 			 $bill_query=mysql_query("select bill_description from bill_description where bill_serial_no= $serial_number and bill_type='$bill_type' and bill_year=$year",$con);
					 			 if (mysql_num_rows($bill_query)==1) {
					 			 	$bill_row=mysql_fetch_assoc($bill_query);
					 			 	echo $bill_row['bill_description'];
					 			 	
					 			 }else{
					 			 ?>
					 		<input type='hidden' id="bill_description_serial" value="<?php echo $serial_number; ?>">
					 		<input type='hidden' id="bill_description_type" value="<?php echo $bill_type; ?>">
					 		<span class="my_print">
					 		<input type='text' name="bill_description" lang="fa" id="bill_description" placeholder="توضیحات در باره برگه <?php echo  $bill_type == ('h') ? 'حواله' : 'رسید' ; ?> انبار." style="height:30px;margin-bottom:0px;width:400px;" required></span>
					 		
					 	 <span class='btn btn-primary my_print' id="add_bill_description">ثبت</span>
					 	 <?php } ?>
					 	</td>
					 	<td style="border:1px solid #000;" colspan="1">
					 		جمع کل
					 	</td>
					 	<td style="border:1px solid #000;" colspan="1">
					 		<?php echo en2f_number(number_format($cost_total)); ?>
					 	</td>
					</tr>
					
					<tr style="height:40px;"> 
					 	<td colspan='5' style='width:60%;text-align:right;padding-right:30px;'><b>مسؤل انبار: </b>................................. امضاء</td>
					 	
					 	<td colspan='3' style='width:40%;text-align:right'> 
					 	<?php if(isset($_GET['type'])){ 
					 		if($_GET['type']=='r'){?>
					 	<b>تهیه کننده: </b>
					 	<?php } }?>
					 	 </td>
					</tr>
					<?php if(isset($_GET['type'])){ 
					 		if($_GET['type']=='h'){?>
					<tr style="height:40px;"> 
					 	<td colspan='8' style='width:60%;text-align:right;padding-right:30px;'>
					 	<b>تهیه کننده: </b>
					 	<b style="margin-right: 220px;">تحویل گیرنده: </b>
					 	<b style="margin-right: 220px;">تصویب کننده: </b>
					 	 </td>
					 
					</tr>
					<?php } }?>
				</table>

		</div>
		</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	