<?php 
include_once("inc/settings.php");

$useLayout = !isset($_SERVER['HTTP_X_PJAX']);
if($useLayout)
	require_once("header.php");
?>
<div class="content-frame col-md-12 col-sm-12 margin-bottom">
<img src="<?= LOGO_URL?>" style="max-height: 10vh; max-width: 80%"></img>

           <div id="server-stats" class="">
                                <div class="col-md-3 col-sm-6">
                                    <div id="overall-bandwidth" class="panel panel-animated panel-inverse bg-inverse animated fadeInUp" style="visibility: visible;">
                                        <div class="panel-body">

                                            <p class="lead">CPU Load</p><!--/lead as title-->

                                            <div class="easyPieChart" data-barcolor="#232332" data-trackcolor="#ecf0f1" data-scalecolor="#ecf0f1" data-percent="16" data-size="120">
                                                    <span>16%</span>
                                                </div>
                                                <p></p><p class="text-ellipsis text-center">Bandwidth Usage 120,4 GB / 2 TB</p>
                                            
                                        </div><!--/panel-body-->
                                    </div><!--/panel overal-bandwidth-->
                                </div><!--/cols-->

                                <div class="col-md-3 col-sm-6">
                                    <div id="overall-bandwidth" class="panel panel-animated panel-primary bg-primary animated fadeInUp" style="visibility: visible;">
                                        <div class="panel-body">

                                            <p class="lead">Battery Power</p><!--/lead as title-->

                                            <div class="easyPieChart" data-barcolor="#232332" data-trackcolor="#ecf0f1" data-scalecolor="#ecf0f1" data-percent="16" data-size="120">
                                                    <span>16%</span>
                                                </div>
                                                <p></p><p class="text-ellipsis text-center">Bandwidth Usage 120,4 GB / 2 TB</p>
                                            
                                        </div><!--/panel-body-->
                                    </div><!--/panel overal-bandwidth-->
                                </div><!--/cols-->

                                <div class="col-md-3 col-sm-6">
                                    <div id="overall-diskspace" class="panel panel-animated panel-success bg-success animated fadeInUp" style="visibility: visible;">
                                        <div class="panel-body">

                                            <p class="lead">Disk Space</p><!--/lead as title-->

                                            <div class="easyPieChart" data-barcolor="#232332" data-trackcolor="#ecf0f1" data-scalecolor="#ecf0f1" data-percent="37" data-size="120">
                                                    <span>37%</span>
                                                </div>
                                                <p></p><p class="text-ellipsis text-center">File Usage 128,137 / 200,000</p>
                                            
                                        </div><!--/panel-body-->
                                    </div><!--/panel overal-diskspace-->
                                </div><!--/cols-->

                                <div class="col-md-3 col-sm-6">
                                    <div id="overall-phisicmem" class="panel panel-animated panel-danger bg-danger animated fadeInUp" style="visibility: visible;">
                                        <div class="panel-body">

                                            <p class="lead">Physical Mem.</p><!--/lead as title-->

                                            <div class="easyPieChart" data-barcolor="#232332" data-trackcolor="#ecf0f1" data-scalecolor="#ecf0f1" data-percent="45" data-size="120">
                                                    <span>45%</span>
                                                </div>
                                                <p></p><p class="text-ellipsis text-center">Physical Memory Usage 457 MB / 1 GB</p>
                                            
                                        </div><!--/panel-body-->
                                    </div><!--/panel overal-phisicmem-->
                                </div><!--/cols-->
                            </div>

			<div class="col-md-6 col-sm-12">
<pre class="pre-scrollable small">
<?php
passthru('/usr/bin/top -b -n 1');
?>
</pre>
			</div>    
			<div class="col-md-6 col-sm-12">
<pre class="pre-scrollable small">
<?php
passthru('/bin/df -h');
?>
</pre>
<pre class="pre-scrollable small">
<?php
passthru('upower -i $(upower -e | grep BAT) | grep --color=never -E "state|to\ full|to\ empty|percentage"');
?>
</pre>
			</div>    

<script type="text/javascript">
$(function() {
  $('.easyPieChart').easyPieChart({
        //your configuration goes here
    });
});
</script>

</div>
<?php if($useLayout) require_once("footer.php"); ?>
