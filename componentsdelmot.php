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
	<center> <h1> Sterge motor </h1> </center>
</div>

	</head>
	
	
	<body>
	
	
	<?php		// conexiune baza de date
	
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
			
			header("Location: componentsdelete.php");
		}
		
		
		if(isset($_POST['Sterge']) && ($_POST['nume'] != NULL))
		{
			// echo "aaaaaaadauga"; // debugging
			
			$nume = $_POST['nume'];
			
			$query = "SELECT * FROM [CampionatFormula1].[dbo].[Motoare] WHERE Nume ='{$nume}'";
			
			$result = sqlsrv_query($conn, $query);
			
			if(sqlsrv_has_rows($result) != 1) # if there's no result, insert data into table
			{ 
				echo "<center><b> Motorul nu a fost gasit! </b></center><br><br>";
			}
			else
			{
				$query_1 = "UPDATE Masini SET MotorID = NULL WHERE MotorID IN (SELECT M.MotorID FROM Motoare M WHERE Nume = '{$nume}')";
				$result = sqlsrv_query($conn, $query_1);
				$query_delete = "DELETE FROM Motoare WHERE Nume = '{$nume}'";
				$result = sqlsrv_query($conn, $query_delete);
				
				echo "<center><b> Motor sters cu succes! </b></center>";
			}
		}
		
	?>
	
	
	<center>
	
		<center>
		<div class = "specsform">
		<form method="post" action=" <?php echo $_SERVER['PHP_SELF'];?>">
			
			Nume: <input type = "text" name = "nume"><br><br>

			<input type = "submit" value="Sterge" name = "Sterge"><br><br><br><br><br><br>
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



