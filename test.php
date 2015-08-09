<html>
<body bgcolor = 'white'>

<h1 align = 'center'>1080 TEST PAGE</h1>
<br />
<?php
$dir = "uploads";



function listTxtFiles($dir) {
	// directory we want to scan
	$dircontents = scandir($dir);
	// list the contents
	echo '<ul id = "listFile">';
	foreach ($dircontents as $file) {
		$extension = pathinfo($file, PATHINFO_EXTENSION);
		if ($extension == 'txt') {
			echo "<li onclick = \"clickFunc(this)\" class = \"listFile\">$file </li>";
		}
	}
	echo '</ul>';
}
listTxtFiles($dir);

?>

<form action = "upload.php" method = "post" enctype = "multipart/form-data">
	<input type = "file" name = "myfile">
	<input type = "submit" name = "upload">
</form>

<!-- comment-->
<a href="http://www.google.com"><img src = "g.png" width = '100' height '30'/>
</a>
<br />
<input id ='num1'> + <input id = 'num2'>
<script src = "main.js">
</script>
<script>
function li_clickable(){
 	var myLi = document.getElementById('listFile').getElementsByTagName('li');

    var calls = function() {
    	//alert(this.innerHTML)
    	window.location.href = "display.php?name=" + "uploads/" +this.innerHTML; 
    };
    
    for (i = 0; i < myLi.length; i++) {
        myLi[i].addEventListener('click', calls, false);
    }
}
li_clickable()
</script>
</body>
</html>