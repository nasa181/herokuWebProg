<?php
	$content .= '<div id="absolute-session-box">'."\n";
	$content .= '  '.$_SESSION['username'].'<br/>'."\n";
	$content .= '  '.$_SESSION['session_start'].'<br/>'."\n";
	$content .= '  <a href="sessionDemoLogout.php">Logout</a>'."\n";
	$content .= '</div>'."\n";
?>