<?php 
include_once("inc/settings.php");

$useLayout = !isset($_SERVER['HTTP_X_PJAX']);
if($useLayout)
	require_once("header.php");
?>
<div class="content-frame">
<img src="<?= LOGO_URL?>" style="max-height: 10vh; max-width: 80%"></img>

<table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Process Name</th>
                                <th>PID</th>
                                <th>Memory</th>
                                <th>CPU Time</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
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
$processes = array(
	array("name"=>"roscore", "id"=>0),
	array("name"=>"buttercup", "id"=>0),
	array("name"=>"navigation", "id"=>0),
	array("name"=>"laser", "id"=>0),
	array("name"=>"laser pipeline", "id"=>0),
	array("name"=>"imu", "id"=>0),
	array("name"=>"gps driver", "id"=>0),
	array("name"=>"teleop", "id"=>0),
	array("name"=>"drive pipeline", "id"=>0),
	array("name"=>"safety light", "id"=>0),
	array("name"=>"kernel msgs", "id"=>0),
);

foreach($processes as $proc):
?>
                            <tr>
                                <td><h4 class="proc"><?=$proc['name']?></h4></td>
                                <td><?=$proc['id']>0 ? $proc['id'] : ""?></td>
                                <td></td>
                                <td></td>
				<td>
					<button type="button" class="btn btn-icon btn-success"><i class="fa fa-check-circle"></i>Start</button>
					<!--button type="button" class="btn btn-icon btn-default" disabled="disabled"><i class="fa fa-warning"></i>Restart</button-->
					<button type="button" class="btn btn-icon btn-default" disabled="disabled"><i class="fa fa-exclamation"></i>Stop</button>
				</td>
                            </tr>
<?php
endforeach;
?>
                        </tbody>
                    </table>
</div>
<?php if($useLayout) require_once("footer.php"); ?>
