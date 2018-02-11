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
		<title>REGISTER - TEST MASTER</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		</head>
	<body>
		<div id="container">
			<div id="header">
			</div>
			<div id="content">
				<h1 id='t1'>REGÍSTRATE</h1>
					<form id='formulario' action='register_ok.php' method='post'>
						<h2 class='t2'>NICK</h2>
						<input type='text' name='nick'>
						<h2 class='t2'>PASSWORD</h2>
						<input type='password' name='pass'>
						<h2 class='t2'>REPETIR PASSWORD POR SI ACASO</h2>
						<input type='password' name='pass2'>
						<h2 class='t2'>EMAIL</h2>
						<input type='text' name='email'>
						<h2 class='t2'>CURSO</h2>
						<select name='opos'>
							  <option value="1">TAI ESTADO</option>
							  <option value="2">AUXILIAR ADMINISTRATIVO DE SALUD</option>
							  <option value="3">AUXILIAR ADMINISTRATIVO DEL ESTADO</option>
							  <option value="4">ASG</option>
							  <option value="5">INGLÉS - 1</option>
						</select>
						<br><br>
						<input type='submit' value='ENVIAR' class='boton' name="submit">
						<br>
					</form>
			</div>
			<div id="footer">
			</div>
		</div>
	</body>

</html>