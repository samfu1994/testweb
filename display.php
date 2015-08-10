<!DOCTYPE html>
<html>
<?php
	$dir = $_GET['name'];
echo "<frameset cols=\"50%,*\">";
  echo "<frame src=\"display1.php?name=$dir\">";
  echo "<frame src=\"display2.php?name=$dir\">";
echo "</frameset>"
?>
</html>
