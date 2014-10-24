<?php 
$useLayout = !isset($_SERVER['HTTP_X_PJAX']);
if($useLayout)
	require_once("header.php");
?>
<iframe width="100%" height="100%" frameborder=0 src="drive.php"  style="min-height: 100vh"></iframe>

<script>
$(function()
{
	$("aside li").removeClass("active");
	$("#drivetab").addClass("active");
});
</script>


<?php if($useLayout) require_once("footer.php"); ?>
