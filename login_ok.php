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
		<title>LOGIN RESULT - TEST MASTER</title>
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
			if(isset($_POST["nick"])&&(isset($_POST["pass"])))
			{
				$sql="SELECT * FROM USERS WHERE NICK='".$_POST["nick"]."' AND PASS='".$_POST["pass"]."'";
				$exists=mysqli_query($conector, $sql);
				$num_filas = mysqli_num_rows($exists);
				if($num_filas==1)
				{
					$registro = mysqli_fetch_assoc($exists);
					$_SESSION["USERID"]=$registro["ID"];
					$_SESSION["NICK"]=$registro["NICK"];
					$_SESSION["OPOSID"]=$registro["ID_OPOS"];
					$_SESSION["ADMIN"]=$registro["ADMIN"];
					//ahora está online!
					$sqlonline="UPDATE USERS SET ONLINE=TRUE WHERE ID=".$_SESSION["USERID"];
					mysqli_query($conector, $sqlonline);
					$sqlconn="UPDATE STATS SET N_CONN=N_CONN+1 WHERE ID_USER=".$_SESSION["USERID"];
					mysqli_query($conector, $sqlconn);
					header("location: profile.php");
				}
				else{
					echo "Usuario incorrecto <a href='login.php'> ¿Volver a intentarlo? </a><br>";
					echo "<a href='register.php'> o ¡Regístrate! </a><br>";				
				}
			}
        }
        else
        {
			echo "what?";
            header("location: index.php");
        }
        mysqli_close($conector);?>
			</div>
			<div id="footer">
			</div>
		</div>
	</body>
</html>