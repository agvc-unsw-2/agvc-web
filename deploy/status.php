<html>

<?php
$log = file_get_contents("/tmp/webdeploy.status");
$bgcolor = "#ffffff";
$finished = false;
if (strpos($log, 'Deploy complete!') !== false) {
	$bgcolor = "#8cf45f";
    $finished = true;
}
if (strpos($log, 'Deploy failed!') !== false) {
	$bgcolor = "#f46b6b";
    $finished = true;
}
?>

<head>
<?php
if ($finished === false) {
    echo '<meta http-equiv="refresh" content="2">';
}
?>
</head>

<body bgcolor="<?php echo $bgcolor; ?>" style="font-family: monospace;">
<?php
echo str_replace("\n", "<br />", $log);
?>

<script>
    window.scrollTo(0,document.body.scrollHeight); // Scroll to end
</script>

</body>
</html>
