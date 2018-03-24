<?php 
$title='انتخاب فایل بازگردانی';
include("../includes/connection.php");
if (isset($_GET['update_user_i'])) {

	echo $file_name = $_GET['restore_db_file'];
	
	
	if ($file_name!='') {
	$mysql_host = 'localhost';
	$mysql_username = 'root';
	$mysql_password = '';
	$mysql_database = 'bank';

	$check_db=mysql_query("drop DATABASE $mysql_database",$con);
	if ($check_db)
	{
		# code...

		$create_db=mysql_query("CREATE DATABASE `$mysql_database` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci" ) or die('Error connecting to MySQL server: ' . mysql_error());
		if ($create_db) {
			header("location:restore.php?restore_file_name=$file_name");
		}else{
			$create_db=mysql_query("CREATE DATABASE `$mysql_database` CHARACTER SET utf8 COLLATE utf8_general_ci" ) or die('Error connecting to MySQL server: ' . mysql_error());
		}
	}
}
	else{
		//echo mysql_error();die;
		header("location:index.php");
	}
}
?>
<?php
include("../includes/header.php"); 
include("alert_messages.php");
?>
	<!-- Begining of Content -->
		<div class="content">
			<div class="span11 messages text-center">
				<p id="restore_error_msg" style="color:red;font-size: 18px;font-weight: bold;display:none ">لطفاً از فارمت sql. را استفاده کنید</p>
				<table class="table_setting "style="width:50%;margin-right:222px">
				<form action="restore_db.php" method="get" enctype="multipart/form-data" id="restore_form">
					<tr> <th colspan='1'><h3>انتخاب فایل بازگردانی</h3></th></tr>
					<tr style="height: 100px;">
						<td class='input_align' style='text-align:center;height:200px;margin: 0px;' id="select_img"><img id="select_image" src="../images/restore.png" style='height:200px;width:200px;'></td>
					</tr>
					<tr >
						<td class='input_align'  style='text-align:center;'>
							<input  type="file" accept=".sql" required id="profile_picture" name='restore_db_file'  style='width:200px;display:none;' required >
							<input type="hidden" name='update_user_i' style='width:200px' value="<?php echo $ad_id; ?>">
						</td>
					</tr>
					<tr>
						<td class='submit_reset' style='text-align:center;'>
						<input type="submit" class='btn btn-primary' value="تائید" style='width:200px'>
						</td>
					</tr>
					</form>	
				</table>
			</div>
		</div>
		<script type="text/javascript">
				$("#restore_form").submit(function(){
			/*var select_value = $("#select_restore_file").val();
			alert(select_value);*/
			var ext = $('#profile_picture').val().split('.').pop().toLowerCase();
			//alert()
				if($.inArray(ext, ['sql']) == -1) {
					$("#restore_error_msg").css("display","block");
					return false;
				}else{
					return true;
				}
		});
		</script>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	