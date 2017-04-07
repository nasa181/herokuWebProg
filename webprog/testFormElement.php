<!DOCTYPE html>
<html>
	<head>
		<title>Test Form Element</title>
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
			if(!isset($_POST['form_id'])||$_POST['form_id']!='test-form'){
				$content .= '<form action="testFormElement.php" method="post">'."\n";
				$content .= '  <span class="form-label">Text: </span><input type="text" name="my-input-text" placeholder="Account name"/><br/>'."\n";
				$content .= '  <span class="form-label">Password: </span><input type="password" name="my-input-password" placeholder="Whatever"/><br/>'."\n";
				$content .= '  <fieldset>'."\n";
				$content .= '    <legend>Checkboxes</legend>'."\n";
				$content .= '    <span class="form-label">Checkbox: </span><input type="checkbox" name="my-input-check-1" value="1" />Checkbox # 1<br/>'."\n";
				$content .= '    <span class="form-label">Checkbox: </span><input type="checkbox" name="my-input-check-2" value="2" />Checkbox # 2<br/>'."\n";
				$content .= '  </fieldset>'."\n";
				$content .= '  <fieldset>'."\n";
				$content .= '    <input type="radio" name="my-input-radio-1" value="this_one" />This one<br/>'."\n";
				$content .= '    <input type="radio" name="my-input-radio-1" value="the_other_one" />or this one<br/>'."\n";
				$content .= '    <input type="radio" name="my-input-radio-2" value="blue"/>BLUE<br/>'."\n";
				$content .= '    <input type="radio" name="my-input-radio-2" value="red"/>RED<br/>'."\n";
				$content .= '  </fieldset>'."\n";
				$content .= '  <p><span class="form-label">Textarea: </span><br/>'."\n";
				$content .= '    <textarea name="my-textarea"></textarea>'."\n";
				$content .= '  </p>'."\n";
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