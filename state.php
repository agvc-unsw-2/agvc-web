<?php 
include_once("inc/settings.php");

$useLayout = !isset($_SERVER['HTTP_X_PJAX']);
if($useLayout)
	require_once("header.php");
?>
<div class="content-frame">
  <img src="<?= LOGO_URL?>" style="max-height: 80px; max-width: 80%"></img>
  <div style="min-height: 375px;">
  <pre id="statelist">
   </pre>
  <pre id="maplist">
   </pre>
  </div>
</div>


<script>
$(function()
{
	$("aside li").removeClass("active");
	$("#statetab").addClass("active");
	PM.Service.statelist();
});
</script>


<?php if($useLayout) require_once("footer.php"); ?>
