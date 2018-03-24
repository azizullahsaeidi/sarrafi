<?php $title="بخش سال"; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
$query=mysql_query("select * from year",$con);
?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php if(isset($_GET['cur_opt'])){
			if($_GET['cur_opt']=='true'){?>
				<div class="alert alert-success" id='alert_message'><span class='text-right red_color' >توجه! </span> شما موفقانه سال مالی جدید را اضافه نمودید.</div>
		<?php }elseif($_GET['cur_opt']=='false'){ ?>
				<div class="alert alert-danger" id='alert_message'><span class='text-right red_color' >توجه! </span> سال مالی  وارده در سیستم ثبت نگردید.</div>
		<?php }elseif($_GET['cur_opt']=='exist') {?>
				<div class="alert alert-warning" id='alert_message'><span class='text-right red_color' >ببخشید! </span> سال مالی وارده در سیستم موجود است.</div>
		<?php }elseif($_GET['cur_opt']=='updated') {?>
				<div class="alert alert-warning" id='alert_message'><span class='text-right red_color' >توجه! </span> ویرایش موفقانه صورت گرفت.</div>
		<?php }elseif($_GET['cur_opt']=='deleted') {?>
				<div class="alert alert-success" id='alert_message'><span class='text-right red_color' >توجه! </span> موفقانه حذف گردید.</div>
		<?php }elseif($_GET['cur_opt']=='reject') {?>
				<div class="alert alert-warning" id='alert_message'><span class='text-right red_color' >توجه! </span> ریکارد مورد نظر حذف نگردید.</div>
		<?php }} ?>
		</div>
			<div class="span6 add_table">
				<table class="table_setting">
				<form action="../controller/setting_query.php" method="post">
					<tr> <th colspan='2' id="form_title_center"><h3>تعریف سال مالی جدید</h3></th></tr>
					<tr>
						<td class='label_align'>سال مالی: </td>
						<td class='input_align'>
							<input type="number" min='1395' max='1495' name="add_year" placeholder="تعریف سال مالی جدید" required>
						</td>
					</tr>
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
						<input type="submit" class='btn btn-primary' value="ثبت سال مالی">
						<input type="reset" class='btn btn-primary'  value="پاک کردن">
						</td>
					</tr>
					
					
					</form>	
				</table>
			</div>
			<div class="span4 show_table">
				<table class="table_setting" border="1">
				
					<tr> <th colspan='2'>سال مالی</th></tr>
					<tr>
						
						<th>سال</th>
						
						<th>حذف</th>

					</tr>
					<?php while($row=mysql_fetch_assoc($query)){ 
					extract($row);
					echo "<tr>";
						$year_id=en2f_number($y_id);
						
						echo "<td >";
						echo en2f_number($y_year)."</td>";
						?>
						<td> <a href='../controller/setting_query.php?setting_year_del_id=<?php echo $y_id?>' onClick="return confirm('آیا حاضر به حذف این مورد هستید؟')"><span class='icon icon-trash admin_icon_trash'></span></a></td>
						</tr>
					<?php }?>
					
				
				</table>

		</div>
		</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	