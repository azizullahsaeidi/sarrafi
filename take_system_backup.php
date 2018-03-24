<?php $title="پشتبانی از سیستم"; 
include("../includes/connection.php"); 
include("../includes/header.php"); 

include("alert_messages.php");
?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 messages'>
		<?php if (isset($_GET['backup']) || isset($_GET['backup_mail'])) { ?>
			<div class='alert alert-success' id='alert_message'><span class='text-right red_color' >توجه! </span> پشتبانی از سیستم موفقانه گرفته شد.</div>
		<?php }elseif (isset($_GET['restore'])) { ?>
			<div class='alert alert-success' id='alert_message'><span class='text-right red_color' >توجه! </span> بازگردانی از سیستم موفقانه صورت گرفت.</div>
		<?php } ?>
		</div>
		<a href="restore_db.php" class='btn btn-success pull-left' style="margin-left: 20px;">بازگردانی سیستم</a>
			<div class="span11 messages text-center">
				<table class="table_setting "style="width:50%;margin-right:222px;margin-top:100px;">
					<tr>
						<td class='input_align' style='text-align:center;height:200px;' id="select_img">
							<a href="system_backup.php" title='گرفتن نسخه پشتبانی از سیستم' onClick='return window.confirm("شما حاضر به گرفتن نسخه پشتبانی از سیستم هستید؟");'>
								<img id="select_image" src="../images/backup.png" style='width:200px'>
							</a>
						</td>
					</tr>
				</table>
			</div>
			</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	