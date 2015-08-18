<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<script src="https://code.jquery.com/jquery-1.8.3.js"></script>
	<style type="text/css">

        a {
            text-decoration: none;
        }

        span {
            display: inline-block;
        }

        .menu {
            font-family: Arial;
            color: #515151;
            width: 200px;
            position: relative;
            height: 40px;
            text-align: left;
            width: 202px;
            margin: 0 auto;
        }

        .menu li a {
            color: #515151;
            display: block;
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
            width: 200px;
            padding: 40px 0 3px;
            border-radius: 3px;
            box-shadow: 0 2px 4px #ddd;
            border: 1px solid #ddd;
            display: none;
        }

        a.hover-link {
            width: 190px;
            background: #fff;
            font-size: 14px;
            color: #515151;
            position: absolute;
            z-index: 110;
            display: block;
            padding: 10px 0 1px 10px;
            height: 28px;
            cursor: pointer;
            border-radius: 5px 5px 0 0;
            font-weight: bold;
            border: 1px solid #ddd;
        }

        .sub-options {
            list-style: none;
            margin: 0px;
            padding: 0px;
            font-size: 11px;
        }
    </style>
</head>



<body bgcolor = 'white'>

<h1 align = 'center'>1080 TEST PAGE</h1>
<h2> Read Me</h2>
<p> Click any of the document listed, then you'll see two documents on a new page. 
		<br />
		The left one is the original document. To get the document on the right, I got word vectors using word2vec and then cluster them, then replace each word on the left with its superword within the same cluster.
		<br />
		One thing you don't want to miss is that clicking any of the words that is not stopword can make it become any of the top 20 words within the same class. 
		<br />
		You can see a drop-down list when you mouseover a non-stopword, click any word in the non-stopword list and the original word is replaced. Non-stopword is marked by yellow background.
		<br />
		You can select the # of word clusters now by clicking the drop-down list when you mouseover the document's name.
		<br />
		If you mouseover the word and the drop-down doesn't show up, please wait for a few seconds, it can take a few seconds to load the webpage.
</p>
<br />
<input type="button" name="action" value="refresh" onclick="refresh()"/>

<?php
$dir = "uploads";
function listTxtFiles($dir) {
			// directory we want to scan
			$dircontents = scandir($dir);
			// list the contents
			echo "<br />";
            $count = 0;
			foreach ($dircontents as $file) {
                $count += 1;
				$extension = pathinfo($file, PATHINFO_EXTENSION);
				if ($extension == 'txt') {
					$file = $file;
					// echo "<span class='menu'>
					// <a class='hover-link'>Hover on Menu 2</a>
					// <div class='sub'>
					//     <ul class='sub-options'>
					//         <li><a href='#'>Home</a></li>
					//     </ul>
					// </div>
					// </span><br/><br/><br/><br/><br/><br/>";


					echo "<span class='menu'>
						<a class='hover-link'>$file</a>
						<div class='sub'>
						    <ul class='sub-options'>";
						$x1 = 2000;
                        $x2 = 3000;
                        $x3 = 5000;
							echo"        <li><a href='display.php?name=uploads/$file&num=$x1'>$x1</a></li>";
                            echo"        <li><a href='display.php?name=uploads/$file&num=$x2'>$x2</a></li>";
                            echo"        <li><a href='display.php?name=uploads/$file&num=$x3'>$x3</a></li>";

						echo"</ul>
						</div>
						</span>";
                    if($count % 7 == 0)
                        echo "<br/><br/><br/><br/><br/><br/>";
				}
			}

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
		function refresh(){
			window.location.reload();
		};
		$(".menu").hover(
            function () {
                $(this).find('.sub').slideToggle(400);
            },
            function () {
                $(this).find('.sub').hide();
            }
	    );

	    // replace
	</script>

</body>
</html>