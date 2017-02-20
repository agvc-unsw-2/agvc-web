<?php 
include_once("inc/settings.php");

$useLayout = !isset($_SERVER['HTTP_X_PJAX']);
if($useLayout)
	require_once("header.php");
?>
<style>

.axis path, .axis line{
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

.action 
{
  display: inline-block; 
  padding: 3px; 
  width: 60px; 
  margin: 0 8px; 
  text-align: center;
  border: 1px dotted #999;
  cursor: pointer;
}

.inactive
{
  opacity: 0.3;
  cursor: not-allowed;
}

.action small
{
  font-size: .7em;
}
</style>

<div class="content-frame">
  <img src="<?= LOGO_URL?>" style="max-height: 40px; max-width: 80%"></img>
  <div style="min-height: 375px;" class="row-fluid">
    <div class="col-md-3">
	  <div class="row">
  	    <div class="col-sm-6 col-md-12">
	      <h4>HFSM</h4>
	      <pre id="statelist"></pre>
		  <span class="action">
   	 	    <i class="fa fa-space-shuttle fa-2x" aria-hidden="true"></i><br/>
			<small>Takeoff</small>
		  </span>
		  <!--span class="action">
   	 	    <i class="fa fa-ambulance fa-2x" aria-hidden="true"></i><br/>
			<small>RTL</small>
		  </span-->
		  <span class="action inactive">
   	 	    <i class="fa fa-fire-extinguisher fa-2x" aria-hidden="true"></i><br/>
			<small>Land</small>
		  </span>
		  <span class="action inactive">
   	 	    <i class="fa fa-cube fa-2x" aria-hidden="true"></i><br/>
			<small>Drop</small>
		  </span>
	    </div>
	    <div class="col-sm-6 col-md-12">
	      <h4>Selection</h4>
	      <pre id="selectioninfo"></pre>
		  <span class="action inactive">
   	 	    <i class="fa fa-hand-grab-o fa-2x" aria-hidden="true"></i><br/>
			<small>Pickup</small>
		  </span>
		  <span class="action">
   	 	    <i class="fa fa-crosshairs fa-2x" aria-hidden="true"></i><br/>
			<small>LandOn</small>
		  </span>
		  <span class="action">
   	 	    <i class="fa fa-location-arrow fa-2x" aria-hidden="true"></i><br/>
			<small>MoveTo</small>
		  </span>
	    </div>
	  </div>
	</div>
    <div class="col-md-9">
      <h4>Vis</h4>
	  <div id="vis" style="height: 480px; width: 700px"><svg style="width: 100%; height: 100%; cursor: crosshair"></svg></div>
    </div>
  </div>
</div>
<div style="position: fixed; bottom: 0px; width: 100%; margin: 0 10px; padding: 0">
    <h4>Map DB</h4>
    <pre id="maplist" style="font-size: 10px; margin: -5px -10px" ></pre>
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

var inited = false;
var xAxis = null;
var yAxis = null;
var objectContainer = null;
var selectedID = -1;

function initMap()
{
	inited = true;
	var xScale = d3.scale.linear()
		.domain([-(width/scale)/2, (width/scale)/2])
		.range([0, width]);

	var yScale = d3.scale.linear()
		.domain([-(height/scale)/2, (height/scale)/2])
		.range([height, 0]);

	xAxis = d3.svg.axis()
		.scale(xScale)
		.orient("bottom")
		.innerTickSize(-height)
		.outerTickSize(0)
		.tickPadding(10)
		.ticks(width/scale/5);

	yAxis = d3.svg.axis()
		.scale(yScale)
		.orient("right")
		.innerTickSize(width)
		.outerTickSize(0)
		.tickPadding(10)
		.ticks(height/scale/5);

	var svg = d3.select("#vis svg");

	objectContainer = svg.append("g");

svg.append("g")
		.attr("class", "x axis")
		.attr("transform", "translate(0," + height + ")")
		.call(xAxis)

		svg.append("g")
		.attr("class", "y axis")
		.call(yAxis)


		var zoom = d3.behavior.zoom()
		.x(xScale)
		.y(yScale)
		.scaleExtent([.5, 5])
		.on("zoom", zoomed);
	svg.call(zoom);

	/*var drag = d3.behavior.drag()
	.origin(function(d) { return d; })
	.on("dragstart", dragstarted)
	.on("drag", dragged)
	.on("dragend", dragended);
    svg.call(drag);*/

}

function zoomed() {
	var svg = d3.select("#vis svg");
	svg.select(".x.axis").call(xAxis);
	svg.select(".y.axis").call(yAxis);

	objectContainer.attr("transform", "translate(" + d3.event.translate + ")scale(" + d3.event.scale + ")");
}

function updatemapobjects(mo)
{
	if(inited == false)
		initMap();

//	var svg = d3.select("#vis svg");

	var cw = width/2;
	var ch = height/2;

	console.log(cw);

	objectContainer.selectAll("circle").remove();

	objectContainer.selectAll("circle")
		.data(mo)
		.enter()
		.append("circle")
		.attr("cx", function(d) { return (d[2] * scale) + cw; })
		.attr("cy", function(d) { return (d[3] * scale) + ch; })
		.attr("r", 0.4 * scale)
		.style("margin", "3px")
		.style("stroke", function(d) { return selectedID == d[1] ? "#ccc" : "#ffffffff";})
		.style("stroke-width", "2px")
		.style("fill", function(d) { return getmapobjectcolor(d[24]); })
		.style("fill-opacity", ".8")
		.on('click', function(d, i) { 
				$("#selectioninfo").html(d[0] + ' ' + d[1]);
				selectedID = d[1];
		})
		.append("svg:title")
		.text(function(d) { return d[1]; })
}

$(function()
{
initMap();
	$("aside li").removeClass("active");
	$("#statetab").addClass("active");
	PM.Service.statelist();
});
</script>


<?php if($useLayout) require_once("footer.php"); ?>
