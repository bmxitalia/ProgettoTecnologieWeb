<?php
	session_start();
	if(!isset($_SESSION['admin']) || $_SESSION['admin']!=3784){
		header('Location: ../login.php');
	}
	require_once __DIR__ . DIRECTORY_SEPARATOR . "../gestioneDB/dbConnection.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="Keywords" content="maratona,padova,informazioni,info,help">
		<meta name="Description" content="Pagina informazioni Padova Marathon">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>Stampa iscritti | Padova Marathon</title>
		<link rel="shortcut icon" href="../assets/ico/favicon.ico" type="image/x-icon">
		<link href="../assets/css/template.css" rel="stylesheet" />
		<link href="../assets/css/adminTemplate.css" rel="stylesheet" />
		<link href="../assets/css/mobile.css" rel="stylesheet" />
		<link href="../assets/css/adminMobile.css" rel="stylesheet" />
		<link href="../assets/css/stampaIscritti.css" rel="stylesheet" />
	</head>
	<body>
		<!-- end menu -->
		<!-- container -->
		<div class="container" id="body">
			<div >
				<?php
					$dbAccess=new dbAccess();
					$dbAccess->configure();
	        		$result=$dbAccess->doQuery("select Numero_di_gara, Nome, Cognome, Data_di_nascita, Nazionalita from ".$_GET['marathon']);
		        	if($result && mysqli_num_rows($result)>0){
		        		echo "<h1>".$dbAccess->getTitoloMaratona($_GET['marathon'])."</h1>";
		        		echo "<table class='table'>";
		        		echo '<thead><tr><th>Numero di gara</th><th>Nome</th><th>Cognome</th><th>Data di nascita</th><th>Nazionalità</th><tbody>';
		        		for($i=0;$i<mysqli_num_rows($result);$i++){
		        			$row=mysqli_fetch_row($result);
		        			echo "<tr>";
		        			echo "<td>".$row[0]."</td>";
		        			echo "<td>".$row[1]."</td>";
		        			echo "<td>".$row[2]."</td>";
		        			echo "<td>".$row[3]."</td>";
		        			echo "<td>".$row[4]."</td>";
		        			echo "</tr>";
		        		}
		        		echo "</tbody></table>";
		        	}
		        ?>
			</div>
		</div>
	</body>
</html>