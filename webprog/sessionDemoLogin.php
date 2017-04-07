<!DOCTYPE html>
<html>
	<head>
		<title>Login Page</title>
		<link rel="stylesheet" href="sessionDemo.css"/>
	</head>
	<body>
		<?php
			session_start();
			if(isset($_SESSION['username'])){
				$content .= '<div id="session-demo-message">You are currently logged in.</div>'."\n";
				include 'sessionDemoNavigation.php';
			}else{
				if(!isset($_POST['form_id'])||$_POST['form_id']!='login-form'){
					$content .= '<form action="sessionDemoLogin.php" method="post">'."\n";
					$content .= '  <span class="form-label">Username: </span><input type="text" name="username"/><br/>'."\n";
					$content .= '  <span class="form-label">Password: </span><input type="password" name="password"/><br/>'."\n";
					$content .= '  <input type="hidden" name="form_id" value="login-form">'."\n";
					$content .= '  <input type="submit" value="submit"/>'."\n";
					$content .= '</form>'."\n";
				}else{
					$_SESSION['username'] = $_POST['username'];
					$_SESSION['session_start'] = date('d-M-Y H:i:s');			
					include 'sessionDemoNavigation.php';
				}
			}
			print $content;
		?>
	</body>
</html>