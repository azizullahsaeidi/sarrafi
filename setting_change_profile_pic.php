<?php $title="تصویر پروفایل "; 
include("../includes/connection.php"); 
include("../includes/header.php"); 
include("alert_messages.php");
?>
<script language="javascript" type="text/javascript">
$(function () {
    $("#profile_picture").change(function () {
        $("#select_img").html("");
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
        if (regex.test($(this).val().toLowerCase())) {
            if ($.browser.msie && parseFloat(jQuery.browser.version) <= 9.0) {
                $("#dvPreview").show();
                $("#dvPreview")[0].filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = $(this).val();
            }
            else {
                if (typeof (FileReader) != "undefined") {
                    $("#select_img").show();
                    $("#select_img").append("<img />");
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#select_img img").attr("src", e.target.result);
                        $("#select_img img").css("width","200px");
                        $("#select_img img").attr("id","select_images");
                        $("#select_img img").attr("name","myId");
                    }
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("بروزر حمایت کرده نمی تواند.");
                }
            }
        } else {
            alert("لطفاً از فارمت درست استفاده کنید.");
        }
    });
});
</script>
	<!-- Begining of Content -->
		<div class="content">
			<div class="span11 messages text-center">
				<table class="table_setting "style="width:50%;margin-right:222px">
				<form action="../controller/admin_query.php" method="post" enctype="multipart/form-data">
					<tr> <th colspan='1'><h3>درج تصویر</h3></th></tr>
					<tr>
						<td class='input_align' style='text-align:center;height:200px;' id="select_img"><img id="select_image" src="../images/admin_profile_pic/<?php echo $ad_photo; ?>" style='width:200px'></td>
					</tr>
					<tr>
						<td class='input_align'  style='text-align:center;'>
							<input type="file" id="profile_picture" name='update_photo'  style='width:200px;' required accept="image/*">
							<input type="hidden" name='update_user_id' style='width:200px' value="<?php echo $ad_id; ?>">
						</td>
					</tr>
					<tr>
						<td class='submit_reset' style='text-align:center;'>
						<input type="submit" class='btn btn-primary' value="ذخیره" style='width:200px'>
						</td>
					</tr>
					</form>	
				</table>
			</div>
		</div>
		<!-- End of Content -->
<?php include_once("../includes/footer.php"); ?>	