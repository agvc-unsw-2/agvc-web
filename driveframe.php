<?php 
$useLayout = !isset($_SERVER['HTTP_X_PJAX']);
if($useLayout)
	require_once("header.php");
?>
<iframe frameborder=0 src="drive.php" style="height: 100%; width:100%;min-height: 425px" scrolling="false"></iframe>
<script>
$(function()
{
	$("aside li").removeClass("active");
	$("#drivetab").addClass("active");
});
</script>

<?php if($useLayout) require_once("footer.php"); ?>
