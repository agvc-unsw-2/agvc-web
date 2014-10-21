<?php 
include_once("inc/settings.php");

$useLayout = !isset($_SERVER['HTTP_X_PJAX']);
if($useLayout)
	require_once("header.php");
?>
<div class="content-frame margin-bottom">
<img src="<?= LOGO_URL?>" style="max-height: 10vh; max-width: 80%"></img>

           <div class="col-sm-12 col-md-12">
                                <div class="col-md-3 col-sm-6">
                                    <div id="overall-bandwidth" class="panel panel-animated panel-inverse bg-inverse animated fadeInUp" style="visibility: visible;">
                                        <div class="panel-body">

						<i class="fa fa-check fa-2x" style="float: right"></i>
                                            <p class="lead">Router x.1</p><!--/lead as title-->
                                            
                                        </div><!--/panel-body-->
                                    </div><!--/panel overal-bandwidth-->
                                </div><!--/cols-->

                                <div class="col-md-3 col-sm-6">
                                    <div id="overall-bandwidth" class="panel panel-animated panel-inverse bg-inverse animated fadeInUp" style="visibility: visible;">
                                        <div class="panel-body">

						<i class="fa fa-check fa-2x" style="float: right"></i>
                                            <p class="lead">Router x.3</p><!--/lead as title-->

                                        </div><!--/panel-body-->
                                    </div><!--/panel overal-bandwidth-->
                                </div><!--/cols-->

                                <div class="col-md-3 col-sm-6">
                                    <div id="overall-diskspace" class="panel panel-animated panel-success bg-success animated fadeInUp" style="visibility: visible;">
                                        <div class="panel-body">

						<i class="fa fa-check fa-2x" style="float: right"></i>
                                            <p class="lead">SICK LMS151 x.7</p><!--/lead as title-->

                                        </div><!--/panel-body-->
                                    </div><!--/panel overal-diskspace-->
                                </div><!--/cols-->

                                <div class="col-md-3 col-sm-6">
                                    <div id="overall-phisicmem" class="panel panel-animated panel-danger bg-danger animated fadeInUp" style="visibility: visible;">
                                        <div class="panel-body">

						<i class="fa fa-check fa-2x" style="float: right"></i>
                                            <p class="lead">GPS Receiver x.16</p><!--/lead as title-->
                                        </div><!--/panel-body-->
                                    </div><!--/panel overal-phisicmem-->
                                </div><!--/cols-->

                                <div class="col-md-3 col-sm-6">
                                    <div id="overall-phisicmem" class="panel panel-animated panel-danger bg-danger animated fadeInUp" style="visibility: visible;">
                                        <div class="panel-body">

						<i class="fa fa-check fa-2x" style="float: right"></i>
                                            <p class="lead">GPS Receiver x.18</p><!--/lead as title-->
                                        </div><!--/panel-body-->
                                    </div><!--/panel overal-phisicmem-->
                                </div><!--/cols-->

                                <div class="col-md-3 col-sm-6">
                                    <div id="overall-phisicmem" class="panel panel-animated panel-primary bg-primary animated fadeInUp" style="visibility: visible;">
                                        <div class="panel-body">

						<i class="fa fa-check fa-2x" style="float: right"></i>
                                            <p class="lead">GPS Receiver x.17</p><!--/lead as title-->
                                        </div><!--/panel-body-->
                                    </div><!--/panel overal-phisicmem-->
                                </div><!--/cols-->

                                <div class="col-md-3 col-sm-6">
                                    <div id="overall-phisicmem" class="panel panel-animated panel-cloud bg-cloud animated fadeInUp" style="visibility: visible;">
                                        <div class="panel-body">

						<i class="fa fa-check fa-2x" style="float: right"></i>
                                            <p class="lead">Internet</p><!--/lead as title-->
                                        </div><!--/panel-body-->
                                    </div><!--/panel overal-phisicmem-->
                                </div><!--/cols-->
                            </div>
		</div>
		<div class="col-md-12 col-sm-12">

			<div class="col-md-6 col-sm-12">
<pre class="pre-scrollable small">
<?php
passthru('ethtool eth0');
?>
</pre>
			</div>    
			<div class="col-md-6 col-sm-12">
<pre class="pre-scrollable small">
<?php
passthru('iwconfig wlan0');
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
