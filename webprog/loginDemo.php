<!DOCTYPE html>
<html>
	<head>
		<title>Login Page</title>
		<style>
			.form-label{
				display:inline-block;
				width:100px;
				margin:0 10px 0 0;
			}
		</style>
	</head>
	<body>
		<?php
			if(!isset($_POST['form_id'])||$_POST['form_id']!='login-form'){
				$content .= '<form action="loginDemo.php" method="post">'."\n";
				$content .= '  <span class="form-label">Username: </span><input type="text" name="username"/><br/>'."\n";
				$content .= '  <span class="form-label">Password: </span><input type="password" name="password"/><br/>'."\n";
				$content .= '  <input type="hidden" name="form_id" value="login-form">'."\n";
				$content .= '  <input type="submit" value="submit"/>'."\n";
				$content .= '</form>'."\n";
			}else{
				$content .= '<p>You are logged in as '.$_POST['username'].'.<br/>'."\n";
				$content .= '(and we did not care about your password!)</p>'."\n";
			}
			print $content;
		?>
	</body>
</html>