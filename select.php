<!DOCTYPE html>
<?php
include "header.php";

if(!isset($_SESSION["NICK"]))
{
	//echo "hm?";
	header("location: index.php");
}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>SELECT STAGE - TEST MASTER</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		</head>
	<body>
		<div id="container">
			<div id="header">
				<h1 id='t1'>USER INFO</h1>
				<h2>
				<?php 
					echo "<h2>".$_SESSION["NICK"]." ";
					if($_SESSION["ADMIN"]==1)
					{
						echo "(with admin powers)</h2>";
					}					
						//TO-DO: MOSTRAR NIVEL DE JUEGO, ETC
						$coursenames=mysqlI_query($conector,"SELECT OPOS FROM OPOS WHERE ID=".$_SESSION["OPOSID"]);
					$coursename=mysqli_fetch_assoc($coursenames);
					echo "<h2>CURSO: ".$coursename["OPOS"]."</h2>";
				?></h2>
			</div>
			<div id="content">
				<h1 id='t1'>Test your Might!!!!</h1>
					<form id='formulario' action='ready.php' method='post'>
						<h2>Selecciona el tema o déjalo a la suerte</h2>
						<?php 
						$sqlunidades = "SELECT UNIT, ID FROM UNITS WHERE ID_OPOS=".$_SESSION["OPOSID"];
						$unidades = mysqli_query($conector,$sqlunidades);
						while($registro = mysqli_fetch_array($unidades))
						{
						echo "<input type='radio' name='unit' value=".$registro["ID"].">".$registro["UNIT"]."<br>";
						}
						echo "<input type='radio' name='unit' value=0 checked>RANDOM<br>";
						echo "<br/><br/><br/>";
						?>
						<h2>Ahora, el número de preguntas</h2>
						<input type="radio" name="nump" value="5" checked> 5<br>
						<input type="radio" name="nump" value="20"> 20<br>
						<!--<input type="radio" name="nump" value="3"> 50<br>
						<input type="radio" name="nump" value="4"> 100<br>-->
					
						<input type='submit' value='AL LÍO' class='boton' name="submit">
					</form>
			</div>
			<div id="footer">
				<a href="logout.php">LOGOUT</a><a href="profile.php">PROFILE</a>
			</div>
		</div>
	</body>

</html>