<!DOCTYPE html>
<?php
include "header.php";


if(!isset($_SESSION["NICK"]))
{
	header("location: index.php");
}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>PROFILE - TEST MASTER</title>
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
				<h1 id='t1'>ESTADÍSTICAS</h1>
				<?php
					//TO-DO: ESTADÍSTICAS DE JUEGO, CARGADAS EN STATS: N_CONN, N_ATTEMPTS, N_OK, N_FAIL
					$sqlstats="SELECT * FROM STATS WHERE ID_USER=".$_SESSION["USERID"];
					//echo $sqlstats;
					$statsresults=mysqli_query($conector, $sqlstats);
					$stats=mysqli_fetch_assoc($statsresults);
					?>
					<table>
						<tr>
							<th>NÚMERO DE CONEXIONES</th><th>NÚMERO DE INTENTOS</th><th>ACIERTOS</th><th>FALLOS</th><th>ACCURACY</th>
						</tr>
						<tr>
							<td><?php
							$acc=0;
							if($stats["N_ATTEMPTS"]!=0)
							{
								$acc = $stats["N_OK"]/$stats["N_ATTEMPTS"];
							}
							echo $stats["N_CONN"]; ?></td><td><?php echo $stats["N_ATTEMPTS"]; ?></td><td><?php echo $stats["N_OK"]; ?></td><td><?php echo $stats["N_FAIL"]; ?></td><td><?php echo $acc." %"; ?></td>
						</tr>
					
					</table>
				<a href="select.php" class="button">IR AL TEST ROOM</a>
			</div>
			<div id="footer">
				<a href="logout.php">LOGOUT</a>
				<?php
					$nconns=mysqlI_query($conector,"SELECT COUNT(ID) AS NOL FROM USERS WHERE ONLINE=1");
					$nconn=mysqli_fetch_assoc($nconns);
					
					if($_SESSION["ADMIN"]==1)
					{
						echo "<a href='admin/index.php'>ADMIN ZONE</a>";
					}
					echo "Hay ".$nconn["NOL"];
					if($nconn["NOL"]==1)
					{
						echo " jugador ";
					}
					else
					{
						echo " jugadores ";
					}
					echo  "en línea";
				?>
			</div>
		</div>
	</body>

</html>