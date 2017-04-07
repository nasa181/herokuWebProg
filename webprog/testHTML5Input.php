<!DOCTYPE html>
<html>
	<head>
		<title>Test HTML 5 New Input Element</title>
		<style>
			.form-label{
				display:inline-block;
				width:200px;
				margin:0 10px 0 0;
			}
		</style>
	</head>
	<body>
		<?php
			$content .= '<h1>Some new input types in HTML5</h1>'."\n";
			if(!isset($_POST['form_id'])||$_POST['form_id']!='test-form'){
				$content .= '<form action="testHTML5Input.php" method="post">'."\n";
				$content .= '  <span class="form-label">Foreground: </span><input type="color" name="color-forground"/><br/>'."\n";
				$content .= '  <span class="form-label">Background: </span><input type="color" name="color-background"/><br/>'."\n";
				$content .= '  <span class="form-label">Birthdate: </span><input type="date" name="date-birthdate"/><br/>'."\n";
				$content .= '  <span class="form-label">Reservation start: </span><input type="datetime-local" name="datetime-reservation"/><br/>'."\n";
				$content .= '  <span class="form-label">Last visit: </span><input type="month" name="month-lastvisit"/><br/>'."\n";
				$content .= '  <span class="form-label">Contact Email: </span><input type="email" name="email-contact"/><br/>'."\n";
				$content .= '  <span class="form-label">Homepage: </span><input type="url" name="url-homepage"/><br/>'."\n";
				$content .= '  <span class="form-label">Number of people: </span><input type="number" name="number-people" value="1" min="1" max="10"/><br/>'."\n";
				$content .= '  <span class="form-label">Satisfaction: </span><input type="range" name="range-satisfaction" value="50" min="0" max="100"/><br/>'."\n";
				$content .= '  <input type="hidden" name="form_id" value="test-form">'."\n";
				$content .= '  <input type="submit" value="submit"/>'."\n";
				$content .= '</form>'."\n";
			}else{
				$content .= print_r($_POST,true);
			}
			print $content;
		?>
	</body>
</html>