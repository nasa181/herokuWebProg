<!DOCTYPE html>

<?php
	if(!isset($_GET)){
		$content = "";
	}else{
		$num = count($_GET);
		$content = "<ul>"."\n";
		$content .= "  There are ".$num." elements in &#36;_GET"."\n";
		foreach($_GET as $key=>$value){
			$content .= "   <li>&#36;_GET[\"".$key."\"] = ".$value."</li>"."\n";
		}
		$content .= "</ul>"."\n";
	}
?>

<html>
	<head>
		<title>Displaying $_GET</title>
	</head>
	<body style="font-size:36px;">
		<?php print $content; ?>
	</body>
</html>