<?php $title="لیست کالا های اول دوره ";
include("../includes/connection.php");
include("../includes/header.php"); 
include("alert_messages.php");
if (isset($_GET['cur'])) {
	$cur_id 	= $_GET['cur'];
	
	$query=mysql_query("SELECT 
				anbar_name,
			    de_date,
			    de_id,
			    i_name,
			    item_name,
			    i_code,
			    de_serial_no,
			    de_quantity,
			    unit_price,
			    de_total_price
			from 
				anbar,
			    item,
			    item_details,
			    item_type
			where 
				denomination=item_id 
			    and total_code=i_code 
			    and anbar.anbar_code=item.anbar_code 
			    and i_id = item_f_id
			    and de_reg_type='r'
			    and de_serial_no =0
				order by de_serial_no 
				",$con); ?>
	<!-- Begining of Content -->
		<div class="content">
			<div class='span11 my_print'  style="width:884px;margin:0px;min-height:24px;padding:5px 20px;">
			<a href="firsttime_product_list.php?cur=<?php echo $cur_id; ?>">
				<span class="btn btn-primary pull-left">برگشت<l class="icon icon-arrow-left icon-white" style='margin-top:3px;margin-right:5px;'></l></span>
			</a>
				<span class="btn btn-primary pull-left" style='margin-left:5px;' onClick='window.print();'>چاپ<l class="icon icon-print icon-white" style='margin-top:3px;margin-right:5px;'></l></span>
				<span class="btn btn-primary" style='margin-left:5px;' >واحد پول: <?php get_currency_id('cur_name'); ?></span>
		</div>
			<div class="span11 messages" id='bank_date_report'>
				<table class="table_setting" border="1">
					<tr> <th colspan='10'>
						لیست کالا های اول دوره
						</th></tr>
					<tr>
						<th>ردیف</th>
						

						<th>تاریخ</th>
						<th>نام انبار</th>
						<th>نام کالا</th>
						<th>کد کالا</th>
						<th>واحد شمارش</th>
						<th>تعداد</th>
						<th>فی</th>
						<th>مبلغ</th>
						
						<?php if($_SESSION['user_qualification']=='admin'){ ?>
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
						
						echo "<td>";
						echo en2f_number($de_date);
						echo  "</td>";
						echo "<td> $anbar_name 		</td>";
						echo "<td> $i_name 		</td>";
						echo "<td>";
						echo en2f_number($i_code);
						echo "</td>";
						echo "<td> $item_name 		</td>";
						echo "<td>";
						echo en2f_number(number_format($de_quantity));
						echo "</td>";
						echo "<td>";
						echo en2f_number(number_format($unit_price));
						echo "</td>";
						echo "<td>";
						echo en2f_number(number_format($de_total_price));
						echo "</td>";$i++;
						
						if($_SESSION['user_qualification']=='admin'){ 
						echo "<td class='my_print'>";
						echo "<a href='first_product_list_edit.php?f_edit_id=$de_id&cur=$cur_id'>"?>
							<span class='icon icon-edit'></span>
						</a>
						</td>
						<?php } ?>
						
					</tr>
					<?php }}else{?>
						<tr> <th colspan='10'>فعلن هیچ دیتی در سیستم موجود نیست.</th></tr>
					<?php } ?>
				</table>
		</div>
		</div>
		<!-- End of Content -->
<?php } include_once("../includes/footer.php"); ?>	