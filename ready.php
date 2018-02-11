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
		<title>ALL SET!!!!! - TEST MASTER</title>
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
				<h1 id='t1'>LET'S ROCK!</h1>
			</div>
			<div id="content">
				<?php
					//HEMOS SELECCIONADO LA UNIDAD O UNIDADES (RANDOM)
					//NÚMERO DE PREGUNTAS N
					$selectedunit=$_POST["unit"];
					$nump=$_POST["nump"];
					echo "<p>buscando preguntas...";
					if($selectedunit==0)
					{
						//MODO RANDOM
						$sqlquestions="SELECT DISTINCT QUESTIONS.ID AS QID FROM QUESTIONS, Q_U WHERE QUESTIONS.ID=Q_U.ID_Q AND Q_U.ID_UNIT IN (SELECT UNITS.ID AS ALLUNITS FROM UNITS WHERE UNITS.ID_OPOS=".$_SESSION["OPOSID"].")  ORDER BY RAND() LIMIT ".$nump;
						//echo $sqlquestions;
					}
					else
					{
						$sqlquestions="SELECT DISTINCT QUESTIONS.ID AS QID FROM QUESTIONS, Q_U WHERE QUESTIONS.ID=Q_U.ID_Q AND Q_U.ID_UNIT=".$selectedunit." ORDER BY RAND() LIMIT ".$nump;
					}
					$qresults = mysqli_query($conector,$sqlquestions);
					echo "hecho!</p>";
					while($qresult=mysqli_fetch_array($qresults))
					{
						//echo $qresult["QID"]."<br/>";
						$sqltestinsert="INSERT INTO TESTS (ID_USER,ID_Q) VALUES(".$_SESSION["USERID"].",".$qresult["QID"].")";
						//echo $sqltestinsert;
						mysqli_query($conector,$sqltestinsert);
					}
					echo "<p>barajando...";
					//AHORA HAY QUE OBTENER LAS N PREGUNTAS AL AZAR DE LA UNIDAD O UNIDADES CORRESPONDIENTES
					//LAS GUARDAMOS EN UN TEST TEMPORAL PARA EL USUARIO EN LA TABLA TESTS
					//RECORREMOS ESA TABLA Y ACTUALIZAMOS, PARA LUEGO MOSTRAR RESULTADOS Y TERMINAR ACTUALIZANDO LAS ESTADÍSTICAS
					echo "hecho!</p>";
					echo "Todo listo, estás preparad@?";
					$_SESSION["TESTQDONE"]=-1;
					$_SESSION["TESTQN"]=$nump;
				?>
				<a href="game.php" class="button">START!</a>
			</div>
			<div id="footer">
				<a href="game_over.php">ABORTAR!</a>
			</div>
		</div>
	</body>

</html>