<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="menustyle.css">
<div class = "header">
	<center> <h1>	Menu </h1> </center>
</div>
</head>
<body>

<center>

<p>Welcome</p>


</center>

<?php 	// conexiune cu baza de date

$serverName = "DM2015\SQLEXPRESS";
$connectionInfo = array( "Database"=>"CampionatFormula1");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
	
}else{
	echo "Connection could not be established.<br />";
	die( print_r( sqlsrv_errors(), true));
}

session_start();

$test = $_SESSION["utilizator"];
echo "<center><p> Bine ai venit, $test ! </p><br><br><br><br><br></center>";



?>
<center>

	<!-- Butoane pentru navigatie -->

<div class = "cars">
	<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
	
	<button type = "submit" name = "cars" >
		Masini
	</button>
	
	<button type = "submit" name = "drivers" >
		Piloti
	</button>	
	
	<button type = "submit" name = "teams" >
		Echipe 
	</button>
	
	<button type = "submit" name = "stats">
		Statistici
	</button>
	
	<button type = "submit" name = "sponsors">
		Financiar
	</button>	
	
	
	<br><br><br>
	
	</form>
</div>


<div class = "logout">
	<p> Deconecteaza-te </p>
</div>

<div class = "logoutbutton">
	<form method="post" action=" <?php echo $_SERVER['PHP_SELF'];?>">
	
		<button type = "submit" name = "logout">
		Log out
		</button>
		
	</form>
</div>
</center>
<?php
if(isset($_POST['logout']))
{
	$logout = $_POST['logout'];
	echo "Logging out";
	header("Location: login.php");
}

if(isset($_POST['cars']))
{
	header("Location: cars.php");
}
if(isset($_POST['drivers']))
{
	header("Location: drivers.php");
}

if(isset($_POST['teams']))
{
	header("Location: teams.php");
}

if(isset($_POST['stats']))
{
	header("Location: stats.php");
}

if(isset($_POST['sponsors']))
{
	header("Location: sponsors.php");
}
?>




</body>
</html>