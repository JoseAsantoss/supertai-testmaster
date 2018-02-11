<!DOCTYPE html>
<?php

include "header.php";

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
		<title>REGISTER OK- TEST MASTER</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		</head>
	<body>
		<div id="container">
			<div id="header">
			</div>
			<div id="content">
<?php
		if (isset($_POST["submit"]))
		{
			if(empty($_POST["nick"]) || empty($_POST["pass"]) || empty($_POST["email"]) || empty($_POST["pass2"]))
			{
				echo "Rellena todos los campos, porfavor. <br/><br/><br/><a href='register.php'>VOLVER A INTENTAR.</a>";
			}
			else
			{
				if($_POST["pass"]==$_POST["pass2"])
				{
					$num_filas=0;
					$pass=$_POST["pass"];
					$name=$_POST["nick"];
					$consultasiyaexiste = mysqli_query($conector, "select * from USERS where NICK='".$nick."'");
					$num_filas = mysqli_num_rows($consultasiyaexiste);				
 					
					if($num_filas>0)
					{
						echo "Ya existe el usuario!<br/>";
						echo "<a href='register.php'>VUELVE A INTENTAR EL REGISTRO PROBANDO OTRAS COSICAS(otro nombre y/o ÑIK)</a>";
					}
					else
					{
						$sqladduser="INSERT INTO USERS (NICK, ID_OPOS, PASS, EMAIL) VALUES('".$_POST["nick"]."','".$_POST["opos"]."','".$_POST["pass"]."','".$_POST["email"]."')";
						mysqli_query($conector,$sqladduser);
						//OBTENER EL ID QUE SE LE HA ASIGNADO AL USUARIO REGISTRADO
						$sqluserid="SELECT ID FROM USERS WHERE NICK='".$_POST["nick"]."'";
						$resultadoID = mysqli_query($conector,$sqluserid);
						$registroID = mysqli_fetch_assoc($resultadoID);
						
						$sqlcreatestats="INSERT INTO STATS (ID_USER) VALUES('".$registroID["ID"]."')";
						mysqli_query($conector,$sqlcreatestats);
						
						echo "<h1>Te has registrado con éxito, ya puedes <a href='login.php'>entrar</a></h1><br/><br/><br/><br/>";
					}
				}
				else
				{
					echo "<p>Las contraseñas no coinciden!</p><br/><br/><br/>";
					echo "<a href='register.php'>VUELVE A INTENTAR EL REGISTRO</a>";
				}
			}
		}
		else
		{
			echo "comor?";
			//header("location: index.php");
		}
		?>
			</div>
			<div id="footer">
			</div>
		</div>
	</body>

</html>