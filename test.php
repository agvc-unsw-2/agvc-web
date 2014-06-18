<?
header("Content-Type: application/json");

$waypoints = array();

for($x = 0; $x < 2; $x++) {
  $waypoints[] = array("lat" => -38.197455 + rand(-100,100)/200000, "lon" => 144.299531 + rand(-100,100)/200000);
}


$out = array("waypoints" => $waypoints);

print json_encode($out);
?>
