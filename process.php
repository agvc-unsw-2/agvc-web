<?php 
include_once("inc/settings.php");

$useLayout = !isset($_SERVER['HTTP_X_PJAX']);
if($useLayout)
	require_once("header.php");
?>
<div class="content-frame">
<img src="<?= LOGO_URL?>" style="max-height: 80px; max-width: 80%"></img>

<button class="btn" id="startstopallproc" style="float: right; margin-top: 30px" onclick="PM.Service.startstopallproc()">FULL SYSTEM</button>
<table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th>Process Name</th>
                                <th class="hidden-xs">PID</th>
                                <th class="hidden-xs">Memory</th>
                                <th class="hidden-xs">CPU</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="processlist">
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
$processes = array();

foreach($processes as $proc):
?>
                            <tr class="procrow">
                                <td><h4 class="proc"><?=$proc['name']?></h4></td>
                                <td class="hidden-xs"><?=$proc['id']>0 ? $proc['id'] : ""?></td>
                                <td class="hidden-xs"></td>
                                <td class="hidden-xs"></td>
				<td class="text-right">
					<button type="button" class="btn btn-icon btn-success"><i class="fa fa-check-circle"></i>Start</button>
					<button type="button" class="btn btn-icon btn-default" disabled="disabled"><i class="fa fa-exclamation"></i>Stop</button>
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
	PM.send('plist');
});
</script>

<script>
$(function()
{
	$("aside li").removeClass("active");
	$("#processtab").addClass("active");
});
</script>

<?php if($useLayout) require_once("footer.php"); ?>
