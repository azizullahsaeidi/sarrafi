<?php $title="بخش مدیریت "; ?>
<?php include("../includes/connection.php"); ?>
<?php 
include("../includes/header.php"); 
include("alert_messages.php");
if (isset($_GET['serial_num'])) {
$serial_no=$_GET['serial_num'];
}else
{
	$serial_no=0;
}
$query=mysql_query("select anbar_name,i_name,item_name,de_id,de_serial_no,de_quantity,de_unit_price,de_total_price,cur_name from 
	anbar,item,item_details,currency,item_type where de_serial_no=$serial_no and de_currency_id=cur_id and 
	de_item_type_id=item_id and de_i_id=i_id and anbar.anbar_code=item.anbar_code",$con);
?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 search_area'>
		<?php alert_messages();?>
		
			<form action="../controller/anbar_query.php" method="post">
				<span id="anbar_search_label">جستجو بر اساس: </span>
				<label for="pro_price_opt" id='pro_price_opt_label'>قیمت کالا:</label><input type='radio' id='pro_price_opt' name='search'>
				<label for="pro_opt" id='pro_opt_label'>کالا:</label><input type='radio' id='pro_opt' name='search'>
				<label for="anbar_opt" id='anbar_opt_label'>انبار:</label><input type='radio' id='anbar_opt' name='search'><br>
				<input type='text' value="" name="" id="search_box" placeholder="جستجو بر اساس کد قیمت کالا" >
				<input type="submit" class="btn btn-primary" value="تائید بیل" id="" style="">
			</form>
			
		</div>
			<div class="span11 messages">
				<table class="table_setting" border="1">
					<tr> <th colspan='11'>لیست مدیران سیستم</th></tr>
					<tr>
						<th>شماره</th>
						<th>نام انبار</th>
						<th>نام کالا</th>
						<th>واحد کالا</th>
						<th>شمار بیل</th>
						<th>تعداد کالا</th>
						<th>قیمت فی</th>
						<th>قیمت کل</th>
						<th>واحد پول</th>
						<?php if (!isset($_GET['status'])) { ?>
						<th>ویرایش</th>
						<th>جذف</th>
						<?php } ?>
					</tr>
					<?php if (mysql_num_rows($query)>0) { $i=1;
					while($row=mysql_fetch_assoc($query)){ 
					extract($row);
					echo "<tr>";
						echo "<td> $i 		</td>";
						$i++; echo "<td> $anbar_name 		</td>";
						echo "<td> $i_name 	</td>";
						echo "<td> $item_name 	</td>";
						echo "<td> $de_serial_no </td>";
						echo "<td> $de_quantity </td>";
						echo "<td> $de_unit_price </td>";
						echo "<td> $de_total_price </td>";
						echo "<td> $cur_name </td>";
						if (!isset($_GET['status'])) {
						echo "<td> <a href='anbar_rased_edit.php?details_edit_id=$de_id'><span class='icon icon-edit'></span></a> </td>";?>
						<td> <a href='../controller/anbar_query.php?details_delete_id=<?php echo $de_id?>&serial_num_delete=<?php echo $_GET['serial_num']; ?>' onClick="return confirm('آیا حاضر به حذف این مورد هستید؟')"><span class='icon icon-trash admin_icon_trash'></span></a></td>
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