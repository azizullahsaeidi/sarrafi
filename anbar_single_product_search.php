<?php $title=" کاردکس کالا"; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
$query=mysql_query("select * from anbar",$con);
$product_query=mysql_query("select * from item,anbar where anbar.anbar_code=item.anbar_code",$con);
?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11' style="width:884px;margin:0px;min-height:24px;padding:5px 20px;">
			<a href="product_list.php">
				<span class="btn btn-primary pull-left">لیست کالا ها</span>
			</a>
			<span class="btn btn-primary" onCLick="location.reload()">تازه سازی صفحه</span>
		</div>
			<?php if($_SESSION['user_qualification']=='admin'){; ?>
		<div class='span11 messages'>
		<?php include("alert_messages.php");  ?>

		</div>
		<?php } ?>
			<div class="span6 add_table">
				<table class="table_setting" >
				<form action="anbar_single_result.php" method="get" id="anbar_single_product_s">
					<tr> <th colspan='2'><h3>اضافه کردن کالا جدید</h3></th></tr>
					<tr>
						<td class='label_align'>کد کالا:</td>
						<td class='input_align' style="direction:ltr">
							
							<input type="text" id="x-small-code" min="0"  max='99' name="anbar_code"  style="text-align:center" placeholder="کد کالا" readonly required>
						</td>
					</tr>
					
					<tr>
						<td class='label_align'> از :</td>
						<td class='input_align'>
							
							<select name="anbar_year_az" id="anbar_year_az">
								<option value="anbar_year_az">سال</option>
								<?php for ($year=1395; $year<1410;$year++) {
									$p_y=en2f_number($year);
								echo "<option value='$year'>$p_y</option>";
								} ?>
							</select>
							<select name="anbar_month_az" id="anbar_month_az">
								<option value="anbar_month_az">ماه</option>
								<?php for ($month=1; $month<13;$month++) {
								$p_m=en2f_number($month);
								echo "<option value='$month'>$p_m</option>";
								} ?>
							</select>
							<select name="anbar_day_az" id="anbar_day_az">
								<option value="anbar_day_az">روز</option>
								<?php for ($day=1; $day<32;$day++) {
									$p_i=en2f_number($day);
									echo "<option value='$day'>$p_i</option>";
								} ?>
							</select>
						</td>
					</tr>
					<tr>
						<td class='label_align'>تا :</td>
						<td class='input_align'>
							
							<select name="anbar_year_ta" id="anbar_year_ta">
								<option value="anbar_year_ta">سال</option>
								<?php for ($year=1395; $year<1410;$year++) {
								$p_y=en2f_number($year);
								echo "<option value='$year'>$p_y</option>";
								} ?>
							</select>
							<select name="anbar_month_ta" id="anbar_month_ta">
								<option value="anbar_month_ta">ماه</option>
								<?php for ($month=1; $month<13;$month++) {
									$p_m=en2f_number($month);
								echo "<option value='$month'>$p_m</option>";
								} ?>
							</select>
							<select name="anbar_day_ta" id="anbar_day_ta">
								<option value="anbar_day_ta">روز</option>
								<?php for ($day=1; $day<32;$day++) {
								$p_i=en2f_number($day);
									echo "<option value='$day'>$p_i</option>";
								} ?>
							</select>
						</td>
					</tr>
					
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
							<?php if(isset($_GET['num'])){?>
								<input type="hidden" name="rased_type" class='' value="many">
								<input type="hidden" name="factor_num" class='' value="<?php echo $_GET['num']; ?>">
							<?php }else{ ?>
								<input type="hidden" name="rased_type" class='' value="one">
							<?php } ?>
						<input type="submit" class='btn btn-primary' value="جستجو" style="width:246px;">
						
						</td>
					</tr>
					
					
					</form>	
				</table>
			</div>
			<div class="span4 show_table" >
					<table class="table_setting" border="1">
						<tr> <th colspan='3'>لیست انبار های موجود در سیستم</th></tr>
						<tr>
							<th>شماره</th>
							<th>کد انبار</th>
							<th>نام انبار</th>
							
						</tr>
						<tbody id="getting_anbar_code">
						<?php $i=1; while($row=mysql_fetch_assoc($query)){ 
						extract($row);

						echo "<tr id='$anbar_code' onCLick='show_product(this.id)'>";
						$count_id=en2f_number($i);
						//$zero=en2f_number(0);
							echo "<td > $count_id  </td>"; $i++;
							if ($anbar_code<10) {
								$id="۰$anbar_code";
							echo "<td >  $id</td>";
							}else{
						$anb=en2f_number($anbar_code);
							echo "<td > $anb</td>";
						}
							echo "<td o> $anbar_name</td>";
							?>
							</tr>
						<?php }?>
						</tbody>
					
					</table>
			</div>
			</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	