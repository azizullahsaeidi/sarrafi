<?php $title="نتیجه جستجو ";
include("../includes/connection.php");
include("../includes/header.php"); 
include("alert_messages.php");
if (isset($_GET['type']) && isset($_GET['ed'])) {
		$type 		= $_GET['type'];
		$cur_id 		= $_GET['cur'];
		$sd 		= $_GET['sd'];
		$ed 		= $_GET['ed'];
		$s_d=explode("/", $sd);
		$e_d=explode("/", $ed);
		
		//$total_code=$anbar_code."/".$product_code."/".$price_code;
		$start_date=$s_d[2]."-".$s_d[1]."-".$s_d[0];
		$end_date=$e_d[2]."-".$e_d[1]."-".$e_d[0];
	
$query=mysql_query("select * from bank,bank_account where  bank_cur_id=$cur_id  
	and bank_account_number=account_number and bank_type='$type' 
	and bank_date between '$start_date' and '$end_date'",$con);

?>
	<!-- Begining of Content -->
		<div class="content">
			<div class='span11 my_print'  style="width:884px;margin:0px;min-height:24px;padding:5px 20px;">
			<a href="bank_date_search_option.php?cur=<?php echo $cur_id; ?>">
				<span class="btn btn-primary pull-left">برگشت<l class="icon icon-arrow-left icon-white" style='margin-top:3px;margin-right:5px;'></l></span>
			</a>
				<span class="btn btn-primary pull-left" style='margin-left:5px;' onClick='window.print();'>چاپ<l class="icon icon-print icon-white" style='margin-top:3px;margin-right:5px;'></l></span>
				<span class="btn btn-primary" style='margin-left:5px;' >واحد پول: <?php get_currency_id('cur_name'); ?></span>
		</div>
			<div class="span11 messages" id='bank_date_report'>
				<table class="table_setting" border="1">
					<tr> <th colspan='8'>
						نتیجه 
						<?php 
						if($type=='bank_a'){
							echo "بیل های رسید وجه.";
							echo "<l style='margin-right:20px;'> </l>";
							echo " از تاریخ ";
							echo "<l style='margin-right:20px;'>( </l>";
							echo en2f_number($s_d[2]);
							echo "/";
							echo en2f_number($s_d[1]);
							echo "/";
							echo en2f_number($s_d[0]);
							echo "<l style='margin-left:20px;'> ) </l>";
							echo " الی ";
							echo "<l style='margin-right:20px;'>( </l>";
							echo en2f_number($e_d[2]);
							echo "/";
							echo en2f_number($e_d[1]);
							echo "/";
							echo en2f_number($e_d[0]);
							echo "<l style='margin-left:20px;'> ) </l>"; 
						}elseif($type=='bank_e'){
						 	echo "بیل های صدور چک.";
						 	echo "<l style='margin-right:20px;'> </l>";
							echo " از تاریخ ";
							echo "<l style='margin-right:20px;'>( </l>";
							echo en2f_number($s_d[2]);
							echo "/";
							echo en2f_number($s_d[1]);
							echo "/";
						 	echo en2f_number($s_d[0]);
							echo "<l style='margin-left:20px;'> ) </l>";
							echo " الی ";
							echo "<l style='margin-right:20px;'>( </l>";
							echo en2f_number($e_d[2]);
							echo "/";
							echo en2f_number($e_d[1]);
							echo "/";
							echo en2f_number($e_d[0]);
							echo "<l style='margin-left:20px;'> ) </l>";  
						} 
						 ?>
						</th></tr>
					<tr>
						<th>ردیف</th>
						<th>شماره بیل</th>

						<th>تاریخ</th>
						<th>نام بانک</th>
						<th>شاخه</th>
						<th>شماره حساب</th>
						<th>مقدار</th>
						<th>شرح</th>
						
					</tr>
					<?php if (mysql_num_rows($query)>0) {
						$i=1;
					while($row=mysql_fetch_assoc($query)){ 
					extract($row);
					echo "<tr>";
						 $a_id=en2f_number($i);
						echo "<td> $a_id 		</td>";
						$box_serial=0;
						$box_9=0;
						$box_11=0;
						if ($bank_serial_no<=9) {
							$box_9='00';
							$box_serial=$box_9.$bank_serial_no;
							$box_serial= en2f_number($box_serial);
						}elseif ($bank_serial_no>=10 && $bank_serial_no <=99) {
							$box_11='0';
							$box_serial=$box_11.$bank_serial_no;
							$box_serial= en2f_number($box_serial);
						}else{
							$box_serial=$bank_serial_no;
							$box_serial= en2f_number($box_serial);
						}
						echo "<td> $box_serial 		</td>";
						echo "<td>";
						$insetDate=explode('-', $bank_date);
						$new_date =$insetDate[0].'/'.$insetDate[1].'/'.$insetDate[2];
						echo en2f_number($new_date);
						echo  "</td>";
						echo "<td> $bank_name 		</td>";
						echo "<td> $bank_branch 	</td>";
						echo "<td> $bank_account_number 	</td>";
						echo "<td>";
						echo en2f_number(number_format($bank_amount));
						echo "</td>";
						echo "<td> $bank_reason </td>";$i++;?>
						
					</tr>
					<?php }}else{?>
						<tr> <th colspan='8'>فعلن هیچ دیتی در سیستم موجود نیست.</th></tr>
					<?php } ?>
				</table>
		</div>
		</div>
		<!-- End of Content -->
<?php } include_once("../includes/footer.php"); ?>	