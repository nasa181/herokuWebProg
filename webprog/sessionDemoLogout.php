<!DOCTYPE html>
<html>
	<head>
		<title>Logout Page</title>
		<link rel="stylesheet" href="sessionDemo.css"/>
	</head>
	<body>
		<?php
			session_start();
			if(!isset($_SESSION['username'])){
				$content .= '<div id="session-demo-message">You have not logged in.</div>'."\n";
				$content .= 'To log in, please go to the <a href="sessionDemoLogin.php">login page</a>.'."\n";
			}else{
				session_destroy();
				$content .= '<div id="session-demo-message">You have been successfully logged out.</div>'."\n";
				$content .= 'To log in again, please go to the <a href="sessionDemoLogin.php">login page</a>.'."\n";
			}
			print $content;
		?>
	</body>
</html>