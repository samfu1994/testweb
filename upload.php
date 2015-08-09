<?php
function display_file($target_file){
	$myfile = fopen($target_file, "r") or die("Unable to open file!");
	echo fread($myfile,filesize($target_file));
}

if (!file_exists('uploads'))
{
    mkdir("uploads", 0777, true);
}
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["myfile"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
$uploadOk = 1;

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) {
    	echo "succeed";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

