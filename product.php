<?php $title=" تعریف کالا"; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
include("alert_messages.php"); 
$query=mysql_query("select * from anbar",$con);
$cur_query=mysql_query("select * from currency",$con);
$item_type_query=mysql_query("select * from item_type",$con);
$product_query=mysql_query("select * from item,anbar where anbar.anbar_code=item.anbar_code",$con); ?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11' style="width:884px;margin:0px;min-height:24px;padding:5px 20px;">
			<a href="product_list.php">
				<span class="btn btn-primary ">لیست کالا ها <l class="icon icon-list icon-white" style='margin-top:2px;'></l></span>
			</a>
				<span class="btn btn-primary pull-left" onCLick="location.reload()" style="border-radius:0px;">تازه سازی صفحه <l class="icon icon-refresh icon-white" style='margin-top:3px;'></l></span>
		</div>
		<!-- <div class='span11 messages'>
		<?php full_alert_message(); ?>
		</div> -->
			<div class="span6 add_table" >
				<table class="table_setting">
				<form action="../controller/product_query.php" method="post" id="add_product_anbar">
					<tr> <th colspan='2' id="form_title_center"><h3>تعریف کالا جدید</h3></th></tr>
					<tr>
						<td class='label_align'>کد کالا:</td>
						<td class='input_align' style="direction:ltr">
							<input type="text" id="x-small-code" class='x_small_code' name="product_full_code"  style="" placeholder="کد کالا" required>
						</td>
					</tr>
					<tr>
						<td class='label_align'> نام کالا :</td>
						<td class='input_align'><input type="text" onmouseover="Tip('پس از وارد کردن ایمیل بر روی دکمه ثبت کلیک کنید')" onmouseout="UnTip()" lang='fa' id="porduct_name_field" min="1" name="product_name"  placeholder="نام کالا" required>
							<select name='item_type_id' required id="item_type_dropdown"> 
								<option value="no_select_third">واحد شمارش</option>
								<?php
									while ($item_row=mysql_fetch_assoc($item_type_query)) {extract($item_row);
										echo "<option value='$item_id'>$item_name</option>";
									}
								 ?>
							</select>
						</td>
					</tr>
					<tr>
						<td class='label_align'> فی :</td>
						<td class='input_align'>
							<input type="number" id="unit_price" min="1" name="unit_price" placeholder=" فی " required>
							<select name='currency_id' id="rased_currency"> 
								<option value="no_select_four" >واحد پولی</option>
								<?php
									while ($cur_row=mysql_fetch_assoc($cur_query)) {extract($cur_row);
										echo "<option value='$cur_id' id='cur$cur_id'>$cur_name</option>";
									}
								 ?>
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
						<input type="submit" class='btn btn-primary' value="ثبت کالا">
						<input type="reset" class='btn btn-primary'  value="پاک کردن">
						</td>
					</tr>
					</form>	
				</table>
			</div>
			<div class="span4 show_table" style="height:420px;overflow: scroll;width:308px;padding:20px;" >
					<table class="table_setting" border="1" style='width:280px;'>
						<tr> <th colspan='3'>لیست انبار های موجود در سیستم</th></tr>
						<tr>
							<th>ردیف</th>
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