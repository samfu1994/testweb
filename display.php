<html>
<head>
<style>
.one-word {
  display: none;
}
.one-word .notplain {
  display: block;
}
</style>
</head>
<body>
<a href = "test.php"> Back to Index </a>
<?php 
function display_file($target_file){
	
	$myfile = fopen($target_file, "r") or die("Unable to open file!");
	$text = fread($myfile,filesize($target_file));
	$output= preg_split('/[\ \n\,]+/', $text);

	$dict_addr = "uploads/dictionary.txt";
	$dict = fopen($dict_addr, "r")  or die("Unable to open file!");
	$dict_text = fread($dict, filesize($dict_addr));
	$dict_output = preg_split('/[\ \n\,]+/', $dict_text);

	$hash = array();
	foreach ($dict_output as $dict_pair) {

		$tmp= explode('=>', $dict_pair);
		$hash[$tmp[0]] = $tmp[1];
	}
	$name = explode('/', $target_file);
	$num = count($name);
	$title = $name[$num - 1];
	echo "<p><b>$title</b></p>";
	// echo "<div onmousemove = \"moveFunc()\">"
	foreach ($output as $word) {
		echo "<span id = 'one-word' >
		<span id = 'plain' style =\"display : inline\"> $word </span> 
		<span id = 'notplain' style =\"display : none\"> $hash[$word]  </span> </span>";
	}
	// echo "</div>"
	return $hash;
}
$dir = $_GET['name'];
$hash = display_file($dir);
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script>

	var e = document.getElementById('one-word');
	e.onclick = function() {
		if($("#one-word").find('#notplain').innerHTML != undefined && $("#one-word").find('#plain').style.display == 'inline'){
			document.getElementById('plain').style.display = 'none';
			document.getElementById('notplain').style.display = 'inline';
		}
		else if($("#one-word").find('#notplain').innerHTML == undefined){
		}
		else if($("#one-word").find('#notplain').innerHTML != undefined && $("#one-word").find('#notplain').style.display == 'inline'){
			document.getElementById('plain').style.display = 'inline';
			document.getElementById('notplain').style.display = 'none';
		}
		else{

		}
	}

	// var xdata = <?php echo json_encode($hash); ?>;

	// $(document).ready(function(){
	// 	$(".one-word").click(function(){
	// 		// alert("click!");
	// 		// $(this).hide();
	// 		var input = this.innerHTML.toLowerCase().trim();
	// 		console.log(input);
	// 		console.log(xdata[input]);
	// 	});
	// });
	
	// $(document).ready(function(){
	// 	$("#notone-word").click(function(){
	// 		console.log(this.getAttribute('tmp'));
	// 		this.setAttribute('id', '0');
	// 		console.log(this);
	// 	});
	// });

	// $(document).ready(function(){
	// 	$("#one-word").click(function(){
	// 		var input = this.innerHTML.toLowerCase().trim();	
	// 		console.log(this);
	// 		if(xdata[input] != undefined){
	// 			this.setAttribute('id', 'notone-word');
	// 			this.innerHTML = xdata[input];
	// 			this.setAttribute('tmp', input);
	// 		}

	// 	});
	// });

	// $(document).ready(function(){
	// 	$("#one-word").mouseover(function(){
			
	// 		var input = this.innerHTML.toLowerCase().trim();
	// 		xdata[input]
	// 	});
	// });

	// $(document).ready(function(){
	// 	$("#one-word").mouseleave(function(){
			
	// 		var input = this.innerHTML.toLowerCase().trim();
	// 		xdata[input]
	// 	});
	// });


	
	</script>

</body>
</html>