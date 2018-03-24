<?php $title="بخش مدیریت ";
include("../includes/connection.php");
include("../includes/header.php"); 
include("alert_messages.php");
echo date("Y-m-d");
$query=mysql_query("select * from admin",$con);
?>
	<!-- Begining of Content -->
	<p>Hello man </p>
		<div class="content">
			<div class='span11 messages'>
			<?php alert_messages();?>
			<?php if($_SESSION['user_qualification']=='admin' ){; ?>
			<a href="admin_add.php">
				<span class="btn btn-primary pull-left">مدیر جدید <l class="icon-plus icon-white" style="margin-top: 3px;"></l></span>
			</a>
			<?php  } ?>
			</div>
		<div class="span11 messages">
				<table class="table_setting" border="1">
					<tr> <th colspan='8'>لیست مدیران سیستم</th></tr>
					<tr>
						<th>ردیف</th>
						<th>نام مدیر</th>
						<th>تحلص</th>
						<th>نام کاربری</th>
						<th>رمز عبور</th>
						<th>صلاحیت</th>
						<th>ویرایش</th>
						<?php if($_SESSION['user_qualification']=='admin' ){; ?>
						<th>حذف</th>
						<?php } ?>
					</tr>
					<?php if (mysql_num_rows($query)>0) {
					while($row=mysql_fetch_assoc($query)){ 
					extract($row);
					$qualification=$arrayName = array('admin' => 'مدیر','anbar' => 'انبار','bank_sandoq' => 'صندوق و بانک');
					//echo $ad_admin;
					if($_SESSION['user_qualification']==$ad_status ||  $_SESSION['user_qualification']=='admin'){
					echo "<tr>";
						 $a_id=en2f_number($ad_id);
						echo "<td> $a_id 		</td>";
						echo "<td> $ad_name 	</td>";
						echo "<td> $ad_lname 	</td>";
						echo "<td> $ad_username </td>";
						echo "<td> $ad_password </td>";
						echo "<td>";
						echo $qualification[$ad_status];
						echo "</td>";
						echo "<td> <a href='admin_edit.php?edit_id=$ad_id'><span class='icon icon-edit'></span></a> </td>";?>
						<?php if($_SESSION['user_qualification']=='admin' ){; ?>
						<td> <a href='../controller/admin_query.php?admin_delete_id=<?php echo $ad_id?>' onClick="return confirm('آیا حاضر به حذف این مورد هستید؟')"><span class='icon icon-trash admin_icon_trash'></span></a></td>
						<?php }} ?>
					</tr>
					<?php }}else{?>
						<tr> <th colspan='8'>فعلن هیچ دیتی در سیستم موجود نیست.</th></tr>
					<?php } ?>
				</table>
		</div>
		</div>
		<!-- End of Content -->
		<h1>hi dear</h1>
<?php 
var_dump("Give your test");

include_once("../includes/footer.php"); ?>	