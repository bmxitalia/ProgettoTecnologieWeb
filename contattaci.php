<!DOCTYPE html>
<?php
	session_start();
	if(isset($_SESSION['DATA'])){
		unset($_SESSION['DATA']);
	}
	if(isset($_SESSION['FLAG'])){
		unset($_SESSION['FLAG']);
	}
	require_once __DIR__ . DIRECTORY_SEPARATOR . "/gestioneDB/dbConnection.php";
?>
<html xml:lang="it" lang="it">
	<head>
		<meta charset="UTF-8">
		<meta name="Keywords" content="maratona,marathon,padova,atletica,corsa,gara,contattaci,contact">
		<meta name="Description" content="Modulo di contatto per ottenere informazioni o eventuali chiarimenti sulla maratona di Padova.">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>Contattaci | Padova Marathon</title>
		<link rel="shortcut icon" href="assets/ico/favicon.ico" type="image/x-icon">
		<link href="assets/css/template.css" rel="stylesheet" />
		<link href="assets/css/mobile.css" rel="stylesheet" />
		<link href="assets/css/print.css" rel="stylesheet" media="print" />
		<link href="assets/css/contatti.css" rel="stylesheet" />
		<link href="assets/css/contattiMobile.css" rel="stylesheet" />
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
						<h1 tabindex="1" xml:lang="en" lang="en">Padova Marathon</h1>
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
					<li>
						<a href="alloggi.php" title="alloggi Padova Marathon" tabindex="9">alloggi</a>
					</li>
					<li class="active">
						<a title="contattaci Padova Marathon">contattaci</a>
					</li>
				</ul>
			</nav>
			<!-- end menu -->
			<!-- start breadcrumb -->
			<ul class="breadcrumb">
				<li><a href="index.html" title="home page Padova Marathon" tabindex="10">home</a></li>
				<li><a tabindex="11" title="Ti trovi sulla pagina Contattaci">Contattaci</a></li>
			</ul>
			<!-- end breadcrumb -->
		</header>
		<div id="body" class="container">
			<div class="rounded-container">
				<h1 id="titoloForm" tabindex="12">Compila il seguente form</h1>
				<form action="contattaci.php" method="post" id="formContatti" title="Form per contattare l'amministratore">
					<fieldset>
							<div id="div-field">
								<div class="field-group">
									<label class="labelField" for="nome">Nome *:</label>
									<input type="text" name="nome" id="nome" class="inputField" placeholder="Nome" title="Inserisci il tuo nome" tabindex="13" required />
								</div>
								<div class="field-group">
									<label class="labelField" for="cognome">Cognome *:</label>
									<input type="text" name="cognome" id="cognome" class="inputField" placeholder="Cognome" title="Inserisci il tuo cognome" tabindex="14" required />
								</div>
								<div class="field-group">
									<label class="labelField" for="email">Email *:</label>
									<input type="email" name="email" id="email" class="inputField" placeholder="Email" title="Inserisci il tuo indirizzo di posta elettronica" pattern="[a-zA-Z0-9_]+(?:\.[A-Za-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*@(?!([a-zA-Z0-9]*\.[a-zA-Z0-9]*\.[a-zA-Z0-9]*\.))(?:[A-Za-z0-9](?:[a-zA-Z0-9-]*[A-Za-z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?" tabindex="15" required />
								</div>
								<div class="field-group">
									<label class="labelField" for="messaggio">Messaggio *:</label>
									<textarea name="messaggio" id="messaggio" class="inputArea"  placeholder="Scrivi il tuo messaggio qui" title="Inserisci il testo del messaggio" tabindex="16" required></textarea>
								</div>
								<input class="btn-black btn-lg" type="submit" name="submit" id="submit" value="Invia" tabindex="17" />
							</div>
					</fieldset>
				</form>
			</div>
		</div>
		<?php
			if(isset($_POST['submit'])){
				$nome		=$_POST['nome'];
				$cognome	=$_POST['cognome'];
				$email		=$_POST['email'];
				$messaggio	=$_POST['messaggio'];
				if(!empty($nome) && ctype_alpha($nome) && !empty($cognome) && ctype_alpha($cognome) && !empty($email) && !empty($messaggio)){
					$dbAccess = new dbAccess();
					$dbAccess->configure();
					$result = $dbAccess->doQuery("INSERT INTO messaggi(Nome, Cognome, Email, Messaggio) VALUES ('".mysqli_real_escape_string($dbAccess->connessione,htmlentities($nome))."','".mysqli_real_escape_string($dbAccess->connessione,htmlentities($cognome))."','".mysqli_real_escape_string($dbAccess->connessione,htmlentities($email))."','".mysqli_real_escape_string($dbAccess->connessione,htmlentities($messaggio))."');");
					if($result){
						echo "<div class='alert alert-success'>
								<h3 tabindex='0'>Messaggio inviato correttamente!</h3><br/>
								<p tabindex='0'>
									Il messaggio è stato inviato, le verrà inviata una risposta il più presto possibile.
								</p>
								<a href='index.html'>Torna alla Home</a>
							</div>";
					}else{
						echo "<div class='alert alert-danger'>
								<h3 tabindex='0'>Attenzione!</h3><br/>
								<p tabindex='0'>
									Si è verificato un errore, l'operazione non è andata a buon fine. La invitiamo a riprovare più tardi.
								</p>
								<a href='index.html'>Torna alla Home</a>
							</div>";
					}
				}else{
					if(!ctype_alpha($nome) || !ctype_alpha($cognome)) {
						echo "<div class='alert alert-danger'>
							<h3 tabindex='0'>Attenzione!</h3>
							<p tabindex='0'>I campi nome e cognome non possono contenere numeri.</p>
							<a href='index.html' title='Torna alla home'>Torna alla home</a>
						</div>";

					}
				}
			}
		?>
		<footer>
			<div class="footer">
				<span class="text" xml:lang="en" lang="en">&copy; Padova Marathon 2018</span>
				<div class="to-top-anchor">
					<a href="#header" tabindex="18" title="Torna a inizio pagina">&UpArrowBar; torna su</a>
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
			<li>
				<a href="alloggi.php" title="alloggi Padova Marathon" tabindex="9">alloggi</a>
			</li>
			<li class="active">
				<a title="contattaci Padova Marathon">contattaci</a>
			</li>
		</ul>
		<script src="assets/js/template.js"></script>
	</body>
</html>
