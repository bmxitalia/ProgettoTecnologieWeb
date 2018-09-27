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
  	require_once 'paginator.php';
    $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
	require_once __DIR__ . DIRECTORY_SEPARATOR . "../gestioneDB/dbConnection.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="Keywords" content="maratona,padova,marathon,admin,gestione,iscritti">
		<meta name="Description" content="Gestione iscritti Padova Marathon">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>Gestione iscritti | Padova Marathon</title>
		<link rel="shortcut icon" href="../assets/ico/favicon.ico" type="image/x-icon">
		<link href="../assets/css/template.css" rel="stylesheet" />
		<link href="../assets/css/adminTemplate.css" rel="stylesheet" />
		<link href="../assets/css/mobile.css" rel="stylesheet" />
		<link href="../assets/css/adminMobile.css" rel="stylesheet" />
		<link href="../assets/css/print.css" rel="stylesheet" media="print"/>
		<link href="../assets/css/gestioneIscritti.css" rel="stylesheet" />
		<link href="../assets/css/gestioneIscrittiMobile.css" rel="stylesheet" />
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
					<li>
						<a href="gestioneArticoli.php" title="gestione articoli Padova Marathon" tabindex="7">Gestione articoli</a>
					</li>
					<li class="active">
						<a title="gestione iscritti Padova Marathon">Gestione iscritti</a>
					</li>
					<li>
						<a href="gestioneMessaggi.php" title="gestione messaggi Padova Marathon" tabindex="8">Gestione Messaggi</a>
					</li>
				</ul>
			</div>
			<!-- end menu -->
			<!-- start breadcrumb -->
			<ul class="breadcrumb">
				<li><a href="pannelloAdmin.php" title="Pannello Admin Padova Marathon" tabindex="9">Admin</a></li>
				<li><a title="Ti trovi sulla pagina Gestione iscritti" tabindex="10">iscritti</a></li>
			</ul>
			<!-- end breadcrumb -->
		</header>
		<!-- end menu -->
		<!-- container -->
		<div class="container" id="body">
			<?php
				if(isset($_SESSION['mailInviata'])) {
					unset($_SESSION['mailInviata']);
					echo "<div class='alert alert-success'>
						<h3 tabindex='0'>Email inviata correttamente!</h3>
						<a href='pannelloAdmin.php' title='Torna a pannello admin'>Torna a pannello admin</a>
					</div>";
				}
				if(isset($_SESSION['eliminato'])) {
					unset($_SESSION['eliminato']);
					echo "<div class='alert alert-success'>
						<h3 tabindex='0'>Iscritto eliminato correttamente!</h3>
						<a href='pannelloAdmin.php' title='Torna a pannello admin'>Torna a pannello admin</a>
					</div>";
				}
			?>
			<div class="rounded-container">
				<h1 class="title" tabindex="11">Gestione iscritti</h1>
				<?php
					$dbAccess=new dbAccess();
					$dbAccess->configure();
				  	$Paginator = new Paginator( $dbAccess);
					if(isset($_GET['tipo']))$submit=$_GET['tipo'];
					else if(isset($_GET['tipologia']))$submit=$_GET['tipologia'];
					else $submit="null";
					$dbAccess->showIscritti($submit);
				?>

				<?php
					$tabI=14;

					if(isset($_GET['id'])){
						if(!isset($_SESSION['admin']) || $_SESSION['admin']!=3784){
							header('Location: ../login.php');
						}
						else {
							$id=$_GET['id'];
							$tipoMaratona=$_GET['tipo'];
							$result=$dbAccess->doQuery("delete from ".$tipoMaratona." where Numero_di_gara=".$id);
							if($result){
								$_SESSION['eliminato'] = true;
								header('Location: gestioneIscritti.php?page='.$page.'&tipologia='.$tipoMaratona);
							}
						}
					}

					if(isset($_GET['tipologia'])){
						$tipo=$_GET['tipologia'];
						if($tipo == null) {
							echo "<div class='alert alert-danger'>
						          <h3 tabindex='0'>Non hai selezionato una maratona</h3>
						          <a href='pannelloAdmin.php title='Torna a pannello admin'>Torna a pannello admin</a>
						        </div>";
						}else{
						  $tabI= $Paginator->showIscrittiTablePaged($page,"select Numero_di_gara, Nome, Cognome from ".$tipo,$tipo);
						}
					}

					if(isset($_GET['submit'])){
						if(!isset($_GET['tipo'])) {
							echo "<div class='alert alert-danger'>
						          <h3 tabindex='0'>Non hai selezionato una maratona</h3>
						          <a href='pannelloAdmin.php' title='Torna a pannello admin'>Torna a pannello admin</a>
						        </div>";
						}else{
							$tipoMaratona=$_GET['tipo'];
							$tabI= $Paginator->showIscrittiTablePaged( $page,"select Numero_di_gara, Nome, Cognome from ".$tipoMaratona,$tipoMaratona);
						}
					}

					$_SESSION['tab']=$tabI;
				?>
			</div>
		</div>
		<!-- end container -->
		<footer>
			<div class="footer">
				<span class="text" xml:lang="en" lang="en">&copy; Padova Marathon 2018</span>
				<div class="to-top-anchor">
					<a href="#header" title="Torna a inizio pagina" tabindex="<?php echo $_SESSION['tab']; ?>">&UpArrowBar; torna su</a>
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
			<li>
				<a href="gestioneArticoli.php" title="gestione articoli Padova Marathon" tabindex="7">Gestione articoli</a>
			</li>
			<li class="active">
				<a title="gestione iscritti Padova Marathon">Gestione iscritti</a>
			</li>
			<li>
				<a href="gestioneMessaggi.php" title="gestione messaggi Padova Marathon" tabindex="8">Gestione Messaggi</a>
			</li>
		</ul>
		<!-- load js script -->
		<script src="../assets/js/template.js"></script>
	</body>
</html>
