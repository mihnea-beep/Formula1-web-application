<!-- https://stackoverflow.com/questions/10639726/echo-out-information-from-database-using-php 
	 https://stackoverflow.com/questions/14679055/php-sql-server-login-sessions
-->


<?php

session_start();

include 'connection.php';

$user = '';

if(isset($_POST['fname']))
	$user = $_POST['fname'];

if(isset($_POST['pwd']))
	$password = $_POST['pwd'];

#checks if the html form is filled
if(empty($_POST['fname']) || empty($_POST['pwd']) ){
    echo "<br><br><br><br><br><center><b><p>Fill all the fields!</p></b></center>";
}
else
{
	
	$query_user = "SELECT * FROM [CampionatFormula1].[dbo].[Utilizatori] WHERE NumeUtilizator ='{$user}'";
	$query_password = "SELECT * FROM [CampionatFormula1].[dbo].[Utilizatori] WHERE Parola ='{$password}'";

	$result_user = sqlsrv_query($conn, $query_user);
	$result_password = sqlsrv_query($conn, $query_password);
	
	if( (sqlsrv_has_rows($result_user) != 1) || (sqlsrv_has_rows($result_password) != 1))
	{
		
		echo "<br><br><br><br><br><center><b><p> Name or password not found! </p></b></center>\n";
	}
	
	else
	{
		echo "Found name\n\n";
		echo "<br><br>";
		$row = sqlsrv_fetch_array($result_user);
		echo "Bine ai venit, ";
		echo $row['NumeUtilizator'];
		
		$_SESSION["utilizator"] = $row['NumeUtilizator'];
		
		$link = "menu.php";
		
		echo "<p><a href = $link > Acceseaza meniul! </a><p>";

		header("Location: menu.php");
		}
		
	}
?>
