<?php $title="نتیجه جستجو ";
include("../includes/connection.php");
include("../includes/header.php"); 
include("alert_messages.php");
if (isset($_GET['type']) && isset($_GET['s_n_f'])) {
		$type 		= $_GET['type'];
		$cur_id 	= $_GET['cur'];
		$s_n_f 		= (int)$_GET['s_n_f'];
		$s_n_t 		= (int)$_GET['s_n_t'];
		$year 		= $_GET['year'];
		//$total_code=$anbar_code."/".$product_code."/".$price_code;
	
$query=mysql_query("select * from bank,bank_account where  bank_cur_id=$cur_id  
	and bank_account_number=account_number and bank_type='$type'
	and bank_serial_no > 0
	and bank_date like '$year-%' 
	and bank_serial_no between $s_n_f and $s_n_t",$con);

?>
	<!-- Begining of Content -->
		<div class="content">
			<div class='span11 my_print'  style="width:884px;margin:0px;min-height:24px;padding:5px 20px;">
			<a href="bank_search_option.php?cur=<?php echo $cur_id; ?>">
				<span class="btn btn-primary pull-left">برگشت<l class="icon icon-arrow-left icon-white" style='margin-top:3px;margin-right:5px;'></l></span>
			</a>
				<span class="btn btn-primary pull-left" style='margin-left:5px;' onClick='window.print();'>چاپ<l class="icon icon-print icon-white" style='margin-top:3px;margin-right:5px;'></l></span>
				<span class="btn btn-primary" style='margin-left:5px;' >واحد پول: <?php get_currency_id('cur_name'); ?></span>
		</div>
			<div class="span11 messages" id='bank_date_report'>
				<table class="table_setting" border="1">
					<tr> <th colspan='10'>
						
						<?php 
						if($type=='bank_a'){
							echo "<l style='margin-right:20px;'> </l>";
							echo " از شماره رسید ";
							echo "<l style='margin-right:20px;'>( </l>";
							if($s_n_f<=9){ $f="00$s_n_f"; echo en2f_number($f);}
							elseif ($s_n_f<=99){ $f="0$s_n_f"; echo en2f_number($f);}
							else { echo en2f_number($s_n_f);}
							echo "<l style='margin-left:20px;'> ) </l>";
							echo " الی ";
							echo "<l style='margin-right:20px;'>( </l>";
							if($s_n_t<=9){ $f="00$s_n_t"; echo en2f_number($f);}
							elseif ($s_n_t<=99){ $f="0$s_n_t"; echo en2f_number($f);}
							else { echo en2f_number($s_n_t);}
							echo "<l style='margin-left:20px;'> ) </l>";
						}elseif($type=='bank_e'){
						 	echo "<l style='margin-right:20px;'> </l>";
							echo " از شماره حواله ";
							echo "<l style='margin-right:20px;'>( </l>";
						 	if($s_n_f<=9){ $f="00$s_n_f"; echo en2f_number($f);}
							elseif ($s_n_f<=99){ $f="0$s_n_f"; echo en2f_number($f);}
							else { echo en2f_number($s_n_f);}
							echo "<l style='margin-left:20px;'> ) </l>";
							echo " الی ";
							echo "<l style='margin-right:20px;'>( </l>";
							if($s_n_t<=9){ $f="00$s_n_t"; echo en2f_number($f);}
							elseif ($s_n_t<=99){ $f="0$s_n_t"; echo en2f_number($f);}
							else { echo en2f_number($s_n_t);}
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
						<th>مبلغ</th>
						<th>شرح</th>
						<th  class='my_print'>نمایش</th>
						<?php if($_SESSION['user_qualification']=='admin'){  ?>
						<th  class='my_print'>ویرایش</th>
						<?php } ?>
						
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
						echo "<td> $bank_reason </td>";$i++;
						echo "<td class='my_print'>";
						if (isset($_GET['type'])) {
							$type=$_GET['type'];
							if ($type=='bank_a') {
								echo "<a href='bank_cash_final_paper.php?cur=$cur_id&type=$type&year=$year&s_n=$bank_serial_no&no_edit=true' target='_blank'>";
								echo "<span class='icon icon-eye-open'></span> </a>";
							}elseif ($type='bank_e') {
								echo "<a href='bank_check_paper_order.php?bank_id=$ban_id&cur=$cur_id&type=$type&year=$year&s_n=$bank_serial_no&no_edit=true'  target='_blank'>";
								echo "<span class='icon icon-eye-open'></span> </a>";
							}
						}
						echo "</td>";
						if($_SESSION['user_qualification']=='admin'){ 
						echo "<td class='my_print'>";
						echo "<a href='../controller/bank_query.php?bank_id_serial_no=$ban_id&cur=$cur_id&type=$type&year=$year&s_n_f=$s_n_f&s_n_t=$s_n_t&s_n=$bank_serial_no' target='_self'>"?>
							<span class='icon icon-edit'></span>
						</a>
						</td>
						<?php } ?>
					</tr>
					<?php }}else{?>
						<tr> <th colspan='10'>فعلن هیچ اطلاعات در سیستم موجود نیست.</th></tr>
					<?php } ?>
				</table>
		</div>
		</div>
		<!-- End of Content -->
<?php } include_once("../includes/footer.php"); ?>	