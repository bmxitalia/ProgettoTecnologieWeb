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
		<meta name="Keywords" content="maratona,maraton,padova,news,articolo,aggiornamenti">
		<meta name="Description" content="Lista news provenienti dallorganizzazione di Padova Marathon">
		<title>News | Padova Marathon</title>
		<link rel="shortcut icon" href="assets/ico/favicon.ico" type="image/x-icon">
		<link href="assets/css/template.css" rel="stylesheet" />
		<link href="assets/css/mobile.css" rel="stylesheet" />
		<link href="assets/css/print.css" rel="stylesheet" media="print" />
		<link href="assets/css/printNews.css" rel="stylesheet" media="print" />
		<link href="assets/css/news.css" rel="stylesheet"/>
		<link href="assets/css/newsMobile.css" rel="stylesheet"/>
		<meta name="viewport" content="width=device-width,initial-scale=1">
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
						<a href="index.html" title="pagina home Padova Marathon" tabindex="5">home</a>
					</li>
					<li>
						<a href="info.html" title="pagina info Padova Marathon" tabindex="6">info</a>
					</li>
					<li class="active">
						<a title="pagina news Padova Marathon">news</a>
					</li>
					<li>
						<a href="iscriviti.php" title="pagina iscriviti Padova Marathon" tabindex="7">iscriviti</a>
					</li>
					<li>
						<a href="alloggi.php" title="pagina alloggi Padova Marathon" tabindex="8">alloggi</a>
					</li>
					<li>
						<a href="contattaci.php" title="pagina contattaci Padova Marathon" tabindex="9">contattaci</a>
					</li>
				</ul>
			</nav>
			<!-- end menu -->
			<!-- start breadcrumb -->
			<ul class="breadcrumb">
				<li><a href="index.html" title="home page Padova Marathon" tabindex="10">home</a></li>
				<li><a title="Ti trovi sulla pagina news" tabindex="11">News</a></li>
			</ul>
			<!-- end breadcrumb -->
		</header>
		<!-- end menu -->
		<!-- container -->
		<div class="container" id="body" >
			<?php
				$dbAccess=new dbAccess();
				$dbAccess->configure();
				$tabI=$dbAccess->takeArticles();
			?>
		</div>
		<!-- end container -->
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
				<a href="index.html" title="pagina home Padova Marathon" tabindex="5">home</a>
			</li>
			<li>
				<a href="info.html" title="pagina info Padova Marathon" tabindex="6">info</a>
			</li>
			<li class="active">
				<a title="pagina news Padova Marathon">news</a>
			</li>
			<li>
				<a href="iscriviti.php" title="pagina iscriviti Padova Marathon" tabindex="7">iscriviti</a>
			</li>
			<li>
				<a href="alloggi.php" title="pagina alloggi Padova Marathon" tabindex="8">alloggi</a>
			</li>
			<li>
				<a href="contattaci.php" title="pagina contattaci Padova Marathon" tabindex="9">contattaci</a>
			</li>
		</ul>
		<!-- load js script -->
		<script src="assets/js/template.js"></script>
		<script src="assets/js/news.js"></script>
	</body>
</html>
