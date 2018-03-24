
<?php 
$title="شمارش گزارش انبار گردانی";
include("../includes/connection.php"); ?>
<?php include("../includes/header.php"); 
$count_number=$_GET['count'];
$i_code=$_GET['i_code'];
if ($count_number=='1') {
	$count_label="اول ";
}elseif ($count_number=='2') {
	$count_label="دوم ";
}elseif ($count_number=='3') {
	$count_label="سوم ";
}elseif ($count_number=='final') {
	$count_label="مغایرت ";
}
$cur=$_GET['cur'];
$page=$_GET['page'];
if($page>0){
	$page=$page;
}else{
	$page=1;
}


$query=mysql_query("select i_code,i_name from item where i_code='$i_code'",$con);
$i_row=mysql_fetch_assoc($query);extract($i_row);?>

	<!-- Begining of Content -->
		<div class="content">
		<div class='span11' style="width:888px;margin:0px;min-height:30px;padding:5px 20px;cursor:pointer">
		</div>
		<!-- <div class='span11 messages'>
		<?php //include("alert_messages.php"); ?>
		</div> -->
			<div class="span10 add_table" style='margin-right:55px;'>
				<table class="table_setting" style='width:100%'>
				<form action="../controller/anbar_query.php" method="post">
					<tr>
						<td class='label_align'>کد کالا:</td>
						<td class='input_align'>
							<input type="text" min="1" name="item_code" value="<?php echo $i_code; ?>" required readonly>
							<input type="hidden" min="1" name="cur" value="<?php echo $cur; ?>">
							<input type="hidden" min="1" name="page" value="<?php echo $page; ?>">
						</td>
					</tr>
					<tr>
						<td class='label_align'>شرح کالا:</td>
						<td class='input_align'>
							<input type="text"  min="1" name="item_name" value="<?php echo $i_name; ?>" required readonly>
						</td>
					</tr>
					<?php if ($_GET['count']=='final') {?>
					<tr>
						<td class='label_align'> <?php echo $count_label; ?>:</td>
						<td class='input_align'>
							<input type="text" id="total_count"  name="item_counting" placeholder=" <?php echo $count_label; ?>" required >
						</td>
					</tr>	
					<?php }else{ ?>
					<tr>
						<td class='label_align'> شمارش <?php echo $count_label; ?>:</td>
						<td class='input_align'>
							<input type="number" id="total_count" min="0" name="item_counting" placeholder="شمارش <?php echo $count_label; ?>" required >
						</td>
					</tr>
					<?php } ?>
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
						<input type="hidden" name="count_number" value="<?php echo $_GET['count']; ?>">
						<input type="submit" class='btn btn-primary' value="ذخیره">
						<?php 
						$i_c=$_GET['i_code'];
						$i_co=explode("/", $i_c);
						$anbar_code=$i_co[0];
						echo "<a href='anbar_gardani_report.php?currency_id=$cur&add_anbar_code=$anbar_code'>";?>
							<span class='btn btn-primary' style='width:96px;'>برگشت<l class="icon-arrow-left icon-white" style="margin-top:3px;margin-right:5px;"></l></span>
							</a>
						</td>
					</tr>
					</form>	
				</table>
			</div>
			</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	