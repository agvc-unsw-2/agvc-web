<?php 
include_once("inc/settings.php");

$useLayout = !isset($_SERVER['HTTP_X_PJAX']);
if($useLayout)
	require_once("header.php");
?>
<style>

.axis path,
	.axis line{
fill: none;
stroke: black;
	}

.line{
fill: none;
stroke: blue;
		stroke-width: 2px;
}

.tick text{
	font-size: 12px;
}

.tick line{
opacity: 0.2;
}

</style>

<div class="content-frame">
  <img src="<?= LOGO_URL?>" style="max-height: 80px; max-width: 80%"></img>
  <div style="min-height: 375px;" class="row-fluid">
    <div class="col-md-3 col-xs-6">
      <h4>HFSM</h4>
      <pre id="statelist"></pre>
	</div>
    <div class="col-md-9">
      <h4>Vis</h4>
	  <div id="vis" style="height: 480px; width: 700px"><svg style="width: 100%; height: 100%"></svg></div>
    </div>
  </div>
</div>
<div style="position: fixed; bottom: 0px; width: 100%; margin: 0 10px; padding: 0">
    <h4>Map DB</h4>
    <pre id="maplist" style="font-size: 10px; margin: 0" ></pre>
  </div>
</div>

<script type="text/javascript">
function getmapobjectcolor(desc)
{
	var color = '#000';							
	switch(desc) {
		case 'Y': color = '#990'; break;
		case 'G': color = '#060'; break;
		case 'R': color = '#600'; break;
		case 'B': color = '#006'; break;
		case 'O': color = 'darkorange'; break;
	}

	return color;
}

var scale = 7;
var width = scale*95;
var height = scale*65;

function initMap()
{

	var xScale = d3.scale.linear()
		.domain([-(width/scale)/2, (width/scale)/2])
		.range([0, width]);

	var yScale = d3.scale.linear()
		.domain([-(height/scale)/2, (height/scale)/2])
		.range([height, 0]);

	var xAxis = d3.svg.axis()
		.scale(xScale)
		.orient("bottom")
		.innerTickSize(-height)
		.outerTickSize(0)
		.tickPadding(10)
		.ticks(width/scale/5);

	var yAxis = d3.svg.axis()
		.scale(yScale)
		.orient("right")
		.innerTickSize(width)
		.outerTickSize(0)
		.tickPadding(10)
		.ticks(height/scale/5);

	var svg = d3.select("#vis svg");

svg.append("g")
		.attr("class", "x axis")
		.attr("transform", "translate(0," + height + ")")
		.call(xAxis)

		svg.append("g")
		.attr("class", "y axis")
		.call(yAxis)
}

function updatemapobjects(mo)
{
	console.log(mo);


	// clear
	//d3.select("#vis svg").remove();

	// build
	//var svg = d3.select("#vis").append("svg");
	var svg = d3.select("#vis svg");

	var cw = width/2;
	var ch = height/2;

	console.log(cw);

	svg.selectAll("circle").remove();

	svg.selectAll("circle")
		.data(mo)
		.enter()
		.append("circle")
		.attr("cx", function(d) { return (d[2] * scale) + cw; })
		.attr("cy", function(d) { return (d[3] * scale) + ch; })
		.attr("r", 0.2 * scale)
		.style("stroke", function(d) { return getmapobjectcolor(d[24]); })
}

$(function()
{
	$("aside li").removeClass("active");
	$("#statetab").addClass("active");
	initMap();
	PM.Service.statelist();
});
</script>


<?php if($useLayout) require_once("footer.php"); ?>
