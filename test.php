<html>
<head>
	<style type="text/css">
		li {
			cursor: pointer;
			width: 10em;
		}
	</style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script>
		function redirect(){
			// document.getElementById('my_form').target = 'my_iframe'; //'my_iframe' is the name of the iframe
			document.getElementById('my_form').submit();
		}
		function refresh(){
			window.location.reload();
		}
		$(document).ready(function(){
		  $(".one-word").click(function(){
		    $(this).hide();
		  });
		});
		$(document).ready(function(){
		  $(".button").click(function(){
		    $("p").hide();
		  });
		});
	</script>
</head>



<body bgcolor = 'white'>

<h1 align = 'center'>1080 TEST PAGE</h1>
<br />
<input type="button" name="action" value="refresh" onclick="refresh()"/>

<?php
$dir = "uploads";
function listTxtFiles($dir) {
			// directory we want to scan
			$dircontents = scandir($dir);
			// list the contents
			echo '<div>';
			echo '<ul id = "listFile">';
			foreach ($dircontents as $file) {
				$extension = pathinfo($file, PATHINFO_EXTENSION);
				if ($extension == 'txt') {
					$file = $file;
					echo "<li onclick = \"clickFunc(this)\" class = \"listFile\">$file </li>";
				}
			}
			echo '</ul>';
			echo '</div >';

		}
listTxtFiles($dir);
?>

<form id="my_form" name="form" action="upload.php" method="POST" enctype="multipart/form-data" >
<div id="upload_section">
    <input name="file" type="file" />
    <input type="button" name="action" value="Upload" onclick="redirect()"/>
    <br />
<!--     <iframe id='my_iframe' name='my_iframe' src="" width="200" height="200">
	</iframe> -->
</div>
</form>
<!-- <p> this is a text</p> -->

<a href="http://www.google.com"><img src = "g.png" width = '100' height '30'/>
</a>

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

li_clickable();
// translate();
</script>

</body>
</html>