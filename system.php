<?php 
include_once("inc/settings.php");
include_once("inc/helpers.php");

$useLayout = !isset($_SERVER['HTTP_X_PJAX']);
if($useLayout)
	require_once("header.php");

$systemLoadAvg = sys_getloadavg();
$numCpus = num_cpus();
$cpuLoadPct = $systemLoadAvg[0]/$numCpus;
$freeDiskSpacePct = disk_free_space("./") / disk_total_space("./");
$memInfo = getSystemMemInfo();
$freeMemPct = 1 - ($memInfo['MemFree'] / $memInfo['MemTotal']);

$power = `upower -i $(upower -e | grep BAT) | grep --color=never -E "state|to\ full|to\ empty|percentage"`;
$powerPct = 1;
$powerText = "no battery";
if($power) {
  $powerlines = split("\n", $power);
  $powerText = split(":", $powerlines[0]);
  $powerText = trim($powerText[1]);
  
  $powerRemaining = split(":", $powerlines[1]);
  $powerRemaining = trim($powerRemaining[1]);

  $powerText .= ": " . $powerRemaining;

  $powerPct = split(":", $powerlines[2]);
  $powerPct = trim(str_replace("%","", $powerPct[1])) / 100.0;
}
?>
<div class="content-frame margin-bottom">
<img src="<?= LOGO_URL?>" style="max-height: 10vh; max-width: 80%"></img>

           <div id="server-stats">
                                <div class="col-md-3 col-sm-6">
                                    <div id="overall-bandwidth" class="panel panel-animated panel-inverse bg-inverse animated fadeInUp" style="visibility: visible;">
                                        <div class="panel-body">

                                            <p class="lead">CPU Load</p><!--/lead as title-->

                                            <div class="easyPieChart epcneed" data-barcolor="#232332" data-trackcolor="#ecf0f1" data-scalecolor="#ecf0f1" data-percent="<?= 100*$cpuLoadPct?>" data-size="120">
                                                    <span><?= sprintf("%.0f", 100 *$cpuLoadPct)?><small>%</small></span>
                                                </div>
                                                <p></p><p class="text-ellipsis text-center"><?= join($systemLoadAvg, ", ")?></p>
                                            
                                        </div><!--/panel-body-->
                                    </div><!--/panel overal-bandwidth-->
                                </div><!--/cols-->

                                <div class="col-md-3 col-sm-6">
                                    <div id="overall-bandwidth" class="panel panel-animated panel-primary bg-primary animated fadeInUp" style="visibility: visible;">
                                        <div class="panel-body">

                                            <p class="lead">Laptop Battery</p><!--/lead as title-->

                                            <div class="easyPieChart epcneed" data-barcolor="#232332" data-trackcolor="#ecf0f1" data-scalecolor="#ecf0f1" data-percent="<?= 100 * $powerPct?>" data-size="120">
                                                    <span><?= sprintf("%.0f", $powerPct * 100) ?><small>%</small></span>
                                                </div>
                                                <p></p><p class="text-ellipsis text-center"><?= $powerText?></p>
                                            
                                        </div><!--/panel-body-->
                                    </div><!--/panel overal-bandwidth-->
                                </div><!--/cols-->

                                <div class="col-md-3 col-sm-6">
                                    <div id="overall-diskspace" class="panel panel-animated panel-success bg-success animated fadeInUp" style="visibility: visible;">
                                        <div class="panel-body">

                                            <p class="lead">Disk Space</p><!--/lead as title-->

                                            <div class="easyPieChart epcneed" data-barcolor="#232332" data-trackcolor="#ecf0f1" data-scalecolor="#ecf0f1" data-percent="<?= sprintf("%.0f", 100-$freeDiskSpacePct*100)?>" data-size="120">
                                                    <span><?= sprintf("%.0f", 100-$freeDiskSpacePct*100)?><small>%</small></span>
                                                </div>
                                                <p></p><p class="text-ellipsis text-center"><?= sprintf("%.2f GB", disk_free_space("./")/(1024*1024*1024))?> free</p>
                                            
                                        </div><!--/panel-body-->
                                    </div><!--/panel overal-diskspace-->
                                </div><!--/cols-->

                                <div class="col-md-3 col-sm-6">
                                    <div id="overall-phisicmem" class="panel panel-animated panel-danger bg-danger animated fadeInUp" style="visibility: visible;">
                                        <div class="panel-body">

                                            <p class="lead">Physical Mem.</p><!--/lead as title-->

                                            <div class="easyPieChart epcneed" data-barcolor="#232332" data-trackcolor="#ecf0f1" data-scalecolor="#ecf0f1" data-percent="<?= $freeMemPct * 100?>" data-size="120">
                                                    <span><?= sprintf("%.0f", $freeMemPct*100)?><small>%</small></span>
                                                </div>
                                                <p></p><p class="text-ellipsis text-center"><?= sprintf("%.0f", $memInfo['MemFree']/1024)?> MB free</p>
                                            
                                        </div><!--/panel-body-->
                                    </div><!--/panel overal-phisicmem-->
                                </div><!--/cols-->
			    </div>






	   <div id="statuslist">
           </div>











                <div class="hidden-sm hidden-xs">

			<div class="col-md-6 col-sm-12">
Processes:
<pre class="pre-scrollable small">
<?php
passthru('/usr/bin/top -b -n 1 -u husky');
?>
</pre>
			</div>    
			<div class="col-md-6 col-sm-12">
Filesystem:
<pre class="pre-scrollable small">
<?php
passthru('/bin/df -h');
?>
</pre>
			</div>    
			<div class="col-md-6 col-sm-12">
ROS Topic List:
<pre class="pre-scrollable small">
ERROR: Unable to communicate with master!
</pre>
			</div>    
			<div class="col-md-6 col-sm-12">
ROS Transform List:
<pre class="pre-scrollable small">
ERROR: Unable to communicate with master!
</pre>
			</div>    
		</div-->

<script type="text/javascript">
$(function() {
  $('.epcneed').removeClass('epcneed').easyPieChart({
        //your configuration goes here
    });
});
</script>
<script type="text/javascript">
$(function() {
	PM.send('statuslist');
});
</script>

</div>


<script>
$(function()
{
	$("aside li").removeClass("active");
	$("#systemtab").addClass("active");
});
</script>


<?php if($useLayout) require_once("footer.php"); ?>
