<!DOCTYPE html>
<?php
	require_once __DIR__ . DIRECTORY_SEPARATOR . "gestioneDB/dbConnection.php";
  session_start();
  if(!ISSET($_SESSION['FLAG'])){
      $myarray=array(false,'ok');
		  $_SESSION['FLAG']=$myarray;
  }
?>
<html xml:lang="it" lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="Keywords" content="maratona,maraton,padova,atletica,corsa,gara">
  <meta name="Description" content="Iscriviti alla maratona di Padova inserendo i tuoi dati">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Iscriviti | Padova Marathon</title>
  <link rel="shortcut icon" href="assets/ico/favicon.ico" type="image/x-icon">
  <link href="assets/css/template.css" rel="stylesheet" />
  <link href="assets/css/mobile.css" rel="stylesheet" />
  <link href="assets/css/print.css" rel="stylesheet" media="print" />
  <link href="assets/css/iscriviti.css" rel="stylesheet" />
  <link href="assets/css/iscrivitiMobile.css" rel="stylesheet" />
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
      <li class="active">
        <a title="Pagina di iscrizione Padova Marathon">iscriviti</a>
      </li>
      <li>
        <a href="alloggi.php" title="alloggi Padova Marathon" tabindex="8">alloggi</a>
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
      <li><a title="Ti trovi sulla pagina Iscriviti" tabindex="11">Iscriviti</a></li>
    </ul>
    <!-- end breadcrumb -->
  </header>
    <div class="container" id="body">
      <?php
        if(isset($_SESSION['erroreNazionalita'])){
          unset($_SESSION['erroreNazionalita']);
          echo "<div class='alert alert-danger'>
              <h3 tabindex='0'>Iscrizione non avvenuta</h3>
              <p tabindex='0'>
                Inserisci correttamente la nazionalità.
              </p>
              <a href='index.html' title='Torna alla home'>Torna alla Home</a>
            </div>";
        }
        if(isset($_SESSION['erroreData'])){
          unset($_SESSION['erroreData']);
          echo "<div class='alert alert-danger'>
              <h3 tabindex='0'>Iscrizione non avvenuta</h3>
              <p tabindex='0'>
                Inserisci correttamente la data di nascita.
              </p>
              <a href='index.html' title='Torna alla home'>Torna alla Home</a>
            </div>";
        }

      ?>
      <div class="rounded-container">
      <?php
        if($_SESSION['FLAG'][0]==false){
      echo'
					<h1 id="titoloForm" title="Compila il seguente form per iscriverti" tabindex="12">Compila il seguente form</h1>
					<form id="iscriviti" method="post" name="iscrizione" action="iscrizione.php">
          <div id="div-field">
            <div class="field-group">
              <label class="labelField" for="nome">Nome *:</label>
              <input class="inputField" name="nome" id="nome" type="text" title="Inserisci il tuo nome" tabindex="13"';
              if(ISSET($_SESSION['DATA'])) echo 'value="'.$_SESSION['DATA'][0].'" required />';
              else echo 'placeholder="Nome" required />';
            echo'
            </div>
            <div class=field-group>
              <label class="labelField" for="cognome">Cognome *:</label>
              <input class="inputField" name="cognome" id="cognome" type="text" title="Inserisci il tuo cognome" tabindex="14"';
              if(ISSET($_SESSION['DATA'])) echo 'value="'.$_SESSION['DATA'][1].'" required />';
              else echo 'placeholder="Cognome" required>';

            echo'
            </div>
            <div class="field-group">
              <label class="labelField">Sesso *:</label>
              <input class="radioField" type="radio" name="sesso" id="uomo" value="uomini" tabindex="15" title="Sesso : uomo"';
              if(!ISSET($_SESSION['DATA']) || $_SESSION['DATA'][2]=='uomini')echo ' checked';
              echo'
              /><label for="uomo" title="Sesso : uomo">Uomo</label>
              <input class="radioField" type="radio" name="sesso" id="donna" value="donne" tabindex="16" title="Sesso : donna"';
              if( ISSET($_SESSION['DATA']) && $_SESSION['DATA'][2]=='donne')echo ' checked';
                echo'/>  <label for="donna" title="Sesso : donna">Donna</label>
            </div>
            <div class="field-group">
              <label class="labelField">Data di nascita *:</label>
              <label for="giorno">Giorno:</label>
              <select class="data" name="giorno"  id="giorno" tabindex="17" title="Inserire giorno di nascita" required>';
              if(!ISSET($_SESSION['DATA']))echo '<option disabled selected value="">--</option>';
              for($i=1;$i<=31;$i++){
                if(ISSET($_SESSION['DATA'])&& $i==$_SESSION['DATA'][3])
                echo '<option selected value="'. $i .'"> '.$i.'</option>';
                else
                echo'<option value="'. $i .'"> '.$i.'</option>';
              }
            echo'
            </select>
            <label for="mese">Mese:</label>
            <select class="data" name="mese"  id="mese" tabindex="18" title="Inserire mese di nascita" required>';
            if(!ISSET($_SESSION['DATA']))echo '<option disabled selected value="">--</option>';
            for($i=1;$i<=12;$i++){
              if(ISSET($_SESSION['DATA'])&& $i==$_SESSION['DATA'][4])
              echo '<option selected value="'. $i .'"> '.$i.'</option>';
              else
              echo'<option value="'. $i .'"> '.$i.'</option>';
            }
          echo'
          </select>
          <label for="anno">Anno:</label>
          <select class="data" name="anno" id="anno" tabindex="19" title="Inserire anno di nascita" required>';
          if(!ISSET($_SESSION['DATA']))echo '<option disabled selected value="">----</option>';
          for($i=1910;$i<=2000;$i++){
            if(ISSET($_SESSION['DATA'])&& $i==$_SESSION['DATA'][5])
            echo '<option selected value="'. $i .'"> '.$i.'</option>';
            else
            echo'<option value="'. $i .'"> '.$i.'</option>';
          }
        echo'
        </select>
            </div>

            <div class="field-group">
              <label class="labelField" for="nazionalita">Nazionalità *:</label>
              <select class="inputField" name="nazionalita" id="nazionalita" title="Inserisci la tua nazionalità" tabindex="20">';
              if(!ISSET($_SESSION['DATA']))echo '<option disabled selected value="">Seleziona la nazionalità</option>';
                $dbAccess=new dbAccess();
                $dbAccess->configure();
                $dbAccess->takeNazionalita();
            echo'
              </select>
            </div>
            <div id="field-email" class="field-group">
              <label class="labelField" for="email">Email *:</label>';?>
              <input class="inputField" id="email" name="email" type="text" title="Inserisci un indirizzo e-mail valido" placeholder="example@domani.com" pattern="[a-zA-Z0-9_]+(?:\.[A-Za-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*@(?!([a-zA-Z0-9]*\.[a-zA-Z0-9]*\.[a-zA-Z0-9]*\.))(?:[A-Za-z0-9](?:[a-zA-Z0-9-]*[A-Za-z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?" tabindex="22"<?php
              if(ISSET($_SESSION['DATA'])) echo 'value="'.$_SESSION['DATA'][7].'" required />';
              else echo ' required />';
              if($_SESSION['FLAG'][1]!='ok'){
              echo'<label id="email-lbl" class="status-lbl">'.$_SESSION['FLAG'][1].'</label>';
              }
              echo'
            </div>
            <div class="field-group">
              <label class="labelField">Iscrizione a *:</label>
              <input class="radioField" type="radio" name="tipo" id="maratona" value="maratona" tabindex="23" title="Maratona"';
              if(!ISSET($_SESSION['DATA']) || $_SESSION['DATA'][8]=='maratona')echo ' checked';
              echo'
              /><label for="maratona" title="Maratona">Maratona</label>
              <input class="radioField" type="radio" name="tipo" id="mezza_maratona" value="mezza_maratona" tabindex="24" title="Mezza maratona"';

              if(ISSET($_SESSION['DATA'])  && $_SESSION['DATA'][8]=='mezza_maratona')echo ' checked';
              echo'
              /> <label for="mezza_maratona" title="Mezza maratona">Mezza maratona</label>
            </div>
              <input class="btn-black btn-lg" type="submit" value="Iscriviti" title="Pulsante per iscriversi" tabindex="25"/>
          </div>
      </form>';
    }
    else{
      unset($_SESSION['DATA']);
			unset($_SESSION['FLAG']);
      echo "<div class='alert alert-success'>
          <h3 tabindex='0'>Registrazione effettuata</h3>
          <p tabindex='0'>
            Iscrizione effettuata con successo.
          </p>
          <a href='index.html' title='Torna alla home'>Torna alla Home</a>
        </div>";
    }
    ?>
    </div></div>
  <footer>
    <div class="footer">
      <span class="text" xml:lang="en" lang="en">&copy; Padova Marathon 2018</span>
      <div class="to-top-anchor">
        <a href="#header" tabindex="26" title="Torna a inizio pagina">&UpArrowBar; torna su</a>
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
    <li class="active">
      <a title="Pagina di iscrizione Padova Marathon">iscriviti</a>
    </li>
    <li>
      <a href="alloggi.php" title="alloggi Padova Marathon" tabindex="8">alloggi</a>
    </li>
    <li>
      <a href="contattaci.php" title="contattaci Padova Marathon" tabindex="9">contattaci</a>
    </li>
  </ul>
  <script src="assets/js/template.js"></script>
  </body>
  </html>
