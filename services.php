<?php 
include_once("inc/settings.php");

$useLayout = !isset($_SERVER['HTTP_X_PJAX']);
if($useLayout)
	require_once("header.php");
?>
<div class="content-frame">
<img src="<?= LOGO_URL?>" style="max-height: 80px; max-width: 80%"></img>

<table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th>Service Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="servicelist">
<?php
/*
     1) roscore                 OFF                 GPS 16        ERR
     2) buttercup               OFF                 GPS 18        ERR
     3) navigation              OFF                 GPS Base      ERR
     4) laser                   OFF                 IMU          ok
     5) laser_pipeline          OFF                 Lidar         ERR
     6) imu                     OFF                 Camera 1     ok
     7) gps driver              OFF                 Camera 2     ok
     8) teleop                  OFF                 Pose         ok
     9) drive pipeline          OFF                 Plan         ok
     a) safety light            OFF                 Platform      ERR
     b) kernel msgs             OFF
*/
$services = array();

foreach($services as $svc):
?>
                            <tr class="svcrow">
                                <td><h4 class="proc"><?=$svc['name']?></h4></td>
				<td class="text-right">
					<button type="button" class="btn btn-icon btn-success"><i class="fa fa-dot-circle-o"></i>Start</button>
				</td>
                            </tr>
<?php
endforeach;
?>
                        </tbody>
                    </table>
</div>

<script>
$(function() {
	PM.send('slist');
});
</script>

<script>
$(function()
{
	$("aside li").removeClass("active");
	$("#servicestab").addClass("active");
});
</script>

<?php if($useLayout) require_once("footer.php"); ?>
