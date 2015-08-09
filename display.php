<?php 
function display_file($target_file){
	$myfile = fopen($target_file, "r") or die("Unable to open file!");
	echo fread($myfile,filesize($target_file));
}
$dir = $_GET['name'];
display_file($dir);
?>