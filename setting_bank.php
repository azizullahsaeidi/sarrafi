<?php $title="بخش بانک "; ?>
<?php include("../includes/connection.php"); ?>
<?php 
include("../includes/header.php"); 
include("alert_messages.php");
$query=mysql_query("select * from bank_account,currency where cur_id=bank_account_type",$con);
?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php alert_messages();?>
		<a href="setting_add_bank.php">
			<span class="btn btn-primary pull-left">حساب جدید <l class="icon-plus icon-white" style="margin-top: 3px;"></l></span>
		</a>
		</div>
			<div class="span11 messages">
				<table class="table_setting" border="1">
					<tr> <th colspan='8'>لیست بانک ها</th></tr>
					<tr>
						<th>ردیف</th>
						<th>نام بانک</th>
						<th>شعبه بانک</th>
						<th>شماره حساب</th>
						<th>نوعیت حساب</th>
						<th>ویرایش</th>
						<th>حذف</th>
					</tr>
					<?php if (mysql_num_rows($query)>0) {
						$i=1;
					while($row=mysql_fetch_assoc($query)){ 
					extract($row);
					//$qualification=$arrayName = array('admin' => 'مدیر','anbar' => 'انبار','bank_sandoq' => 'صندوق و بانک');
					echo "<tr>";
						 $id=en2f_number($i);
						 $i++;
						 $ac_n=en2f_number($account_number);
						echo "<td> $id 		</td>";
						echo "<td> $bank_name 	</td>";
						echo "<td> $bank_branch 	</td>";
						echo "<td> $ac_n </td>";
						echo "<td> $cur_name </td>";
						
						echo "<td> <a href='setting_edit_bank.php?edit_bank_id=$bank_id'><span class='icon icon-edit'></span></a> </td>";?>
						<td> <a href='../controller/setting_query.php?bank_delete_id=<?php echo $bank_id?>' onClick="return confirm('آیا حاضر به حذف این مورد هستید؟')"><span class='icon icon-trash admin_icon_trash'></span></a></td>
					</tr>
					<?php }}else{?>
						<tr> <th colspan='8'>فعلن هیچ دیتا در سیستم موجود نیست.</th></tr>
					<?php } ?>
				</table>
		</div>
		</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	