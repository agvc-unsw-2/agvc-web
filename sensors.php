<?php 
include_once("inc/settings.php");

$useLayout = !isset($_SERVER['HTTP_X_PJAX']);
if($useLayout)
	require_once("header.php");
?>
<div class="content-frame col-md-12" id="sensorframe">
  <img src="<?= LOGO_URL?>" style="max-height: 40px; max-width: 80%; display: block"></img>
  <div class="row">

  <div class="col-md-12">
    <div id="panel-lidar" class="panel panel-default">
      <div class="panel-heading bg-primary"><h3 class="panel-title"> Platform </h3></div>
      <div class="panel-body">
        <form class="form-horizontal form-bordered">
          <div class="form-group" style="padding-left: 20px">
            <label class="col-lg-1 col-sm-3 col-xs-6 control-label" for="encolin">Battery</label>
            <div class="col-lg-2 col-sm-3 col-xs-5"><input type="text" class="form-control" id="battery" disabled value="0.00"></div>
            <label class="col-lg-1 col-sm-3 col-xs-6 control-label" for="encolin">E-Stop</label>
            <div class="col-lg-2 col-sm-3 col-xs-5"><input type="text" class="form-control" id="estop" disabled value="F"></div>
          <!--/div>
          <div class="form-group"-->
            <label class="col-lg-1 col-sm-3 col-xs-6 control-label" for="encolin">Linear V</label>
            <div class="col-lg-2 col-sm-3 col-xs-5"><input type="text" class="form-control" id="cmdvellin" disabled value="0.00" width="100%"></div>
            <label class="col-lg-1 col-sm-3 col-xs-6 control-label" for="encoang">Rotate V</label>
            <div class="col-lg-2 col-sm-3 col-xs-5"><input type="text" class="form-control" id="cmdvelang" disabled value="0.00" width="100%"></div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div id="panel-lidar" class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title"> Camera Left </h3></div>
      <div class="panel-body" style="text-align: center">
        <img id="camera1" src="imgs/ring.gif" style="max-height: 360px; height: auto; width: 100%; object-fit: contain">
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div id="panel-lidar" class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title"> Camera Right </h3></div>
      <div class="panel-body" style="text-align: center">
        <img id="camera2" src="imgs/ring.gif" style="max-height: 360px; height: auto; width: 100%; object-fit: contain">
      </div>
    </div>
  </div>

  <!--div class="col-md-6">
    <div id="panel-lidar" class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title"> Lidar </h3></div>
      <div class="panel-body">
        <div id="lidar"></div>              
      </div>
    </div>
  </div>

  <div class="col-md-6 hidden-xs">
    <div id="panel-lidar" class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title"> Drive </h3></div>
      <div class="panel-body">
        <iframe frameborder=0 src="drive.php" style="height: 230px; min-height: 230px; width:100%" scrolling="false"></iframe>
      </div>
    </div>
  </div-->


  <!--div class="col-md-6">
    <div id="panel-lidar" class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title"> IMU </h3></div>
      <div class="panel-body">
        <form class="form-horizontal form-bordered">
          <div class="form-group">
            <label class="col-md-3 control-label col-sm-3 col-xs-6" for="imux">Ang Vel X</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imux" disabled value="0.0013"></div>
            <label class="col-md-3 control-label col-sm-3 col-xs-6" for="imux2">Ang Acc X</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imux2" disabled value="0.0013"></div>
          </div>
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="imuy">Ang Vel Y</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuy" disabled value="-0.0013"></div>
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="imuy2">Ang Acc Y</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuy2" disabled value="-0.0013"></div>
          </div>
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="imuz">Ang Vel Z</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuz" disabled value="0.03"></div>
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="imuz">Ang Acc Z</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuz2" disabled value="0.03"></div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div id="panel-lidar" class="panel panel-default">
      <div class="panel-heading bg-danger"><h3 class="panel-title"> GPS Onboard </h3></div>
      <div class="panel-body">
        <form class="form-horizontal form-bordered">
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="encolin">16 Lat</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuy" disabled value="-0.0013"></div>
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="encoang">16 Lon</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuz" disabled value="0.03"></div>
          </div>
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="encolin">18 Lat</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuy" disabled value="-0.0013"></div>
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="encoang">18 Lon</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuz" disabled value="0.03"></div>
          </div>
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="encolin">&Delta; X</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuy" disabled value="-0.0013"></div>
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="encoang">&Delta; Y</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuz" disabled value="0.03"></div>
          </div>
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="encolin">&mu; X</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuy" disabled value="-0.0013"></div>
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="encoang">&mu; Y</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuz" disabled value="0.03"></div>
          </div>
        </form>
      </div>
    </div>
  </div-->

  <!--div class="col-md-6">
    <div id="panel-lidar" class="panel panel-default">
      <div class="panel-heading bg-primary"><h3 class="panel-title"> GPS Offboard </h3></div>
      <div class="panel-body">
        <form class="form-horizontal form-bordered">
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="encolin">17 Lat</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuy" disabled value="-0.0013"></div>
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="encoang">17 Lon</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuz" disabled value="0.03"></div>
          </div>
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="encolin">&Delta; &mu; X</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuy" disabled value="-0.0013"></div>
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="encoang">&Delta; &mu; Y</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuz" disabled value="0.03"></div>
          </div>
        </form>
      </div>
    </div>
  </div-->

  </div>
</div>

<script type="text/javascript">

var framenum = 100;
var laserdata = {};
var barrels = {};
var lines = {};

var battery = 0;
var time_left = 0;
var estop = true;
var cmdvel = {'lin': 0, 'ang': 0};

function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}

var leftOK = true;
var rightOK = true;

$("#camera1").on('load', function() {
	leftOK = true;
});
$("#camera2").on('load', function() {
	rightOK = true;
});

function drawlidar() {

var margin = {top: 0, right: 0, bottom: 0, left: 0},
    width = $("#lidar").width() - margin.left - margin.right,
    height = 225 - margin.top - margin.bottom;

var points = d3.range(1, 110).map(function(i) {
  return [i * 110 / 2500 + (3*3.141592653/4), 75 + .15* Math.random() * (height - 100)];
});

if(laserdata && 'ranges' in laserdata) {
  points = [];
  angle = laserdata['min'];
  for(i = 0; i < laserdata['ranges'].length; i++) {
    range = laserdata['ranges'][i] * 20;

    if(range > 0)
      points.push([angle - (3.14159653/2), range]);

    angle += laserdata['inc'];
  }
}

d3.select("#lidar svg").remove();

var svg = d3.select("#lidar").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom);
  //.append("g");
   //.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

 // lidar points
 svg.selectAll("circle")
      .data(points)
      .enter()
      .append("circle")
      .attr("cx", function(d) { return Math.cos(d[0])*d[1] + width/2; })
      .attr("cy", function(d) { return Math.sin(d[0])*d[1] + height - 15; })
      .attr("r", 1);

  svg.selectAll("circle2")
      .data(barrels)
      .enter()
      .append("circle")
      .attr("cx", function(d) { return d[1]*20 + width/2; })
      .attr("cy", function(d) { return -d[0]*20 + height - 15; })
      .attr("r", .30 * 20)
      .style("stroke", "#cc0")
      .style("fill", "#cc0");

  svg.selectAll("line")
      .data(lines)
      .enter()
      .append("line")
      .attr("x1", function(d) { return d[1]*20 + width/2; })
      .attr("y1", function(d) { return -d[0]*20 + height - 15; })
      .attr("x2", function(d) { return d[3]*20 + width/2; })
      .attr("y2", function(d) { return -d[2]*20 + height - 15; })
      .attr("stroke-width", .15 * 20)
      .attr("stroke", "#993");

  // vertical lines
  svg.append("line")
      .attr("x1", width/2)
      .attr("y1", 0)
      .attr("x2", width/2)
      .attr("y2", height)
      .attr("stroke-width", 1)
      .attr("stroke", "#666");

  // horizontal lines
  svg.append("line")
      .attr("x1", 0)
      .attr("y1", height-15)
      .attr("x2", width)
      .attr("y2", height-15)
      .attr("stroke-width", 1)
      .attr("stroke", "#666");

  // vehicle line
  svg.append("line")
      .attr("x1", width/2)
      .attr("y1", height-15  - (-0.04 * 20))
      .attr("x2", width/2)
      .attr("y2", height-15  + (1.0 * 20))
      .attr("stroke-width", .8 * 20)
      .attr("stroke", "red");

  // distance line 5m
  svg.append("circle")
      .attr("cx", width/2)
      .attr("cy", height-15)
      .attr("r", 5 * 20)
      .style("stroke", "#999");

  // distance line 10m
  svg.append("circle")
      .attr("cx", width/2)
      .attr("cy", height-15)
      .attr("r", 10 * 20)
      .style("stroke", "#ccc");

  svg.append("text")
      .attr("x", width/2 + (5*20) + 3)
      .attr("y", height-3)
      .text("5");

  svg.append("text")
      .attr("x", width/2 + (10*20) + 3)
      .attr("y", height-3)
      .text("10");

//$("#camera1").attr('src', 'data/resize.php?path=left.jpg&' + pad(framenum,4) + Math.random());
//$("#camera2").attr('src', 'data/resize.php?path=right.jpg&' + pad(framenum,4) + Math.random());
if(leftOK) {
	$("#camera1").attr('src', 'data/left.jpg?' + pad(framenum,4) + Math.random());
	leftOK = false;
} else {
	console.log("Left camera frame skipped");
}
if(rightOK) {
	$("#camera2").attr('src', 'data/right.jpg?' + pad(framenum,4) + Math.random());
	rightOK = false;
} else {
	console.log("Right camera frame skipped");
}
$("#estop").attr('value', estop);
var battstr = Math.round(battery*100)/100;
if(time_left > 0)
	battstr += ' (' + Math.floor(time_left/60) +':' + ('0' + time_left % 60).slice(-2) + ')';
$("#battery").attr('value', battstr);
$("#cmdvelang").attr('value', Math.round(cmdvel['ang']*100)/100);
$("#cmdvellin").attr('value', typeof cmdvel['lin'] == 'string' ? cmdvel['lin'] : Math.round(cmdvel['lin']*100)/100);
framenum++;


};


</script>

<script>
$(function()
{
	console.log("SensorFrame started");
	$("aside li").removeClass("active");
	$("#sensorstab").addClass("active");

  var updInt = setInterval(drawlidar, 200);
$('#sensorframe').bind('destroyed', function() {
	console.log("SensorFrame stopped");
	clearInterval(updInt);
})

});
</script>


<?php if($useLayout) require_once("footer.php"); ?>
