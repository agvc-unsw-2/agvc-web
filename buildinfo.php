<?php
$hostname = gethostname();
$git = file_get_contents("/srv/mbzircws/src/mbzirc/.git/HEAD");
print "<h4>{$hostname}/" . str_replace("ref: refs/heads/", "", $git) . "</h4>";
?>
