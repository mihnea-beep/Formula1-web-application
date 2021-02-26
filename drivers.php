<!DOCTYPE HTML>
<html>

	<head>
		<style>

			body{
				background-color: #AAAAAA;
				border: 1px solid black;
				padding-top: 50px;
				padding-bottom: 700px;
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
  width: 40%;
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
	
	.button button{
		width: 10%;
		height: 50px;
		clear: both;
		font-size: 25px;
		
	}		
		
	</style>

<div class = "header">
	<center> <h1> Piloti </h1> </center>
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
		
		// echo HTML 
		$view_mode = 0;
		
		//echo "<p> initiating query for $a </p>";
		
		
		if(isset($_POST['back']))
		{
			header("Location: menu.php");
		}
		
		if(isset($_POST['order']))
		{
			if($_POST['order'] == 'Punctaj') 
				$view_mode = 1;
			else
			if($_POST['order'] == 'Alfabetic')
				$view_mode = 2;
			else
				$view_mode = 0;
			
			//echo $_POST['order'];
		}
		
		if(isset($_SPOST['driverchoice']))
		{

		}

		if($view_mode == 0)	// pilotii afisati default ( join intre tabele - masini & piloti)
		{
			echo "<center>";
			echo "<table id = 'table' border = '2'>";
			echo "<tr> <th> <b> Nume </b> </th> <th> <b> Prenume </b> </th>
			<th> Nationalitate </th> <th> Sex </th>
			<th> <b> Nr. Membri Staff </b> </th> <th> Masina </th> <th> Puncte </th> </tr>";
			
			$query_nume_masina = "SELECT P.Nume, P.Prenume, P.Nationalitate, P.Sex, S.[Nr. Membri], M.Nume, P.Puncte FROM [CampionatFormula1].[dbo].[Piloti] P JOIN Staff S
																						  ON P.PilotID = S.PilotID
																						  JOIN Masini M
																						  ON M.MasinaID = P.MasinaID
																						  ORDER BY P.Nationalitate";
			$result_nume_masina = sqlsrv_query($conn, $query_nume_masina);
			
			while($row = sqlsrv_fetch_array($result_nume_masina)){
			
			echo "<tr>";
			echo "	<td>".$row[0]."</td>";
			echo "	<td>".$row['Prenume']."</td>";
			echo "	<td>".$row['Nationalitate']."</td>";
			echo "	<td>".$row['Sex']."</td>";
			echo "  <td>".$row['Nr. Membri']."</td>";
			echo "  <td>".$row[5]."</td>";
			echo "  <td>".$row['Puncte']."</td>";
			echo "</tr>";
			}
			
			echo "</table>";
			echo "</center>";
		}
		
		if($view_mode == 1)	// pilotii ordonati dupa punctaj
		{
			echo "<center>";
			echo "<table id = 'table' border = '2'>";
			echo "<tr> <th> <b> Nume </b> </th> <th> <b> Prenume </b> </th>
			<th> Nationalitate </th> <th> Sex </th>
			<th> <b> Nr. Membri Staff </b> </th> <th> Masina </th> <th> Puncte </th> </tr>";
			
			$query_nume_masina = "SELECT P.Nume, P.Prenume, P.Nationalitate, P.Sex, S.[Nr. Membri], M.Nume, P.Puncte FROM [CampionatFormula1].[dbo].[Piloti] P JOIN Staff S
																						  ON P.PilotID = S.PilotID
																						  JOIN Masini M
																						  ON M.MasinaID = P.MasinaID
																						  ORDER BY P.Puncte DESC";
			$result_nume_masina = sqlsrv_query($conn, $query_nume_masina);
			
			while($row = sqlsrv_fetch_array($result_nume_masina)){
			
			echo "<tr>";
			echo "	<td>".$row[0]."</td>";
			echo "	<td>".$row['Prenume']."</td>";
			echo "	<td>".$row['Nationalitate']."</td>";
			echo "	<td>".$row['Sex']."</td>";
			echo "  <td>".$row['Nr. Membri']."</td>";
			echo "  <td>".$row[5]."</td>";
			echo "  <td>".$row['Puncte']."</td>";
			echo "</tr>";
			}
			
			echo "</table>";
			echo "</center>";
		}
		
		if($view_mode == 2)	// pilotii ordonati alfabetic
		{
			echo "<center>";
			echo "<table id = 'table' border = '2'>";
			echo "<tr> <th> <b> Nume </b> </th> <th> <b> Prenume </b> </th> 
			<th> Nationalitate </th> <th> Sex </th>
			<th> <b> Nr. Membri Staff </b> </th> <th> Masina </th> <th> Puncte </th> </tr>";
			
			$query_nume_masina = "SELECT P.Nume, P.Prenume, P.Nationalitate, P.Sex, S.[Nr. Membri], M.Nume, P.Puncte FROM [CampionatFormula1].[dbo].[Piloti] P JOIN Staff S
																						  ON P.PilotID = S.PilotID
																						  JOIN Masini M
																						  ON M.MasinaID = P.MasinaID
																						  ORDER BY P.Nume, P.Prenume";
			$result_nume_masina = sqlsrv_query($conn, $query_nume_masina);
			
			while($row = sqlsrv_fetch_array($result_nume_masina)){
			
			echo "<tr>";
			echo "	<td>".$row[0]."</td>";
			echo "	<td>".$row[1]."</td>";
			echo "  <td>".$row[2]."</td>";
			echo "  <td>".$row[3]."</td>";
			echo "  <td>".$row[4]."</td>";
			echo "  <td>".$row[5]."</td>";
			echo "  <td>".$row[6]."</td>";
			echo "</tr>";
			}
			
			echo "</table>";
			echo "</center>";
		}
		
		if($view_mode == 3)
		{
			echo "<center>";
			echo "<table id = 'table' border = '2'>";
			echo "<tr> <th> <b> Nume </b> </th> <th> <b> Prenume </b> 
			<th> Nationalitate </th> <th> Sex </th>
			</th> <th> <b> Nr. Membri Staff </b> </th> <th> Masina </th> <th> Puncte </th> </tr>";
			
			$query_nume_masina = "SELECT P.Nume, P.Prenume, P.Nationalitate, P.Sex, S.[Nr. Membri], M.Nume, P.Puncte FROM [CampionatFormula1].[dbo].[Piloti] P JOIN Staff S
																						  ON P.PilotID = S.PilotID
																						  JOIN Masini M
																						  ON M.MasinaID = P.MasinaID
																						  WHERE P.Nume =".$name."'";
			$result_nume_masina = sqlsrv_query($conn, $query_nume_masina);
			
			while($row = sqlsrv_fetch_array($result_nume_masina)){
			
			echo "<tr>";
			echo "	<td>".$row[0]."</td>";
			echo "	<td>".$row[1]."</td>";
			echo "  <td>".$row[2]."</td>";
			echo "  <td>".$row[3]."</td>";
			echo "  <td>".$row[4]."</td>";
			echo "  <td>".$row[5]."</td>";
			echo "  <td>".$row[6]."</td>";
			echo "</tr>";
			}
			
			echo "</table>";
			echo "</center>";
		}


		?>
		
	<center>
	<br>

		<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
		<center>
			<div class = "companychoice">
			  <label for="cars"><br><br><p>Clasament:</label>
			
			  <select name="order" id="cars">
			  <optgroup>
				<option value=" "> </option>
				<option value="Alfabetic" name = "Alfabetic" >Alfabetic</option>
				<option value="Punctaj" name = "Punctaj">Punctaj</option>

			 </optgroup>
			  </select>
			</div>
			  <br><br>
			  
			  <div class = "backbutton">
			  <button type = "submit" name = "orderType">
				<!--<input type="submit" value="Submit" name ="orderType">-->
				Submit
			  </button>
			  </div>
		  </center>
		</form>


		
		
		
		 
	</center>
	<center>
	

		<br><br><br><br><br><br>
		<center>
		<div class = "backbutton">
			<form method="post" action=" <?php echo $_SERVER['PHP_SELF'];?>">
				<button type = "submit" name = "back">
					Back
				</button>
			</form>
		</div>
		
		
		</center>
		
	</body>
	

</html>