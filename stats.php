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

	</style>

<div class = "header">
	<center> <h1 id = "script_test"> Logistica </h1> </center>
</div>

	</head>
	
	<body>
	<p> <center><b>Nr. seturi anvelope / companie </b> </center></p>
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
		

	if($view_mode == "Basic")
	{
		
	}
	else
		{
		
		echo "<center>";
		echo "<h1>".$view_mode."</h1>";
		if($view_mode != " ")
		{	echo "<table id = 'table' border = '2'>";
		//echo "<tr> <td> <b> Nume </b> </td> <td> <b> Cai-Putere </b> </td> </tr>";
			echo "<th> <b> Anvelope </b> </th> <th> <b> Nr. Seturi </b> </th>";
		}
		
		// Afisare numar seturi anvelope corespunzatoare companiei alese de utilizator
		
		$query_nume_masina = "SELECT A.Nume, COUNT(A.AnvelopaID) AS NrSeturiAnvelope
							  FROM Companii C JOIN Masini M
							  ON C.CompanieID = M.CompanieID
							  JOIN Anvelope A
							  ON M.AnvelopeID = A.AnvelopaID 
							  WHERE C.Nume = '".$view_mode."'
							  GROUP BY A.AnvelopaID, A.AnvelopaID, A.Nume";
							  
		$result_nume_masina = sqlsrv_query($conn, $query_nume_masina);
		
		while($row = sqlsrv_fetch_array($result_nume_masina)){
		
		echo "<tr>";
		echo "	<td>".$row[0]."</td>";
		echo "	<td>".$row[1]."</td>";
		echo "</tr>";
		echo "</div>";
		} 
		
		echo "</table>";
		echo "</center>";
		
	}

		?>


	<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
	<center>
	<div class = "companychoice">
	  <label for="company"><br><br>Alege un producator:</label>
	
	  <select name="company" id="company">
	  <optgroup>
		<option value=" "> </option>
		
		<option value="Ferrari" name = "Ferrari" >Ferrari</option>
		<option value="Mercedes">Mercedes</option>
		<option value="OpelRace">OpelRace</option>
		<option value="QuickR">QuickR</option>
		<option value="RaceR">RaceR</option>
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
		//document.getElementById("horsepower").onclick = function() {
		//alert("button was clicked");};
   
   </script>

		
<?php
if(isset($_POST['back']))
{
	//$logout = $_POST['logout'];
	//echo "Logging out";
	header("Location: menu.php");
}

	/*echo '<script> 
	document.getElementById("script_test").innerHTML = "'.$order.'";
	</script>';*/

?>
		


</center>
	
	</body>
	

	
</html>