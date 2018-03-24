<?php $title="نتیجه جستجو ";
include("../includes/connection.php");
include("../includes/header.php"); 
include("alert_messages.php");
if (isset($_GET['s_n_f']) && isset($_GET['s_n_t'])) {
		$type 		= $_GET['type'];
		$cur_id 		= $_GET['cur'];
		$s_n_f 		= (int)$_GET['s_n_f'];
		$s_n_t 		= (int)$_GET['s_n_t'];
		$year 		= $_GET['year'];

	$query=mysql_query("select * from bank_check where  check_cur_id=$cur_id  
	and check_date like '$year-%'
	and check_serial_no between $s_n_f and $s_n_t",$con);

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
							echo "<l style='margin-right:20px;'> </l>";
							echo " از شمار چک ";
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
						 ?>
						</th></tr>
					<tr>
						<th>ردیف</th>
						<th>شماره بیل</th>
						<th>تاریخ</th>
						<th>نام بانک</th>
						<th>نوع سند</th>
						<th>شماره سند</th>
						<th>مقدار</th>
						
						<th>شرح</th>
						<th class="my_print">نمایش</th>
						<?php if($_SESSION['user_qualification']=='admin' ){; ?>
						<th class="my_print">ویرایش</th>
						<?PHP } ?>
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
						if ($check_serial_no<=9) {
							$box_9='00';
							$box_serial=$box_9.$check_serial_no;
							$box_serial= en2f_number($box_serial);
						}elseif ($check_serial_no>=10 && $check_serial_no <=99) {
							$box_11='0';
							$box_serial=$box_11.$check_serial_no;
							$box_serial= en2f_number($box_serial);
						}else{
							$box_serial=$check_serial_no;
							$box_serial= en2f_number($box_serial);
						}
						echo "<td> $box_serial 		</td>";
						echo "<td>";
						echo en2f_number($check_date);
						echo  "</td>";
						echo "<td> $check_bank_name 		</td>";
						echo "<td> $check_doc_type 	</td>";
						echo "<td> $check_doc_no 	</td>";
						echo "<td>";
						echo en2f_number(number_format($check_amount));
						echo "</td>";
						echo "<td> $check_desc </td>";$i++;

						echo "<td class='my_print'>";
						echo "<a href='bank_check_final_paper.php?$year=$year&cur=$cur_id&type=$type&year=$year&s_n=$check_serial_no&no_edit=true'  target='_blank'>";
								echo "<span class='icon icon-eye-open'></span> </a>";
						echo "</td>"; 
						 if($_SESSION['user_qualification']=='admin' ){; 
						echo "<td class='my_print'>"; 
						echo "<a href='../controller/bank_check_query.php?check_id_serial_no=$check_id&cur=$cur_id&year=$year&s_n_f=$s_n_f&s_n_t=$s_n_t&s_n=$check_serial_no'>"?>
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