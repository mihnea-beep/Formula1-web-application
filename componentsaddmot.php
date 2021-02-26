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
		width: 120px;
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

#component_type{
 width:150px;   
 font-size: 25px;
}

#component_type option{
  width:150px;   
}

.specsform {

	font-size: 25px;
	 width: 200px;
  height: 50px;
	
}


		}
		
			
			
		
	</style>

<div class = "header">
	<center> <h1> Adauga motor </h1> </center>
</div>

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
			
			header("Location: componentsadd.php");
		}
		
		if(isset($_POST['Adauga']) && ($_POST['nume'] != NULL))
		{
			//echo "aaaaaaadauga";
			
			$nume = $_POST['nume'];
						
			if(empty($_POST['capacitate']))
				$capacitate = NULL;
			else
				$capacitate = $_POST['capacitate'];
			
			$query = "SELECT * FROM [CampionatFormula1].[dbo].[Motoare] WHERE Nume ='{$nume}'";
			
			$result = sqlsrv_query($conn, $query);
			
			if(sqlsrv_has_rows($result) != 1) # if there's no result, insert data into table
			{ 
				//echo "name not found\n<br><br>";
				//echo "name available";

				if($capacitate == NULL)
					$query_user = "INSERT INTO Motoare (Nume, Capacitate) VALUES ('$nume', NULL)";
				else
					$query_user = "INSERT INTO Motoare (Nume, Capacitate) VALUES ('$nume', '$capacitate')";
				
				if($result = sqlsrv_query($conn, $query_user))
				{
					echo "<center><p><br><br>Motor adaugat cu succes!</p></center>";
					//header("Location: login.php");
				}
			}
			else
			{
				echo "<center><p>Motor cu acelasi nume exista deja!<p></center>";
			}
		}
		else if(isset($_POST['Adauga']) && ($_POST['nume'] == NULL))
		{
			echo "<head><center><b> Nu puteti adauga un motor fara nume <b><br><br><br></center><head>";
		}
		
		
	?>
	
	
	<center>
	
		<center>
		<div class = "specsform">
		<form method="post" action=" <?php echo $_SERVER['PHP_SELF'];?>">
			
			Nume: <input type = "text" name = "nume"><br><br>
			Capacitate: <input type = "text" name = "capacitate"><br><br>
			<input type = "submit" value="Adauga" name = "Adauga"><br><br><br><br><br><br>
			<br><br><br>
		</form>
		</div>
		<center>
		
		
	
		<div class = "backbutton">
		<form method="post" action=" <?php echo $_SERVER['PHP_SELF'];?>">

			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<button type = "submit" name = "back">
				Back
			</button>
		</form>
		</div>
		
		
		
		</center>
	
	</body>
	
	<? php
	
	

		
	?>
	
	
</html>



