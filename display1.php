<html>
<head>
<style type="text/css">
.oneword {
  display:inline;
  cursor: pointer;
 
}
.oneword2 {
  display:none;
  cursor: pointer;
  
}
</style>

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>-->
	<script type="text/javascript">
		function myclick(obj){
		var nodes=obj.parentNode.childNodes;
		
		if(nodes[0].className =="oneword"){
		nodes[0].className="oneword2";
		nodes[1].className="oneword";
		}
		else{
		nodes[1].className="oneword2";
		nodes[0].className="oneword";
			}
		}
	</script>
</head>
<body align="center">
<!-- <a href = "test.php"> Back to Index </a> -->
<?php 
function getQuery($name){
	return 0;
}
function display_file($target_file){
	
	$myfile = fopen($target_file, "r") or die("Unable to open file!");
	$text = fread($myfile,filesize($target_file));
	$lines = explode("\n", $text);
	// $output= preg_split('/[\ \,]+/', $text);

	// $dict_addr = "uploads/dictionary.txt";
	// $dict = fopen($dict_addr, "r")  or die("Unable to open file!");
	// $dict_text = fread($dict, filesize($dict_addr));
	// $dict_output = preg_split('/[\ \n\,]+/', $dict_text);
	// $hash = array();

	$user_name = "root";
	$password = "root";
	$database = "dict";
	$server = "localhost";

	if(!$db_handle = mysql_connect($server, $user_name, $password)){
		echo 'Could not connect to mysql';
		exit;
	}
	$db_found = mysql_select_db($database, $db_handle);
	if (!$db_found) {
		echo "Database NOT Found ";
		exit;
	}

	$name = explode('/', $target_file);
	$num = count($name);
	$title = $name[$num - 1];
	
	echo "<p><b>$title</b></p>";
	echo "<table>";
	$testt = '\'abide\'';
	$SQL = "SELECT center FROM dict_table WHERE plain = ".$testt;
	$result = mysql_query($SQL, $db_handle);
	// $center = mysql_result($result, 0);
	// echo $SQL;
	// echo "<br />";
	// $tt = Array();
	// while ($row = mysql_fetch_assoc($result)) {
 //    	$tt = $row['center'];
	// }
	// print_r($tt);
	// mysql_free_result($result);
	foreach($lines as $line){
		$word_array = preg_split('/[\ \n\,]+/', $line);
		echo "<br />";


		foreach($word_array as $word){
			// if(count($word) > 0 and (ord($word[0]) < 'a' or ord( $word[0]) > ord('z') ) )
			// 	$SQL = "SELECT center FROM dict_table WHERE plain = ".'\''. $word. '\'';
			// elseif(count($word) > 0)
			// 	$SQL = "SELECT center FROM dict_". $word[0] ." WHERE plain = ".'\''. $word. '\'';
			// else
			// 	continue;
			$SQL = "SELECT center FROM dict_table USE INDEX (search_index) WHERE plain = ".'\''. $word. '\'';
			$result = mysql_query($SQL, $db_handle);
			$n = mysql_num_rows($result);
			$tt = Array();
			while ($row = mysql_fetch_assoc($result)) {
		    	$tt = $row['center'];
			}
			if ($n==0){
				echo "<span><span class= 'oneword' onclick='myclick(this)' id ='$n'>$word </span><span class= 'oneword2' onclick='myclick(this)'>$word</span> 
				</span>";
			}
			else{
				echo "<span><span class= 'oneword' onclick='myclick(this)'>$word </span><span class= 'oneword2' onclick='myclick(this)'>$tt</span> 
				</span>";
			}
		}
	}
	echo"</table>";
	
}
$dir = $_GET['name'];
display_file($dir);
?>


</body>
</html>