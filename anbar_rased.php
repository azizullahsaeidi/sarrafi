<?php 
if ($_GET['type']=='r') {
		$title="رسید انبار";
	}elseif ($_GET['type']=='h') {
		$title="حواله انبار";
	}
	$num=$_GET['num'];
	?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/cur_year.php"); ?>
<?php include("../includes/header.php"); 
include("alert_messages.php");
$query=mysql_query("select * from anbar",$con);
$anbar_type=$_GET['type'];
$cur_year=$y_year;
$serial_query=mysql_query("select max(de_serial_no) de_serial_no from item_details where de_reg_type='$anbar_type' and de_date like '$cur_year%' limit 1",$con);
$serial_row=mysql_fetch_assoc($serial_query);
$serial_number=$serial_row['de_serial_no'];
?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php full_alert_message();
		if (!isset($_GET['opt'])) { 
		if ($serial_number+1>1) { 
			echo "<div class='alert alert-danger' id='alert_messages' style='width:700px;padding:4px 20px;'><span class='text-right ' >توجه! </span> آیا حاضر به ایجاد برگ جدید هستید؟</div>";?>
		<a href="../controller/product_query.php?type=<?php echo $_GET['type']; ?>&s_n=<?php echo $serial_number; ?>&cur=<?php echo get_currency_id('cur_id'); ?>&anbar_temp=true" target="_blank">
			<span class="btn btn-primary pull-left">آخرین برگ رسید وجه </span></a>
		<?php }} ?>
		</div>
		<div class='span11' style="width:888px;margin:0px;min-height:30px;padding:5px 20px;cursor:pointer">
			<?php if(isset($_GET['s_n'])){ ?>
			<a href="anbar_rased_list.php?serial_num=<?php echo $_GET['s_n']; ?>&type=<?php echo $_GET['type']; ?>&cur=<?php echo $_GET['cur']; ?>">
				<span class="btn btn-primary pull-left" style="padding:6px 14px;">لیست کالا ها <l class="icon icon-list icon-white" style='margin-top:2px;'></l></span>
			</a>
			<?php }?>
			<?php if(isset($_GET['num'])>=2 && isset($_GET['s_n'])) { ?>
						<span class="badge badge-success" style="height:30px;font-size:14px;"><?php
						if ($_GET['type']=='r') {
							echo "بخش رسید.";
						}elseif ($_GET['type']=='h') {
							echo "بخش حواله.";
						}

						 ?> <br>شماره 
						 <?php
						 if ($_GET['type']=='r') {
							echo " رسید.";
						}elseif ($_GET['type']=='h') {
							echo " حواله.";
						}
						 ?>
						 : <?php echo " ". en2f_number($_GET['s_n']); ?></span> 
						 <span class="badge badge-success" style="height:30px;font-size:14px;">
						
						

						 <br>شماره : <?php echo " ". en2f_number($_GET['num']); ?></span> 
						<?php }else{ ?>
						<span class="badge badge-info" style="height:30px;font-size:14px;font-family:bbc_bold;border-radius:0px;"><?php
						if ($_GET['type']=='r') {
							echo "بخش رسید.";
						}elseif ($_GET['type']=='h') {
							echo "بخش حواله.";
						}

						 ?> <br>شماره
						 <?php
						 if ($_GET['type']=='r') {
							echo " رسید";
						}elseif ($_GET['type']=='h') {
							echo " حواله";
						}
						 ?>
						 : <?php echo " ".en2f_number($serial_number+1); ?></span> 
						 <span class="badge badge-info" style="height:30px;font-size:14px;font-family:bbc_bold;border-radius:0px;">
						
						

						 <br>شماره ردیف: <?php echo " ". en2f_number($num); ?></span>
						<?php } ?>

						<a href="anbar_rased.php"></a>
				<span class="btn btn-primary pull-left" style="padding:6px 14px; margin-left:5px;" onClick="location.reload();">تازه سازی صفحه <l class="icon icon-refresh icon-white" style='margin-top:3px;'></l></span>
		</div>
		<!-- <div class='span11 messages'>
		<?php //include("alert_messages.php"); ?>
		</div> -->
			<div class="span6 add_table">
				<table class="table_setting">
				<form action="../controller/anbar_query.php" method="post" id="hawala_rased_anbar">
					
					
					<tr>
						<td class='label_align'>کد کالا:</td>
						<td class='input_align' style="direction:ltr">
							<input type="text" id="x-small-code" min="01" max='99' name="anbar_code" readonly style='text-align:center'   placeholder="کد کالا" required>
						</td>
					</tr>
					<tr>
						<td class='label_align'> نام کالا :</td>
						<td class='input_align'><input type="text" id="anbar_porduct_name_field" min="1" name="product_name" readonly  placeholder="نام کالا" required>
							
							<input type="text" name="item_type_name" id="item_type_name" placeholder="واحد شمارش" readonly>
						</td>
						
					</tr>
					<tr>
						<td class='label_align'> فی :</td>
						<td class='input_align'>
							<input type="number" id="anbar_unit_price" min="1" name="unit_price" placeholder=" فی " required readonly>
							
							<input type="text" name="currency_name" id="rased_currency_name" placeholder="واحد پولی" readonly>
						</td>
					</tr>
					<tr>
						<td class='label_align'>تعداد کالا:</td>
						<td class='input_align'>
							<input type="number"  id="product_number" min="1" name="pro_number" placeholder="تعداد کالا" required >
							
						</td>
					</tr>
					<tr>
						<td class='label_align'>جمع:</td>
						<td class='input_align'>
							<input type="text" id="final_result" min="1" name="final_result" placeholder=" جمع" required readonly>
						</td>
					</tr>
					<tr>
						<td class='label_align'>تعداد کالای موجود:</td>
						<td class='input_align'>
							<input type="text" id="exist_pro" min="1" name="exist_pro" placeholder="تعداد کالا های موجود در سیستم" required readonly>
						</td>
					</tr>
					<tr>
						<td class='label_align'>مجموع کل:</td>
						<td class='input_align'>
							<input type="text" id="total_count" min="1" name="total_count" placeholder="مجموع کل" required readonly>
						</td>
					</tr>
					

					
					
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
						<?php if(isset($_GET['num'])>=2 && isset($_GET['s_n'])) { ?>
						<input type="hidden" name="add_serial_no" class='' value="<?php echo $_GET['s_n']; ?>">
						<?php }else{ ?>
						<input type="hidden" name="add_serial_no" class='' value="<?php echo $serial_number+1; ?>">
						<?php } ?>
						<input type="hidden" name="select_currency" id="select_currency" value="<?php echo $_GET['cur']; ?>">
						<input type="hidden" name="item_f_id" id='item_f_id'>
						<input type="hidden" name="factor_num" class='' value="<?php echo $_GET['num']; ?>">
						<input type="hidden" name="type" id='anbar_type' value="<?php echo $_GET['type']; ?>">
						<input type="submit" class='btn btn-primary' id='anbar_rasid_submit' value="ثبت">
						<input type="reset" class='btn btn-primary'  value="پاک کردن">
						</td>
					</tr>
					
					
					</form>	
				</table>
				<p class="text-center" style="color:red;font-size: 17px;display: none" id="error_message">
					ببخشید! تعداد کالای موجود در سیستم کمتر از مورد خواسته شده می باشد.
				</p>
			</div>
			<div class="span4 show_table" style="height:390px;overflow: scroll;" >
					<table class="table_setting" border="1">
						<tr> <th colspan='3'>لیست انبار های موجود در سیستم</th></tr>
						<tr>
							<th>ردیف</th>
							<th>کد انبار</th>
							<th>نام انبار</th>
							
						</tr>
						<tbody id="product_anbar_code">
						<?php $i=1; while($row=mysql_fetch_assoc($query)){ 
						extract($row);

						echo "<tr id='$anbar_code'>";
						$count_id=en2f_number($i);
						$zero=en2f_number(0);
							echo "<td > $count_id  </td>"; $i++;
							if ($anbar_code<10) {
								$id="۰$anbar_code";
							echo "<td >  $id</td>";
							}else{
						$anb=en2f_number($anbar_code);
							echo "<td > $anb</td>";
						}
							echo "<td > $anbar_name</td>";
							?>
							</tr>
						<?php }?>
						</tbody>
					
					</table>
			</div>
			</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	