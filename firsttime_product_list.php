<?php 
		$title="اول دوره";
		$type='r';
include("../includes/connection.php"); ?>
<?php include("../includes/cur_year.php"); ?>
<?php include("../includes/header.php"); 
include("alert_messages.php");
$query=mysql_query("select * from anbar",$con);
$anbar_type=$type;
$cur_year=$y_year;

?>
	<!-- Begining of Content -->
		<div class="content">
		
		<div class='span11' style="width:888px;margin:0px;min-height:30px;padding:5px 20px;cursor:pointer">
			
			<a href="first_product_list.php?cur=<?php echo $_GET['cur']; ?>">
				<span class="btn btn-primary" style="padding:6px 14px;"> <l class="icon icon-list icon-white" style='margin-top:2px;'></l> لیست اول دوره</span>
			</a>
			
			

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
							<input type="number"  id="product_number" min="1" name="firsttime_pro_number" placeholder="تعداد کالا" required >
							
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
						
						<input type="hidden" name="select_currency" id="select_currency" value="<?php echo $_GET['cur']; ?>">
						<input type="hidden" name="item_f_id" id='item_f_id'>
						<input type="hidden" name="factor_num" class='' value="">
						<input type="hidden" name="type" id='anbar_type' value="r">
						<input type="submit" class='btn btn-primary' value="ثبت">
						<input type="reset" class='btn btn-primary'  value="پاک کردن">
						</td>
					</tr>
					
					
					</form>	
				</table>
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