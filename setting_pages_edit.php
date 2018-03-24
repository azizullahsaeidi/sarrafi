<?php 
	//session_start(); if(!isset($_SESSION['user_login'])) { header("Location:login.php?login=false");  }
if (isset($_GET['setting_currency_id'])) {
	//$setting_currency_id=$_GET['setting_currency_id'];
	$title='ویرایش واحد پول';
}
if (isset($_GET['setting_province_id'])) {
	//$setting_province_id=$_GET['setting_province_id'];
	$title='ویرایش ولایت';
}
if (isset($_GET['setting_item_type_id'])) {
	//$setting_item_type_id=$_GET['setting_item_type_id'];
	$title='ویرایش واحد کالا';
}
?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); ?>
	<!-- Begining of Content -->
		<div class="content">
			
		<div class='span11 messages'>
			<?php if(isset($_GET['opt']))
			{
				if($_GET['opt']=='false')
				{ 
					echo "<div class='alert alert-danger' id='alert_messages'><span class='text-right red_color' >ببخشید! </span> ویرایش صورت نگرفت.</div>";
				}
			} ?>
			<?php if (isset($_GET['setting_currency_id'])) {
				$setting_currency_id=(int)$_GET['setting_currency_id'];
				$query=mysql_query("select * from currency where cur_id=$setting_currency_id",$con);
				$row=mysql_fetch_assoc($query);extract($row);
			?>
			<a href="setting_currency.php">
				<span class="btn btn-primary pull-left">برگشت <l class="icon-arrow-left icon-white" style="margin-top: 3px;padding-right: 5px;"></l></span>
			</a>		
		</div>
			<div class="span11 messages text-center">
				<table class="table_setting "style="width:50%;margin-right:222px">
				<form action="../controller/setting_query.php" method="post" enctype="multipart/form-data">
					<tr> <th colspan='2' id="form_title_center"><h4>ویرایش واحد پول</h4></th></tr>
					<tr>
						<td class='label_align'>واحد پول:</td>
						<td class='input_align'><input type="text" lang='fa' value="<?php echo $cur_name; ?>" name="edit_setting_cur_name" placeholder="نام" required></td>
					</tr>
					
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
						<input type="hidden" value="<?php echo $cur_id; ?>" name="cur_id"> 
						<input type="submit" class='btn btn-primary ' id="just_submit" value="تائید">
						</td>
					</tr>
					</form>	
				</table>
			<?php } elseif (isset($_GET['setting_province_id'])) {
				$setting_province_id=(int)$_GET['setting_province_id'];
				$query=mysql_query("select * from province where pro_id=$setting_province_id",$con);
				$row=mysql_fetch_assoc($query);extract($row);
			?>
			<a href="setting_province.php">
				<span class="btn btn-primary pull-left">برگشت <l class="icon-arrow-left icon-white" style="margin-top: 3px;padding-right: 5px;"></l></span>
			</a>		
		</div>
			<div class="span11 messages text-center">
				<table class="table_setting "style="width:50%;margin-right:222px">
				<form action="../controller/setting_query.php" method="post" enctype="multipart/form-data">
					<tr> <th colspan='2' id="form_title_center"><h4>ویرایش ولایت</h4></th></tr>
					<tr>
						<td class='label_align'>نام ولایت:</td>
						<td class='input_align'><input type="text" lang='fa' value="<?php echo $pro_name; ?>" name="edit_setting_pro_name" placeholder="نام" required></td>
					</tr>
					
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
						<input type="hidden" value="<?php echo $pro_id; ?>" name="pro_id"> 
						<input type="submit" class='btn btn-primary ' id="just_submit" value="تائید">
						</td>
					</tr>
					</form>	
				</table>
			<?php } elseif (isset($_GET['setting_item_type_id'])) {
				$setting_item_type_id=(int)$_GET['setting_item_type_id'];
				$query=mysql_query("select * from item_type where item_id=$setting_item_type_id",$con);
				$row=mysql_fetch_assoc($query);extract($row);
			?>
			<a href="setting_item_type.php">
				<span class="btn btn-primary pull-left">برگشت <l class="icon-arrow-left icon-white" style="margin-top: 3px;padding-right: 5px;"></l></span>
			</a>		
		</div>
			<div class="span11 messages text-center">
				<table class="table_setting "style="width:50%;margin-right:222px">
				<form action="../controller/setting_query.php" method="post" enctype="multipart/form-data">
					<tr> <th colspan='2' id="form_title_center"><h4>ویرایش واحد کالا</h4></th></tr>
					<tr>
						<td class='label_align'>واحد کالا:</td>
						<td class='input_align'><input type="text" lang='fa' value="<?php echo $item_name; ?>" name="edit_setting_item_name" required></td>
					</tr>
					
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
						<input type="hidden" value="<?php echo $item_id; ?>" name="item_id"> 
						<input type="submit" class='btn btn-primary ' id="just_submit" value="تائید">
						</td>
					</tr>
					</form>	
				</table>
			<?php } ?>
			</div>
			</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	