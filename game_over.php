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
		<title>GAME OVER - TEST MASTER</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		</head>
	<body>
		<div id="container">
			<div id="header">
			<?php 
			echo "<h1>TEST FINALIZADO!</h1>";
			?>
			</div>
			<div id="content">
				<?php 					
					//CONTAMOS CUÁNTAS PREGUNTAS SE HAN ACERTADO
					$sqlhits="SELECT COUNT(ID_Q) AS HITS FROM TESTS WHERE ANSWER=RIGHTONE AND ID_USER=".$_SESSION["USERID"];
					$respuestas=mysqli_query($conector, $sqlhits);
					$respuesta = mysqli_fetch_assoc($respuestas);
					$hits=$respuesta["HITS"];
					//CALCULAMOS EL PORCENTAJE DE ÉXITO
					$accuracy=0;
					if($_SESSION["TESTQDONE"]<$_SESSION["TESTQN"])
					{
						$_SESSION["TESTQDONE"]--;
					}
					if($_SESSION["TESTQDONE"]>0){
						$accuracy=($hits/$_SESSION["TESTQDONE"])*100;
					}
					
					//CONTAMOS CUÁNTAS SE HAN FALLADO
					$fails=$_SESSION["TESTQDONE"]-$hits;
					
					//MOSTRAMOS ESTADÍSTICAS
					?>
					<table>
						<tr>
							<td>PREGUNTAS COMPLETADAS</td>
							<td><?php echo $_SESSION["TESTQDONE"]; ?><td/>
						</tr>
						<tr>
							<td>PREGUNTAS ACERTADAS</td>
							<td><?php echo $hits; ?><td/>
						</tr>
						<tr>
							<td>PREGUNTAS FALLADAS</td>
							<td><?php echo $fails; ?><td/>
						</tr>
						<tr>
							<td>ACCURACY</td>
							<td><?php echo $accuracy." %"; ?><td/>
						</tr>
					</table>
					
					<h2>Detalle de preguntas y respuestas</h2>
					<?php
					//bucle de optención de preguntas y respuestas
					$preguntas=mysqli_query($conector, "SELECT QUESTIONS.TEXT AS QTEXT, TESTS.ANSWER AS IDANSWER, TESTS.RIGHTONE AS IDRIGHTONE FROM QUESTIONS, TESTS WHERE QUESTIONS.ID=TESTS.ID_Q AND TESTS.ID_USER=".$_SESSION["USERID"]);
					
					while($pregunta = mysqli_fetch_array($preguntas))
					{
						echo "<h3>".$pregunta["QTEXT"]."</h3>";
						//obtenemos los textos de las respuestas
						$answers=mysqli_query($conector, "SELECT TEXT FROM ANSWERS WHERE ID=".$pregunta["IDANSWER"]);
						$answer=mysqli_fetch_array($answers);
						$answertext=$answer["TEXT"];
						$rights=mysqli_query($conector, "SELECT TEXT FROM ANSWERS WHERE ID=".$pregunta["IDRIGHTONE"]);
						$right=mysqli_fetch_array($rights);
						$righttext=$right["TEXT"];
						if($pregunta["IDANSWER"]==$pregunta["IDRIGHTONE"])
						{
							//RESPUESTA CORRECTA!
							echo "¡Has elegido la correcta!<br/><span class='rightanswer'>".$answertext."<br/></span>";
						}
						else
						{
							//RESPUESTA INCORRECTA
							echo "Has elegido:<br/><span class='wronganswer'>".$answertext."</span><br/>";
							echo "y la respuesta correcta era:</br><span class='rightanswer'>".$righttext."</span><br/>";
							
						}
						
					}				
					
					//ACTUALIZAMOS LA BASE DE DATOS
					$sqlstatsupdate="UPDATE STATS SET N_ATTEMPTS=N_ATTEMPTS+".$_SESSION["TESTQDONE"].", N_OK=N_OK+".$hits.", N_FAIL=N_FAIL+".$fails." WHERE ID_USER=".$_SESSION["USERID"];
					mysqli_query($conector,$sqlstatsupdate);
					//ELIMINAMOS LOS REGISTROS DE LA TABLA TESTS
					mysqli_query($conector,"DELETE FROM TESTS WHERE ID_USER=".$_SESSION["USERID"]);
					?>
				<br/><a href="profile.php" class="button">BACK TO PROFILE!</a>
			</div>
			<div id="footer">
				<a href="logout.php">LOGOUT</a><a href="profile.php">PROFILE</a>
			</div>
		</div>
	</body>

</html>