<html>
<head>
<title>My Dashboard</title>
<script src="jquery-2.1.1.min.js"></script>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
html { height: 100% }
body { height: 100%; margin: 0; padding: 0 }
#map-canvas { height: 100% }
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnvO1E29_wY49gCJCISs1vDzCnvfSznXg&sensor=SET_TO_TRUE_OR_FALSE">
</script>
<script type="text/javascript">
// This example creates a 2-pixel-wide red polyline showing
// the path of William Kingsford Smith's first trans-Pacific flight between
// Oakland, CA, and Brisbane, Australia.

var map;
var barrels = [];

function update()
{
//alert('update');
	$.getJSON( "test.php", function( data ) {
		if(barrels.length < 100)
			setTimeout(update, 1000);

		for (var idx in data.waypoints) {
			var waypoint = data.waypoints[idx];
			var populationOptions = {
				strokeColor: '#FF0000',
				strokeOpacity: 1.0,
				strokeWeight: 2,
				fillColor: '#FF0000',
				fillOpacity: 0.75,
				map: map,
				center: new google.maps.LatLng(waypoint.lat, waypoint.lon),
				radius: .75,
				};
//			alert('lat is ' + waypoint.lat + ' , lon is ' + waypoint.lon);
			// Add the circle for this city to the map.
			cityCircle = new google.maps.Circle(populationOptions);
			cityCircle.setMap(map);

			barrels.push(waypoint);
		}

	});
}

function initialize() {
	$.getJSON( "test.json?1", function( data ) {
		setTimeout(update, 1000);

		var mapOptions = {
			center: new google.maps.LatLng(data.robot_lat, data.robot_lon),
			zoom: 19,
			mapTypeId: google.maps.MapTypeId.SATELLITE
		};

		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

		var flightPlanCoordinates = [
			new google.maps.LatLng(37.772323, -122.214897),
			new google.maps.LatLng(21.291982, -157.821856),
			new google.maps.LatLng(-18.142599, 178.431),
			new google.maps.LatLng(-27.46758, 153.027892)
		];

		var flightPath = new google.maps.Polyline({
			path: flightPlanCoordinates,
			geodesic: true,
			strokeColor: '#FF0000',
			strokeOpacity: 1.0,
			strokeWeight: 2
		});

		//flightPath.setMap(map);
	});

}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
</head>
<body>
<div id="map-canvas"/>
</body>
</html>
