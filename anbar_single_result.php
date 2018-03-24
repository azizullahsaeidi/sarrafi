<?php $title="کاردکس کالا "; ?>
<?php include("../includes/connection.php"); ?>
<?php 
include("../includes/header.php"); 
include("alert_messages.php");
?>
	<!-- Begining of Content -->
		<div class="content">
			<?php if (isset($_GET['anbar_code']) && isset($_GET['anbar_month_ta'])) {

				$total_code 		= $_GET['anbar_code'];
				$anbar_year_az 		= $_GET['anbar_year_az'];
				$anbar_month_az 	= $_GET['anbar_month_az'];
				$anbar_day_az 		= $_GET['anbar_day_az'];

				$start_date=$anbar_year_az."-".$anbar_month_az."-".$anbar_day_az;

				$anbar_year_ta 		= $_GET['anbar_year_ta'];
				$anbar_month_ta 	= $_GET['anbar_month_ta'];
				$anbar_day_ta 		= $_GET['anbar_day_ta'];
				//$total_code=$anbar_code."/".$product_code."/".$price_code;
				$end_date=$anbar_year_ta."-".$anbar_month_ta."-".$anbar_day_ta;
				
			$a_query=mysql_query("select sum(de_total_price) a_total,sum(de_quantity) a_amount from item_details where total_code='$total_code' and de_date < '$start_date' and de_reg_type='r'",$con);	
			$e_query=mysql_query("select sum(de_total_price) e_total,sum(de_quantity) e_amount from item_details where total_code='$total_code' and de_date < '$start_date' and de_reg_type='h'",$con);	
			$a_row=mysql_fetch_assoc($a_query);
			$e_row=mysql_fetch_assoc($e_query);

			$befor_start_date_value=$a_row['a_total']-$e_row['e_total'];
			$befor_start_date_amount=$a_row['a_amount']-$e_row['e_amount'];
	$anbar_query=mysql_query("SELECT 
								anbar_name,
								i_name,
								i_code,
								cur_name,
								unit_price 
							from anbar,
								item,
								currency 
							where 
								anbar.anbar_code=item.anbar_code 
								and item.i_code='$total_code' 
								and currency=cur_id
								",$con);
	//var_dump(mysql_num_rows($anbar_query));
	$pub_row=mysql_fetch_assoc($anbar_query);
					?>
		<div class='span11 search_area'>
			
			<a href="anbar_single_product_search.php"><span class="btn btn-primary pull-left">برگشت
			<l class="icon icon-arrow-left icon-white" style="margin-top:3px;"></l ></span></a>
			<span class="btn btn-primary pull-left" style='margin-left:4px;' onClick='window.print()'>چاپ
			<l class="icon icon-print icon-white" style="margin-top:3px;"></l ></span>
			
		</div>
		<div class="span11 messages" id='cardex_report'>
				<?php
					$product_query=mysql_query("SELECT de_date,de_serial_no,total_code,de_quantity,de_total_price,de_reg_type 
					from 
						item_details 
					where 
						 total_code='$total_code' and de_date between '$start_date' and '$end_date' and de_status='perm' limit 0,43");
				?>
				<table class="table_setting"  style="width:100%">

					<tr>
						<th colspan='2' rowspan='2' style='text-align:right;'> <img src='../images/committee_logo.png' style='width:70px;padding:2px;'> </th>
						<th colspan='5'  style='border-left:0px;border-bottom:0px;padding-right:40px;'>
							دفتر نمایندگی کمیته امداد امام خمینی (ره) در کشور افغانستان</th>
						<th colspan='3' style='width:75px;border-right:0px;border-bottom:0px'>شماره صفحه: <?php if(isset($_GET['page'])){ echo en2f_number($_GET['page']); }else{ echo en2f_number(1); } ?></th>
					</tr>
					<tr>
						<th colspan='5' style='border-left:0px;border-top:0px;;padding-right:40px;'>گزارش انبار ( <?php echo $pub_row['anbar_name']; ?> )  مبلغ ( <?php echo  $pub_row['cur_name']; ?> )</th>
						<th colspan='3' style='border-right:0px;border-top:0px'>سال: <?php echo en2f_number(jdate("Y")); ?></th>
					</tr>
					<tr>
						<th colspan='2' style='text-align:right'>کد کالا: <?php echo en2f_number($pub_row['i_code']); ?> </th>
						<th colspan='5'>نام کالا: <?php echo $pub_row['i_name']; ?> </th>
						<th colspan='3'>فی: <?php echo en2f_number($pub_row['unit_price']); ?> </th>
						
					</tr>
				</table>

				<table class="table_setting" border="1" style="width:50%">
					<thead>
					<tr>
						<th>ردیف</th>
						<th>تاریخ</th>
						<th>شماره رسید/حواله</th>
						<th>رسید انبار</th>
						<th>حواله انبار</th>
						
						
					</tr>
				</thead>
				<tbody id="box_report">
					<tr>
						<td colspan='2'>اول دوره</td>
						<td ></td>
						<td >
							<?php 
								echo en2f_number(number_format($befor_start_date_amount));
							?>
						</td>
						<td ></td>
					</tr>
					<?php if (mysql_num_rows($product_query)>0) { $i=1;
						//echo "greate";
						//$last_total=0;
					while($row=mysql_fetch_assoc($product_query)){ 
					extract($row);
					$de_date=en2f_number($de_date);
					$i_count=en2f_number($i);
					$de_serial_no=en2f_number($de_serial_no);

					echo "<tr>";
						echo "<td> $i_count 		</td>";
						$i++; 
						$insetDate=explode('-', $de_date);
						$new_date =$insetDate[0].'/'.$insetDate[1].'/'.$insetDate[2];
						echo "<td>$new_date</td>";
						echo "<td> $de_serial_no 	</td>";
						if ($de_reg_type=='r') {?>
							
							<td> <?php echo en2f_number($de_quantity); ?>	</td>
							<td>  </td>
							
						<?php }elseif ($de_reg_type=='h') {?>
						<td>  </td>
						<td> <?php echo en2f_number($de_quantity);?> 	</td>
						<?php } ?>
						
						
						 
					</tr>
					
					<?php }
					echo "</tbody>";
				} ?>
				</table>
				
				<?php
					$product_s_query=mysql_query("SELECT de_date,de_serial_no,total_code,de_quantity,de_total_price,de_reg_type 
					from 
						item_details 
					where 
						 total_code='$total_code' and de_date between '$start_date' and '$end_date' and de_status='perm' limit 43,80");
				if (mysql_num_rows($product_s_query)>0) { $i=44;
				?>
				<table class="table_setting" border="1" style="width:49%;float:left;">
					<thead>
					<tr>
						<th>ردیف</th>
						<th>تاریخ</th>
						<th>شماره رسید/حواله</th>
						<th>رسید انبار</th>
						<th>حواله انبار</th>
						
						
					</tr>
					<thead>
						<tbody id='box_report'>
						
					<?php 
					while($row=mysql_fetch_assoc($product_s_query)){ 
					extract($row);
					$de_date=en2f_number($de_date);
					$i_count=en2f_number($i);
					$de_serial_no=en2f_number($de_serial_no);
					echo "<tr>";
						echo "<td> $i_count 		</td>";
						$i++; echo "<td> $de_date 		</td>";
						echo "<td> $de_serial_no 	</td>";
						if ($de_reg_type=='r') {?>
							
							<td> <?php echo en2f_number($de_quantity); ?>	</td>
							<td>  </td>
							
						<?php }elseif ($de_reg_type=='h') {?>
						<td>  </td>
						<td> <?php echo en2f_number($de_quantity);?> 	</td>
						<?php } ?>
						
						
						 
					</tr>
					<?php } ?>
					</tbody>
				</table>
					<?php } ?>
				
				<table class="table_setting" border="1" style="width:49%;float:left;" >
					<?php $counting_query=mysql_query("select sum(de_total_price) total_price,sum(de_quantity) quantity,de_reg_type from item_details where
					total_code='$total_code' and de_date between '$start_date' and '$end_date' and de_status='perm' group by de_reg_type order by de_reg_type desc ",$con);
					
				
						$rased_remain=0;
						$rased_quantity=0;
						$hawala_remain=0;
						$hawala_quantity=0;
					while($counting_row=mysql_fetch_assoc($counting_query)){
					$reg_type=$counting_row['de_reg_type'];
					if ($reg_type=='r') {?>
					<tbody id='box_report'>
					<tr>
						<th>وارده</th>
						<th><?php  $rased_quantity=$counting_row['quantity']; echo en2f_number(number_format($rased_quantity)); ?></th>
					</tr>
					
					<tr>
						<th>مبلغ</th>
						<th><?php $rased_remain= $counting_row['total_price']; echo en2f_number(number_format($rased_remain)); ?></th>
					</tr>
					<?php }elseif ($reg_type=='h') { ?>
					<tr>
						<th>صادره</th>
						<th><?php $hawala_quantity=$counting_row['quantity']; echo en2f_number(number_format($hawala_quantity)); ?></th>
					</tr>
					
					<tr>
						<th>مبلغ</th>
						<th><?php $hawala_remain=$counting_row['total_price']; echo en2f_number(number_format($hawala_remain)); ?></th>
					</tr>
					<?php } ?>
					
					<?php } ?>
					<tr>
						<th>مانده تعداد</th>
						<th><?php echo en2f_number(number_format(($rased_quantity-$hawala_quantity)+$befor_start_date_amount)); ?></th>
					</tr>
					<tr>
						<th>مانده مبلغ</th>
						<th><?php echo en2f_number(number_format(($rased_remain-$hawala_remain)+$befor_start_date_value)); ?></th>
					</tr>
					</tbody>
				</table>
				<?php }else{ ?>
				<table class="table_setting" border="1">
					<tr> <th colspan='11'>لیست مدیران سیستم</th></tr>
					<tr>
						<th>ردیف</th>
						<th>نام انبار</th>
						<th>نام کالا</th>
						<th>واحد کالا</th>
						<th>شمار بیل</th>
						<th>تعداد کالا</th>
						<th>قیمت فی</th>
						<th>قیمت کل</th>
						<th>واحد پول</th>
						<?php if (!isset($_GET['status'])) { ?>
						<th>ویرایش</th>
						<th>جذف</th>
						<?php } ?>
					</tr>
					
						<tr style="height:200px;"> <th colspan='11' ><h1>برای دریافت اطلاعات از فورم بالا استفاده کنید.</h1></th></tr>
					
				</table>
					<?php }?>
		</div>
		</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	