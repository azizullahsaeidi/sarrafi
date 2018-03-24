<?php $title="گزارش انبار گردانی"; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/cur_year.php"); ?>
<?php 
include("../includes/header.php"); 
include("alert_messages.php");
$anbar_query=mysql_query("select * from anbar",$con);
$currency_query=mysql_query("select * from currency",$con);
$current_year=date("Y");
if (isset($_GET['serial_num'])) {
$serial_no=$_GET['serial_num'];
}else
{
	$serial_no=0;
}
$cur_year=$y_year;
$pagination_query=0;
?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 search_area'>
		<?php alert_messages();?>
			<form action="anbar_gardani_report.php" method="get" id="anbar_rased_report_form_g" style="display:inline;">
				<select id="rased_anbar_code" class="search_anbar" name="add_anbar_code">
					<option value="anbar_search">انتخاب انبار</option>
					<?php while ($anbar_row=mysql_fetch_assoc($anbar_query)) { extract($anbar_row);
						if(isset($_GET['add_anbar_code'])){
							$an_code=$_GET['add_anbar_code'];
							if ($anbar_code==$an_code) {
								echo "<option value='$anbar_code' selected>$anbar_name</option>";
								continue;
							}else{
								echo "<option value='$anbar_code'>$anbar_name</option>";
								continue;
							}
						}else{
							
						echo "<option value='$anbar_code'>$anbar_name</option>";
						}
					} ?>
				</select>
			
				<select id="currency_id" class="currency_opt" name="currency_id">
					<option value="currency_id">واحد پول</option>
					<?php while ($currency_row=mysql_fetch_assoc($currency_query)) { extract($currency_row);
						if(isset($_GET['currency_id'])){
							$c_id=$_GET['currency_id'];
							if ($cur_id==$c_id) {
								echo "<option value='$cur_id' selected>$cur_name</option>";
								continue;
							}else{
								echo "<option value='$cur_id'>$cur_name</option>";
								continue;
							}
						}else{
							echo "<option value='$cur_id'>$cur_name</option>";
						}
					} ?>
				</select>
				
				<input type="submit" class="btn btn-primary" value="جستجو" id="" style="margin-bottom:10px;width:85px">
			</form>
			
		<span class='btn btn-primary pull-left' style="width:60px;" onClick="return window.print();">
			چاپ <l class="icon icon-print icon-white" style="margin-top:3px;"></l ></span>
			
			
		</div>
		<div class="span11 messages" id='box_report'>
				<?php if (isset($_GET['add_anbar_code']) && isset($_GET['currency_id'])) 
				{

					$page="";
					$page1="";
					if (isset($_GET['page'])) {
						$page=$_GET['page'];
						
					
						if ($page=="" || $page==1) {
							$page1=0;
						}else{
							$page1=($page*70)-70;
						}
					}else{
						$page1=0;
					}

					$anbar_code 	=(int)$_GET['add_anbar_code'];
					
					$currency_id 	=(int)$_GET['currency_id'];
					$product_query=mysql_query("select i_name,i_code,unit_price from item where anbar_code=$anbar_code and currency=$currency_id and i_year<='$cur_year-12-30' limit $page1,60"); 
					$pagination_query=mysql_query("select i_name,i_code,unit_price from item where anbar_code=$anbar_code and currency=$currency_id and i_year>='$cur_year'"); ?>
				<table class="table_setting"  style="width:100%">

					<tr>
						<th colspan='2' rowspan='2' style='text-align:right;'> <img src='../images/committee_logo.png' style='width:70px;padding:2px;'> </th>
						<th colspan='5'  style='border-left:0px;border-bottom:0px;padding-right:40px;'>
							دفتر نمایندگی کمیته امداد امام خمینی (ره) در کشور افغانستان</th>
						<th colspan='3' style='width:75px;border-right:0px;border-bottom:0px'>شماره صفحه: <?php if(isset($_GET['page'])){ echo en2f_number($_GET['page']); }else{ echo en2f_number(1); } ?></th>
					</tr>
					<?php if(isset($_GET['add_anbar_code'])){ 
					$a_code 	=(int)$_GET['add_anbar_code'];
						$c_id 	=(int)$_GET['currency_id'];
						$gen_query=mysql_query("select cur_name,anbar_name from currency,anbar where cur_id=$c_id and anbar_code=$a_code limit 1",$con);
						$gen_row=mysql_fetch_assoc($gen_query);
				?>
					<tr>
						<th colspan='5' style='border-left:0px;border-top:0px;;padding-right:40px;'>
							گزارش انبار ( <?php echo $gen_row['anbar_name']; ?> ) <l style='margin-right:20px '></l> مبلغ ( <?php echo  $gen_row['cur_name']; ?> )</th>
						<th colspan='3' style='border-right:0px;border-top:0px'>سال: <?php echo en2f_number(jdate("Y")); ?></th>
					</tr>
					<?php } ?>
					
				</table>
				<table class="table_setting" border="1">
					<tr> <th colspan='8'>لیست کالا  <?php  ?></th></tr>
					<tr>
						<th>ردیف</th>
						<th>کد کالا</th>
						<th>شرح کالا</th>
						<th>مانده</th>
						<th>شمارش اول</th>
						<th>شمارش دوم</th>
						<th>شمارش سوم</th>
						<th>مغایرت</th>
					</tr>
					<?php if (mysql_num_rows($product_query)>0) { $i=1;
					while($row=mysql_fetch_assoc($product_query)){ 
					extract($row);
					$rased_query=mysql_query("select sum(de_quantity) rased_total_quantity from item_details where de_reg_type='r' and total_code='$i_code' and de_date <='$cur_year-12-30' ",$con);
					$hawala_query=mysql_query("select sum(de_quantity) hawala_total_quantity from item_details where de_reg_type='h' and total_code='$i_code' and de_date <='$cur_year-12-30' ",$con);
					$anbar_gardani_query=mysql_query("select gar_first,gar_second,gar_third,gar_result from anbar_gardani_report where gar_i_code='$i_code' and gar_year>='$cur_year'",$con);

					$rase_row=mysql_fetch_assoc($rased_query);
					$hawala_row=mysql_fetch_assoc($hawala_query);
					$gar_row=mysql_fetch_assoc($anbar_gardani_query);

					$first=$gar_row['gar_first'];
					$second=$gar_row['gar_second'];
					$third=$gar_row['gar_third'];
					$final_result=$gar_row['gar_result'];
					//$rased_total_price 		=(int)$rase_row['rased_total_price'];
					$rased_total_quantity 	=(int)$rase_row['rased_total_quantity'];
					//$hawala_total_price 	=(int)$hawala_row['hawala_total_price'];
					$hawala_total_quantity 	=(int)$hawala_row['hawala_total_quantity'];
					//$remain_price 			=$rased_total_price-$hawala_total_price;
					$remain_quantity 		=$rased_total_quantity-$hawala_total_quantity;
					


					if($remain_quantity >=1){
					echo "<tr>";
						$counting=en2f_number($i);
						$code_n=en2f_number($i_code);
						$r_q=en2f_number($remain_quantity);
						echo "<td class='remain_quantities'> $counting 		</td>";
						echo "<td> $code_n 	</td>";
						$i++; echo "<td> $i_name 		</td>";
						echo "<td> $r_q </td>";
						if (mysql_num_rows($anbar_gardani_query)>0) {
							$f=en2f_number($first);
						echo "<td> $f 		</td>";
							if ($second=='') {

						echo "<td> <a class='my_print' href='anbar_gardani_counting.php?count=2&i_code=$i_code&cur=$currency_id&page=$page'> <span class='icon icon-edit'></span> </a> </td>";
								# code...
							}else{
								$s=en2f_number($second);
						echo "<td> $s 		</td>";	
							}
							if ($third=='') {
						echo "<td> <a class='my_print' href='anbar_gardani_counting.php?count=3&i_code=$i_code&cur=$currency_id&page=$page'> <span class='icon icon-edit'></span> </a> </td>";
								# code...
							}else{
								$t=en2f_number($third);
						echo "<td> $t		</td>";	
							}
							if ($third==0) {
						echo "<td> </td>";
								# code...
							}else{
								$magaeerat=en2f_number($remain_quantity-$third);
						echo "<td> 	$magaeerat	</td>";	
							}
						}else{
						echo "<td> <a class='my_print' href='anbar_gardani_counting.php?count=1&i_code=$i_code&cur=$currency_id&page=$page'> <span class='icon icon-edit'></span> </a> </td>";
						echo "<td> <a class='my_print' href='anbar_gardani_counting.php?count=2&i_code=$i_code&cur=$currency_id&page=$page'> <span class='icon icon-edit'></span> </a> </td>";
						echo "<td> <a class='my_print' href='anbar_gardani_counting.php?count=3&i_code=$i_code&cur=$currency_id&page=$page'> <span class='icon icon-edit'></span> </a> </td>";
						echo "<td>   </td>";
						}
						 ?>
					</tr>






					<?php } }}else{?>
						<tr> <th colspan='11'>فعلن هیچ دیتا در سیستم موجود نیست.</th></tr>
					<?php } ?>
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
					if (mysql_num_rows($pagination_query)>=70) { 
						$page_number=mysql_num_rows($pagination_query);?>
					<form action='anbar_gardani_report.php' method='get'>
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
								 $per_page=ceil($page_number/70);
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
									<input type='hidden' name='add_anbar_code' value='<?php echo $_GET['add_anbar_code']; ?>'>
									<input type='hidden' name='sd' value='<?php echo $start_date; ?>'>
									<input type='hidden' name='ed' value='<?php echo $end_date; ?>'>
									<!-- <input type='hidden' name='start_day' value='<?php// echo $_GET['start_day']; ?>'>
									<input type='hidden' name='end_year' value='<?php //echo $_GET['end_year']; ?>'>
									<input type='hidden' name='end_month' value='<?php //echo $_GET['end_month']; ?>'>
									<input type='hidden' name='end_day' value='<?php //echo $_GET['end_day']; ?>'> -->
									<input type='hidden' name='currency_id' value='<?php echo $_GET['currency_id']; ?>'>
									<input type='submit' class='btn btn-primary' value='تائید'>
								</td>
							</tr>
						</table>
					</form>
					<?php	}
				echo "</div>";
				}else{ ?>
				<table class="table_setting" border="1">
					<tr> <th colspan='11'>لیست کالا های انبار</th></tr>
					<tr>
						<th >ردیف</th>
						<th>کد کالا</th>
						<th>شرح کالا</th>
						<th>نرخ</th>
						<th>مبلغ وارده</th>
						<th>مبلغ صادره</th>
						<th>مبلغ موجود</th>
						<th>مقدار وارده</th>
						<th>مقدار صادره</th>
						
						<th>مقدار باقی مانده</th>
						
					</tr>
					
						<tr style="height:200px;"> <th colspan='11' ><h1>برای دریافت اطلاعات از فورم بالا استفاده کنید.</h1></th></tr>
					
				</table>
				 <?php }    ?>
		</div>
		</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	