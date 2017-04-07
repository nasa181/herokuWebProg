<!DOCTYPE html>
<html>
	<head>
		<title>Arrays in PHP</title>
	</head>
	<body style="font-size:60px;">
		<p>
		<?php
			$indexed_array1 = array("AA0000","00AA00","0000AA");
			for($i=0;$i<count($indexed_array1);$i++){
				print gen_color_patch($indexed_array1[$i]);
			}
			$indexed_array1[] = "999900";
			print gen_color_patch($indexed_array1[3]);
		?>
		</p>
		<p>
		<?php
			$associative_array1 = array("CourseVille Blue"=>"018ADA","Facebook Blue"=>"3b5998","Android Green"=>"99CC00");
			foreach($associative_array1 as $div_title=>$c){
				print gen_color_patch($c,$div_title);
			}
			$indexed_array1["TrueMove Red"] = "ea2127";
			print gen_color_patch($indexed_array1["TrueMove Red"],"TrueMove Red");
		?>
		</p>
	</body>
</html>

<?php
	function gen_color_patch($color,$title=null){
		if(isset($title)){
			$title_attr = " title=\"".$title."\" ";
		}
		return "<div style=\"background:#".$color.";width:200px;height:200px;display:inline-block;margin:5px;\"".$title_attr."></div>";
	}
?>