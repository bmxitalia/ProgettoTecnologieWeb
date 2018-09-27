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
		<title>Aggiorna email admin | Padova Marathon</title>
		<link rel="shortcut icon" href="../assets/ico/favicon.ico" type="image/x-icon">
		<link href="../assets/css/template.css" rel="stylesheet" />
		<link href="../assets/css/adminTemplate.css" rel="stylesheet" />
		<link href="../assets/css/mobile.css" rel="stylesheet" />
		<link href="../assets/css/adminMobile.css" rel="stylesheet" />
		<link href="../assets/css/print.css" rel="stylesheet" media="print" />
		<link href="../assets/css/updateAdmin.css" rel="stylesheet" />
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
			<li><a href="pannelloAdmin.php" title="Pannello Admin Padova Marathon" tabindex="8">admin</a></li>
			<li><a title="Ti trovi sulla pagina Modifica e-mail" tabindex="9">e-mail</a></li>
		</ul>
		<!-- end breadcrumb -->
	</header>
	<body>
		<!-- end menu -->
		<!-- container -->
		<div class="container" id="body">
			<div class="rounded-container">
				<h1 class='title' tabindex="10">Aggiorna e-mail</h1>
				<?php
					$dbAccess=new dbAccess();
					$dbAccess->configure();
					$tabI=$dbAccess->createUpdateMailForm();
				?>
			</div>
		</div>
		<!-- end container -->
		<?php
			if(isset($_POST['submit'])){
				$vecchiaInserita=$_POST['mail1'];
				$nuova=$_POST['mail2'];
				$nuova2=$_POST['mail3'];
				$vecchia=$dbAccess->getMail();
				if($vecchia==$vecchiaInserita){
					if($nuova!=$vecchiaInserita){
						if($nuova==$nuova2){
							$query="UPDATE admin SET mail='".$nuova."' WHERE mail='".$vecchia."';";
							$result=$dbAccess->doQuery($query);
							if($result){
								$_SESSION['operazione']=true;
								header('Location: pannelloAdmin.php');
							}
							else{
								include "../pages/QueryError.php";
							}
						}else{
							echo "<div class='alert alert-danger'>
									<h3 tabindex='0'>Attenzione!</h3>
									<p tabindex='0'>Le due mail inserite non corrispondono!</p>
									<a href='pannelloAdmin.php'>Torna alla Home</a>
								</div>";
						}
					}else{
						echo "<div class='alert alert-danger'>
									<h3 tabindex='0'>Attenzione!</h3>
									<p tabindex='0'>La nuova mail non può coincidere con la vecchia!</p>
									<a href='pannelloAdmin.php'>Torna alla Home</a>
								</div>";
					}
				}else{
					echo "<div class='alert alert-danger'>
							<h3 tabindex='0'>Attenzione!</h3>
							<p tabindex='0'>La vecchia mail non è quella corretta!</p>
							<a href='pannelloAdmin.php'>Torna alla Home</a>
						</div>";
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