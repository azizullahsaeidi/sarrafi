<?php $title="نتیجه جستجو ";
include("../includes/connection.php");
include("../includes/header.php"); 
include("alert_messages.php");
if (isset($_GET['type']) && isset($_GET['s_n_f'])) {
		$type 		= $_GET['type'];
		$cur_id 		= $_GET['cur'];
		$s_n_f 		= (int)$_GET['s_n_f'];
		$s_n_t 		= (int)$_GET['s_n_t'];
		$year 		= $_GET['year'];
		


		//$total_code=$anbar_code."/".$product_code."/".$price_code;
	
$query=mysql_query("select * from box where  box_cur_id=$cur_id  
	and box_serial_no > 0
	and  box_type='$type'
	and box_date like '$year-%' 
	and box_serial_no between $s_n_f and $s_n_t ",$con);

?>
	<!-- Begining of Content -->
		<div class="content">
			<div class='span11 my_print'  style="width:884px;margin:0px;min-height:24px;padding:5px 20px;">
			<a href="box_search_option.php?cur=<?php echo $cur_id; ?>">
				<span class="btn btn-primary pull-left">برگشت<l class="icon icon-arrow-left icon-white" style='margin-top:3px;margin-right:5px;'></l></span>
			</a>
				<span class="btn btn-primary pull-left" style='margin-left:5px;' onClick='window.print();'>چاپ<l class="icon icon-print icon-white" style='margin-top:3px;margin-right:5px;'></l></span>

				<span class="btn btn-primary" style='margin-left:5px;' >
				واحد پول: <?php get_currency_id('cur_name'); ?></span>
			</div>
			<div class="span11 messages" id='bank_date_report'>
				<table class="table_setting" border="1">
					<tr> <th colspan='9'>
					
						<?php 
						if($type=='a'){
							
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
						}elseif($type=='e'){
						 	
						 	echo "<l style='margin-right:20px;'> </l>";
							echo " از شماره برگ پرداخت";
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
						<?php if($type=='e'){ ?>
						<th>در وجه</th>
						<th>تحویل گیرنده وجه</th>
						<?php }elseif($type=='a'){ ?>
						<th>مورد دریافت</th>
						<?php } ?>
						<th>مبلغ</th>
						<th>شرح</th>
						<th class="my_print">نمایش</th>
						<?php if($_SESSION['user_qualification']=='admin'){  ?>
						<th class="my_print">ویرایش</th>
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
						if ($box_serial_no<=9) {
							$box_9='00';
							$box_serial=$box_9.$box_serial_no;
							$box_serial= en2f_number($box_serial);
						}elseif ($box_serial_no>=10 && $box_serial_no <=99) {
							$box_11='0';
							$box_serial=$box_11.$box_serial_no;
							$box_serial= en2f_number($box_serial);
						}else{
							$box_serial=$box_serial_no;
							$box_serial= en2f_number($box_serial);
						}
						echo "<td> $box_serial 		</td>";
						echo "<td>";
						$insetDate=explode('-', $box_date);
						$new_date =$insetDate[0].'/'.$insetDate[1].'/'.$insetDate[2];
						echo en2f_number($new_date);
						echo  "</td>";
						if($type=='e'){
							$name=explode("/", $box_reciever_name);
							echo "<td>  $name[0]		</td>";
							echo "<td>  $name[1]	</td>";
						}elseif($type=='a'){
							echo "<td>";
							 if($box_reciever_name=='help_people'){
							 	echo "کمک مردمی";
							 }elseif ($box_reciever_name=='wojohat') {
							 	echo "وجوهات امانی";
							 }elseif ($box_reciever_name=='study') {
							 	echo "وصول مطالبات";
							 }elseif ($box_reciever_name=='borrow') {
							 	echo "وام";
							 }elseif ($box_reciever_name=='sale') {
							 	echo "فروش";
							 }elseif ($box_reciever_name=='orphan') {
							 	echo "ایتام";
							 }elseif ($box_reciever_name=='other') {
							 	echo "اعتبارات";
							 }
							 echo "</td>";
						}
						echo "<td>";
						echo en2f_number(number_format($box_amount));
						echo "</td>";
						echo "<td> $box_reason </td>";$i++;
						echo "<td class='my_print'>"; 
						if (isset($_GET['type'])) {
							$type=$_GET['type'];
							if ($type=='a') {
								echo "<a href='box_final_arrive_paper.php?cur=$cur_id&type=$type&year=$year&s_n=$box_serial_no&no_edit=true'  target='_blank'>";
								echo "<span class='icon icon-eye-open'></span> </a>";
							}elseif ($type='e') {
								echo "<a href='payment_paper.php?box_id=$box_id&cur=$cur_id&type=$type&year=$year&s_n=$box_serial_no&no_edit=true' target='_blank'>";
								echo "<span class='icon icon-eye-open'></span> </a>";
							}
						}
						echo "</td>";
						if($_SESSION['user_qualification']=='admin'){ 
						 echo "<td class='my_print'>"; 
						echo "<a href='../controller/box_query.php?box_id_serial_no=$box_id&cur=$cur_id&type=$type&year=$year&s_n_f=$s_n_f&s_n_t=$s_n_t&s_n=$box_serial_no'>";
						?>
							<span class='icon icon-edit'></span>
						</a>
						 </td>
						 <?php } ?>
						
						
					</tr>
					<?php }}else{?>
						<tr> <th colspan='8'>فعلن هیچ اطلاعات در سیستم موجود نیست.</th></tr>
					<?php } ?>
				</table>
		</div>
		</div>
		<!-- End of Content -->
<?php } include_once("../includes/footer.php"); ?>	