<!DOCTYPE html>
<?php
include "../header.php";

$conector=mysqli_connect($hostbbdd,$userbbdd,$passwordbbdd,$bbdd);
session_start();


if(isset($_SESSION["NICK"]))
{
	if($_SESSION["ADMIN"]==1)
	{
		
	}
	else
	{
		header("location: ../profile.php");
	}
}
else
{
	header("location: ../index.php");
}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>ADMIN: THE CREATOR - TEST MASTER</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		</head>
	<body>
		<div id="container">
			<div id="header">
				<h2>HOLA AMO</h2>
			</div>
			<div id="content">
				<form id='creatorform' action='creator_ok.php' method='post'>
						<h2 class='t2'>PREGUNTA</h2>
						<textarea name='question' cols="100"></textarea>
						
						<h2 class='t2'>RESPUESTA 1</h2>
						<input type='text' name='answer1'>
						<h3 class='t2'>CORRECTA 1 <input type="radio" name="right" value="1" checked></h3>
						
						<h2 class='t2'>RESPUESTA 2</h2>
						<input type='text' name='answer2'>
						<h3 class='t2'>CORRECTA 2 <input type="radio" name="right" value="2"></h3>
						
						<h2 class='t2'>RESPUESTA 3</h2>
						<input type='text' name='answer3'>
						<h3 class='t2'>CORRECTA 3 <input type="radio" name="right" value="3"></h3>
						
						<h2 class='t2'>RESPUESTA 4</h2>
						<input type='text' name='answer4'>
						<h3 class='t2'>CORRECTA 4 <input type="radio" name="right" value="4"></h3>
						
						
						<h2 class='t2'>COLOCAMOS ESTA PREGUNTA EN LOS SIGUIENTES TEMAS:</h2>
						<?php
						$sqlunidades = "SELECT UNITS.ID AS UNITID, UNITS.UNIT, OPOS.OPOS FROM UNITS, OPOS WHERE UNITS.ID_OPOS = OPOS.ID";
						mysqli_set_charset($conector,"utf8");
						$resultados = mysqli_query($conector,$sqlunidades);
						$unitvalue=1;
						while($registro = mysqli_fetch_array($resultados))
						{
						echo "<input type='checkbox' name='units[]' value='".$registro["UNITID"]."'>".$registro["UNIT"]." de <strong>".$registro["OPOS"]."</strong><br>";
						$unitvalue++;
						}
						echo "<br/><br/><br/>";
						?>
						
						
						<input type='submit' value='ONE MORE!' class='boton' name="submit">
						<br>
					</form>
			</div>
			<div id="footer">
				<a href="../logout.php">LOGOUT</a><a href="../profile.php">PROFILE</a>
			</div>
		</div>
	</body>

</html>


