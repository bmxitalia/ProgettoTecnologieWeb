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
		<title>Inserimento alloggio| Padova Marathon</title>
		<link rel="shortcut icon" href="../assets/ico/favicon.ico" type="image/x-icon">
		<link href="../assets/css/template.css" rel="stylesheet" />
		<link href="../assets/css/adminTemplate.css" rel="stylesheet" />
		<link href="../assets/css/mobile.css" rel="stylesheet" />
		<link href="../assets/css/adminMobile.css" rel="stylesheet" />
		<link href="../assets/css/print.css" rel="stylesheet" media="print"/>
		<link href="../assets/css/inserimentoArticolo.css" rel="stylesheet" />
	</head>
	<header>
		<!-- header -->
		<div class="header-wrapper">
			<div class="header" id="header">
				<div class="logo">
					<img src="../assets/img/logo.png" alt="logo image" />
				</div>
				<div class="title">
					<h1 xml:lang="en" lang="en" tabindex="1">Padova Marathon</h1>
					<a href="../login.php?logout=0" title="Logout" class="subscribe-button" tabindex="2">LOGOUT</a>
				</div>
			</div>
		</div>
		<!-- end header -->
		<!-- menu -->
		<div class="navbar">
			<a class="helps" href="#body" tabindex="3" title="Vai al contenuto">
				Salta la navigazione
			</a>
			<ul class="nav" id="mainNav">
				<li class="icon" onclick="loadResponsiveMenu()">
					<a href="#noJsNav" tabindex="4">&#9776;</a>
				</li>
				<li>
					<a href="pannelloAdmin.php" title="pannello admin Padova Marathon" tabindex="5">Pannello Admin</a>
				</li>
				<li class="active">
					<a title="gestione alloggi Padova Marathon">Gestione alloggi</a>
				</li>
				<li>
					<a href="gestioneArticoli.php" title="gestione articoli Padova Marathon" tabindex="6">Gestione articoli</a>
				</li>
				<li>
					<a href="gestioneIscritti.php" title="gestione iscritti Padova Marathon" tabindex="7">Gestione iscritti</a>
				</li>
				<li>
					<a href="gestioneMessaggi.php" title="gestione messaggi Padova Marathon" tabindex="8">Gestione Messaggi</a>
				</li>
			</ul>
		</div>
		<!-- end menu -->
		<!-- start breadcrumb -->
		<ul class="breadcrumb">
			<li><a href="pannelloAdmin.php" title="pannello admin Padova Marathon" tabindex="9">admin</a></li>
			<li><a href="gestioneAlloggi.php" title="gestione alloggi Padova Marathon" tabindex="10">alloggi</a></li>
			<li><a title="Ti trovi sulla pagina Inserimento nuovo alloggio" tabindex="11">Inserimento</a></li>
		</ul>
		<!-- end breadcrumb -->
	</header>
	<body>
		<!-- end menu -->
		<!-- container -->
		<div class="container" id="body">
			<div class="rounded-container">
				<h1 tabindex="12">Form di inserimento alloggio</h1>
				<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="formModificaAlloggio" enctype="multipart/form-data">
					<fieldset>
						<div id="div-field">
							<div class="field-group">
								<label class="labelField" for="nome">Nome *:</label>
								<input type="text" name="nome" id="nome" class="inputField" title="Inserisci il nome dell'alloggio" tabindex="13" required />
								</div>
							<div class="field-group">
								<label class="labelField" for="via">Via *:</label>
								<input type="text" name="via" id="via" class="inputField" title="Inserisci la via dell'alloggio" tabindex="14" required />
							</div>
							<div class="field-group">
								<label class="labelField" for="numCiv">Numero civico *:</label>
								<input type="text" name="numCiv" id="numCiv" class="inputField" title="Inserisci il numero civico dell'alloggio" tabindex="15" required />
							</div>
							<div class="field-group">
								<label class="labelField" for="email">Email *:</label>
								<input type="text" name="email" id="email" class="inputField" pattern="[a-zA-Z0-9_]+(?:\.[A-Za-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*@(?!([a-zA-Z0-9]*\.[a-zA-Z0-9]*\.[a-zA-Z0-9]*\.))(?:[A-Za-z0-9](?:[a-zA-Z0-9-]*[A-Za-z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?" title="Inserisci un indirizzo e-mail valido" tabindex="16" required />
							</div>
							<div class="field-group">
								<label class="labelField" for="immagine">Immagine :</label>
								<input type="file" name="immagine" id="immagine" class="inputField" title="Inserire un'immagine" tabindex="17" />
							</div>
							<div class="field-group">
								<label class="labelField" for="prezzo">Prezzo *:</label>
								<input type="text" name="prezzo" id="prezzo" class="inputField" title="Inserire il prezzo dell'alloggio" tabindex="18" required />
							</div>
							<div class="field-group">
								<label class="labelField" for="stelle">Stelle *:</label>
								<select class="inputField" name="stelle" id="stelle" title="Inserire le stelle dell'alloggio" tabindex="19" required>
									<option value="1 Stella">1 Stella</option>
									<option value="2 Stelle">2 Stelle</option>
									<option value="3 Stelle">3 Stelle</option>
									<option value="4 Stelle">4 Stelle</option>
									<option value="5 Stelle">5 Stelle</option>
								</select>
							</div>
							<input class="btn-lg btn-black" type="submit" name="submit" id="submit" value="Inserisci" title="Bottone per l'inserimento di un nuovo alloggio" tabindex="20" />
							<!--<a href="gestioneAlloggi.php">Torna a gestione alloggi</a>-->
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		<!-- end container -->
		<footer>
			<div class="footer">
				<span class="text" xml:lang="en" lang="en">&copy; Padova Marathon 2018</span>
				<div class="to-top-anchor">
					<a href="#header" title="Torna a inizio pagina" tabindex="21">&UpArrowBar; torna su</a>
				</div>
				<div class="w3c-valiation">
					<img src="../assets/img/validation/html5.png" alt="html5 validation logo" />
					<img src="../assets/img/validation/css.png" alt="w3c validation logo" />
				</div>
			</div>
		</footer>
		<ul class="nav responsive" id="noJsNav">
			<li>
				<a href="pannelloAdmin.php" title="Pannello Admin Padova Marathon" tabindex="5">Pannello Admin</a>
			</li>
			<li class="active">
				<a title="Gestione Alloggi Padova Marathon">Gestione alloggi</a>
			</li>
			<li>
				<a href="gestioneArticoli.php" title="Gestione Articoli Padova Marathon" tabindex="6">Gestione articoli</a>
			</li>
			<li>
				<a href="gestioneIscritti.php" title="Gestione Iscritti Padova Marathon" tabindex="7">Gestione iscritti</a>
			</li>
			<li>
				<a href="gestioneMessaggi.php" title="Gestione Messaggi Padova Marathon" tabindex="8">Gestione Messaggi</a>
			</li>
		</ul>
		<!-- load js script -->
		<script src="../assets/js/template.js"></script>
	</body>
</html>

<?php
	$dbAccess = new dbAccess();
	$dbAccess -> configure();

	if(isset($_POST['submit'])) {
		$image_setted = false;
		
		if(($_FILES['immagine']['name'])) {
			$image_setted = true;
			$target_dir    = "../assets/img/alloggi/";
			$target_file   = $target_dir . basename($_FILES['immagine']['name']);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$check         = getimagesize($_FILES["immagine"]["tmp_name"]);
		}

		$nome 		= $_POST['nome'];
		$via	 	= $_POST['via'];
		$numCiv	 	= $_POST['numCiv'];
		$email		= $_POST['email'];
		$prezzo		= $_POST['prezzo'];
		$stelle		= $_POST['stelle'];

		if(!empty($nome) && !empty($via) && is_numeric($numCiv) && $numCiv>=1 && is_numeric($prezzo) && $prezzo>0 && (!$image_setted || $imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif")) {

			if(!$image_setted) {
				$img = pathinfo("../assets/alloggi/immagine-non-disponibile.jpg", PATHINFO_BASENAME);
    		}
    		else {
    			$img = pathinfo($target_file, PATHINFO_BASENAME);
    		}

    		$query = "INSERT INTO alloggi(Nome,Via,NumeroCivico,Email,Immagine,Prezzo,Stelle) VALUES ('".$nome."','".$via."',$numCiv,'".$email."','".$img."',$prezzo,'".$stelle."');";
			$result = $dbAccess->doQuery($query);
			if($result){
				echo "<div class='alert alert-success'>
						<h3 tabindex='0'>Inserimento del nuovo alloggio avvenuto correttamente!</h3>
						<a href='gestioneAlloggi.php' title='Torna a gestione alloggi'>Torna alla gestione alloggi</a>
					</div>";
			}
			else {	
				echo "<div class='alert alert-danger'>
					<h3 tabindex='0'>Inserimento del nuovo alloggio non avvenuto!</h3>
					<a href='gestioneAlloggi.php' title='Torna a gestione alloggi'>Torna alla gestione alloggi</a>
				</div>";
			}

		}
		else {
			if(!is_numeric($numCiv) || $numCiv<=0){
				echo "<div class='alert alert-danger'>
						<h3 tabindex='0'>Attenzione!</h3>
						<p tabindex='0'>Il numero civico inserito non è valido. Suggerimento: il numero civico non può contenere lettere e deve essere un numero positivo</p>
						<a href='gestioneAlloggi.php' title='Torna a gestione alloggi'>Torna a gestione alloggi</a>
					</div>";
			}
			if(!is_numeric($prezzo) || $prezzo<=0){
				echo "<div class='alert alert-danger'>
						<h3 tabindex='0'>Attenzione!</h3>
						<p tabindex='0'>Il prezzo inserito non è valido. Suggerimento: il prezzo di una camera non contiene lettere ed è un numero positivo.</p>
						<a href='gestioneAlloggi.php' title='Torna a gestione alloggi'>Torna a gestione alloggi</a>
					</div>";	
			}
			if($image_setted && $check == false) {
				echo "<div class='alert alert-danger'>
						<h3 tabindex='0'>Attenzione!</h3>
						<p tabindex='0'>Il file selezionato non è un'immagine</p>
						<a href='gestioneAlloggi.php' title='Torna a gestione alloggi'>Torna a gestione alloggi</a>
					</div>";
			}
		}
	}
?>

