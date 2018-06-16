<?php
// Delete old status file
unlink("/tmp/webdeploy.status");

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["deployfile"])) {
    // File has been uploaded, perform deploy

	$tmp_name = $_FILES["deployfile"]["tmp_name"];
    $tmp_working_name = "/tmp/webdeploy.tar.gz";

    if(file_exists($tmp_working_name)) {
        unlink($tmp_working_name);
    }
    move_uploaded_file($tmp_name, $tmp_working_name);

    ?>
    Running deploy script
    <script type="text/javascript">
    </script>
    
    <iframe id="deploy_log_iframe" src="deploy/status.php" width="100%" height="100%"></iframe>
    <?php

} else {
    // Display form
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="deployForm" enctype="multipart/form-data">
        <input type="file" name="deployfile" class="deployfile">
        <br />
        <input type="submit" value="Start Upload">
    </form>

    <br />

    <!--iframe id="hidden_iframe" name="hidden_iframe" src="about:blank"></iframe-->

    <?php
}

// TODO need to add to nginx site conf to allow large uploads
?>

