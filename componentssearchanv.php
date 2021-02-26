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
		


		
			.autocomplete {
  position: relative;
  display: inline-block;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}

		}
		
			
			
		
	</style>

<div class = "header">
	<center> <h1> Anvelope </h1> </center>
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
		$view_mode = 0;
		
		// echo HTML 
		
		//echo "<p> initiating query for $a </p>";
		
		// Echipa = Pilot + Staff (+ Masina, Companie masina)
		if(isset($_POST['anvelope'])){
			
			$view_mode = 1;
			
			if($view_mode == 1)
		{
			$car = $_POST['anvelope'];
			$_SESSION["car"] = $car;
			//echo $car;
			
			// afisare in functie de tipul anvelopei
			
			$query_anvelope = "SELECT Nume, Aderenta, Durabilitate
								  FROM Anvelope
								  WHERE Nume = '{$car}'";
			
			$result = sqlsrv_query($conn, $query_anvelope);
			
			if(sqlsrv_has_rows($result) != 1){ # if there's no result, insert data into table
				echo "<center><b> Anvelope inexistente! </b></center>";
				$car = "invalid";
				$view_mode = 0;}
			else{
				$view_mode = 1;
				$row = sqlsrv_fetch_array($result);
				//echo "car found";
				echo "<center>";
				echo "<table id = 'table' border = '2'>";
				echo "<th> <b> Nume </b> </th> <th> <b> Aderenta </b> </th> <th> <b> Durabilitate </b> </th> ";
				
				echo "<tr>";
			echo "	<td>".$row[0]."</td>";
			echo "	<td>".$row[1]."</td>";
			echo "  <td>".$row[2]."</td>";
		
			echo "</tr>";
				echo "</table>";
				echo "</center>";
				
			}
		}
		}
		
		if($view_mode == 0)
		{
			echo "<center>";
			echo "<table id = 'table' border = '2'>";
			echo "<th> <b> Nume </b> </th> <th> <b> Aderenta </b> </th> <th> <b> Durabilitate </b> </th> ";
			
			// afisare default
			
			$query_nume_masina = "SELECT Nume, Aderenta, Durabilitate
								  FROM Anvelope";
								  
			$result_nume_masina = sqlsrv_query($conn, $query_nume_masina);
			
			while($row = sqlsrv_fetch_array($result_nume_masina)){
			
			echo "<tr>";
			echo "	<td>".$row[0]."</td>";
			echo "	<td>".$row[1]."</td>";
			echo "  <td>".$row[2]."</td>";
			}
			
			echo "</table>";
			echo "</center>";
		}
		
		//
	
			if(isset($_POST['back']))
		{
			
			header("Location: componentssearch.php");
		}
		
		if(isset($_POST['Componente']))
		{
			
			header("Location: componentspecs.php");
		}
		
//
		?>
		
		<br><br><br><br><br><br>
		<center>
		<form autocomplete = "off" method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
			
			<div class="autocomplete" style="width:300px;">
				<input id="myInput" type="text" name="anvelope" placeholder="Nume anvelope">
			</div>
				<input type="submit" name = "anvelopechoice">
				
		</form>
		
		
		<!--<div class = "button">
		<form method="post" action=" <?php echo $_SERVER['PHP_SELF'];?>">

		<center>
		<br><br><br><br><br><br>
			<button type = "submit" name = "Componente">
				Componente
			</button>
			<br><br><br><br><br><br><br>
		</center>
		</form>
		</center>
		</div>-->
		<br><br><br><br>
		
		
		<center>
		<div class = "backbutton">
		<form method="post" action=" <?php echo $_SERVER['PHP_SELF'];?>">

		
			<button type = "submit" name = "back">
				Back
			</button>
		</form>
		</center>
		
	</body>

	
</html>