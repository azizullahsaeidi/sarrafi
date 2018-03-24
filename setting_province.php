<?php $title="بخش ولایات "; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
$query=mysql_query("select * from province order by pro_id ",$con);
?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php if(isset($_GET['cur_opt'])){
			if($_GET['cur_opt']=='true'){?>
				<div class="alert alert-success" id='alert_message'><span class='text-right red_color' >توجه! </span> شما موفقانه ولایت را اضافه نمودید.</div>
		<?php }elseif($_GET['cur_opt']=='false'){ ?>
				<div class="alert alert-danger" id='alert_message'><span class='text-right red_color' >توجه! </span> ولایت وارده در سیستم ثبت نگردیده است.</div>
		<?php }elseif($_GET['cur_opt']=='exist') {?>
				<div class="alert alert-danger" id='alert_message'><span class='text-right red_color' >ببخشید! </span> شما قادر به اضافه کردن ولایت جدید نیستید.</div>
		<?php }elseif($_GET['cur_opt']=='updated') {?>
				<div class="alert alert-success" id='alert_message'><span class='text-right red_color' >توجه! </span> ویرایش موفقانه صورت گرفت.</div>
		<?php }elseif($_GET['cur_opt']=='deleted') {?>
				<div class="alert alert-success" id='alert_message'><span class='text-right red_color' >توجه! </span> موفقانه حذف گردید.</div>
		<?php }elseif($_GET['cur_opt']=='reject') {?>
				<div class="alert alert-warning" id='alert_message'><span class='text-right red_color' >توجه! </span> ریکارد مورد نظر حذف نگردید.</div>
		<?php }elseif($_GET['cur_opt']=='empty') {?>
				<div class="alert alert-warning" id='alert_message'><span class='text-right red_color' >توجه! </span> اطلاعات را درست وارد کنید.</div>
		<?php }} ?>
		</div>
			<div class="span6 add_table">
				<table class="table_setting">
				<form action="../controller/setting_query.php" method="post">
					<tr> <th colspan='2' id="form_title_center"><h3>تعریف ولایت</h3></th></tr>
					<tr>
						<td class='label_align'>ولایت جدید: </td>
						<td class='input_align'><input type="text" lang='fa' name="province" placeholder="اضافه کردن ولایت جدید" required></td>
					</tr>
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
						<input type="submit" class='btn btn-primary' value="ذخیره">
						<input type="reset" class='btn btn-primary'  value="پاک کردن">
						</td>
					</tr>
					
					
					</form>	
				</table>
			</div>
			<div class="span4 show_table">
				<table class="table_setting" border="1">
					<tr> <th colspan='4'>لیست ولایات موجود در سیستم</th></tr>
					<tr>
						<th>ردیف</th>
						<th>ولایات</th>
						<th>ویرایش</th>
						<th>حذف</th>
					</tr>
					<?php while($row=mysql_fetch_assoc($query)){ 
					extract($row);
					echo "<tr>";
						$p_id=en2f_number($pro_id);
						echo "<td > $p_id </td>";
						echo "<td > $pro_name</td>";
						echo "<td> <a href='setting_pages_edit.php?setting_province_id=$pro_id'><span class='icon icon-edit'></span></a> </td>";?>
						<td> <a href='../controller/setting_query.php?setting_pro_del_id=<?php echo $pro_id?>' onClick="return confirm('آیا حاضر به حذف این مورد هستید؟')"><span class='icon icon-trash admin_icon_trash'></span></a></td>
						</tr>
					<?php }?>
					
				
				</table>

		</div>
		</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	