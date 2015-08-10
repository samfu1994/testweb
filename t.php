<?php
	$dict_addr = "uploads/dictionary.txt";
	$dict = fopen($dict_addr, "r")  or die("Unable to open file!");
	$dict_text = fread($dict, filesize($dict_addr));

	$dict_output = preg_split('/[\ \n\,]+/', $dict_text);
	$hash = array();
	foreach ($dict_output as $dict_pair) {
		$tmp= explode('=>', $dict_pair);
		$hash[$tmp[0]] = $tmp[1];
	}
?>
<script>
var xdata = <?php echo json_encode($hash); ?>;
console.log(xdata);
</script>