<?php
	ini_set("session.gc_maxlifetime","10");
	ini_set("session.cookie_lifetime","10");
	session_start();
	if(isset($_SESSION['DATA'])){
		unset($_SESSION['DATA']);
	}
	if(isset($_SESSION['FLAG'])){
		unset($_SESSION['FLAG']);
	}
	if(isset($_GET['logout'])){
		session_destroy();
	}
	if(isset($_SESSION['admin'])){
		header('Location: admin/pannelloAdmin.php');
	}
	require_once __DIR__ . DIRECTORY_SEPARATOR . "gestioneDB/dbConnection.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login | Padova Marathon</title>
		<link href="assets/css/template.css" rel="stylesheet" />
		<link href="assets/css/login.css" rel="stylesheet" />
		<link href="assets/css/loginMobile.css" rel="stylesheet" />
		<link rel="shortcut icon" href="assets/ico/favicon.ico" type="image/x-icon">
	</head>
	<body>
		<div id="container">
			<form id="form-login" method="post" action="login.php">
				<div id="div-field">
					<div class="field-group">
						<h1>Login</h1>
						<span>Inserisci username e password per accedere al pannello amministrazione. <a href="index.html" tabindex="1" accesskey="h">Torna alla Home</a></span>
					</div>
					<div class="field-group">
						<label class="labelField" for="username">Username</label>
						<input type="text" name="username" id="username" class="inputField" tabindex="2" accesskey="u" required />
					</div>
					<div class="field-group">
						<label class="labelField" for="password">Password</label>
						<input type="password" name="password" id="password" class="inputField" tabindex="3" accesskey="p" required />
					</div>
					<input type="submit" name="submit" value="Accedi" id="submit" class="btn-lg btn-black" tabindex="4" />
				</div>
			</form>
			<?php
				if(isset($_POST['submit'])){
					$username=$_POST['username'];
					$pwd=$_POST['password'];
					$dbAccess=new dbAccess();
					$dbAccess->configure();
					$adminUsername=$dbAccess->getUserName();
					$adminPwd=$dbAccess->getPwd();
					$userId=$dbAccess->getUserId();
					//controllo mail e password
					if($username==$adminUsername){
						if($pwd==$adminPwd){
							$_SESSION['admin']=$userId;
							header('Location: admin/pannelloAdmin.php');
						}
						else{
							echo "<div class='alert alert-danger'>
								<h3 tabindex='0'>Errore!</h3><br/>
								<p tabindex='0'>
									La password inserita non è corretta
								</p>
								<a href='index.html'>Torna alla Home</a>
							</div>";
						}
					}else{
						echo "<div class='alert alert-danger'>
							<h3 tabindex='0'>Errore!</h3><br/>
							<p tabindex='0'>
								Lo username inserito non è corretto
							</p>
							<a href='index.html'>Torna alla Home</a>
						</div>";
					}
				}
			?>
		</div>
	</body>
</html>
