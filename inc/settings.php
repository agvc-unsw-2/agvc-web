<?php
function getRealHost(){
   list($realHost,)=explode(':',$_SERVER['HTTP_HOST']);
   return $realHost;
}
define("LOGO_URL","imgs/logounsw.png");
define("WEBSITE_TITLE","UNSW Competitive Robotics UI");
define("WS_SERVER", getRealHost() . ":8765");
//define("WS_SERVER","www.robotics.unsw.edu.au/agvc-web-ws");
?>
