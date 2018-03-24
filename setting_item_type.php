<?php $title="بخش واحدات کالا "; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
$query=mysql_query("select * from item_type order by item_id",$con);
?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php if(isset($_GET['cur_opt'])){
			if($_GET['cur_opt']=='true'){?>
				<div class="alert alert-success" id='alert_message'><span class='text-right red_color' >توجه! </span> شما موفقانه واحد کالا جدید را در سیستم اضافه نمودید.</div>
		<?php }elseif($_GET['cur_opt']=='false'){ ?>
				<div class="alert alert-danger" id='alert_message'><span class='text-right red_color' >توجه! </span> واحد کالا جدید در سیستم ثبت نگردیده است.</div>
		<?php }elseif($_GET['cur_opt']=='exist') {?>
				<div class="alert alert-warning" id='alert_message'><span class='text-right red_color' >ببخشید! </span> واحد کالا وارده در سیستم موجود است.</div>
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
					<tr> <th colspan='2' id="form_title_center"><h3>تعریف واحد شمارش کالا</h3></th></tr>
					<tr>
						<td class='label_align'>واحد کالا </td>
						<td class='input_align'><input type="text" lang='fa' name="item_type" placeholder="تعریف واحد شمارش کالا" required></td>
					</tr>
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
						<input type="submit" class='btn btn-primary' value="ثبت واحد شمارش">
						<input type="reset" class='btn btn-primary'  value="پاک کردن">
						</td>
					</tr>
					
					
					</form>	
				</table>
			</div>
			<div class="span4 show_table">
				<table class="table_setting" border="1">
				
					<tr> <th colspan='4'>لیست واحد شمارش کالا های موجود در سیستم</th></tr>
					<tr>
						<th>ردیف</th>
						<th>واحد کالا</th>
						<th>ویرایش</th>
						<th>حذف</th>
					</tr>
					<?php while($row=mysql_fetch_assoc($query)){ 
					extract($row);
					echo "<tr>";
					$i_id=en2f_number($item_id);
						echo "<td > $i_id </td>";
						echo "<td > $item_name</td>";
						echo "<td> <a href='setting_pages_edit.php?setting_item_type_id=$item_id'><span class='icon icon-edit'></span></a> </td>";?>
						<td> <a href='../controller/setting_query.php?setting_item_del_id=<?php echo $item_id?>' onClick="return confirm('آیا حاضر به حذف این مورد هستید؟')"><span class='icon icon-trash admin_icon_trash'></span></a></td>
						</tr>
					<?php }?>
					
				
				</table>

		</div>
		</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	