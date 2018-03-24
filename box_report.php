<?php $title="گزارش دفتر صندوق";
include("../includes/connection.php");
include("../includes/cur_year.php");
//include("../includes/currency_name.php");
include("../includes/header.php"); 
include("alert_messages.php");
$page="";
$page1="";
$count_sum=0;
$count_consume=0;
$count_total=0;
$added=0;
$extract=0;
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
		$sum=0;
		$consume=0;
if (!isset($_GET['year']))
{
	$year=jdate("Y");
}
else if (isset($_GET['year']))
{
	$year=$_GET['year'];
}
$cur_id=$_GET['cur'];
$pagination_query=mysql_query("SELECT 
		box_id
	FROM 
		box 
	WHERE 
		box_cur_id=$cur_id 
	
	and (box_status ='a_perm' or box_status='p_perm')
	and box_date like '$year-%'",$con);
if (isset($_GET['page']) && $_GET['page']!=1) {
	$p=$_GET['page'];
$count_page=($p-1)*25;
$counting_query=mysql_query("SELECT 
		box_amount,box_type
	FROM 
		box 
	WHERE 
		box_cur_id=$cur_id 
	
	and (box_status ='a_perm' or box_status='p_perm')
	and box_date like '$year-%' limit 0,$count_page",$con);
	while ($count_row=mysql_fetch_assoc($counting_query))
	{
		$count_amount=$count_row['box_amount'];
		$count_type=$count_row['box_type'];
		if ($count_type=='a')
		{
	    	$count_amount."<br>";
				$count_sum+=$count_amount."<br>";
		}
		elseif ($count_type=='e')
		{
			$count_amount;
			$count_consume+=$count_amount;
		}
	}
}
$query=mysql_query("SELECT 
		box_date,box_amount,box_serial_no,box_reason,box_type 
	FROM 
		box 
	WHERE 
		box_cur_id=$cur_id 
	
	and (box_status ='a_perm' or box_status='p_perm')
	and box_date like '$year-%' limit $page1,25",$con);
if (!isset($_GET['year']))
{
	$year=$y_year;
}
else if (isset($_GET['year']))
{
	$year=$_GET['year'];
}
//$year=$y_year;
$f_t_year=$year-1;

$add_query=mysql_query("select sum(box_amount) box_amount from box where box_cur_id=$cur_id and box_type='a' and box_status='a_perm' and (box_date <= '$f_t_year-12-30')",$con);
$take_query=mysql_query("select sum(box_amount) box_amount from box where box_cur_id=$cur_id and box_type='e' and box_status='p_perm' and (box_date <= '$f_t_year-12-30')",$con);

$add_row=mysql_fetch_assoc($add_query);
$take_row=mysql_fetch_assoc($take_query);

$add_value=$add_row['box_amount'];
$take_value=$take_row['box_amount'];

$f_value=$add_value-$take_value;





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
						<th colspan='3' style='border-left:0px;border-top:0px'>دفتر صندوق ( <?php get_currency_id('cur_name'); ?> ) شاخه  ( <?php echo $province_row['pro_name']; ?> ) در سال  <?php echo en2f_number(jdate("Y")); ?> </th>
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
								$first_one=$count_sum+$f_value;
								echo en2f_number(number_format($count_sum+$f_value));
							}else{
								$first_one=$count_sum+$f_value;
								echo en2f_number(number_format($count_sum+$f_value));
								}?>
						</td>
						<td>
							<?php if(isset($_GET['page'])){
								$second_one=$count_consume;
								echo en2f_number(number_format($count_consume));
							}?>
						</td>
						<td>
						<?php
							
								$exist_amount=($count_sum-$count_consume)+$f_value;
							
						 ?>
							<?php if(isset($_GET['page'])){
								
								echo en2f_number(number_format($exist_amount));
							}else{
								echo en2f_number(number_format($exist_amount));
								}
								?>
						</td>
					</tr>
					</thead>
					<tbody id='box_report'>
					<?php //ECHO mysql_num_rows($query);die;
					$sum=$exist_amount;
					$sums=$exist_amount;
					if(mysql_num_rows($query)>=1){
						
						while ($row=mysql_fetch_assoc($query)) {
						extract($row);
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
						$box_date=en2f_number($box_date);
						$box_a=en2f_number(number_format($box_amount));
						
						echo "<tr>";
						echo "<td>$box_serial</td>";
						$insetDate=explode('-', $box_date);
						$new_date =$insetDate[0].'/'.$insetDate[1].'/'.$insetDate[2];
						echo "<td>$new_date</td>";
						echo "<td>$box_reason</td>";
						if ($box_type=='a') {
							echo "<td>$box_a</td>";
							$sum+=$box_amount;
							$added+=$box_amount;
							$sums+=$box_amount;
							$add_sum=en2f_number(number_format($sum));
							echo "<td></td>";
							echo "<td>$add_sum</td>";
						}elseif ($box_type=='e') {
							echo "<td></td>";
							echo "<td>$box_a</td>";
							$extract+=$box_amount;
							$consume+=$box_amount;
							$sum=$sum-$box_amount;
							$cons=$consume;
							$extract_box=en2f_number(number_format($sum));
							echo "<td>$extract_box</td>";
						}
						echo "</tr>";
					}
						echo "</tbody>";
						echo "<tr>";
							//$cur_name=get_currency_id('cur_name');
							echo "<td colspan='3'>جمع / نقل به صفحه بعد ( ";
							get_currency_id('cur_name');
							echo " )</td>";
							$total_sum=en2f_number(number_format($added+$first_one));
							$total_consume=en2f_number(number_format($extract+$count_consume));
							$remain=$sums-$consume;
							$total_remain=en2f_number(number_format($remain));
							echo "<td>$total_sum</td>";
							echo "<td>$total_consume</td>";
							echo "<td>";
							echo $total_remain;
							echo "</td>";
						echo "</tr>";
				} ?>
				
				</table>
				<table>
					<tr><th colspan="6" style="min-height: 20px;border: 0px" border="1"></th></tr>
				</table>
				
				<div style="margin-top: 10px">
					<l style='font-size: 20px;'>تهیه کننده:...............................</l>
					<l style='font-size: 20px;margin-right: 300px'>تصویب کننده:...............................</l>
				</div>
				<?php 
				echo "<div style='clear:both'></div>";
				echo "<div style='text-align:left;margin-top:5px;' id='box_pagination'> ";
					if (mysql_num_rows($pagination_query)>=25) { 
						$page_number=mysql_num_rows($pagination_query);?>
					<form action='box_report.php' method='get'>
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