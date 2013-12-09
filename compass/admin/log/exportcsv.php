<?php
session_start();
if ($_SESSION['loginname'] == null) {
	header("location:/compass/error_code.php?code=001");
}

$data = $_REQUEST['data'];
$filename = $_REQUEST['filename'] . ".csv";
$dir = realpath("."). "\\csvexports\\";

if (!file_exists($dir . $filename)) {
	$fh = fopen($dir . $filename, 'w');
	fwrite($fh, $data);
	fclose($fh);
	echo '1';
} else {
	echo '2';
}
?>
