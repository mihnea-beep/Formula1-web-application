<!DOCTYPE HTML>
<html>

	<head>
		<style>

			body{
				background-color: #AAAAAA;
				border: 1px solid black;
				padding-top: 50px;
				padding-bottom: 700px;
				font-size: 20px;
			}
			
			p{
				font-size: 25px;
			}
			
			.header {
				padding:
				font-size: 25px;
			}
			#table {
				
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 20%;
}

#table td, #table th {
	
  border: 1px solid #ddd;
  padding: 8px;
}

#table tr:nth-child(even){background-color: #f2f2f2;}

#table tr:hover {background-color: #ddd;}

#table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
		.backbutton button{
		width: 100px;
		height: 50px;
		clear: both;
		font-size: 25px;
		
	}
	
		.submitbutton input{
		width: 100px;
		height: 50px;
		clear: both;
		font-size: 25px;
		
		
		
	}
	
	.companychoice{
		
		font-size: 25px;
		clear: both;
		padding-left: 20px;
		
	}
	
	optgroup{
		
		font-size: 15px;
		
	}
	
	.link{
		
		padding-left: 20px;
		
	}
	
	#company{
 width:150px;   
 font-size: 25px;
}

#company option{
  width:150px;   
  font-size: 25px;
}

	</style>

<div class = "header">
	<center> <h1 id = "script_test"> Piese folosite la masina pilotului in functie de bugetul staff-ului </h1> </center>
</div>

	</head>
	
	<body>
		<?php 
		
		// initiate connection
		
		$serverName = "DM2015\SQLEXPRESS"; //serverName\instanceName
		$connectionInfo = array( "Database"=>"CampionatFormula1");
		$conn = sqlsrv_connect( $serverName, $connectionInfo);

		if( $conn ) {
			//echo "Conexiune realizata cu succes.<br />";
		}else{
			echo "Connection could not be established.<br />";
			die( print_r( sqlsrv_errors(), true));
		}
		
		session_start();	// start session
		
		$a = $_SESSION["utilizator"];
		$view_mode = "Basic";
		$order = "Name";
		
		if(isset($_POST['CarType']))
		{
			$name = $_POST['company'];
			$view_mode = $name;
		
		}
		
	if($view_mode == "Buget maxim" )
	{
		
		echo "<center>";
		
		{	
			echo "<table id = 'table' border = '2'>";
			echo "<th> <b> Masina </b> </th><th> Buget </th> <th> Anvelope </th> <th> Motor </th> </th>";
		}
		
		// afisare piese, in functie de bugetul maxim
		
		$query_nume_masina = "SELECT M.Nume, S.Buget, ANV.Nume AS NumeAnvelope, MOT.Nume AS NumeMotor
							  FROM Piloti P JOIN Staff S
							  ON P.PilotID = S.PilotID
							  JOIN Masini M
							  ON P.MasinaID = M.MasinaID
							  LEFT JOIN Motoare MOT
							  ON M.MotorID = MOT.MotorID
							  LEFT JOIN Anvelope ANV
							  ON ANV.AnvelopaID = M.AnvelopeID
							  WHERE S.Buget IN
							  (SELECT MAX(S.Buget)
							  FROM Staff S)";
							  
		$result_nume_masina = sqlsrv_query($conn, $query_nume_masina);
		
		while($row = sqlsrv_fetch_array($result_nume_masina)){
		
		echo "<tr>";
		echo "	<td>".$row[0]."</td>";
		echo "	<td>".$row[1]."</td>";
		echo "	<td>".$row[2]."</td>";
		echo "	<td>".$row[3]."</td>";
		echo "</tr>";
		echo "</div>";
		} 
		
		echo "</table>";
		echo "</center>";
		
	}
	else
	if($view_mode == "Buget minim" )
	{
		
		echo "<center>";
		
		{	
			echo "<table id = 'table' border = '2'>";
			echo "<th> <b> Masina </b> </th> <th> Buget </th> <th> Anvelope </th> <th> Motor </th> </th>";
		}
		
		// afisare piese in functie de bugetul minim
		
		$query_nume_masina = "SELECT M.Nume, S.Buget, ANV.Nume AS NumeAnvelope, MOT.Nume AS NumeMotor
							  FROM Piloti P JOIN Staff S
							  ON P.PilotID = S.PilotID
							  JOIN Masini M
							  ON P.MasinaID = M.MasinaID
							  LEFT JOIN Motoare MOT
							  ON M.MotorID = MOT.MotorID
							  LEFT JOIN Anvelope ANV
							  ON ANV.AnvelopaID = M.AnvelopeID
							  WHERE S.Buget IN
							  (SELECT MIN(S.Buget)
							  FROM Staff S)";
							  
		$result_nume_masina = sqlsrv_query($conn, $query_nume_masina);
		
		while($row = sqlsrv_fetch_array($result_nume_masina)){
		
		echo "<tr>";
		echo "	<td>".$row[0]."</td>";
		echo "	<td>".$row[1]."</td>";
		echo "	<td>".$row[2]."</td>";
		echo "	<td>".$row[3]."</td>";
		echo "</tr>";
		echo "</div>";
		} 
		
		echo "</table>";
		echo "</center>";
		
	}
	else
		{
		
		echo "<center>";
		echo "<p> Alegeti un criteriu de cautare. </p>";
		echo "</center>";
		
	}

		?>


	<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
	<center>
	<div class = "companychoice">
	  <label for="company"><br><br>Tipul de buget:</label>
	
	  <select name="company" id="company">
	  <optgroup>
		<option value=" "> </option>
		
		<option value="Buget maxim" name = "Buget maxim" >Buget maxim</option>
		<option value="Buget minim">Buget minim</option>

	 </optgroup>
	  </select>
	 </div>
	  <br><br>
	  <div class = "submitbutton">
	  <input type="submit" value="Submit" name ="CarType">
	  </div>
	  </center>
	</form>
	
	<div class = "link">
		<center>
		<br><br>
			<p><a href="extrastats.php">Alte informatii logistice </a></p>
		</center>
	</div>
		
		<br><br><br><br>
		<center>
		<div class = "backbutton">
			<form method="post" action=" <?php echo $_SERVER['PHP_SELF'];?>">
		
				
				<button type = "submit" name = "back">
				Back
				</button>
				
			</form>
		</div>
		</center>

		<script>

   </script>

		
<?php
if(isset($_POST['back']))
{

	header("Location: extrastats.php");
}


?>
		


</center>
	
	</body>
	

	
</html>