<?php

class Paginator {

     private $_conn;
     private $_tipo;
     private $_limit;
     private $_page;
     private $_query;
     private $_total;
     public function __construct( $conn) {
       $this->_conn = $conn;
       $this->_limit=3;
       $this->_links=1;


     }
     public function showIscrittiTablePaged($page,$query,$tipo){
       $this->_query = $query;
       $rs= $this->_conn->doQuery( $this->_query );
       $this->_total = $rs->num_rows;
       $this->_tipo=$tipo;
       $total=$this->_conn->doQuery($this->_query);
       $tab=14;
       if(mysqli_num_rows($total) >0){
         $result=$this->getData($this->_limit,$page);
         ?>
         <div id="print-div">
           <a href="stampaIscritti.php?marathon=<?php echo $tipo; ?>" title="Vai alla pagina di stampa per gli iscritti della maratona selezionata" tabindex="<?php echo $tab; $tab++; ?>" class="btn-black" target="_blank">Stampa iscritti</a>
         </div>
        <?php
         echo "<table class='table' id='tabellaMaratona' summary='Tabella di gestione degli iscritti alla maratona'>";
		     echo "<caption class='title' tabindex='".$tab."'>".$this->_conn->getTitoloMaratona($tipo)."</caption>"; $tab++;
		     echo '<thead><tr><th scope="col">Numero di gara</th><th scope="col">Nome</th><th scope="col">Cognome</th><th colspan="2" scope="colgroup" id="op">Operazioni</th></tr></thead><tbody>';
         for($i = 0; $i<count($result->data); $i++){
           echo "<tr>";
           echo "<td>".$result->data[$i]['Numero_di_gara']."</td>";
           echo "<td>".$result->data[$i]['Nome']."</td>";
           echo "<td>".$result->data[$i]['Cognome']."</td>";
         ?>
         <td><a class='btn-black' href="inviaMail.php?id=<?php echo $result->data[$i]['Numero_di_gara']; ?>&tipo=<?php echo $tipo; ?>" title="Invia e-mail all'iscritto" tabindex="<?php echo $tab; $tab++; ?>">Mail</a></td>
		     <td><a class='btn-red' href="gestioneIscritti.php?id=<?php echo $result->data[$i]['Numero_di_gara']; ?>&tipo=<?php echo $tipo; ?>" title="Elimina iscritto" tabindex="<?php echo $tab; $tab++; ?>">Elimina</a></td>
         <?php
           echo "</tr>";
         }
        echo "</tbody></table>";
         $tab=$this->createLinks($this->_links,$tab);
         return $tab;
       }else{
         echo "<div class='alert alert-danger' id='erroreNoSelection'>
              <h3 tabindex='0'>Attenzione!</h3>
              <p tabindex='0'>Nessun iscritto alla maratona selezionata!</p>
              <a href='pannelloAdmin.php' title='Torna a pannello admin'>Torna a pannello admin</a>
            </div>";
       }
     }


     public function getData( $limit = 1, $page = 1 ) {
      $this->_limit   = $limit;
      $this->_page    = $page;
      $query= $this->_query . " LIMIT " . ( ( $this->_page - 1 ) * $this->_limit ) . ", $this->_limit";
      $rs= $this->_conn->doQuery($query);
      while ( $row = $rs->fetch_assoc() ) {
          $results[]  = $row;
      }
      $result         = new stdClass();
      $result->page   = $this->_page;
      $result->limit  = $this->_limit;
      $result->total  = $this->_total;
      $result->data   = $results;
      return $result;
    }

    public function createLinks( $links,$tab) {
    if ( $this->_limit >= $this->_total ) {
        return ' ';
    }
    $last       = ceil( $this->_total / $this->_limit );
    $start      = ( ( $this->_page - $links ) > 0 ) ? $this->_page - $links : 1;
    $end        = ( ( $this->_page + $links ) < $last ) ? $this->_page + $links : $last;
    echo  '<div class="pagination-container"><ul class="pagination">';
    if ( $this->_page == 1 ){
      $class="li-disabled";
      $tabidx='tabindex=-1';
    }
    else{
      $class=" ";
      $tabidx='tabindex="'.$tab.'"';
      $tab++;
    }
    echo      '<li class="' . $class . '"><a href="?page=' . ( $this->_page - 1 ) .'&tipologia=' . ( $this->_tipo) . '" title="pagina precendente"  '.$tabidx.'  >&laquo;</a></li>';

    if ( $start > 1 ) {
        echo   '<li><a href="?page=1'.'&tipologia=' . ( $this->_tipo) .'" title="pagina 1 degli iscritti alla maratona selezionata" '.$tabidx.'>1</a></li>';
        if($start >2 )echo   '<li class="disabled"><span>...</span></li>';
    }

    for ( $i = $start ; $i <= $end; $i++ ) {
       if( $this->_page == $i ){
         $class="li-active";
         $tabidx='tabindex=-1';
       }
       else{
         $class=" ";
         $tabidx='tabindex="'.$tab.'"';
         $tab++;
       }
       echo '<li class="' . $class . '"><a href="?page=' . $i .'&tipologia=' . ( $this->_tipo) .  '" title="pagina '.$i.' degli iscritti alla maratona selezionata" '.$tabidx.'  >' . $i . '</a></li>';

    }

    if ( $end < $last ) {
        if($end < $last-1)echo '<li class="disabled"><span>...</span></li>';
        echo '<li><a href="?page=' . $last .'&tipologia=' . ( $this->_tipo) .  '" title="pagina '.$last.' degli iscritti alla maratona selezionata" '.$tabidx.' >' . $last . '</a></li>';
    }

    if( $this->_page == $last ){
      $class="li-disabled";
      $tabidx='tabindex=-1';
    }
    else{
      $class=" ";
      $tabidx='tabindex="'.$tab.'"';
      $tab++;
    }
    echo   '<li class="' . $class . '"><a href="?page=' . ( $this->_page + 1 ) .'&tipologia=' . ( $this->_tipo) .  '" title="pagina successiva" '.$tabidx.'">&raquo;</a></li>';
    echo   '</ul>';
    echo '<ul class="pagination">';
    echo'<form method="get" action="gestioneIscritti.php">';
    echo'<input type="hidden"name=tipologia value="'.$this->_tipo.'"></input>';
    echo'<label>Pagina: </label><select name="page" title="Seleziona la pagina a cui passare" tabindex='.$tab.'>';
    $tab++;
    for($i=1;$i<=ceil($this->_total/$this->_limit);$i++){
    echo '<option value="'. $i .'"> '.$i.'</option>';
    }
    echo'</select><input class="btn-black" type=submit value="Vai" id="vaiBtn" title="vai alla pagina selezionata" tabindex='.$tab.'></form>
    </ul>';
    $tab++;
    echo'</div>';
    return $tab++;
  }
}
