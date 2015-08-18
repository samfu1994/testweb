<html xmlns="http://www.w3.org/1999/xhtml">

<head>
      <script src="https://code.jquery.com/jquery-1.8.3.js"></script>
  <title> <?php $dir = $_GET['name']; $dir = explode('/', $dir); $l = count($dir) - 1; echo "$dir[$l]";?></title>
  <style type="text/css">

    #left
    {
      width: 45%;
      float: left;
    }

    #right
    {
      margin-left: 45%; /* Change this to whatever the width of your left column is*/
    }
        a {
            text-decoration: none;
        }

        span {
            display: inline;
        }

        .menu {
            font-family: Arial;
            color: #515151;
            position: relative;
            text-align: left;
            margin: 0 auto;
        }

        .menu li a {
            color: #515151;
            display: inline;
            width: 200px;
            padding: 6px 15px;
            cursor: pointer;
            font-size: 14px;
        }

        .menu li a:hover {
            background: #f44141;
            color: #fff;
        }

        .sub {
            background: #fff;
            position: absolute;
            z-index: 2;
            width: 400px;
            padding: 40px 0 3px;
            border-radius: 3px;
            box-shadow: 0 2px 4px #ddd;
            border: 1px solid #ddd;
            display: none;
        }

        a.hover-link {
        }

        .sub-options {
            list-style: none;
            margin: 0px;
            padding: 0px;
            font-size: 11px;
            width: 500px;
        }
  </style>
  
</head>
<body>
  <div id="container">
    <div id="left">
      <?php 
function display_file($target_file, $PARA_NUM){
  $NORMALIZE_NUM = 100000.0;
  $myfile = fopen($target_file, "r") or die("Unable to open file!");
  $text = fread($myfile,filesize($target_file));
  $lines = explode("\n", $text);

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

  foreach($lines as $line){
    $word_array = preg_split('/[\ \n]+/', $line);
    echo "<br />";


    foreach($word_array as $word){
      $search_word = str_replace(".", "", $word);
      $search_word = str_replace(",", "", $search_word);
      $search_word = str_replace(";", "", $search_word);
      $search_word = str_replace(":", "", $search_word);
      $search_word = str_replace("!", "", $search_word);
      $search_word = str_replace("--", "", $search_word);
      $SQL = "SELECT cluster FROM dict_". $PARA_NUM." USE INDEX (search_index) WHERE plain = ".'\''. $search_word. '\'';
      $result = mysql_query($SQL, $db_handle);
      $n1 = mysql_num_rows($result);
      $tt = Array();
      while ($row = mysql_fetch_assoc($result)) {
          $tt = $row['cluster'];
      }

      if ($n1 == 0){
        echo "<span >$word&nbsp</span>";
      }
      else{
        $SQL = "SELECT center, distance FROM word_".$PARA_NUM." USE INDEX (search_index) WHERE cluster = ". $tt ." ORDER BY distance DESC";
        $new_SQL = "SELECT neighbors, distance FROM neighbor_table_".$PARA_NUM." USE INDEX (search_index) WHERE plain = ".'\''. $search_word.'\''. " ORDER BY distance DESC";
        $new_result = mysql_query($new_SQL, $db_handle);
        $result = mysql_query($SQL, $db_handle);
        $n2 = mysql_num_rows($result);//n2 should be 20, otherwise this cluster has less than 20 words.
        $tt = Array(); 
        echo "<span class = 'menu'>
        <a class = 'hover-link' style=\"background-color: #ffffcc\">$word&nbsp</a>
        <div class='sub'>
          <ul class='sub-options'>";
        echo"<li><a href='#'> <span style = \"color:blue\">".$word."&nbsp</span> </a></li>";
        while ($row = mysql_fetch_assoc($result)) {
          $new_row = mysql_fetch_assoc($new_result);
          echo"<li><a href='#'><span>".$row['center']."&nbsp</span> ". round($row['distance']/$NORMALIZE_NUM,2)." <span>&nbsp&nbsp&nbsp&nbsp&nbsp".$new_row['neighbors']."&nbsp</span>".round($new_row['distance']/$NORMALIZE_NUM, 2)." </a></li>";
        }
        echo"
          </ul>
        </div>
        </span>";
      }
    }
  }
  
}
function display_file_right($target_file, $PARA_NUM){
  $NORMALIZE_NUM = 100000.0;
  $myfile = fopen($target_file, "r") or die("Unable to open file!");
  $text = fread($myfile,filesize($target_file));
  $lines = explode("\n", $text);

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
  
  // echo "<h1><b>Superword passage of $title</b></h1>";
  
  foreach($lines as $line){

    $word_array = preg_split('/[\ \n]+/', $line);
    echo "<br />";
    foreach($word_array as $word){
      $search_word = str_replace(".", "", $word);
      $search_word = str_replace(",", "", $search_word);
      $search_word = str_replace(";", "", $search_word);
      $search_word = str_replace(":", "", $search_word);
      $search_word = str_replace("!", "", $search_word);
      $search_word = str_replace("--", "", $search_word);
      $SQL = "SELECT cluster FROM dict_". $PARA_NUM." USE INDEX (search_index) WHERE plain = ".'\''. $search_word. '\'';
      $result = mysql_query($SQL, $db_handle);
      $n1 = mysql_num_rows($result);
      $tt = Array();
      while ($row = mysql_fetch_assoc($result)) {
          $tt = $row['cluster'];
      }

      if ($n1 == 0){
        echo "<span >$word&nbsp</span>";
      }
      else{
        $SQL = "SELECT center, distance FROM word_".$PARA_NUM." USE INDEX (search_index) WHERE cluster = ". $tt." ORDER BY distance DESC";
        $new_SQL = "SELECT neighbors, distance FROM neighbor_table_".$PARA_NUM." USE INDEX (search_index) WHERE plain = ".'\''. $search_word.'\''. " ORDER BY distance DESC";
        $new_result = mysql_query($new_SQL, $db_handle);
        $result = mysql_query($SQL, $db_handle);
        $n2 = mysql_num_rows($result);//n2 should be 20, otherwise this cluster has less than 20 words.
        $tt = Array(); 
        $tt1 = Array();
        while ($row = mysql_fetch_assoc($result)) {
          $tt = $row['center'];
          $tt1 = $row['distance'];
          if($tt != $word)
            break;
        }
        echo "<span class = 'menu'>
        <a class = 'hover-link' style=\"background-color: #ffffcc\">$tt&nbsp</a>
        <div class='sub'>
          <ul class='sub-options'>";
        echo"<li><a href='#'> <span style = \"color:blue\">".$word."&nbsp</span> </a></li>";
        echo"<li><a href='#'> <span>".$tt."&nbsp</span>". round($tt1/$NORMALIZE_NUM, 4). "</a></li>";
        while ($row = mysql_fetch_assoc($result)) {
          $new_row = mysql_fetch_assoc($new_result);
          echo"<li><a href='#'><span>".$row['center']."&nbsp</span> ". round($row['distance']/$NORMALIZE_NUM,2)."&nbsp&nbsp&nbsp&nbsp&nbsp<span>".$new_row['neighbors']."&nbsp</span>".round($new_row['distance']/$NORMALIZE_NUM, 2)." </a></li>";
        }
        echo"
          </ul>
        </div>
        </span>";
      }
    }
  }
  
}
$dir = $_GET['name'];
$PARA_NUM = $_GET['num'];
display_file($dir, $PARA_NUM);
?>

    </div>
     <div id="right">
      <?php display_file_right($dir, $PARA_NUM);  ?>
    </div> 
    <div class="clear"></div>
  </div>
  <script type="text/javascript">
    // toggle
    $(".menu").hover(
            function () {
                $(this).find('.sub').slideToggle(400);
            },
            function () {
                $(this).find('.sub').hide();
            }
    );

    // replace
    $('.sub li span').click(
            function(){
                var conent = $(this).html();
                $(this).parents('.menu').find('.hover-link').html(conent);
                return false;
            }
    );
  </script>
</body>
</html>