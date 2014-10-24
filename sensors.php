<?php 
include_once("inc/settings.php");

$useLayout = !isset($_SERVER['HTTP_X_PJAX']);
if($useLayout)
	require_once("header.php");
?>
<div class="content-frame col-md-12">
  <img src="<?= LOGO_URL?>" style="max-height: 10vh; max-width: 80%; display: block"></img>
  <div class="col-md-6">
    <div id="panel-lidar" class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title"> Camera </h3></div>
      <div class="panel-body">
        <img id="camera1" src="data/frame0001.jpg" style="max-width: 100%">
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div id="panel-lidar" class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title"> Lidar </h3></div>
      <div class="panel-body">
        <div id="lidar"></div>              
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div id="panel-lidar" class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title"> Platform </h3></div>
      <div class="panel-body">
        <form class="form-horizontal form-bordered">
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="encolin">Battery (v)</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuy" disabled value="12.73"></div>
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="encolin">E-Stop</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuy" disabled value="false"></div>
          </div>
          <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="encolin">Linear Vel</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuy" disabled value="-0.0013"></div>
            <label class="col-md-3 col-sm-3 col-xs-6 control-label" for="encoang">Angular Vel</label>
            <div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="form-control" id="imuz" disabled value="0.03"></div>
          </div>
        </form>
      </div>
    </div>
  </div>


  <div class="col-md-6">
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
  </div>

  <div class="col-md-6">
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
  </div>

</div>

<script type="text/javascript">

var framenum = 100;

function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}

function drawlidar() {

var margin = {top: 0, right: 0, bottom: 0, left: 0},
    width = $("#lidar").width() - margin.left - margin.right,
    height = 300 - margin.top - margin.bottom;

var points = d3.range(1, 110).map(function(i) {
  return [i * 110 / 2500 + (3*3.141592653/4), 75 + .15* Math.random() * (height - 100)];
});

d3.select("#lidar svg").remove();

var svg = d3.select("#lidar").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom);
  //.append("g");
   //.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

 svg.selectAll("circle")
      .data(points)
      .enter()
      .append("circle")
      .attr("cx", function(d) { return Math.cos(d[0])*d[1] + width/2; })
      .attr("cy", function(d) { return Math.sin(d[0])*d[1] + height/2; })
      .attr("r", 1);


$("#camera1").attr('src', 'data/frame' + pad(framenum,4) + '.jpg');
framenum++;
};

var updInt = setInterval(drawlidar, 1000);

$('#lidar').bind('destroyed', function() {
	clearInterval(updInt);
})

</script>
<?php if($useLayout) require_once("footer.php"); ?>
