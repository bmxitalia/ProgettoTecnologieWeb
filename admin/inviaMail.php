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
		<title>Invia mail a iscritto | Padova Marathon</title>
		<link rel="shortcut icon" href="../assets/ico/favicon.ico" type="image/x-icon">
		<link href="../assets/css/template.css" rel="stylesheet" />
		<link href="../assets/css/adminTemplate.css" rel="stylesheet" />
		<link href="../assets/css/mobile.css" rel="stylesheet" />
		<link href="../assets/css/adminMobile.css" rel="stylesheet" />
		<link href="../assets/css/print.css" rel="stylesheet" media="print"/>
		<link href="../assets/css/inviaMail.css" rel="stylesheet" />
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
					<a href="pannelloAdmin.php" title="pannello admin Padova Marathon" tabindex="4">Pannello Admin</a>
				</li>
				<li>
					<a href="gestioneAlloggi.php" title="gestione alloggi Padova Marathon" tabindex="5">Gestione alloggi</a>
				</li>
				<li>
					<a href="gestioneArticoli.php" title="gestione articoli Padova Marathon" tabindex="6">Gestione articoli</a>
				</li>
				<li class="active">
					<a title="gestione iscritti Padova Marathon">Gestione iscritti</a>
				</li>
				<li>
					<a href="gestioneMessaggi.php" title="gestione messaggi Padova Marathon" tabindex="7">Gestione Messaggi</a>
				</li>
			</ul>
		</div>
		<!-- end menu -->
		<!-- start breadcrumb -->
		<ul class="breadcrumb">
			<li><a href="pannelloAdmin.php" title="Pannello Admin Padova Marathon" tabindex="8">Admin</a></li>
			<li><a href="gestioneIscritti.php" title="Gestione iscritti Padova Marathon" tabindex="9">iscritti</a></li>
			<li><a title="Ti trovi sulla pagina Invia e-mail" tabindex="10">mail</a></li>
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
					$mail="";
					if(isset($_GET['id'])){
						$idGara=$_GET['id'];
						$tipo=$_GET['tipo'];
						$_SESSION['tipo'] = $tipo;
						$mail=$dbAccess->getIscrittoMail($idGara,$tipo);
						$_SESSION['mail']=$mail;
						$tabI=$dbAccess->showMailForm($idGara,$tipo);
					}
				?>
			</div>
		</div>
		<!-- end container -->
		<?php
			if(isset($_POST['submit'])){
				$messaggio=$_POST['testo'];
				$adminMail=$dbAccess->getMail();
				mail($_SESSION['mail'], "Mail dall'admin di Padova Marathon", $messaggio, "From: ".$adminMail. "\r\nReply-To: ".$adminMail);
				$_SESSION['mailInviata'] = true;
				header('Location: gestioneIscritti.php?tipo='.$_SESSION['tipo'].'&submit=Visualizza+iscritti');
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
				<a href="pannelloAdmin.php" title="pannello admin Padova Marathon" tabindex="4">Pannello Admin</a>
			</li>
			<li>
				<a href="gestioneAlloggi.php" title="gestione alloggi Padova Marathon" tabindex="5">Gestione alloggi</a>
			</li>
			<li>
				<a href="gestioneArticoli.php" title="gestione articoli Padova Marathon" tabindex="6">Gestione articoli</a>
			</li>
			<li class="active">
				<a title="gestione iscritti Padova Marathon">Gestione iscritti</a>
			</li>
			<li>
				<a href="gestioneMessaggi.php" title="gestione messaggi Padova Marathon" tabindex="7">Gestione Messaggi</a>
			</li>
		</ul>
		<!-- load js script -->
		<script src="../assets/js/template.js"></script>
	</body>
</html>