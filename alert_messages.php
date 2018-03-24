<?php
function full_alert_message(){
	if(isset($_GET['opt'])){
			if($_GET['opt']=='true'){
				echo "<div class='alert alert-success' id='alert_message'><span class='text-right red_color' >توجه! </span>  موفقانه ثبت گردید.</div>";
		}elseif($_GET['opt']=='false'){ 
				echo "<div class='alert alert-danger' id='alert_message'><span class='text-right red_color' >توجه! </span>  ثبت نگردید.</div>";
		}elseif($_GET['opt']=='exist') {
				echo "<div class='alert alert-warning' id='alert_message'><span class='text-right red_color' >ببخشید! </span> موجود است.</div>";
		}elseif($_GET['opt']=='updated') {
				echo "<div class='alert alert-success' id='alert_message'><span class='text-right red_color' >توجه! </span> ویرایش موفقانه صورت گرفت.</div>";
		}elseif($_GET['opt']=='deleted') {
				echo "<div class='alert alert-success' id='alert_message'><span class='text-right red_color' >توجه! </span> موفقانه حذف گردید.</div>";
		}elseif($_GET['opt']=='reject') {
				echo "<div class='alert alert-warning' id='alert_message'><span class='text-right red_color' >توجه! </span> حذف نگردید.</div>";
		}elseif($_GET['opt']=='empty') {
				echo "<div class='alert alert-warning' id='alert_message'><span class='text-right red_color' >توجه! </span> اطلاعات را درست وارد کنید.</div>";
		}}
	}
function alert_messages(){
	if(isset($_GET['opt']))
		{
			if($_GET['opt']=='deleted')
			{
				echo "<div class='alert alert-success' id='alert_messages'><span class='text-right red_color' >توجه! </span> حذف گردید.</div>";
			}
			elseif($_GET['opt']=='reject')
			{ 
				echo "<div class='alert alert-danger' id='alert_messages'><span class='text-right red_color' >توجه! </span> حذف نگردید.</div>";
			} 
			elseif($_GET['opt']=='done') 
			{
				echo "<div class='alert alert-success' id='alert_messages'><span class='text-right ' >توجه! </span> ویرایش موفقانه صورت گرفت.</div>";
			}
			elseif($_GET['opt']=='true') 
			{
				echo "<div class='alert alert-success' id='alert_messages'><span class='text-right ' >توجه! </span> موفقانه ثبت گردید.</div>";
			}
		}
}

function add_admin_alert(){
	if(isset($_GET['opt'])){
			if($_GET['opt']=='pass_no_conf'){?>
				<div class="alert alert-danger" id='alert_messages'><span class='text-right red_color' >توجه! </span> رمز عبور با تائید آن یکی نیست.</div>
		<?php }elseif($_GET['opt']=='false'){ ?>
				<div class="alert alert-danger" id='alert_messages'><span class='text-right red_color' >توجه! </span> مدیر جدید ثبت نگردید.</div>
		<?php }elseif($_GET['opt']=='exist') {?>
				<div class="alert alert-warning" id='alert_messages'><span class='text-right red_color' >ببخشید! </span> نام کاری شما در سیستم موجود است.</div>
		<?php }}
}