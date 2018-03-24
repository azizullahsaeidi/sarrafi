<?php $title=" تعریف و لیست انبار"; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php");
 include("alert_messages.php");
$query=mysql_query("select * from anbar",$con);
?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php full_alert_message(); ?>
		</div>
			<div class="span5 add_table">
				<table class="table_setting">
				<form action="../controller/anbar_query.php" method="post" id="add_new_anbar">
					<tr> <th colspan='2' id="form_title_center"><h3>تعریف انبار جدید</h3></th></tr>
					<tr>
						<td class='label_align'>انبار جدید: </td>
						<td class='input_align'><input type="text" lang='fa' name="anbar_name"  placeholder="نام انبار جدید" required></td>
					</tr>
					<tr>
						<td class='label_align'>کد  انبار: </td>
						<td class='input_align'><input type="number" lang='fa' id="add_new_anbar_code" min='1' max='99' name="anbar_code" placeholder="کد  انبار" required></td>
					</tr>
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
						<input type="submit" class='btn btn-primary' value="ثبت انبار">
						<input type="reset" class='btn btn-primary'  value="پاک کردن">
						</td>
					</tr>
					
					
					</form>	
				</table>
			</div>
			<div class="span5 show_table">
				<table class="table_setting" border="1">
					<tr> <th colspan='5'>لیست انبار های موجود در سیستم</th></tr>
					<tr>
						<th>ردیف</th>
						<th>کد انبار</th>
						<th>نام انبار</th>
						<th>ویرایش</th>
						<th>حذف</th>
					</tr>
						<?php $i=1; while($row=mysql_fetch_assoc($query)){ 
						extract($row);
						echo "<tr>";
						$count_id=en2f_number($i);
							echo "<td > $count_id  </td>"; $i++;
							if ($anbar_code<10) {
								$id="۰$anbar_code";
							echo "<td >  $id</td>";
							}else{
						$anb=en2f_number($anbar_code);
							echo "<td > $anb</td>";
						}
							echo "<td > $anbar_name</td>";
						echo "<td> <a href='anbar_edit.php?anbar_edit=$anbar_code'><span class='icon icon-edit'></span></a> </td>";?>
						<td> <a href='../controller/anbar_query.php?anbar_delete_id=<?php echo $anbar_id?>' onClick="return confirm('آیا حاضر به حذف این مورد هستید؟')"><span class='icon icon-trash admin_icon_trash'></span></a></td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	