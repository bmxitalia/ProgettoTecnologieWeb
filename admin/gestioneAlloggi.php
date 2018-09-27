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
	require_once __DIR__ . DIRECTORY_SEPARATOR . "../gestioneDB/dbConnection.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="Keywords" content="maratona,padova,marathon,admin,gestione,alloggi">
		<meta name="Description" content="Gestione alloggi Padova Marathon">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>Gestione alloggi | Padova Marathon</title>
		<link rel="shortcut icon" href="../assets/ico/favicon.ico" type="image/x-icon">
		<link href="../assets/css/template.css" rel="stylesheet" />
		<link href="../assets/css/adminTemplate.css" rel="stylesheet" />
		<link href="../assets/css/mobile.css" rel="stylesheet" />
		<link href="../assets/css/adminMobile.css" rel="stylesheet" />
		<link href="../assets/css/print.css" rel="stylesheet" media="print"/>
		<link href="../assets/css/gestioneAlloggi.css" rel="stylesheet" />
		<link href="../assets/css/gestioneArticoliMobile.css" rel="stylesheet" />
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
				<li  class="active">
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
			<li><a href="pannelloAdmin.php" title="Pannello admin Padova Marathon" tabindex="9">admin</a></li>
			<li><a title="Ti trovi sulla pagina Gestione alloggi" tabindex="10">alloggi</a></li>
		</ul>
		<!-- end breadcrumb -->
	</header>
	<body>
		<!-- end menu -->
		<!-- container -->
		<div class="container" id="body">
			<?php 
				if(isset($_SESSION['modificato'])) {
					unset($_SESSION['modificato']);
					echo "<div class='alert alert-success'>
						<h3 tabindex='0'>Modifica dell'alloggio avvenuta correttamente!</h3>
						<a href='pannelloAdmin.php' title='Torna a pannello admin'>Torna a pannello admin</a>
					</div>";
				}
				if(isset($_SESSION['eliminato'])) {
					unset($_SESSION['eliminato']);
					echo "<div class='alert alert-success'>
						<h3 tabindex='0'>Eliminazione dell'alloggio avvenuta correttamente!</h3>
						<a href='pannelloAdmin.php' title='Torna a pannello admin'>Torna a pannello admin</a>
					</div>";
				}
			?>
			<div class="rounded-container">
				<h1 class="title" tabindex="11">Gestione alloggi</h1>
				<a href="inserimentoAlloggio.php" class="btn-lg btn-black" id="insertButton" tabindex="12" title="Inserimento di un nuovo alloggio">Nuovo alloggio</a>
				<?php
					$dbAccess=new dbAccess();
					$dbAccess->configure();
					$tabI=$dbAccess->administrateHotel();
				?>
			</div>
		</div>
		<!-- end container -->
		<footer>
			<div class="footer">
				<span class="text">&copy; Padova Marathon 2018</span>
				<div class="to-top-anchor">
					<a href="#header" tabindex="<?php echo $tabI; ?>" title="Torna a inizio pagina">&UpArrowBar; torna su</a>
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
			<li  class="active">
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
		<!-- load js script -->
		<script src="../assets/js/template.js"></script>
	</body>
</html>

<?php
	if(isset($_GET['id'])){
		if(!isset($_SESSION['admin']) || $_SESSION['admin']!=3784){
			header('Location: ../login.php');
		}
		else {
			$id=$_GET['id'];
			$nome=$_GET['nome'];
			$dbAccess->doQuery("DELETE FROM alloggi WHERE ID=$id;");
			$_SESSION['eliminato'] = true;
			$curpage = $_SERVER['PHP_SELF'];
	        header('Refresh: 0; url=' . $curpage); //refresh istantaneo dopo l'eliminazione, manca la gestione di un messaggio di notifica
		}
	}
?>
