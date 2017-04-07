<?php
	include 'util.php';
	$page_data = demo_page_data($_GET['page']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>myCourseVille Demo Platform App on Azure</title>
	<?php demo_add_common_head();?>
</head>
<body class="w3-black w3-text-blue">
	<header class="w3-row w3-padding">
		<pre id="cv-logo">
 _____                            _   _ _ _ _ 
/  __ \                          | | | (_) | |
| /  \/ ___  _   _ _ __ ___  ___ | | | |_| | | ___ 
| |    / _ \| | | | '__/ __|/ _ \| | | | | | |/ _ \
| \__/\ (_) | |_| | |  \__ \  __/\ \_/ / | | |  __/
 \____/\___/ \__,_|_|  |___/\___| \___/|_|_|_|\___|
		</pre>
	</header>
	<div class="w3-container w3-padding">
		<?php print $page_data['content'];?>
	</div>
</body>
