<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="budgetstyle.css">
</head>
<body>
<?php	
		// conexiune cu baza de date
		
		$serverName = "DM2015\SQLEXPRESS"; 
		$connectionInfo = array( "Database"=>"CampionatFormula1");
		$conn = sqlsrv_connect( $serverName, $connectionInfo);

		if( $conn ) {
			//echo "Conexiune realizata cu succes.<br />";
		}else{
			echo "Connection could not be established.<br />";
			die( print_r( sqlsrv_errors(), true));
		}
		
		session_start();
		
			
		if(isset($_POST['back']))
		{
			
			header("Location: sponsors.php");
		}
		
?>

<center>
	<p>Detalii buget: </p>
		<ul>
		  <li><a href="compsponsors.php">Numar sponsori companii</a></li>
		  <li><a href="staffpay.php">Bugetul echipelor in functie de medie</a></li>
		  <li><a href="earningsavg.php">Medie castiguri companii</a></li>
		</ul>
		
	<div class = "backbutton">
		<form method="post" action=" <?php echo $_SERVER['PHP_SELF'];?>">

			<br><br><br><br>
			<button type = "submit" name = "back">
				Back
			</button>
		</form>
	</div>
</center>


</body>
</html>