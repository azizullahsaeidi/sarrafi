<?php $title="گزارش انبار "; 
include("../includes/connection.php"); 
include("../includes/cur_year.php"); 

include("../includes/header.php"); 
include("alert_messages.php");
$anbar_query=mysql_query("select * from anbar",$con);
$currency_query=mysql_query("select * from currency",$con);

$current_year=date("Y");
if (isset($_GET['year']))
{
	$cur_y=$_GET['year'];
}
else 
{
	$cur_y = $y_year;
}

if(isset($_GET['cur']))
{
	$curr_id=$_GET['cur'];
}
if(isset($_GET['add_sum']))
{
	$add_sum=$_GET['add_sum'];
	$ext_sum=$_GET['ext_sum'];
	$tot_sum=0;
}
else
{
	$add_sum=0;
	$ext_sum=0;
	$tot_sum=0;	
}

?>
	<!-- Begining of Content -->
		<div class="content">
		<div class='span11 search_area'>
		<?php // alert_messages();?>
		<form action="anbar_report_search_result.php" method="get" id="anbar_rased_report_form" style="display:inline;">
				<select id="rased_anbar_code" class="search_anbar" name="add_anbar_code" required>
					<option value="anbar_search">انتخاب انبار</option>
					<?php while ($anbar_row=mysql_fetch_assoc($anbar_query))
					{ 
						extract($anbar_row);
						if(isset($_GET['add_anbar_code']))
						{
							$an_code=$_GET['add_anbar_code'];
							if ($an_code=='anbar_search')
							{
								header("location:anbar_report_search_result.php");
							}
							else
							{
								if ($anbar_code==$an_code)
								{
									echo "<option value='$anbar_code' selected>$anbar_name</option>";
									continue;
								}
								else
								{
									echo "<option value='$anbar_code'>$anbar_name</option>";
									continue;
								}
							}
						}
						else
						{
							echo "<option value='$anbar_code'>$anbar_name</option>";
						}
					} ?>
				</select>
				<select id="currency_id" class="currency_opt" name="cur" style="width:15%;" required>
					<option value="currency_id">واحد پول</option>
					<?php 
					while ($currency_row=mysql_fetch_assoc($currency_query))
					{ 
						extract($currency_row);
						if(isset($_GET['cur']))
						{
							$c_id=$_GET['cur'];
							if ($cur_id==$c_id)
							{
								echo "<option value='$cur_id' selected>$cur_name</option>";
								continue;
							}
							else
							{
								echo "<option value='$cur_id'>$cur_name</option>";
								continue;
							}
						}
						else
						{
							echo "<option value='$cur_id'>$cur_name</option>";
						}
					} ?>
				</select>
				<input type="number" name="year" required style="width:15%;height:30px;" placeholder="سال مالی را بنویسید">
				<input type="submit" class="btn btn-primary" value="جستجو" id="" style="margin-bottom:10px;width:85px;">
			</form>	
			<?php 
			if(isset($_GET['add_anbar_code']))
			{
			?>
				<span class='btn btn-primary pull-left' style="width:60px;" onClick="return window.print();">چاپ <l class="icon icon-print icon-white" style="margin-top:3px;"></l ></span>
			<?php
			 } 
			?>	
		</div>
		<div class="span11 messages"   id='box_report'>
				<?php if (isset($_GET['add_anbar_code']) && isset($_GET['cur']))
				{
					$page="";
					$page1="";
					if (isset($_GET['page']))
					{
						$page=$_GET['page'];									
						if ($page=="" || $page==1)
						{
							$page1=0;
						}
						else
						{
							$page1=($page*30)-30;
						}
					}
					else
					{
						$page1=0;
					}
					$anbar_code=$_GET['add_anbar_code'];
					$gen_query=mysql_query("select anbar_name from anbar where anbar_code=$anbar_code  limit 1",$con);
					$anbar_row=mysql_fetch_assoc($gen_query);

					$product_query=mysql_query("select i_id,i_name,i_code,unit_price ,i_year from item where anbar_code=$anbar_code and currency=$curr_id limit $page1,30"); 
					$pagination_query=mysql_query("select i_id,i_name,i_code,unit_price,i_year from item where anbar_code=$anbar_code  and currency=$curr_id "); 
					?>
				<table class="table_setting" border="1">
					<thead>
					<tr>
						<th colspan='2' rowspan='2' style='width:75px;'> <img src='../images/committee_logo.jpg' style='width:70px;padding:2px;'> </th>
						<th colspan='5'  style='border-left:0px;border-bottom:0px;padding-right:100px;'>
							دفتر نمایندگی کمیته امداد امام خمینی (ره) در کشور افغانستان</th>
						<th colspan='3' style='width:75px;border-right:0px;border-bottom:0px'>شماره صفحه: <?php if(isset($_GET['page'])){ echo en2f_number($_GET['page']); }else{ echo en2f_number(1); } ?></th>
					</tr>
					<tr>
						<th colspan='5' style='border-left:0px;border-top:0px;;padding-right:100px;'>گزارش انبار ( <?php echo $anbar_row['anbar_name']; ?> )  مبلغ ( <?php  get_currency_id('cur_name'); ?> )</th>
						<th colspan='3' style='border-right:0px;border-top:0px'>سال: <?php echo en2f_number($cur_y); ?></th>
					</tr>
					<tr>
						<th>ردیف</th>
						<th>کد کالا</th>
						<th>شرح کالا</th>
						<th>نرخ</th>
						<th>مبلغ وارده</th>
						<th>مبلغ صادره</th>
						<th>مانده نقد</th>
						<th>مقدار وارده</th>
						<th>مقدار صادره</th>
						<th>مانده کالا</th>
					</tr>
				</thead>
				<tbody id="box_report">
					<?php if(mysql_num_rows($product_query)>0) 
					{ 
						$i=1;
						while($row=mysql_fetch_assoc($product_query))
						{ 
							extract($row);
							$rased_query=mysql_query("select  sum(de_total_price) rased_total_price,sum(de_quantity) rased_total_quantity from item_details where de_reg_type='r' and total_code='$i_code' and item_f_id=$i_id and de_date <= '$cur_y-12-30'",$con);
							$hawala_query=mysql_query("select  sum(de_total_price) hawala_total_price,sum(de_quantity) hawala_total_quantity from item_details where de_reg_type='h' and total_code='$i_code'  and de_date <= '$cur_y-12-30'  ",$con); 
							$rase_row=mysql_fetch_assoc($rased_query);
							$hawala_row=mysql_fetch_assoc($hawala_query);
		
							$r_t_p	=(int)$rase_row['rased_total_price'];
							$r_t_q 	=(int)$rase_row['rased_total_quantity'];
							$h_t_p 	=(int)$hawala_row['hawala_total_price'];
							$h_t_q 	=(int)$hawala_row['hawala_total_quantity'];
							
							$i_year; 	
							$r_p 		=$r_t_p-$h_t_p;
							$r_q		=$r_t_q-$h_t_q;
		
							$counts=en2f_number($i);
							$code_num=en2f_number($i_code);
							$u_price=en2f_number($unit_price);
		
							$rased_total_price 		= en2f_number(number_format($r_t_p));
							$rased_total_quantity 	= en2f_number(number_format($r_t_q));
							$hawala_total_price 	= en2f_number(number_format($h_t_p));
							$hawala_total_quantity 	= en2f_number(number_format($h_t_q));
							$remain_price 			= en2f_number(number_format($r_p));
							$remain_quantity 		= en2f_number(number_format($r_q));
							if ($i_year == $cur_y || $r_q >= 0 || $r_p >= 0)
							{
								$add_sum+=$r_t_p;
								$ext_sum+=$h_t_p;
								echo "<tr>";
									echo "<td> $counts 		</td>";
									echo "<td> $code_num 	</td>";
									$i++; echo "<td> $i_name 		</td>";
									echo "<td> $u_price 	</td>";
									echo "<td> $rased_total_price </td>";
									echo "<td> $hawala_total_price </td>";
									echo "<td> $remain_price </td>";
									echo "<td> $rased_total_quantity </td>";
									echo "<td> $hawala_total_quantity </td>";
									echo "<td> $remain_quantity </td>";
									 ?>
								</tr>
							<?php 
							} 
						} 
						?>
						<tr>
							<th colspan="4">جمع کل</th>
							<th ><?php echo en2f_number($add_sum); ?></th>
							<th ><?php echo en2f_number($ext_sum); ?></th>
							<th ><?php echo en2f_number($add_sum-$ext_sum); ?></th>
							<th colspan="3"></th>
						</tr>
						<?php }
						else
						{?>
							<tr> <th colspan='11'>فعلن هیچ دیتا در سیستم موجود نیست.</th></tr>
					<?php } ?>
					</tbody>
				</table>
				<table>
					<tr><th colspan="6"></th></tr>
				</table>
				
				<div style="margin-top: 10px">
					<l style='font-size: 20px;'>تهیه کننده:...............................</l>
					<l style='font-size: 20px;margin-right: 300px'>تصویب کننده:...............................</l>
				</div>
				<?php 
				echo "<div style='clear:both'></div>";
				echo "<div style='text-align:left;margin-top:5px;' id='box_pagination'> ";
				//echo mysql_num_rows($pagination_query);
					if (mysql_num_rows($pagination_query)>=30)
					{ 
						$page_number=mysql_num_rows($pagination_query);?>
					<form action='anbar_report_search_result.php' method='get'>
						<table style='text-align:left;'>
							<tr>
								<td style="width:10%">صفحه 
								<?php
									if
									(isset($_GET['page']))
									{
										echo "<span style='color:red'>". en2f_number($_GET['page'])."</span>";
									}
									else
									{
										echo "<span style='color:red'>". en2f_number(1)."</span>";
									}
								 ?> 
								 از <?php 
								 $per_page=ceil($page_number/30);
								 echo en2f_number($per_page); ?></td>
								<td style="width:50%"></td>
								<td style='width:81px;'>انتخاب صفحه:</td>
								<td>
									<?php 
									echo "<select name='page' style='margin-bottom:0px;'>";
									for($i=1; $i<= $per_page; $i++)
									{
										$select_i=en2f_number($i);
										if (isset($_GET['page']))
										{
											$pages=$_GET['page'];
											if ($i==$pages)
											{
												echo "<option value='$i' selected>$select_i</option>";
												continue;
											}
											else
											{
												echo "<option value='$i'>$select_i</option>";
												continue;
											}
										}
										else
										{
											echo "<option value='$i'>$select_i</option>";
											continue;
										}
									}
									?>
									</select>
								</td>
								<td>
									<input type='hidden' name='year' value='<?php echo $cur_y; ?>'>
									<input type='hidden' name='add_sum' value='<?php echo $add_sum; ?>'>
									<input type='hidden' name='ext_sum' value='<?php echo $ext_sum; ?>'>
									<input type='hidden' name='add_anbar_code' value='<?php echo $anbar_code; ?>'>
									<input type='hidden' name='cur' value='<?php echo get_currency_id('cur_id'); ?>'>
									<input type='submit' class='btn btn-primary' value='تائید'>
								</td>
							</tr>
						</table>
					</form>
					<?php }
				echo "</div>";
				 }
				 else
				 { ?> 
				 <table class="table_setting" border="1">
					<tr> <th colspan='11'>لیست کالا های انبار</th></tr>
					<tr>
						<th>ردیف</th>
						<th>کد کالا</th>
						<th>شرح کالا</th>
						<th>نرخ</th>
						<th>مبلغ وارده</th>
						<th>مبلغ صادره</th>
						<th>مانده نقد</th>
						<th>مقدار وارده</th>
						<th>مقدار صادره</th>
						<th>مانده کالا</th>
						<th>مقدار باقی مانده</th>
					</tr>
					<tr style="height:200px;">
						<th colspan='11' ><h1>برای دریافت اطلاعات از فورم بالا استفاده کنید.</h1></th>
					</tr>
				</table>
				<?php } ?>
		</div>
		</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	