<?php
$file_name = $_GET["filename"];
$file_path = "./upload/".$file_name;
$file_size = filesize($file_path);
header('Pragma: public');
header('Expires: 0');
header('Last-Modified: ' . gmdate('D, d M Y H:i ') . ' GMT');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-Control: private', false);
header('Content-Type: application/octet-stream');
header('Content-Length: ' . $file_size);
header('Content-Disposition: attachment; filename="' . $file_name . '";');
header('Content-Transfer-Encoding: binary');
readfile($file_path);
?>
