<?php

if (!file_exists('uploads'))
{
    mkdir("uploads", 0777, true);
}
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
$uploadOk = 1;

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    	header("Location:test.php");
    	exit;
    }
    else{
   		echo "<script>alert('upload failed');</script>";
   		echo "<script>window.location = 'test.php' </script>";
  //  		while (ob_get_status()) {
		//     ob_end_clean();
		// }
  //  		header("Location:test.php");
  //   	exit;
    }
}
?>

