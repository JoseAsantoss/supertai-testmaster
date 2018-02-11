<?php
$userbbdd="mnuez";
$passwordbbdd="ases!2017";
$hostbbdd="techberry.es";
$bbdd="ADAMSTAI";

$conector=mysqli_connect($hostbbdd,$userbbdd,$passwordbbdd,$bbdd);
session_start();
//realizar actualizaciones: YA NO ESTÁ ONLINE
$sqlnotonline="UPDATE USERS SET ONLINE=FALSE WHERE ID=".$SESSION_["USERID"];
mysqli_query($conector, $sqlnotonline);;
session_unset();
session_destroy();

header("location: index.php");
?>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>LOGOUT - TEST MASTER</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		</head>
	<body>
		<div id="container">
			<div id="header">
			</div>
			<div id="content">
				
			</div>
			<div id="footer">
			</div>
		</div>
	</body>