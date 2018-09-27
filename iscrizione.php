<?php
 require_once __DIR__ . DIRECTORY_SEPARATOR . "gestioneDB/dbConnection.php";
 session_start();
  $maratona=$_POST['tipo'];
  $sesso=$_POST['sesso'];
  $nome=$_POST['nome'];
  $cognome=$_POST['cognome'];
  $giorno=$_POST['giorno'];
  $mese=$_POST['mese'];
  $anno=$_POST['anno'];
  $nazionalita=$_POST['nazionalita'];
  $email=$_POST['email'];
  $tipo='iscritti_'.$maratona.'_'.$sesso;
  $data_nascita=$anno.'-'.$mese.'-'.$giorno;
  if($giorno != null && $mese != null && $anno != null){

    if($giorno == 31 && ($mese == 2 || $mese == 4 || $mese == 6 || $mese == 9 || $mese == 11)){
      $_SESSION['erroreData'] = true;
      header("Location: iscriviti.php");
    }
    else if($mese == 2 && $giorno > 28 && $anno%4 != 0){
      $_SESSION['erroreData'] = true;
      header("Location: iscriviti.php");
    }
    else if($mese == 2 && $giorno > 29 && $anno%4 == 0){
      $_SESSION['erroreData'] = true;
      header("Location: iscriviti.php");
    }
    else{
      if($nazionalita != null) {
        $my_array=array("$nome","$cognome","$sesso","$giorno","$mese","$anno","$nazionalita","$email","$maratona");
        $_SESSION['DATA']=$my_array;
        $dbAccess=new dbAccess();
        $dbAccess->configure();
        $query='INSERT INTO '.$tipo.' (Nome,Cognome,Data_di_Nascita,Nazionalita,Email)values("'.$nome.'","'.$cognome.'","'.$data_nascita.'","'.$nazionalita.'","'.$email.'")';
        $result=mysqli_query($dbAccess->connessione,$query);
        if($result){
          $_SESSION['FLAG'][0]=true;
        }
        else{
          $query='select * from '.$tipo.' where Email="'.$email.'"';
          $result=mysqli_query($dbAccess->connessione,$query);
          if(mysqli_num_rows($result)) $_SESSION['FLAG'][1]='Email già iscritta a '.$maratona.' '.$sesso.'';
          else $_SESSION['FLAG'][1]='ok';
        }
      }
      else{
        $_SESSION['erroreNazionalita'] = true;
        header("Location: iscriviti.php");
      }
    }
  }
  else{
    $_SESSION['erroreData'] = true;
    header("Location: iscriviti.php");
  }
   header("Location: ".$_SERVER['HTTP_REFERER']);
?>