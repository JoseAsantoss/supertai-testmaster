<!DOCTYPE html>
<?php
include "header.php";


if(isset($_SESSION["NICK"]))
{
	header("location: profile.php");
}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>INDEX - TEST MASTER</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
	</head>
	<body>
		<div id="container">
			<div id="header">
			</div>
			<div id="content">
				<a class="button" href="login.php">ACCEDER</a><br/>
				<a class="button" href="register.php">REGISTRARSE</a>
			</div>
			<div id="footer">
			</div>
		</div>
	</body>

</html>


