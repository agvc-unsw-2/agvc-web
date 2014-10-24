<?php
include_once("inc/settings.php");

$useLayout = !isset($_SERVER['HTTP_X_PJAX']);
if($useLayout)
	require_once("header.php");
?>
<div style="background-color: #fff; min-height: 100vh; min-width: 100%; display: table">
  <div style="text-align: center; vertical-align: middle; display:table-cell; ">
    <img src="<?= LOGO_URL?>" style="max-height: 50vh; max-width: 70%; display: inline-block"></img>
    <br/>
    <img src="imgs/logounsw.png" style="max-height: 20vh; max-width: 30%; display: inline-block"></img>
  </div>
</div>

<script>
$(function()
{
	$("aside li").removeClass("active");
	$("#dashboardtab").addClass("active");
});
</script>
<?php if($useLayout) require_once("footer.php"); ?>
