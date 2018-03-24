<?php $title="ویرایش کالا ";
include("../includes/connection.php"); 
include("../includes/header.php");
include("alert_messages.php");
?>
	<!-- Begining of Content -->
		<div class="content">
		<?php
		if (isset($_GET['f_edit_id'])) {
			$details_id=$_GET['f_edit_id'];
			$type='r';
			$de_status='perm';
			$query=mysql_query("SELECT 
									anbar_name,
									i_name,
									item_name,
									i_code,de_id,
									de_serial_no,
									de_quantity,
									unit_price,
									de_total_price,
									cur_name,
									cur_id,
									total_code
								from 
									anbar,
									item,
									item_details,
									currency,
									item_type 
								where de_id=$details_id 
									and currency=cur_id 
									and denomination=item_id 
									and total_code=i_code 
									and anbar.anbar_code=item.anbar_code 
									and de_status='$de_status' 
									and de_reg_type='$type'",$con);


			$row=mysql_fetch_assoc($query);extract($row);
			if ($query) {
				$sum_query=mysql_query("SELECT sum(de_quantity) total_quantity from item_details where total_code='$total_code' and de_reg_type='$type'",$con);
				$sum_row=mysql_fetch_assoc($sum_query);
			}
			
			?>
		<div class='span11 messages'>
		<?php alert_messages();?>
		<?php if(isset($_GET['s_n']) && !isset($_GET['s_n_f'])){ ?>
			<a href="anbar_rased_list.php?serial_num=<?php echo $_GET['s_n']; ?>">
			<span class="btn btn-primary pull-left" > لیست فکتور ها <l class="icon-list icon-white" style="margin-top: 3px;"></l></span>
			</a>
		<?php }?>
		</div>
			<div class="span11 messages">
				<table class="table_setting">
				<form action="../controller/anbar_query.php" method="post" id="hawala_rased_anbar">
					
					
					
					<tr>
						<td class='label_align'>کد کالا:</td>
						<td class='input_align' style="direction:ltr">
							<input type="text"  min="01" max='99' name="product_id_edit" readonly style="text-align:center" value="<?php echo $total_code; ?>" required>
						</td>
					</tr>
					<tr>
						<td class='label_align'> نام کالا :</td>
						<td class='input_align'><input type="text" id="anbar_porduct_name_field" min="1" name="product_name" value="<?php echo $i_name; ?>" readonly   required>
							
							<input type="text" name="item_type_name" id="item_type_name" value="<?php echo $item_name; ?>" placeholder="واحد شمارش" readonly>
						</td>
						
					</tr>
					<tr>
						<td class='label_align'>قیمت فی واحد:</td>
						<td class='input_align'>
							<input type="number" id="anbar_unit_price" value="<?php echo $unit_price; ?>" min="1" name="unit_price"  required readonly>
							
							<input type="text" name="currency_name" value="<?php echo $cur_name; ?>" id="rased_currency_name" readonly>
						</td>
					</tr>
					<tr>
						<td class='label_align'>تعداد کالا:</td>
						<td class='input_align'>
							<input type="number" id="product_number_edit" min="1" value="<?php echo $de_quantity; ?>" name="first_product_number_edit"  required >
							
						</td>
					</tr>
					<tr>
						<td class='label_align'>قیمت کلی:</td>
						<td class='input_align'>
							<input type="text" id="final_result" min="1" name="final_result" value="<?php echo $de_total_price; ?>"  required readonly>
						</td>
					</tr>
					
					
					<tr>
						<td class='label_align'>
						<?php
							if (isset($_GET['s_n_f'])) {
								$s_n_f 	= $_GET['s_n_f'];
								$s_n_t 	= $_GET['s_n_t'];
								$year 	= $_GET['year'];
						echo "<input type='hidden' name='s_n_f'  value='$s_n_f'>";
						echo "<input type='hidden' name='s_n_t'  value='$s_n_t'>";
						echo "<input type='hidden' name='year'  value='$year'>";
							}
						?>
						 </td>
						<td class='submit_reset'>
						<input type="hidden" name="select_currency" id="select_currency" value="<?php echo $cur_id; ?>">
						<input type="hidden" name="de_id"  value="<?php echo $de_id; ?>">
						<input type="hidden" name="type" id='anbar_type' value="<?php if(isset($_GET['type'])){ echo $_GET['type'];} ?>">
						<input type="submit" id="just_submit" class='btn btn-primary' value="تائید">
						
						</td>
					</tr>
					
					
					</form>	
				</table>
				<?php }else{ echo "Something is missed"; }?>
		</div>
		</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	