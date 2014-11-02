<?php 
$useLayout = !isset($_SERVER['HTTP_X_PJAX']);
if($useLayout)
	require_once("header.php");
?>
          <iframe width="100%" height="100%" src="map.php" frameborder="0" style="height: 100vh" scrolling="no" class="content-body" id="mapframe"></iframe>

<script>
$(function()
{
	$("aside li").removeClass("active");
	$("#maptab").addClass("active");

	setTimeout(PM.Service.map, 500);
});
</script>

<?php if($useLayout) require_once("footer.php"); ?>
