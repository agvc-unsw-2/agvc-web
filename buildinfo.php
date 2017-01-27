<?php
$git = file_get_contents("/srv/mbzircws/src/mbzirc/.git/HEAD");
print str_replace("ref: refs/heads/", "", $git);
?>
