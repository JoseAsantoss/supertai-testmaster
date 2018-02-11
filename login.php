<!DOCTYPE html>
<?php
$userbbdd="mnuez";
$passwordbbdd="ases!2017";
$hostbbdd="techberry.es";
$bbdd="ADAMSTAI";

$conector=mysqli_connect($hostbbdd,$userbbdd,$passwordbbdd,$bbdd);
session_start();


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
		<title>LOGIN - TEST MASTER</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		</head>
	<body>
		<div id="container">
			<div id="header">
			</div>
			<div id="content">
				<h1 id='t1'>Inicia sesión</h1>
					<form id='formulario' action='login_ok.php' method='post'>
						<h2 class='t2'>NICK</h2>
						<input type='text' name='nick'>
						<h2 class='t2'>PASS</h2>
						<input type='password' name='pass'><br><br>
						<input type='submit' value='Iniciar sesión!' class='boton' name="submit">
						<br>
					</form>
					<a class="button" href="register.php">o REGÍSTRATE</a>
			</div>
			<div id="footer">
			</div>
		</div>
	</body>

</html>