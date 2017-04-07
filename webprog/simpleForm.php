<!DOCTYPE html>
<html>
	<head>
		<title>Simple Form</title>
		<style>
			.form-label{
				display:inline-block;
				width:100px;
				margin:0 10px 0 0;
			}
		</style>
	</head>
	<body>
		<form action="getDemo.php" method="get">
			<span class="form-label">Username: </span><input type="text" name="username"/><br/>
			<span class="form-label">Password: </span><input type="password" name="password"/><br/>
			<input type="submit" value="submit"/>
		</form>
	</body>
</html>