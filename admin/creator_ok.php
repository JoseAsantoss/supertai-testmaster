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
				<?php
					if (isset($_POST["submit"]))
					{
						if(empty($_POST["answer1"])||empty($_POST["answer2"])||empty($_POST["answer3"])||empty($_POST["answer4"])||empty($_POST["question"])||count($_POST["units"])==0)
						{
							header("location: creator.php");
						}
						else
						{
							//registrar la pregunta
								$sqlq="INSERT INTO QUESTIONS (TEXT) VALUES('".$_POST["question"]."')";
								
								mysqli_query($conector,$sqlq);
							//obtener el ID de la pregunta
								$sqlqid="SELECT ID FROM QUESTIONS WHERE TEXT='".$_POST["question"]."'";
								$resultsqid=mysqli_query($conector,$sqlqid);
								$qr = mysqli_fetch_array($resultsqid);
								$qid = $qr["ID"];
							//registrar las respuestas
							$rightone = $_POST["right"];
							for($r=1;$r<=4;$r++)
							{
								if($r==$rightone)
								{
									$sqlainput="INSERT INTO ANSWERS(ID_Q,TEXT,OK) VALUES (".$qid.",'".$_POST["answer".$r]."',1)";
								}
								else
								{
									$sqlainput="INSERT INTO ANSWERS(ID_Q,TEXT,OK) VALUES (".$qid.",'".$_POST["answer".$r]."',0)";					
								}
							mysqli_query($conector,$sqlainput);
							}
						}
						//registrar las unidades que se corresponden con la pregunta
						$unitsSelected = $_POST["units"];
						$Nunitsselected=count($unitsSelected);
						for($i=0;$i<$Nunitsselected;$i++)
						{
							$unitID = $unitsSelected[$i];
							$sqlqu="INSERT INTO Q_U VALUES(".$qid.",".$unitID.")";
							mysqli_query($conector,$sqlqu);
						}
						header("location: creator.php");
					}
				?>
			</div>
			<div id="footer">
				<a href="../logout.php">LOGOUT</a><a href="../profile.php">PROFILE</a>
			</div>
		</div>
	</body>

</html>


