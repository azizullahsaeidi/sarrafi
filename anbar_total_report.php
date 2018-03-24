<?php $title="بخش مدیریت "; ?>
<?php include("../includes/connection.php"); ?>
<?php 
include("../includes/header.php"); 
include("alert_messages.php");
$product_query=mysql_query("select i_name,i_code,unit_price from item where anbar_code=20");


?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php alert_messages();?>
		<a href="anbar_rased.php?num=1">
			<span class="btn btn-primary pull-left" style="margin-top:5px;">
				بیل جدید<l class="icon-plus icon-white" style="margin-top: 3px;"></l>
			</span>
		</a>
			<span class="btn btn-primary pull-left" onClick="window.print();" id="action_btn" style="margin-top:5px;margin-left:3px;">
			 	چاپ بیل <l class="icon-print icon-white" style="margin-top: 3px;"></l>
			</span>
			
		</div>
			<div class="span11 messages">
				<table class="table_setting" border="1">
					<tr> <th colspan='11'>لیست فکتور های بیل شماره  <?php  ?></th></tr>
					<tr>
						<th>شماره</th>
						<th>کد کالا</th>
						<th>نام کالا</th>
						<th>نرخ</th>
						<th>مبلغ وارده</th>
						<th>مبلغ صادره</th>
						<th>مبلغ موجود</th>
						<th>مقدار وارده</th>
						<th>مقدار صادره</th>
						<?php if (!isset($_GET['status'])) { ?>
						<th>مقدار باقی مانده</th>
						<th>جذف</th>
						<?php } ?>
					</tr>
					<?php if (mysql_num_rows($product_query)>0) { $i=1;
					while($row=mysql_fetch_assoc($product_query)){ 
					extract($row);
					$rased_query=mysql_query("select sum(de_total_price) rased_total_price,sum(de_quantity) rased_total_quantity from item_details where de_reg_type='r' and total_code='$i_code' group by total_code",$con);
					$hawala_query=mysql_query("select sum(de_total_price) hawala_total_price,sum(de_quantity) hawala_total_quantity from item_details where de_reg_type='h' and total_code='$i_code' group by total_code",$con);
					$rase_row=mysql_fetch_assoc($rased_query);
					$hawala_row=mysql_fetch_assoc($hawala_query);

					$rased_total_price 		=(int)$rase_row['rased_total_price'];
					$rased_total_quantity 	=(int)$rase_row['rased_total_quantity'];
					$hawala_total_price 	=(int)$hawala_row['hawala_total_price'];
					$hawala_total_quantity 	=(int)$hawala_row['hawala_total_quantity'];
					$remain_price 			=$rased_total_price-$hawala_total_price;
					$remain_quantity 		=$rased_total_quantity-$hawala_total_quantity;
					echo "<tr>";
						echo "<td> $i 		</td>";
						$i++; echo "<td> $i_name 		</td>";
						echo "<td> $i_code 	</td>";
						echo "<td> $unit_price 	</td>";
						echo "<td> $rased_total_price </td>";
						echo "<td> $hawala_total_price </td>";
						echo "<td> $remain_price </td>";
						echo "<td> $rased_total_quantity </td>";
						echo "<td> $hawala_total_quantity </td>";
						echo "<td> $remain_quantity </td>";
						if (!isset($_GET['status'])) {
							
						echo "<td> <a href='anbar_rased_edit.php?details_edit_id='><span class='icon icon-edit'></span></a> </td>";?>
						<?php } ?>
					</tr>
					<?php }}else{?>
						<tr> <th colspan='11'>فعلن هیچ دیتا در سیستم موجود نیست.</th></tr>
					<?php } ?>
				</table>

		</div>
		</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	