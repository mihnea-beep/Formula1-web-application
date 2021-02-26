<!DOCTYPE html>
<html>
<head>
<style>
ul {
  list-style-type: none;
  padding: 0;
  border: 1px solid #ddd;
}

ul li {
  padding: 8px 16px;
  border-bottom: 1px solid #ddd;
}

ul li:last-child {
  border-bottom: none
}

body{
				background-color: #AAAAAA;
				border: 1px solid black;
				padding-top: 50px;
				padding-bottom: 700px;
				font-size: 25px;
			}
			
			p{
				font-size: 25px;
			}
			
			.header {
				padding:
				font-size: 25px;
			}
			

	.backbutton button{
		width: 100px;
		height: 50px;
		clear: both;
		font-size: 25px;
		
	}
	
</style>
</head>
<body>
<?php
		$serverName = "DM2015\SQLEXPRESS"; //serverName\instanceName
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
			
			header("Location: stats.php");
		}
		
?>

<center>
	<p>Informatii logistice: </p>
		<ul>
		  <li><a href="extrastats1.php">Piese folosite la masina pilotului in functie de bugetul staff-ului</a></li>
		  <li><a href="extrastats2.php">Companiile care primesc capital de la sponsori in functie de media bugetului acestora</a></li>
		  <li><a href="extrastats3.php">Parteneriate intre sponsori si companii ale caror masini se afla in primele 10 cele mai puternice. </a></li>
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