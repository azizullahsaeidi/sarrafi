<?php 
	//session_start(); if(!isset($_SESSION['user_login'])) { header("Location:login.php?login=false");  }
if (isset($_GET['item_edit_id'])) {
	//$setting_currency_id=$_GET['setting_currency_id'];
	$title='ویرایش کالا';
}

?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); ?>

	<!-- Begining of Content -->
		<div class="content">
			
		<div class='span11 messages'>
			<?php include("alert_messages.php"); ?>
			<?php if (isset($_GET['item_edit_id'])) {
				$item_edit=(int)$_GET['item_edit_id'];
				$anbar_code=(int)$_GET['anbar_code'];
				$cur_query=mysql_query("select * from currency",$con);
				$item_type_query=mysql_query("select * from item_type",$con);
				$query=mysql_query("select * from anbar",$con);
				$product_query=mysql_query("select * from item,currency,item_type,anbar where i_id=$item_edit and currency=cur_id and denomination=item_id and anbar.anbar_code=item.anbar_code",$con);
				$row=mysql_fetch_assoc($product_query);extract($row);
				$total_code=explode("/", $i_code);
			?>
			<a href="product_list.php">
				<span class="btn btn-primary pull-left">برگشت <l class="icon-arrow-left icon-white" style="margin-top: 3px;padding-right: 5px;"></l></span>
			</a>		
		</div>
			<div class="span11 messages text-center">
				<table class="table_setting "style="width:50%;margin-right:222px">

				<form action="../controller/product_query.php" method="post">
					<tr> <th colspan='2' id="form_title_center"><h3>ویرایش کالا</h3></th></tr>
					<tr>
						<td class='label_align'><br>کد کالا:</td>
						<td class='input_align' style="direction:ltr">
							<span id="x-small-label-f">کد سری</span>
							<span id="x-small-label-s">کد گروه</span>
							<span id="x-small-label-t">کد انبار</span><br>
							<input type="number" id="x-small-t" min="0" max='99' readonly name="edit_anbar_code"  value="<?php echo $total_code[0]; ?>" style="text-align:center" placeholder="کد انبار" required>/
							<input type="number" id="x-small-s" min="0" max='9999' readonly name="edit_pro_code"  value="<?php echo $total_code[1]; ?>" style="text-align:center" placeholder="کد کالا" required >/
							<input type="number" id="x-small-f" min="0" max='999' name="edit_price_code" value="<?php echo $total_code[2]; ?>" style="text-align:center"  placeholder="کد قیمت" required >
						</td>
					</tr>
					<tr>
						<td class='label_align'> نام کالا :</td>
						<td class='input_align'><input type="text" lang='fa' id="porduct_name_field" min="1" value="<?php echo $i_name;?>" name="edit_product_name"  placeholder="نام کالا" required>
							<select name='edit_item_type_id' required id="item_type_dropdown"> 
								<?php
									while ($item_row=mysql_fetch_assoc($item_type_query)) {extract($item_row);
										if ($item_id==$denomination) {
										echo "<option value='$item_id' selected='selected'>$item_name</option>";
										}else{
										echo "<option value='$item_id'>$item_name</option>";
										}
									}
								 ?>
							</select>
						</td>
						
					</tr>
					<tr>
						<td class='label_align'>قیمت فی واحد:</td>
						<td class='input_align'>
							<input type="number" id="unit_price" min="1" value="<?php echo $unit_price;?>" name="edit_unit_price" placeholder="قیمت فی واحد" required>
							<select name='edit_currency_id' id="rased_currency"> 
								
								<?php echo $currency;
									while ($cur_row=mysql_fetch_assoc($cur_query)) {extract($cur_row);
										if ($cur_id==$currency) {
										echo "<option value='$currency' selected='selected'>$cur_name</option>";
										}else{
										echo "<option value='$cur_id'>$cur_name</option>";
										}
									}
								 ?>
							</select>
						</td>
					</tr>
					
					
					
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
							
								<input type="hidden" name="edit_i_id" class='' value="<?php echo $_GET['item_edit_id']; ?>">
								<input type="hidden" name="anbar_code" class='' value="<?php echo $_GET['anbar_code']; ?>">
						
						<input type="submit" class='btn btn-primary' id="just_submit" value="تائید">
						
						</td>
					</tr>
					
					
					</form>	
				</table>
			<?php } ?>
			</div>
			</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	