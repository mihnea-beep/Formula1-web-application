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

#component_type{
 width:150px;   
 font-size: 25px;
}

#component_type option{
  width:150px;   
}

		}
		
			
			
		
	</style>

<div class = "header">
	<center> <h1> Adauga componente </h1> </center>
</div>

	</head>
	
	
	<body>
	
	<!-- // conexiune -->
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
		
		// butoane/selectie componenta
			
		if(isset($_POST['back']))
		{
			
			header("Location: componentspecs.php");
		}
		
			if(isset($_POST['add']))
		{
			$_SESSION['component_type'] = $_POST['component_type'];
			//header("Location: componentsaddanv.php");
		}
		
		if(isset($_POST['component_type']))
		{
			if($_POST['component_type'] == 'Anvelope')
				header("Location: componentsaddanv.php");
			if($_POST['component_type'] == 'Motor')
				header("Location: componentsaddmot.php");
		}
		
	?>
	
	<center>
	
		<div class = "button">
		<form method="post" action=" <?php echo $_SERVER['PHP_SELF'];?>">
		
			<select name="component_type" id="component_type">
				<option value="Motor">Motor</option>
				<option value="Anvelope">Anvelope</option>
			</select>
			
			<div>
			<br>
			<button type = "submit" name = "add">
				Continua
			</button>
			<br>
			</div>
		</form>
		</div>
	
	
		<div class = "backbutton">
		<form method="post" action=" <?php echo $_SERVER['PHP_SELF'];?>">

			<br><br><br>
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



