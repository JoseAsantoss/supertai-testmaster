<!DOCTYPE html>
<?php
include "../header.php";

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
mysqli_set_charset($conector,"utf8");
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>ADMIN - TEST MASTER</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		</head>
	<body>
		<div id="container">
			<div id="header">
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
			</div>
			<div id="content">
				<h2>ESTADÍSTICAS GLOBALES</h2>
				<?php
					$sqlusersall="SELECT USERS.ID AS UID, USERS.NICK AS UNICK, USERS.ID_OPOS AS UIDOPOS, USERS.EMAIL AS UEMAIL, USERS.ONLINE AS UONLINE, USERS.ADMIN AS UADMIN, STATS.N_CONN AS UCONN, STATS.N_ATTEMPTS AS UATTEMPTS, STATS.N_OK AS UOK, STATS.N_FAIL AS UFAIL, STATS.LEVEL AS ULEVEL FROM USERS, STATS WHERE USERS.ID = STATS.ID_USER";
					$resultados = mysqli_query($conector,$sqlusersall);
				?>
				<table>
					<tr>
					<th>ID</th><th>NICK</th><th>OPOS</th><th>EMAIL</th><th>ONLINE</th><th>ADMIN</th><th>CONEXIONES</th><th>INTENTOS</th><th>ACIERTOS</th><th>FALLOS</th><th>LEVEL</th>
					</tr>
					<?php
					while($registro = mysqli_fetch_array($resultados))
					{
						echo "<tr>";
						echo "<td>".$registro["UID"]."</td><td>".$registro["UNICK"]."</td><td>".$registro["UIDOPOS"]."</td><td>".$registro["UEMAIL"]."</td><td>".$registro["UONLINE"]."</td><td>".$registro["UADMIN"]."</td><td>".$registro["UCONN"]."</td><td>".$registro["UATTEMPTS"]."</td><td>".$registro["UOK"]."</td><td>".$registro["UFAIL"]."</td><td>".$registro["ULEVEL"]."</td>";
						echo "</tr>";
					}
					?>
				</table>
				<?php 
					//TO-DO: ESTADÍSTICAS DE LAS PREGUNTAS POR CURSO Y BLOQUE
					$sqlqstats="SELECT COUNT(QUESTIONS.ID) AS QTOTAL, UNITS.UNIT AS UTEXT FROM QUESTIONS INNER JOIN Q_U ON QUESTIONS.ID=Q_U.ID_Q INNER JOIN UNITS ON Q_U.ID_UNIT=UNITS.ID GROUP BY UNITS.ID";
					$qstatsresults=mysqli_query($conector,$sqlqstats);
					echo "<table><tr><th>NÚMERO DE PREGUNTAS</th><th>UNIDAD</th></tr>";
					while($qstatsresult=mysqli_fetch_array($qstatsresults))
					{
						echo "<tr>";
						echo "<td>".$qstatsresult["QTOTAL"]."</td><td>".$qstatsresult["UTEXT"]."</td>";
						echo "</tr>";
					}
					echo "</table>";
				?>
				<a href="creator.php" class="button">LET'S CREATE</a>
			</div>
			<div id="footer">
				<a href="../logout.php">LOGOUT</a><a href="../profile.php">PROFILE</a>
			</div>
		</div>
	</body>

</html>


