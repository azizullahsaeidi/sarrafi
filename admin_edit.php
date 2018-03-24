<?php $title="ویرایش مدیر ";
include("../includes/connection.php");
include("../includes/header.php"); ?>
	<!-- Begining of Content -->
		<div class="content">
			<?php if (isset($_GET['edit_id'])) {
				$edit_id=(int)$_GET['edit_id'];
				$query=mysql_query("select * from admin where ad_id=$edit_id",$con);
				$row=mysql_fetch_assoc($query);extract($row);
			?>
		<div class='span11 messages'>
			<?php if(isset($_GET['opt']))
			{
				if($_GET['opt']=='pass_no_conf')
				{
					echo "<div class='alert alert-danger' id='alert_messages'><span class='text-right red_color' >توجه! </span> رمز عبور با تائید رمز عبور یکی نیست.</div>";
				}
				elseif($_GET['opt']=='false')
				{ 
					echo "<div class='alert alert-danger' id='alert_messages'><span class='text-right red_color' >توجه! </span> مدیر جدید ثبت نگردید.</div>";
				}elseif($_GET['opt']=='exist') 
				{
					echo "<div class='alert alert-warning' id='alert_messages'><span class='text-right red_color' >ببخشید! </span> نام کاری شما در سیستم موجود است.</div>";
				}
			} ?>
			<a href="admin.php">
				<span class="btn btn-primary pull-left">برگشت <l class="icon-arrow-left icon-white" style="margin-top: 3px;padding-right: 5px;"></l></span>
			</a>		
		</div>
			<div class="span11 messages text-center">
				<table class="table_setting "style="width:50%;margin-right:222px">
				<form action="../controller/admin_query.php" method="post" enctype="multipart/form-data">
					<tr> <th colspan='2'><h3>ویرایش مدیر </h3></th></tr>
					<tr>
						<td class='label_align'>نام مدیر:</td>
						<td class='input_align'><input type="text" lang='fa' value="<?php echo $ad_name; ?>" name="edit_ad_name" placeholder="نام" required></td>
					</tr>
					<tr>
						<td class='label_align'>تخلص مدیر:</td>	
						<td class='input_align'><input type="text" lang='fa' value="<?php echo $ad_lname; ?>" name="edit_ad_lname" placeholder="تخلص" required></td>
					</tr>
					
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
						<input type="hidden" value="<?php echo $ad_id; ?>" name="ad_id"> 
						<input type="submit" class='btn btn-primary ' id="just_submit" value="ثبت ویرایش">
						</td>
					</tr>
					</form>	
				</table>
			<?php } ?>
			</div>
			</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	