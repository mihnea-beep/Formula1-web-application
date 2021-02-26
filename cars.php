<!DOCTYPE HTML>
<html>

	<head>

<link rel="stylesheet" href="carsstyles.css">
<div class = "header">
	<center> <h1 id = "script_test"> Masini </h1> </center>
</div>

	</head>
	
	<body>
		<?php 
		
		// conexiunea cu baza de date
		
		$serverName = "DM2015\SQLEXPRESS"; 
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
		
		// echo HTML 
		
	// alegerea cererii in functie de optiunile selectate 
		
		if(isset($_POST['cars']))
	{
	//$logout = $_POST['logout'];
	//echo "Logging out";
	if($_POST['cars'] === "Ferrari")
		$view_mode = "Ferrari";
		
	if($_POST['cars'] === "Mercedes")
		$view_mode = "Mercedes";
	
	if($_POST['cars'] === "OpelRace")
		$view_mode = "OpelRace";
		
	if($_POST['cars'] === "QuickR")
		$view_mode = "QuickR";
		
	if($_POST['cars'] === "RaceR")
		$view_mode = "RaceR";
	//header("Location: menu.php");
	}
	
	if($view_mode == "Basic")
	{
		
		echo "<center>";
		//echo "<p> Masini <p>";
		echo "<table id = 'table' border = '2'>";
		echo "<th> <b> Nume </b> </th> <th> <b> Cai-Putere </b> </th>";
		
		$query_nume_masina = "SELECT TOP 10 Nume, CP FROM [CampionatFormula1].[dbo].[Masini]";
		$result_nume_masina = sqlsrv_query($conn, $query_nume_masina);
		
		while($row = sqlsrv_fetch_array($result_nume_masina)){
		
		echo "<tr>";
		echo "	<td>".$row['Nume']."</td>";
		echo "	<td>".$row['CP']."</td>";
		echo "</tr>";
		} 
		
		echo "</table>";
		echo "</center>";
	}
	else
		{
			
		
		echo "<center>";
		echo "<h1>".$view_mode."</h1>";
		echo "<table id = 'table' border = '2'>";
		//echo "<tr> <td> <b> Nume </b> </td> <td> <b> Cai-Putere </b> </td> </tr>";
		echo "<th> <b> Nume </b> </th> <th> <b> Cai-Putere </b> </th>";
		
		// afisare masini in functie de compania producatoare
		
		$query_nume_masina = "SELECT M.Nume, M.CP FROM [CampionatFormula1].[dbo].[Masini] M JOIN Companii C 
																							ON M.CompanieID = C.CompanieID
																							WHERE C.Nume = '".$view_mode."'";
		$result_nume_masina = sqlsrv_query($conn, $query_nume_masina);
		
		while($row = sqlsrv_fetch_array($result_nume_masina)){
		
		echo "<tr>";
		echo "	<td>".$row['Nume']."</td>";
		echo "	<td>".$row['CP']."</td>";
		echo "</tr>";
		echo "</div>";
		} 
		
		echo "</table>";
		echo "</center>";
		
	}

		?>
	
	<!-- optiuni de selectare dupa producatorul masinii -->
		
	<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
	<center>
	<div class = "companychoice">
	  <label for="cars"><br><br>Alege un producator:</label>
	
	  <select name="cars" id="cars">
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
		
		<br><br><br><br><br><br>
		<center>
		
			<div class = "componentsbutton">
			<form method="post" action=" <?php echo $_SERVER['PHP_SELF'];?>">
		
				
				<button type = "submit" name = "componente">
				Specificatii
				</button>
				
			</form>
		<br>
		</div>
		
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

	header("Location: menu.php");
}

if(isset($_POST['componente']))
{

	header("Location: components.php");
}
?>
		


</center>
	
	</body>
	
</html>