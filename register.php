<?php
session_start();
$serverName = "DM2015\SQLEXPRESS"; //serverName\instanceName
$connectionInfo = array( "Database"=>"CampionatFormula1");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
	//echo "Conexiune realizata cu succes.<br />";
}else{
	echo "Connection could not be established.<br />";
	die( print_r( sqlsrv_errors(), true));
}

# datele de intrare



$user = '';
#$email = '';
#$password = '';

if(isset($_POST['fname']))
	$user = $_POST['fname'];

if(isset($_POST['email']))
	$email = $_POST['email'];

if(isset($_POST['pwd']))
	$password = $_POST['pwd'];

if(empty($_POST['fname']) || empty($_POST['email']) || empty($_POST['pwd'])) # if empty?
{
		echo "<p><b>Completeaza toate campurile!</b></p>";
}
else
{
	$query_user = "SELECT * FROM [CampionatFormula1].[dbo].[Utilizatori] WHERE NumeUtilizator ='{$user}'";
	
	//$query_email = "SELECT * FROM [CampionatFormula1].[dbo].[Utilizatori] WHERE NumeUtilizator ='{$user}'";
	//$result = sqlsrv_query($conn, $query);
	
	$result = sqlsrv_query($conn, $query_user);
	
	if(sqlsrv_has_rows($result) != 1) # if there's no result, insert data into table
	{ 
		
		echo "name not found\n<br><br>";
		echo "username available";
		
		$query_user = "INSERT INTO Utilizatori (NumeUtilizator, Parola, Email) VALUES ('$user', '$password', '$email')";
		
		if($result = sqlsrv_query($conn, $query_user))
		{
			echo "<br><br>user added";
		    header("Location: login.php");
		}
		
		
		
	}
	
	else
	{
		echo "Found name\n\n";
		echo "<br><br>";
		echo "username not available";
		}
}


?>

<!DOCTYPE = HTML>
<html>
<head>

	<style>
	body{
		background-color: #AAAAAA;
	}
	
	.container {
  width: 200px;
  height: 50px;
  clear: both;
}

.container input {
  width: 100%;
  height: 100%;
  clear: both;
}

.container {
	font-size: 25px;
}

.container input{
	font-size: 25px;
}

.inceput {
	font-size: 20px;
}


		
	
	</style>
<center>
<div class = "inceput">
	<h1> Register page </h1><br>
</div>
</center>

</head>
<center>
<body>

	<div class = "container">
		<form method="post" action=" <?php echo $_SERVER['PHP_SELF'];?>">

			Nume de utilizator: <input type = "text" name = "fname"><br><br>
			Email: <input type = "text" name = "email"><br><br>
			Parola: <input type = "password" name = "pwd"><br><br><br>
			
			<input type = "submit" value="Sign up"><br><br><br>
			<br><br><br>

			<p><a href = "login.php" > Inapoi </a></p>
		
		</form>
		</div>
</body>
</center>
</html>