<!DOCTYPE html>
<html>
	<head>
		<title>Page 1</title>
		<link rel="stylesheet" href="sessionDemo.css"/>
	</head>
	<body>
<?php
	session_start();
	if(!isset($_SESSION['username'])){
		$content .= 'You are not logged in. Please <a href="sessionDemoLogin.php">login</a> first.'."\n";
	}else{
		include 'sessionDemoNavigation.php';
		$content .= '<h1>Page 1</h1>'."\n";
		$content .= '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec quis enim in metus elementum egestas et id mauris. Donec sollicitudin ante vitae adipiscing tempor. Morbi pharetra et est in porttitor. Etiam eleifend bibendum consectetur. Maecenas laoreet lobortis cursus</p>'."\n";
	}
	print $content;
?>
	</body>
</html>