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
	
$query=mysql_query("select * from box where  box_cur_id=$cur_id  
	and  box_type='$type' 
	and box_date between '$start_date' and '$end_date'",$con);

?>
	<!-- Begining of Content -->
		<div class="content">
			<div class='span11 my_print'  style="width:884px;margin:0px;min-height:24px;padding:5px 20px;">
			<a href="box_date_search_option.php?cur=<?php echo $cur_id; ?>">
				<span class="btn btn-primary pull-left">برگشت<l class="icon icon-arrow-left icon-white" style='margin-top:3px;margin-right:5px;'></l></span>
			</a>
				<span class="btn btn-primary pull-left" style='margin-left:5px;' onClick='window.print();'>چاپ<l class="icon icon-print icon-white" style='margin-top:3px;margin-right:5px;'></l></span>
				<span class="btn btn-primary" style='margin-left:5px;' >واحد پول: <?php get_currency_id('cur_name'); ?></span>
		</div>
			<div class="span11 messages" id='bank_date_report'>
				<table class="table_setting" border="1">
					<tr> <th colspan='8'>
					
						<?php 
						if($type=='a'){
							
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
						}elseif($type=='e'){
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
						<?php if($type=='e'){ ?>
						<th>در وجه</th>
						<th>تحویل گیرنده وجه</th>
						<?php }elseif($type=='a'){ ?>
						<th>مورد دریافت</th>
						<?php } ?>
						<th>مبلغ</th>
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
							 	echo "وصول مطالعات";
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
						echo "<td> $box_reason </td>";$i++;?>
						
					</tr>
					<?php }}else{?>
						<tr> <th colspan='8'>فعلن هیچ اطلاعات در سیستم موجود نیست.</th></tr>
					<?php } ?>
				</table>
		</div>
		</div>
		<!-- End of Content -->
<?php } include_once("../includes/footer.php"); ?>	