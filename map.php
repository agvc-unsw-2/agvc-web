<html>
<head>
<title>My Dashboard</title>
<script src="js/jquery-2.1.1.min.js"></script>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
html { height: 100% }
body { height: 100%; margin: 0; padding: 0 }
#map-canvas { height: 100% }
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnvO1E29_wY49gCJCISs1vDzCnvfSznXg&sensor=false&libraries=geometry"></script>
<script type="text/javascript">
// This example creates a 2-pixel-wide red polyline showing
// the path of William Kingsford Smith's first trans-Pacific flight between
// Oakland, CA, and Brisbane, Australia.

var map;
var barrels = [];
var initialized = false;
var localmarker = null;
var destmarker = null;
var path = null;
var draggingDestination = false;
var meterpermillilat = 110.92088;
var meterpermillilng = 92.47358;

var lastobj = null;
window.onmessage = function(m) {
        obj = m.data;
	if(obj['r'] == 'map') {
                lastobj = obj['mapinfo'];

		if(!initialized && obj['mapinfo']['gps'] != null) {
			if(typeof(google) != 'undefined')
				googleinitialize(obj['mapinfo']['gps']);
		}
		else
		{
			//obj['mapinfo']['gps']['lat'] = localmarker.getPosition().lat() + .00001;
			if(typeof(google) != 'undefined') 
				googleupdate(obj['mapinfo']);
		}
		console.log(obj); 
        }
};


function googleupdate(obj)
{

	localmarker.setPosition(obj['gps']);
        if(obj['mappos']) {
            var icon = localmarker.getIcon();
            icon.rotation = obj['mappos']['rpy'][2] * 180.0 / 3.141592653 + 90;
            localmarker.setIcon(icon);

            var pathlatlns = [];
            if(obj['path']) {
	        for(i = 0; i < obj['path']['x'].length; i+=1) {
	           pathlatlns.push({
		     'lat': obj['gps']['lat'] + ((obj['path']['x'][i] - obj['mappos']['pos'][0]) / meterpermillilat)/1000,
		     'lng': obj['gps']['lng'] + ((obj['path']['y'][i] - obj['mappos']['pos'][1]) / meterpermillilng)/1000
	           });
                }
                if(!draggingDestination && pathlatlns.length > 0)
                    destmarker.setPosition(pathlatlns[pathlatlns.length-1]);
            }
	    path.setPath(pathlatlns);

        }
/*	$.getJSON( "test.php", function( data ) {
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

	});*/
}

function googleinitialize(myLatlng) {
		initialized = true;
//		setTimeout(update, 1000);

//var myLatlng = new google.maps.LatLng(data['latitude'],data['longitude']);

		var mapOptions = {
			center:  myLatlng,
			zoom: 20,
			mapTypeId: google.maps.MapTypeId.SATELLITE
		};

		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

	        destmarker = new google.maps.Marker({
                    position: myLatlng,
		    map: map,
		    title:"Destination",
                    draggable: true
		});

		localmarker = new google.maps.Marker({
                    position: myLatlng,
		    map: map,
                    icon: {
		      path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
		      scale: 3,
                      rotation: 0
                    },
                    title:"Vehicle"
		});

google.maps.event.addListener(destmarker,'dragstart', function(event) {
    draggingDestination = true;
});
google.maps.event.addListener(destmarker,'dragend', function(event) {
    draggingDestination = false;
    var latlon = destmarker.getPosition();
    var xy = {
              'x': ((latlon.lat() - lastobj['gps']['lat']) * meterpermillilat * 1000) + lastobj['mappos']['pos'][0],
	      'y': ((latlon.lng() - lastobj['gps']['lng']) * meterpermillilng * 1000) + lastobj['mappos']['pos'][1],
    };
                window.top.postMessage({r: 'waypoint', dest: xy}, '*');
  });


                path = new google.maps.Polyline({
                        path: [],
			strokeColor: '#FF0000',
			strokeOpacity: 1.0,
			strokeWeight: 2,
                        map: map
		});

		// calibrate conversion
		var p0 = new google.maps.LatLng(myLatlng['lat'], myLatlng['lng']);
		var plat = new google.maps.LatLng(myLatlng['lat']+.001, myLatlng['lng']);
		var plng = new google.maps.LatLng(myLatlng['lat'], myLatlng['lng']+.001);

		meterpermillilat = google.maps.geometry.spherical.computeDistanceBetween(p0, plat);
		meterpermillilng = google.maps.geometry.spherical.computeDistanceBetween(p0, plng);
		console.log('meters per milli lat ' + meterpermillilat);
		console.log('meters per milli lng ' + meterpermillilng);

}

</script>
</head>
<body>
<div id="map-canvas">
Waiting for initialisation.
</div>
</body>
</html>
