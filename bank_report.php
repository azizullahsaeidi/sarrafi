<?php $title="گزارش دفتر بانک";
include("../includes/connection.php");
include("../includes/cur_year.php");
//include("../includes/currency_name.php");
include("../includes/header.php"); 
include("alert_messages.php");
$page="";
$page1="";
$single_sum=0;
$single_con=0;
$count_sum=0;

$count_consume=0;
$count_total=0;
		if (isset($_GET['page']))
		{
			$page=$_GET['page'];
			if ($page=="" || $page==1)
			{
				$page1=0;
			}
			else
			{
				$page1=($page*25)-25;
			}
		}
		else
		{
			$page1=0;
		}
		
		$consume=0;
if (!isset($_GET['year']))
{
	$year=jdate("Y");
}
else if (isset($_GET['year']))
{
	$year=$_GET['year'];
}
if (!isset($_GET['year']))
{
	$cur_y=$y_year;
}
else if (isset($_GET['year']))
{
	$cur_y=$_GET['year'];
}
//$cur_y=$y_year;
$cur_id=$_GET['cur'];

$pagination_query=mysql_query("SELECT 
						ban_id
					FROM 
						bank 
					WHERE 
						bank_cur_id=$cur_id 
					
					and (bank_status ='f_b_perm' or bank_status='bank_per')
					and bank_date like '$cur_y-%'",$con);
if (isset($_GET['page']) && $_GET['page']!=1) {
	$p=$_GET['page'];
$count_page=($p-1)*25;
$counting_query=mysql_query("SELECT 
						bank_amount,bank_type
					FROM 
						bank 
					WHERE 
						bank_cur_id=$cur_id 
					
					and (bank_status ='f_b_perm' or bank_status='bank_per')
					and bank_date like '$cur_y-%' limit 0,$count_page",$con);
			while ($count_row=mysql_fetch_assoc($counting_query)) {
				$count_amount=$count_row['bank_amount'];
				$count_type=$count_row['bank_type'];
				if ($count_type=='bank_a') {
					    	$count_amount."<br>";
								$count_sum+=$count_amount."<br>";
						}elseif ($count_type=='bank_e') {
							$count_amount;
							$count_consume+=$count_amount;
						}
			}


}

$query=mysql_query("SELECT 
						bank_date,bank_amount,bank_serial_no,bank_reason,bank_type 
					FROM 
						bank 
					WHERE 
						bank_cur_id=$cur_id 
					
					and (bank_status ='f_b_perm' or bank_status='bank_per')
					and bank_date like '$year-%' limit $page1,25",$con);
	$f_year=$cur_y-1;
	$add_query 		=mysql_query("SELECT
		 							sum(bank_amount) add_amount 
		 						from 
		 							bank 
		 						where 
			 						 
			 						bank_cur_id=$cur_id 
			 						and bank_status='bank_per' 
			 						and bank_type='bank_a'
			 						and  bank_date <= '$f_year-12-30' ",$con);
	$extract_query 	=mysql_query("SELECT
		 							sum(bank_amount) extract_amount 
		 						from 
		 							bank 
		 						where 
			 						 
			 						bank_cur_id=$cur_id 
			 						and bank_status='f_b_perm'
			 						and bank_type='bank_e' 
			 						and  bank_date  <= '$f_year-12-30' ",$con);
	$add_row 		=mysql_fetch_assoc($add_query);
	$extract_row 	=mysql_fetch_assoc($extract_query);
	$add_amount     =$add_row['add_amount'];
	$ext_amount 	=$extract_row['extract_amount'];
	$last_remain    =$add_amount-$ext_amount;
?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 search_area'>
		<?php alert_messages();?>
			
			
			<span class='btn btn-primary pull-left' style="width:60px;" onClick="window.print();">
				چاپ 
				<l class="icon icon-print icon-white" style="margin-top:3px;"></l >
			</span>
			<span class='btn btn-primary ' style="width:110px;">واحد پولی: <?php echo get_currency_id('cur_name'); ?> </span>
			<form action="" method="get" id="search_form">
				<b>جستجو به اساس سال :</b> 
				<input type="number" name="year" min="0" max="10000" placeholder="سال مالی مورد نظر خویش را بنویسید" required>
				<input type="hidden" name="cur" value="<?php echo $cur_id?>">
				<input type="submit" value="جستجو" class="btn btn-info">
			</form>
		</div>
		<div class="span11 messages"  id='box_report'>

				<table class="table_setting" border="1" >
					<thead>
					<tr>
						<th colspan='1' rowspan='2' style='width:75px;'> <img src='../images/committee_logo.jpg' style='width:70px;padding:2px;'> </th>
						<th colspan='3'  style='border-left:0px;border-bottom:0px'>
							دفتر نمایندگی کمیته امداد امام خمینی (ره) در کشور افغانستان</th>
						<th colspan='2' style='width:75px;border-right:0px;border-bottom:0px'>شماره صفحه: <?php if(isset($_GET['page'])){ echo en2f_number($_GET['page']); }else{ echo en2f_number(1); } ?></th>
					</tr>
					<tr>
						<th colspan='3' style='border-left:0px;border-top:0px'>دفتر بانک ( <?php get_currency_id('cur_name'); ?> ) شاخه  ( <?php echo $province_row['pro_name']; ?> )  در سال <?php echo en2f_number(jdate("Y")); ?> </th>
						<th colspan='2' style='border-right:0px;border-top:0px'></th>
					</tr>

					<tr>
						<th  style='width:70px;font-size:12px;border-bottom:0px'>شماره برگ پرداخت</th>
						<th rowspan='2'>تاریخ</th>
						<th style='width:30%'>شرح</th>
						<th>بدهکار</th>
						<th>بستانکار</th>
						<th>مانده</th>
					</tr>
					<tr>
						<th  style='width:70px;font-size:12px;border-top:0px'>یا رسید نقد</th>
						<th style='width:30%'>
						<?php if(isset($_GET['page'])){
						echo "جمع / نقل از صفحه قبل";
						 }else{
						 	echo "اول دوره";
						 	} ?>
						</th>
						<td>
							<?php if(isset($_GET['page'])){
								echo en2f_number(number_format($count_sum+$last_remain));
							}else{
								echo en2f_number(number_format($last_remain));
								}?>
						</td>
						<td>
							<?php if(isset($_GET['page'])){
								echo en2f_number($count_consume);
							}?>
						</td>
						<td>
							<?php if(isset($_GET['page'])){
								$last_remains=($count_sum-$count_consume)+$last_remain;
								echo en2f_number(number_format($last_remains));
							}else{
								$last_remains =$last_remain;
								echo en2f_number(number_format($last_remain));
								}?>
						</td>
					</tr>
					</thead>
					<tbody id='box_report'>
					<?php //ECHO mysql_num_rows($query);die;
					$sums=$last_remains;
					$sum=$last_remains;
					if(mysql_num_rows($query)>=1){
						
						while ($row=mysql_fetch_assoc($query)) {
						extract($row);
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
						$insetDate=explode('-', $bank_date);
						$new_date =$insetDate[0].'/'.$insetDate[1].'/'.$insetDate[2];
						$box_date=en2f_number($new_date);
						$box_a=en2f_number(number_format($bank_amount));
					
						echo "<tr>";
						echo "<td>$box_serial</td>";
						echo "<td>";
						echo en2f_number($box_date)."</td>";
						echo "<td>$bank_reason</td>";
						if ($bank_type=='bank_a') {
							echo "<td>$box_a</td>";
							$single_sum=$bank_amount;
							$sums+=$single_sum;
							$sum=$sum+$single_sum;
							//$sums=$cons+$single_sum;
							$add_sum=en2f_number(number_format($sum));
							echo "<td></td>";
							echo "<td>";
							
							echo $add_sum;
							echo "</td>";
						}elseif ($bank_type=='bank_e') {
							echo "<td></td>";
							echo "<td>$box_a</td>";
							$single_con=$bank_amount;
							$consume+=$bank_amount;
						
							$sum=$sum-$single_con;
							$extract_box=en2f_number(number_format($sum));
							echo "<td>";
						
							//echo $sum."<br>";
							echo $extract_box;
							echo "</td>";
						}
						echo "</tr>";
					}
						echo "</tbody>";
						echo "<tr>";
							//$cur_name=get_currency_id('cur_name');
							echo "<td colspan='3'>جمع / نقل به صفحه بعد </td>";
							$remain=$sums-$consume;
							$total_sum=en2f_number(number_format($sums));
							$total_consume=en2f_number(number_format($consume));
							$total_remain=en2f_number(number_format($remain));
							echo "<td>$total_sum</td>";
							echo "<td>$total_consume</td>";
							echo "<td>$total_remain</td>";
						echo "</tr>";
					}
				?>
				</table>
				<table>
					<tr><th colspan="6" style="min-height: 20px;border: 0px" border="1"></th></tr>
				</table>
			
				<div style="margin-top: 10px;">
					<l style='font-size: 20px;'>تهیه کننده:...............................</l>
					<l style='font-size: 20px;margin-right: 300px'>تصویب کننده:...............................</l>
				</div>
				<?php 
				echo "<div style='clear:both'></div>";
				echo "<div style='text-align:left;margin-top:5px;' id='box_pagination'> ";
					if (mysql_num_rows($pagination_query)>=25) { 
						$page_number=mysql_num_rows($pagination_query);?>
					<form action='bank_report.php' method='get'>
						<table style='text-align:left;'>
							<tr>
								<td style="width:10%">صفحه 
								<?php
									if (isset($_GET['page'])) {
										echo "<span style='color:red'>". en2f_number($_GET['page'])."</span>";
									}else{
										echo "<span style='color:red'>". en2f_number(1)."</span>";
									}
								 ?> 
								 از <?php 
								 $per_page=ceil($page_number/25);
								 echo en2f_number($per_page); ?></td>
								<td style="width:50%"></td>
								<td style='width:81px;'>انتخاب صفحه:</td>
								<td>
									<?php 
									echo "<select name='page' style='margin-bottom:0px;'>";
									for($i=1; $i<= $per_page; $i++) {
										$select_i=en2f_number($i);
									if (isset($_GET['page'])) {
										$pages=$_GET['page'];
										if ($i==$pages) {
											echo "<option value='$i' selected>$select_i</option>";
											continue;
										}else{
											echo "<option value='$i'>$select_i</option>";
											continue;
										}
									}else{
											echo "<option value='$i'>$select_i</option>";
											continue;
										}
									}
									?>
									</select>
								</td>
								<td>
									<?php 
									if (isset($_GET['year']))
									{
										echo "<input type='hidden' name='year' value='$year'>";
									}
									?>
									<input type='hidden' name='cur' value='<?php echo get_currency_id('cur_id'); ?>'>
									<input type='submit' class='btn btn-primary' value='تائید'>
								</td>
							</tr>
						</table>
					</form>
					<?php	}
				echo "</div>";
				 ?>
					
		</div>
		</div>
		<div style='clear:both;'></div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	