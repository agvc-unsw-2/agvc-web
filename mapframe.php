<?php 
$useLayout = !isset($_SERVER['HTTP_X_PJAX']);
if($useLayout)
	require_once("header.php");
?>
          <iframe width="100%" height="100%" src="map.php" frameborder="0" style="min-height: 100vh"></iframe>
<?php if($useLayout) require_once("footer.php"); ?>
