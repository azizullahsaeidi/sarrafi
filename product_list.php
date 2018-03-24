<?php $title="لیسته کالا"; ?>
<?php include("../includes/connection.php"); ?>
<?php 
include("../includes/header.php"); 
//include("../includes/number_change.php"); 
include("alert_messages.php");
$year=jdate("Y");
$anbar_query=mysql_query("select * from anbar",$con);
$currency_query=mysql_query("select * from currency",$con);
$current_year=date("Y");
if (isset($_GET['serial_num'])) {
$serial_no=$_GET['serial_num'];
}else
{
	$serial_no=0;
}

if (isset($_GET['anbar_code'])) {
$an_code=(int)$_GET['anbar_code'];
}else
{
	$an_code=1;
}

$page="";
$page1="";
		if (isset($_GET['page'])) {
			$page=$_GET['page'];
			
		
			if ($page=="" || $page==1) {
				$page1=0;
			}else{
				$page1=($page*14)-14;
			}
		}else{
			$page1=0;
		}
	$sql  ="SELECT 
				i_id
				
			from 
				item
			where 
			
				 anbar_code=$an_code
				 and i_year=$year
				;
				";
				$pagination_query=mysql_query($sql,$con);	
?>
	<!-- Begining of Content -->
		<div class="content">
			<div class='span11 my_print' style="width:884px;margin:0px;min-height:24px;padding:5px 20px;">
			<?php if($_SESSION['user_qualification']=='admin'){; ?>
				<a href="product.php">
					<span class="btn btn-primary pull-left">کالا جدید <l class="icon icon-plus icon-white" style="margin-top:3px;"></l></span>
				</a>
			<?php } ?>
			<span class="btn btn-primary pull-left" style='margin-left:5px;' onClick='window.print();'>چاپ<l class="icon icon-print icon-white" style='margin-top:3px;margin-right:5px;'></l></span>
			<form method="get" action="product_list.php" style="display:inline;" id='bank_and_box'>
				<select name="anbar_code" style="margin-bottom:0px;" id='bank_acount_number'>
					<option value='none'>انتخاب انبار</option>
					<?php while ($a_row=mysql_fetch_assoc($anbar_query)) {
						//var_dump($a_row);
						extract($a_row);
						if($anbar_code==$an_code){
						echo "<option value='$anbar_code' selected>$anbar_name</option>";
						continue;
						}else{
							echo "<option value='$anbar_code' >$anbar_name</option>";
						continue;
						}
					}?>
				</select>
				<input type="submit" class="btn btn-primary" value="جستجو">
			</form>
		</div>
			<div class="span11 messages" id='bank_date_report'>
				<?php
					$sql  ="SELECT 
								anbar_name,
								i_name,
								i_id,
								i_code,
								unit_price,
								item_name,
								cur_name
							from 
								anbar,
								item,
								item_type,
								currency
							where 
								item.anbar_code=anbar.anbar_code
								and cur_id=currency 
								and item_id=denomination
								and item.anbar_code=$an_code
								and i_year='$year'
								limit $page1,14
								;
								";
								$get_query=mysql_query($sql,$con);
				 ?>
				<table class="table_setting" border="1">
					<tr> <th colspan='8'>لیست کالا های موجود در انبار</th></tr>
					<tr>
						<th>شماره</th>
						
						<th>نام کالا</th>
						<th>کد کالا</th>
						<th>واحد شمارش</th>
						<th>قیمت فی </th>
						<th>واحد پولی</th>
						<?php if (!isset($_GET['status'])) { ?>
						<th class="my_print">ویرایش</th>
						<th class="my_print">جذف</th>
						<?php } ?>
					</tr>
					<?php if (mysql_num_rows($get_query)>0) { $i=1;
					while( $get_row = mysql_fetch_assoc($get_query)) { extract($get_row);
					echo "<tr>";
						$count_id=en2f_number($i);
						$i_code=en2f_number($i_code);
						$unit_price=en2f_number($unit_price);
						echo "<td> $count_id 		</td>";
						$i++; 
						echo "<td> $i_name 	</td>";
						echo "<td> $i_code 	</td>";
						echo "<td> $item_name </td>";
						echo "<td> $unit_price </td>";
						echo "<td> $cur_name </td>";
						if (!isset($_GET['status'])) {
						echo "<td class='my_print'> <a href='product_edit.php?item_edit_id=$i_id&anbar_code=$an_code'><span class='icon icon-edit'></span></a> </td>";?>
						<td class='my_print'> <a href='../controller/product_query.php?item_delete_id=<?php echo $i_id?>&anbar_code=<?php echo $an_code; ?>' onClick="return confirm('آیا حاضر به حذف این مورد هستید؟')"><span class='icon icon-trash admin_icon_trash'></span></a></td>
						<?php } ?>
					</tr>
					<?php }}else{
						if (isset($_GET['anbar_code'])) {
							echo "<tr style='height:300px;'> <th colspan='11'>در این انبار هنوز کالا  ثبت نشده است.</th></tr>";
						}else{?>
						<tr style='height:300px;'> <th colspan='8'>برای دیدن لیست کالا ها نخست انبار را انتخاب کنید.</th></tr>
					<?php }} ?>
				</table>


				<?php 
				echo "<div style='clear:both'></div>";
				echo "<div style='text-align:left;margin-top:5px;' id='box_pagination'> ";
					if (mysql_num_rows($pagination_query)>=14) { 
						$page_number=mysql_num_rows($pagination_query);?>
					<form action='product_list.php' method='get'>
						<table style='text-align:left;'>
							<tr>
								<td style="width:10%">صفحه 
								<?php
									if (isset($_GET['page'])) {
										echo "<span style='color:red'>". en2f_number($_GET['page'])."</span>";
									}else{
										echo "<span style='color:red'>". en2f_number(1)."</span>";
									}
								 ?> 
								 از <?php 
								 $per_page=ceil($page_number/14);
								 echo en2f_number($per_page); ?></td>
								<td style="width:50%"></td>
								<td style='width:81px;'>انتخاب صفحه:</td>
								<td>
									<?php 
									echo "<select name='page' style='margin-bottom:0px;'>";
									for($i=1; $i<= $per_page; $i++) {
										$select_i=en2f_number($i);
									if (isset($_GET['page'])) {
										$pages=$_GET['page'];
										if ($i==$pages) {
											echo "<option value='$i' selected>$select_i</option>";
											continue;
										}else{
											echo "<option value='$i'>$select_i</option>";
											continue;
										}
									}else{
											echo "<option value='$i'>$select_i</option>";
											continue;
										}
									}
									?>
									</select>
								</td>
								<td>
									<input type='hidden' name='anbar_code' value='<?php echo $an_code; ?>'>
									<input type='submit' class='btn btn-primary' value='تائید'>
								</td>
							</tr>
						</table>
					</form>
					<?php	}
				echo "</div>";
				 ?>
				
		</div>
		</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	