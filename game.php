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
		<title>GAME - TEST MASTER</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		</head>
	<body>
		<div id="container">
			<div id="header">
			<?php 
			echo "<h1>PREGUNTA ".($_SESSION["TESTQDONE"]+2)." DE ".$_SESSION["TESTQN"]."</h1>";
			?>
			</div>
			<div id="content">
				<?php 
					//HAY QUE ACTUALIZAR DEL ANTERIOR?
					//no olvidar que tenemos la variable $_SESSION["TESTQN"] y $_SESSION["TESTQDONE"]=0;
					$_SESSION["TESTQDONE"]++;
					if (isset($_POST["submit"]))
					{
						//comprobamos si venimos de formulario, es decir, de una respuesta anterior
						$sqlactualizatest="UPDATE TESTS SET DONE=1, ANSWER=".$_POST["ANSWER"]." WHERE ID_USER=".$_SESSION["USERID"]." AND ID_Q=".$_SESSION["QID"];
					}
					
					mysqli_query($conector,$sqlactualizatest);
					//ya hemos terminado?
					if($_SESSION["TESTQDONE"]==$_SESSION["TESTQN"])
					{
						//finish!
						//echo "FINISH!";
						header("location: game_over.php");
					}
					else
					{
					//mostrar la pregunta
					$sqlpreguntatest="SELECT QUESTIONS.TEXT AS QTEXT, QUESTIONS.ID AS QID FROM TESTS, QUESTIONS WHERE TESTS.ID_Q=QUESTIONS.ID AND TESTS.DONE=0 LIMIT 1";
					$preguntas = mysqli_query($conector,$sqlpreguntatest);
					$pregunta = mysqli_fetch_assoc($preguntas);
					$qtext = $pregunta["QTEXT"];
					$qid=$pregunta["QID"];
					echo "<h2>pregunta ".$qid." ".$qtext."</h2>";
					//mostrar las 4 respuestas
					$sqlrespuestas="SELECT ID, TEXT, OK FROM ANSWERS WHERE ID_Q=".$qid;
					$respuestas = mysqli_query($conector,$sqlrespuestas);
					?>
					
					<form id='formulario' action='game.php' method='post'>
					<?php
					while($respuesta = mysqli_fetch_array($respuestas))
					{
						echo "<h3>".$respuesta["TEXT"]."</h3>";
						echo "<input type='radio' name='ANSWER' value=".$respuesta["ID"].">";
						if($respuesta["OK"]==1)
						{
							//actualizamos TESTS
							$sqlrightone="UPDATE TESTS SET RIGHTONE=".$respuesta["ID"]." WHERE ID_USER=".$_SESSION["USERID"]." AND ID_Q=".$qid;
							mysqli_query($conector,$sqlrightone);
						}
					}					
					?>
					<input type='submit' value='RESPONDER!' class='button' name="submit"><br/>
					</form>
					<?php
					$_SESSION["QID"]=$qid;
					
					}
				
				?>
			</div>
			<div id="footer">
				<a href="game_over.php">ABORTAR!</a>
			</div>
		</div>
	</body>

</html>