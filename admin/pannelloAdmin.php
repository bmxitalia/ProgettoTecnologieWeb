<?php
	session_start();
	if(!isset($_SESSION['admin']) || $_SESSION['admin']!=3784){
		header('Location: ../login.php');
	}
	if(isset($_SESSION['DATA'])){
		unset($_SESSION['DATA']);
	}
	if(isset($_SESSION['FLAG'])){
		unset($_SESSION['FLAG']);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="Keywords" content="maratona,padova,marathon,admin,gestione">
		<meta name="Description" content="Pannello admin Padova Marathon">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>Pannello Admin | Padova Marathon</title>
		<link rel="shortcut icon" href="../assets/ico/favicon.ico" type="image/x-icon">
		<link href="../assets/css/template.css" rel="stylesheet" />
		<link href="../assets/css/adminTemplate.css" rel="stylesheet" />
		<link href="../assets/css/mobile.css" rel="stylesheet" />
		<link href="../assets/css/adminMobile.css" rel="stylesheet" />
		<link href="../assets/css/print.css" rel="stylesheet" media="print"/>
	</head>
	<body>
		<header>
			<!-- header -->
			<div class="header-wrapper">
				<div class="header" id="header">
					<div class="logo">
						<img src="../assets/img/logo.png" alt="logo image" />
					</div>
					<div class="title">
						<h1 xml:lang="en" lang="en" lang="en" tabindex="1">Padova Marathon</h1>
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
					<li class="active">
						<a title="pannello admin Padova Marathon">Pannello Admin</a>
					</li>
					<li>
						<a href="gestioneAlloggi.php" title="gestione alloggi Padova Marathon" tabindex="4">Gestione alloggi</a>
					</li>
					<li>
						<a href="gestioneArticoli.php" title="gestione articoli Padova Marathon" tabindex="5">Gestione articoli</a>
					</li>
					<li>
						<a href="gestioneIscritti.php" title="gestione iscritti Padova Marathon" tabindex="6">Gestione iscritti</a>
					</li>
					<li>
						<a href="gestioneMessaggi.php" title="gestione messaggi Padova Marathon" tabindex="7">Gestione Messaggi</a>
					</li>
				</ul>
			</div>
			<!-- end menu -->
			<!-- start breadcrumb -->
			<ul class="breadcrumb">
				<li><a title="Ti trovi sulla pagina Pannello Admin" tabindex="8">admin</a></li>
			</ul>
			<!-- end breadcrumb -->
		</header>
		<!-- end menu -->
		<!-- container -->
		<div class="container" id="body">
			<?php
				if(isset($_SESSION['operazione'])){
					unset($_SESSION['operazione']);
					include "../pages/OperazioneEffettuata.php";
				}

			?>
			<div class="rounded-container">
				<h1 class="title" tabindex="9">Pannello admin</h1>
				<p>Benvenuto Admin, da questa pagina potrai, tramite il menù, accedere alle pagine di amministrazione del sito.</p>
				<p>Tramite i tre bottoni sottostanti è possibile modificare la propria <span xml:lang="en" lang="en">e-mail</span>, <span xml:lang="en" lang="en">password</span> e <span xml:lang="en" lang="en">username</span> di amministrazione.</p>
				<div class="button-container">
					<a href="updateMail.php" class="btn-black" tabindex="10">Modifica <span xml:lang="en" lang="en">e-mail</span></a>
					<a href="updatePwd.php" class="btn-black" tabindex="11">Modifica <span xml:lang="en" lang="en">password</span></a>
					<a href="updateUsername.php" class="btn-black" tabindex="12">Modifica <span xml:lang="en" lang="en">username</span></a>
				</div>
				<p>La seguente lista mostra le funzionalità delle varie pagine di amministrazione:</p>
				<ul>
					<li><a href="gestioneAlloggi.php" tabindex="13" title="Vai alla pagina di gestione degli alloggi">Gestione alloggi</a>: questa pagina permette di inserire, modificare e cancellare gli alloggi disponibili per gli ospiti della <span xml:lang="en" lang="en">Padova Marathon</span>;</li>
					<li><a href="gestioneArticoli.php" tabindex="14" title="Vai alla pagina di gestione degli articoli">Gestione articoli</a>: questa pagina permette di inserire, modificare e cancellare gli articoli nella pagina <span xml:lang="en" lang="en">News</span> del sito <span xml:lang="en" lang="en">Padova Marathon</span>;</li>
					<li><a href="gestioneIscritti.php" tabindex="15" title="Vai alla pagina di gestione degli iscritti">Gestione iscritti</a>: questa pagina permette di cancellare l'iscrizione degli iscritti alla maratona oppure di mandare una mail agli iscritti;</li>
					<li><a href="gestioneMessaggi.php" tabindex="16" title="Vai alla pagina di gestione dei messaggi">Gestione Messaggi</a>: questa pagina consente di visualizzare i messaggi inviati dagli utenti.</li>
				</ul>
			</div>
		</div>
		<!-- end container -->
		<footer>
			<div class="footer">
				<span class="text" xml:lang="en" lang="en" lang="en">&copy; Padova Marathon 2018</span>
				<div class="to-top-anchor">
					<a href="#header" title="Torna a inizio pagina" tabindex="17">&UpArrowBar; torna su</a>
				</div>
				<div class="w3c-valiation">
					<img src="../assets/img/validation/html5.png" alt="html5 validation logo" />
					<img src="../assets/img/validation/css.png" alt="w3c validation logo" />
				</div>
			</div>
		</footer>
		<ul class="nav responsive" id="noJsNav">
			<li class="active">
				<a title="pannello admin Padova Marathon">Pannello Admin</a>
			</li>
			<li>
				<a href="gestioneAlloggi.php" title="gestione alloggi Padova Marathon" tabindex="4">Gestione alloggi</a>
			</li>
			<li>
				<a href="gestioneArticoli.php" title="gestione articoli Padova Marathon" tabindex="5">Gestione articoli</a>
			</li>
			<li>
				<a href="gestioneIscritti.php" title="gestione iscritti Padova Marathon" tabindex="6">Gestione iscritti</a>
			</li>
			<li>
				<a href="gestioneMessaggi.php" title="gestione messaggi Padova Marathon" tabindex="7">Gestione Messaggi</a>
			</li>
		</ul>
		<!-- load js script -->
		<script src="../assets/js/template.js"></script>
	</body>
</html>
