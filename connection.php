<?php
// se realizeaza conexiunea cu baza de date

$serverName = "DM2015\SQLEXPRESS"; //server \ instanta

$connectionInfo = array( "Database"=>"CampionatFormula1");

$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
	//echo "Conexiune realizata cu succes.<br />";
}else{
	echo "Connection could not be established.<br />";
	die( print_r( sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>	<!-- interfata de Login -->
<html>
	<title>
		F1 Login
	</title>
	<head>
	<link rel="stylesheet" href="connectionstyle.css">
	<center>
		<h1> Login page </h1><br><br><br>
	
	</head>
	<body>
	
	<div class = "container">
	<form method="post" action=" <?php echo $_SERVER['PHP_SELF'];?>">

		Nume de utilizator: <input type = "text" name = "fname"><br><br>
		Parola: <input type = "password" name = "pwd"><br><br><br>
		<input type = "submit" value="Log In"><br><br><br><br><br><br><br>
		<br><br><br><br><br><br>
		Nu ai cont?<br>
		<p><a href = "register.php" > Inregistreaza-te </a></p>
	
	</form>
	</div>
	</center>
	<br><br><br><br><br><br><br><br>
	<div class = "car">
		<img src = "car2.png" alt ="car">
	</div>
	</body>
</html>