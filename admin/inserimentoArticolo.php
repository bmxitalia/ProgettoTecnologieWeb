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
		<title>Inserimento articolo | Padova Marathon</title>
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
				<li>
					<a href="gestioneAlloggi.php" title="gestione alloggi Padova Marathon" tabindex="6">Gestione alloggi</a>
				</li>
				<li class="active">
					<a title="gestione articoli Padova Marathon">Gestione articoli</a>
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
			<li><a href="pannelloAdmin.php" title="Pannello Admin Padova Marathon" tabindex="9">admin</a></li>
			<li><a href="gestioneArticoli.php" title="Gestione articoli Padova Marathon" tabindex="10">articoli</a></li>
			<li><a title="Ti trovi sulla pagina Inserimento nuovo articolo" tabindex="11">articolo</a></li>
		</ul>
		<!-- end breadcrumb -->
	</header>
	<body>
		<!-- end menu -->
		<!-- container -->
		<div class="container" id="body">
			<div class="rounded-container">
				<?php
					$dbAccess=new dbAccess();
					$dbAccess->configure();
					echo "<h1 class='title' tabindex='12'>Inserimento nuovo articolo</h1>";
					$tabI=$dbAccess->showArticleForm();
				?>
			</div>
		</div>
		<!-- end container -->
		<?php
			if(isset($_POST['submit'])){
				$target_dir = "../assets/img/articoli/";
				$target_file = $target_dir . basename($_FILES['immagine']['name']);
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$titolo=$_POST['titolo'];
				$didascalia=$_POST['didascalia'];
				$testo=$_POST['testo'];
				$giorno=$_POST['giorno'];
				$mese=$_POST['mese'];
				$anno=$_POST['anno'];
				$check = false;
				if($_FILES['immagine']['name']) {
					$check = getimagesize($_FILES["immagine"]["tmp_name"]);
				}
		    	if($check == false) {
		        	echo "<div class='alert alert-danger'>
							<h3 tabindex='0'>Inserimento del nuovo articolo non avvenuto!</h3>
							<p tabindex='0'>Il file selezionato non è un'immagine oppure non si è selezionato un file!</p>
							<a href='gestioneArticoli.php' title='Torna a gestione articoli'>Torna alla gestione articoli</a>
						</div>";
		    	}else{
		    		if (file_exists($target_file)) {
		    			echo "<div class='alert alert-danger'>
							<h3 tabindex='0'>Inserimento del nuovo articolo non avvenuto!</h3>
							<p tabindex='0'>L'immagine selezionata esiste già nel database!</p>
							<a href='gestioneArticoli.php' title='Torna a gestione articoli'>Torna alla gestione articoli</a>
						</div>";
					}else{
						if (!move_uploaded_file($_FILES["immagine"]["tmp_name"], $target_file)){
			    			echo "<div class='alert alert-danger'>
								<h3 tabindex='0'>Inserimento del nuovo articolo non avvenuto!</h3>
								<p tabindex='0'>L'immagine non può essere caricata!</p>
								<a href='gestioneArticoli.php' title='Torna a gestione articoli'>Torna alla gestione articoli</a>
							</div>";
						}else{
							if(!empty($titolo) && !empty($didascalia) && !empty($testo) && ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif")){
								$img=pathinfo($target_file,PATHINFO_BASENAME);
								$data=$dbAccess->dateBuild($giorno,$mese,$anno);
								$query="insert into articoli(titolo,immagine,alt,testo,data) values ('".mysqli_real_escape_string($dbAccess->connessione,htmlentities($titolo))."','".$img."','".mysqli_real_escape_string($dbAccess->connessione,htmlentities($didascalia))."','".mysqli_real_escape_string($dbAccess->connessione,htmlentities($testo))."','".$data."');";
								$result=$dbAccess->doQuery($query);
								if($result){
									header('Location: gestioneArticoli.php');
								}
							}else{
								echo "<div class='alert alert-danger'>
									<h3 tabindex='0'>Inserimento del nuovo articolo non avvenuto!</h3>
									<p tabindex='0'>Inserire i campi correttamente e verificare che l'estensione dell'immagine sia jpg, png, jpeg o gif. Solamente queste estensioni sono consentite</p>
									<a href='gestioneArticoli.php' title='Torna a gestione articoli'>Torna alla gestione articoli</a>
								</div>";
							}
						}
					}
		    	}
			}
		?>
		<footer>
			<div class="footer">
				<span class="text" xml:lang="en" lang="en">&copy; Padova Marathon 2018</span>
				<div class="to-top-anchor">
					<a href="#header" title="Torna a inizio pagina" tabindex="<?php echo $tabI; ?>">&UpArrowBar; torna su</a>
				</div>
				<div class="w3c-valiation">
					<img src="../assets/img/validation/html5.png" alt="html5 validation logo" />
					<img src="../assets/img/validation/css.png" alt="w3c validation logo" />
				</div>
			</div>
		</footer>
		<ul class="nav responsive" id="noJsNav">
			<li>
				<a href="pannelloAdmin.php" title="pannello admin Padova Marathon" tabindex="5">Pannello Admin</a>
			</li>
			<li>
				<a href="gestioneAlloggi.php" title="gestione alloggi Padova Marathon" tabindex="6">Gestione alloggi</a>
			</li>
			<li class="active">
				<a title="gestione articoli Padova Marathon">Gestione articoli</a>
			</li>
			<li>
				<a href="gestioneIscritti.php" title="gestione iscritti Padova Marathon" tabindex="7">Gestione iscritti</a>
			</li>
			<li>
				<a href="gestioneMessaggi.php" title="gestione messaggi Padova Marathon" tabindex="8">Gestione Messaggi</a>
			</li>
		</ul>
		<!-- load js script -->
		<script src="../assets/js/template.js"></script>
	</body>
</html>

