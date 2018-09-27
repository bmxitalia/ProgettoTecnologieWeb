<?php
	require_once __DIR__ . DIRECTORY_SEPARATOR . "gestioneDB/dbConnection.php";
	session_start();
	if(isset($_SESSION['DATA'])){
		unset($_SESSION['DATA']);
	}
	if(isset($_SESSION['FLAG'])){
		unset($_SESSION['FLAG']);
	}
?>
<!DOCTYPE html>
<html xml:lang="it" lang="it">
	<head>
		<meta charset="UTF-8">
		<meta name="Keywords" content="maratona,maraton,padova,alloggi-,hotel,ristoro,ristori">
		<meta name="Description" content="Alloggi disponibili a Padova in occassione della Padova Marathon">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>Alloggi | Padova Marathon</title>
		<link rel="shortcut icon" href="assets/ico/favicon.ico" type="image/x-icon">
		<link href="assets/css/template.css" rel="stylesheet" />
		<link href="assets/css/mobile.css" rel="stylesheet" />
		<link href="assets/css/print.css" rel="stylesheet" media="print" />
		<link href="assets/css/printAlloggi.css" rel="stylesheet" media="print" />
		<link href="assets/css/alloggi.css" rel="stylesheet" />
		<link href="assets/css/alloggiMobile.css" rel="stylesheet" />
	</head>
	<body>
		<header>
			<!-- header -->
			<div class="header-wrapper">
				<div class="header" id="header">
					<div class="logo">
						<img src="assets/img/logo.png" alt="logo image" />
					</div>
					<div class="title">
						<h1 xml:lang="en" lang="en" tabindex="1">Padova Marathon</h1>
						<div class="date">
							<h2 tabindex="2">5 AGOSTO 2018</h2>
						</div>
						<a href="iscriviti.php" title="Pagina di iscrizione Padova Marathon" class="subscribe-button" tabindex="3">ISCRIVITI QUI</a>
					</div>
				</div>
			</div>
			<!-- end header -->
			<!-- menu -->
			<nav class="navbar">
				<a class="helps" href="#body" tabindex="4" title="Vai al contenuto">
					Salta la navigazione
				</a>
				<ul class="nav" id="mainNav">
					<li class="icon" onclick="loadResponsiveMenu()">
						<a href="#noJsNav" tabindex="5">&#9776;</a>
					</li>
					<li>
						<a href="index.html" title="home page Padova Marathon" tabindex="5">home</a>
					</li>
					<li>
						<a href="info.html" title="info Padova Marathon" tabindex="6">info</a>
					</li>
					<li>
						<a href="news.php" title="news Padova Marathon" tabindex="7">news</a>
					</li>
					<li>
						<a href="iscriviti.php" title="Pagina iscrizione Padova Marathon" tabindex="8">iscriviti</a>
					</li>
					<li class="active">
						<a title="alloggi Padova Marathon">alloggi</a>
					</li>
					<li>
						<a href="contattaci.php" title="contattaci Padova Marathon" tabindex="9">contattaci</a>
					</li>
				</ul>
			</nav>
			<!-- end menu -->
			<!-- start breadcrumb -->
			<ul class="breadcrumb">
				<li><a href="index.html" title="home page Padova Marathon" tabindex="10">home</a></li>
				<li><a title="Ti trovi sulla pagina Alloggi" tabindex="11">Alloggi</a></li>
			</ul>
			<!-- end breadcrumb -->
		</header>
		<div class="container" id="body">
			<div id="containerAlloggi">
				<h1 class="title" tabindex="12">I nostri alloggi disponibili:</h1>
				<?php
					$dbAccess = new dbAccess();
					$dbAccess->configure();
					$tabI=$dbAccess->takeHotel();
				?>
			</div>
		</div>
		<footer>
			<div class="footer">
				<span class="text" xml:lang="en" lang="en">&copy; Padova Marathon 2018</span>
				<div class="to-top-anchor">
					<a href="#header" tabindex="<?php echo $tabI; ?>" title="Torna a inizio pagina">&UpArrowBar; torna su</a>
				</div>
				<div class="w3c-valiation">
					<img src="assets/img/validation/html5.png" alt="html5 validation logo" />
					<img src="assets/img/validation/css.png" alt="w3c validation logo" />
				</div>
			</div>
		</footer>
		<ul class="nav responsive" id="noJsNav">
			<li>
				<a href="index.html" title="home page Padova Marathon" tabindex="5">home</a>
			</li>
			<li>
				<a href="info.html" title="info Padova Marathon" tabindex="6">info</a>
			</li>
			<li>
				<a href="news.php" title="news Padova Marathon" tabindex="7">news</a>
			</li>
			<li>
				<a href="iscriviti.php" title="Pagina iscrizione Padova Marathon" tabindex="8">iscriviti</a>
			</li>
			<li class="active">
				<a title="alloggi Padova Marathon">alloggi</a>
			</li>
			<li>
				<a href="contattaci.php" title="contattaci Padova Marathon" tabindex="9">contattaci</a>
			</li>
		</ul>
		<script src="assets/js/template.js"></script>
	</body>
</html>
