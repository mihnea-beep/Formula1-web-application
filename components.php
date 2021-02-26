<!DOCTYPE HTML>
<html>
	<head>
	<link rel="stylesheet" href="componentsstyle.css">
<div class = "header">
	<center> <h1> Specificatii </h1> </center>
</div>

	</head>
	<!-- Pagina de cautare a masinilor dupa nume --
	Pentru masina gasita, se afiseaza specificatiile tehnice 
	-->
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
		
		if(isset($_POST['myCar'])){
			
			$view_mode = 1;	// modul de vizualizare a paginii pentru cautarea unei masini
			
			if($view_mode == 1)
		{
			$car = $_POST['myCar'];
			$_SESSION["car"] = $car;
			//echo $car;
			
			// Cautarea masinilor dupa nume - Cerere simpla (JOIN)
			
			$query_car = "SELECT Mas.Nume, Mas.CP, Mot.Nume, Mot.Capacitate, Anv.Nume
								  FROM CampionatFormula1.dbo.Masini Mas LEFT JOIN Motoare Mot
																		ON Mas.MotorID = Mot.MotorID
																		LEFT JOIN Anvelope Anv
																		ON Anv.AnvelopaID = Mas.AnvelopeID
																		WHERE Mas.Nume ='".$car."'";
			
			$result = sqlsrv_query($conn, $query_car);
			
			if(sqlsrv_has_rows($result) != 1){ # if there's no result, insert data into table
				//echo "<center><p>Masina nu a fost gasita<p></center>";
				$car = "invalid";
				$view_mode = 0;}
			else{
				$view_mode = 1;
				$row = sqlsrv_fetch_array($result);
				//echo "car found";
				echo "<center>";
				echo "<table id = 'table' border = '2'>";
				echo "<th> <b> Nume </b> </th> <th> <b> Cai-Putere </b> </th> <th> <b> Motor </b> </th> <th> <b> Capacitate </b> <th> <b> Anvelope </b> </th> </th>";
				
				echo "<tr>";
			echo "	<td>".$row[0]."</td>";
			echo "	<td>".$row[1]."</td>";
			echo "  <td>".$row[2]."</td>";
			if($row[3] != NULL)
				echo "  <td>".$row[3]." L</td>";
			else
				echo "<td> </td>";
			echo "  <td>".$row[4]."</td>";
			echo "</tr>";
				echo "</table>";
				echo "</center>";
				
			}
		}
		}
		
		if($view_mode == 0)	// modul default de vizualizare (refresh/submit pentru cautari 'empty')
		{
			echo "<center>";
			echo "<table id = 'table' border = '2'>";
			echo "<th> <b> Nume </b> </th> <th> <b> Cai-Putere </b> </th> <th> <b> Motor </b> </th> <th> <b> Capacitate </b> <th> <b> Anvelope </b> </th> </th>";
			
			
			// Cautarea masinilor dupa nume - Afisare default
			
			$query_nume_masina = "SELECT TOP 1 Mas.Nume, Mas.CP, Mot.Nume, Mot.Capacitate, Anv.Nume
								  FROM CampionatFormula1.dbo.Masini Mas LEFT JOIN Motoare Mot
																		ON Mas.MotorID = Mot.MotorID
																		LEFT JOIN Anvelope Anv
																		ON Anv.AnvelopaID = Mas.AnvelopeID";
								  
			$result_nume_masina = sqlsrv_query($conn, $query_nume_masina);
			
			while($row = sqlsrv_fetch_array($result_nume_masina)){
			
			echo "<tr>";
			echo "	<td>".$row[0]."</td>";
			echo "	<td>".$row[1]."</td>";
			echo "  <td>".$row[2]."</td>";
			if($row[3] != NULL)
				echo "  <td>".$row[3]." L</td>";
			else
				echo "<td> </td>";
			echo "  <td>".$row[4]."</td>";
			echo "</tr>";
			}
			
			echo "</table>";
			echo "</center>";
		}
		
		// Butoane care duc spre paginile asociate
		
			if(isset($_POST['back']))
		{
			
			header("Location: cars.php");
		}
		
		if(isset($_POST['Componente']))
		{
			
			header("Location: componentspecs.php");
		}

		?>
		
		<!-- form cautare -->
		
		<br><br><br><br><br><br>
		<center>
		<form autocomplete = "off" method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
			
			<div class="autocomplete" style="width:300px;">
				<input id="myInput" type="text" name="myCar" placeholder="Masina/Companie">
			</div>
				<input type="submit" name = "carchoice">
				
		</form>
		
		
		<div class = "button">
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
		</div>
		
		
		<center>
		<div class = "backbutton">
		<form method="post" action=" <?php echo $_SERVER['PHP_SELF'];?>">

		
			<button type = "submit" name = "back">
				Back
			</button>
		</form>
		</center>
		
		
		
		
		<!-- Script pentru completarea automata a numelor masinilor -->
		<script>
function autocomplete(inp, arr) {

  var currentFocus;
  
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
     
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
     
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      
      this.parentNode.appendChild(a);
     
      for (i = 0; i < arr.length; i++) {
        // verificare daca numele obiectului incepe cu aceleasi litere ca textul input
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          // div pentru fiecare element
          b = document.createElement("DIV");
          // bold pentr literele care se potrivesc 
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          
          b.addEventListener("click", function(e) {
              // insert
              inp.value = this.getElementsByTagName("input")[0].value;
			  // inchidere lista
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });

  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {

        currentFocus++;

        addActive(x);
      } else if (e.keyCode == 38) { 

        currentFocus--;

        addActive(x);
      } else if (e.keyCode == 13) {

        e.preventDefault();
        if (currentFocus > -1) {

          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {

    if (!x) return false;

    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);

    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {

    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {

    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }

  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

// lista masinilor
var countries = ['AClass', 'BClass', 'W125', 'Tropfenwagen', 'SilverArrow', 'W126','GT Coupe',
'488 GTE',
'Challenge',
'GT3',
'SF1000',
'Q100',
'Q101',
'Q200',
'QuickMega',
'OPR2000',
'OPRX',
'OPR3K',
'ProtoRace',
'ProtoRaceX',
'Rac3R'];

autocomplete(document.getElementById("myInput"), countries);
</script>

	</body>
</html>