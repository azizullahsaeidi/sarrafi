<?php $title=" بخش جستجو"; ?>
<?php include("../includes/connection.php"); ?>
<?php include("../includes/header.php");?>

<script type="text/javascript" src="../cal/scripts/calendar.all.js"></script>
<script type="text/javascript" src="../cal/scripts/calendar.js"></script>
<script type="text/javascript" src="../cal/scripts/jquery.ui.core.js"></script>
<script type="text/javascript" src="../cal/scripts/jquery.ui.datepicker-cc-fa.js"></script>
<script type="text/javascript" src="../cal/scripts/jquery.ui.datepicker-cc.js"></script>


  <script type="text/javascript">
	    $(function() {
	        // حالت پیشفرض
	        $('#datepicker12from').datepicker({

	            onSelect: function(dateText, inst) {
	                $('#datepicker12to').datepicker('option', 'minDate', new JalaliDate(inst['selectedYear'], inst['selectedMonth'], inst['selectedDay']));
	            	
	            }
	        });
	        $('#datepicker12to').datepicker();
	        //-----------------------------------
	      
	    });
    </script>




	<!-- Begining of Content -->
		<div class="content">
		<div class='span11' style="width:884px;margin:0px;min-height:24px;padding:5px 20px;">
			
			<div class="span11 add_table" style="width:500px;margin:0px;min-height:24px;padding:30px 20px;margin-right:170px;">
				<table class="table_setting" >
				<form action="../controller/bank_query.php" method="post" id="bank_date_search_option">
					<tr> <th colspan='2' style='padding-right:20px;'><h3>جستجو بر اساس تاریخ</h3></th></tr>
					<tr>
						<td class='label_align'>واحد پول:</td>
						<td class='input_align' style="direction:ltr">
							
							<input type="text" id="x-small-code" min="0"  max='99' value="<?php get_currency_id('cur_name'); ?>"  style="text-align:center" placeholder="کد انبار" readonly required>
						</td>
					</tr>
					<tr>
						<td class='label_align'> انتخاب رسید/برگ پرداخت :</td>
						<td class='input_align'>
							<select id="bank_acount_number" class="search_anbar" name="bank_date_search_type">
								<option value="none">انتخاب رسید/برگ پرداخت</option>
								<option value='cash'>رسید وجه - نقد</option>
								<option value='check'>رسید وجه - بهادار</option>
								<option value='extract'>صدور چک</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class='label_align'> از :</td>
						<td class='input_align'>
							
							<input type='text' id='datepicker12from' name='sd' required>
						</td>
					</tr>
					<tr>
						<td class='label_align'>تا :</td>
						<td class='input_align'>
							<input type='text' id='datepicker12to' name='ed' required>
							
						</td>
					</tr>
					
					<tr>
						<td class='label_align'> </td>
						<td class='submit_reset'>
							
								<input type="hidden" name="cur" class='' value="<?php get_currency_id('cur_id'); ?>">
						<input type="submit" class='btn btn-primary' value="جستجو" style="width:246px;">
						
						</td>
					</tr>
					
					
					</form>	
				</table>
			</div>
			</div>
			
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	