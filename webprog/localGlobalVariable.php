<!DOCTYPE html>
<html>
	<head>
		<title>Local/Global Variables</title>
	</head>
	<body style="font-size:60px;">

		<?php
			$x = 5;
			function function_1(){
				$x = 8;
				return $x;
			}
			function function_2($x){
				return $x;
			}
			function function_3(){
				global $x;
				return $x;
			}
			function function_4(&$y){
				$y = 4;				
			}

		?>

		<p><?php print "Local: function_1() = ".function_1(); ?></p>
		<p><?php print "Parameter: function_2(99) = ".function_2(99); ?></p>
		<p><?php print "Global: function_3() = ".function_3(); ?></p>
		<p>
			<?php
				function_4($x);
				print "Global: function_3() = ".function_3(); ?></p>

	</body>
</html>