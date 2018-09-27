	<?php ob_start(); ?>
	<?php
		class DBAccess{
			/*
			const host="localhost";
			const utente="grighi";
			const pwd="oT5mahm8ooCh8aph";
			const databasename="grighi";
			*/
			const host         = "localhost";
			const utente       = "root";
			const pwd          = "";
			const databasename = "tecweb";

			public $connessione;

			public function openDBConnection(){

				$this->connessione=mysqli_connect(static::host, static::utente, static::pwd, static::databasename);

				if(!$this->connessione){
					return false;
				}else{
					return true;
				}
			}

			public function setUTF8(){
				mysqli_query($this->connessione,"SET character_set_results=utf8");
			}

			public function configure(){
				$successo=$this->openDBConnection();
				if($successo==false){
					die("Errore apertura connessione database");
				}else{
					$successo=mysqli_select_db($this->connessione,static::databasename);
					if(!$successo){
						die("Errore di selezione del database ". mysqli_error($this->connessione));
					}else{
						$this->setUTF8();
					}
				}
			}

			public function closeConnection(){
				mysqli_close($this->connessione);
			}

			public function takeArticles(){
				$today=date("Y-m-d");
				$query="select ID,Titolo,Immagine,Alt,Testo from articoli where Data<='".$today."'";
				$result=$this->connessione->query($query);
				$righe=mysqli_num_rows($result);
				if($righe==0){
					echo "Nessun articolo presente qui";
				}else{
					$tab=12;
					for($i=0;$i<$righe;$i++){
						$row=mysqli_fetch_row($result);
						echo "<div class='newsArticle rounded-container'>";
						echo "<h1 class='newsTitle' id='h".$row[0]."' tabindex='".$tab."'>".html_entity_decode($row[1])."</h1>"; //inserire indexTab sugli h1
						$tab++;
						//echo "<div class='imgAndCaption'>";
						echo "<div class='imgAndCaption'>";
						echo "<img class='newsImg' src='assets/img/articoli/".html_entity_decode($row[2])."' alt='".html_entity_decode($row[3])."'/>";
						echo "<p class='captionImg'>".html_entity_decode($row[3])."</p>";
						echo "</div>";
							//echo "</div>";
						if(strlen($row[4])<=300){
							echo "<p class='newsArticleDesc' id='paragraph".$i."'>".html_entity_decode($row[4])."</p><br/>";
						}else{
							$daVisualizzare=substr(html_entity_decode($row[4]),0,300);
							echo "<p class='newsArticleDesc' id='paragraph".$i."'>".$daVisualizzare." ...</p><br/>"; ?>
							<span class="otherText" id="article<?php echo $i; ?>"><?php echo html_entity_decode($row[4]); ?></span>

							<a href="articolo.php?id=<?php echo $row[0] ?>" class="linkMostra btn-black" title="Link per mostrare il resto dell'articolo <?php echo $i; ?>" tabindex="<?php echo $tab; ?>">Mostra altro</a>
							<button onclick="mostraTutto(<?php echo $i; ?>)" class="showButton btn-black" id="button<?php echo $i; ?>" title="bottone mostra altro per articolo <?php echo $i; ?>" tabindex="<?php echo $tab; $tab++; ?>">Mostra altro</button>
							<?php
								echo "<script src='assets/js/news.js'></script>";
							}
							echo "</div>";
						}
					}
					$this->closeConnection();
					return $tab;
			}
			public function takeNazionalita(){
					$query="SELECT * FROM nazionalita";
					$result=mysqli_query($this->connessione,$query) ;
					foreach($result as $row){
						if(ISSET($_SESSION['DATA'])&& $row['Nome']==$_SESSION['DATA'][6])
						echo '<option selected value='. $row['Nome'] .'> '.$row['Nome'].'</option>';
						else
						echo'<option value='. $row['Nome'] .'> '.$row['Nome'].'</option>';
					}
					$this->closeConnection();
			}

			public function showArticleTable() {
				$query  = "select ID,Titolo from articoli";
				$result = $this->connessione->query($query);
				$righe  = mysqli_num_rows($result);

				if($righe==0){
					echo "<div class='alert alert-danger'>
							<h3 tabindex='0'>Nessun articolo presente nel database!</h3>
							<a href='pannelloAdmin.php' title='Torna a pannello admin'>Torna a pannello admin</a>
						</div>";
				}else{
					$tab=13;
					echo '<table class="table" summary="Tabella per la gestione degli articoli"><caption tabindex="'.$tab.'">Tabella per la gestione degli articoli</caption><thead><tr><th scope="col">Articolo</th><th colspan="2" scope="colgroup" id="op">Operazioni</th></tr></thead><tbody>';
					$tab++;
					for($i=0;$i<$righe;$i++){
						$row=mysqli_fetch_row($result);
						$title=strip_tags($row[1]);
						echo "<tr>";
						echo "<th scope='row'>".html_entity_decode($title)."</th>";
						echo "<td><a class='btn-black' href='modificaArticolo.php?id=".$row[0]."' title='Modifica articolo' tabindex='".$tab."'>Modifica</a></td>"; //bottone modifica
						$tab++; ?>
						<td><a class='btn-red' href="gestioneArticoli.php?id=<?php echo $row[0]; ?>" title="Elimina articolo" tabindex="<?php echo $tab; ?>">Elimina</a></td>
						<?php
						$tab++;
						echo "</tr>"; //fine riga
					}
					echo "</tbody></table>"; //fine tabella
					//$this->closeConnection(); ********************** pensare a do mettere la chiusura del database **************
					return $tab;
				}
			}

			public function showArticleData($articleId){
				$tab=12;
				$result = $this->doQuery("select Titolo, Immagine, Alt, Testo, Data from articoli where ID=".$articleId.";");
				$row    = mysqli_fetch_row($result);
				echo "<form action='modificaArticolo.php?id=".$articleId."' method='post' id='formModificaArticolo' enctype='multipart/form-data'>";
					echo "<fieldset>";
							echo "<div id='div-field'>";

								echo "<div class='field-group'>";
									echo "<label class='labelField' for='titolo'>Titolo *:</label>";?>
									<input type='text' name='titolo' id='titolo' class='inputField' value="<?php echo $row[0]; ?>" title="Inserire il titolo dell'articolo" tabindex="<?php echo $tab; $tab++; ?>" required />
								<?php
								echo "</div>";

								echo "<div class='field-group'>";
									echo "<label class='labelField' for='immagine'>Immagine *:</label>";
									echo "<input type='file' name='immagine' id='immagine' title='Inserire una immagine per articolo' tabindex='".$tab."' class='inputField'/>"; $tab++;
								echo "</div>";

								echo "<div class='field-group'>";
									echo "<label class='labelField' for='didascalia'>Didascalia *:</label>";?>
									<input type='text' name='didascalia' id='didascalia' class='inputField' value="<?php echo $row[2]; ?>" title="Inserire la didascalia dell'immagine" tabindex="<?php echo $tab; $tab++; ?>" required />
								<?php
								echo "</div>";

								echo "<div class='field-group'>";
									echo "<label class='labelField' for='testo'>Testo *:</label>"; ?>
									<textarea name='testo' id='testo' class='inputArea' title="Inserire il testo dell'articolo" tabindex="<?php echo $tab; $tab++; ?>" required><?php echo html_entity_decode($row[3]); ?></textarea>
									<?php
								echo "</div>";

								$data=strtotime($row[4]);
								$giorno=date('d',$data);
								$mese=date('m',$data);
								$anno=date('Y',$data);

								echo "<div class='field-group'>";
									echo "<label class='labelField' for='data'>Data di pubblicazione *:</label>";
									echo "<select name='giorno' form='formModificaArticolo' class='selectField' id='data' title='Inserire giorno' tabindex='".$tab."'>"; $tab++;
									for($i=1;$i<=31;$i++){
										if($i==$giorno){
											echo "<option value='".$i."' selected='selected'>".$i."</option>";
										}else{
											echo "<option value='".$i."'>".$i."</option>";
										}
									}
									echo "</select>";

									echo "<select name='mese' form='formModificaArticolo' title='Inserire mese' tabindex='".$tab."'>"; $tab++;
									for($i=1;$i<=12;$i++){
										if($i==$mese){
											echo "<option value='".$i."' selected='selected'>".$i."</option>";
										}else{
											echo "<option value='".$i."'>".$i."</option>";
										}
									}
									echo "</select>";
									echo "<select name='anno' form='formModificaArticolo' title='Inserire anno' tabindex='".$tab."'>"; $tab++;
									for($i=1920;$i<=date('Y');$i++){
										if($i==$anno){
											echo "<option value='".$i."' selected='selected'>".$i."</option>";
										}else{
											echo "<option value='".$i."'>".$i."</option>";
										}
									}
									echo "</select>";
								echo "</div>";?>

								<input class="btn-lg btn-black" type="submit" name="submit" id="submit" title="Pulsante di modifica dell'articolo" value="Modifica" tabindex="<?php echo $tab; $tab++; ?>" />

								<?php
							echo "</div>";
					echo "</fieldset>";
				echo "</form>";
				return $tab;
			}

			public function getImgName($articleId){
				$result=$this->doQuery("select immagine from articoli where ID=".$articleId.";");
				$row=mysqli_fetch_row($result);
				return $row[0];
			}

			public function showIscritti($submit){
				$tab=12;
				echo "<div class='formDiv'>";
				echo "<form method='GET' action='gestioneIscritti.php' id='formGestioneIscritti'>";
								echo "<label for='tipo' class='lab'>Gara:</label>";
									echo "<select name='tipo' id='tipo' form='formGestioneIscritti' class='sel' title='Seleziona il tipo di maratona' tabindex='".$tab."' required>";
									  $tab++;
										echo "<option value='' disabled ";
										if($submit=='null')echo "selected";
										echo ">--</option>";
										echo "<option value='iscritti_maratona_uomini'";
										if($submit=="iscritti_maratona_uomini")echo "selected";
										echo ">Iscritti alla maratona degli uomini</option>";
										echo "<option value='iscritti_mezza_maratona_uomini'";
										if($submit=="iscritti_mezza_maratona_uomini")echo "selected";
										echo">Iscritti alla mezza maratona degli uomini</option>";
										echo "<option value='iscritti_maratona_donne'";
										if($submit=="iscritti_maratona_donne")echo "selected";
										echo">Iscritti alla maratona delle donne</option>";
										echo "<option value='iscritti_mezza_maratona_donne'";
										if($submit=="iscritti_mezza_maratona_donne")echo "selected";
										echo">Iscritti alla mezza maratona delle donne</option>";
									echo "</select>";
									echo "<input type='submit' name='submit' id='submitMaratona' class='btn-black' value='Visualizza iscritti' title='Visualizza gli iscritti' tabindex='".$tab."'/>";
							echo "</form>";
							echo "</div>";
					}

	        public function getIscrittoMail($id,$type){
	        	$result=$this->doQuery("select Email from ".$type." where Numero_di_gara=".$id);
	        	$row=mysqli_fetch_row($result);
	        	return $row[0];
	        }

	        public function getTitoloMaratona($maratona){
	        	if($maratona=="iscritti_maratona_uomini"){
	        		return "Gestisci gli uomini iscritti alla maratona";
	        	}
	        	if($maratona=="iscritti_maratona_donne"){
	        		return "Gestisci le donne iscritte alla maratona";
	        	}
	        	if($maratona=="iscritti_mezza_maratona_donne"){
	        		return "Gestisci le donne iscritte alla mezza maratona";
	        	}
	        	if($maratona=="iscritti_mezza_maratona_uomini"){
	        		return "Gestisci gli uomini iscritti alla mezza maratona";
	        	}
	        }

	        public function showMailForm($PersonId,$marathonType){
	        	$tab=11;
	        	echo "<h1 tabindex='".$tab."'>Invia un messaggio a ".$this->getNomeIscritto($PersonId,$marathonType)."</h1>"; $tab++;
	        	echo "<form action='inviaMail.php' method='post' id='formInvioMail'>";
					echo "<fieldset>";
							echo "<div id='div-field'>";
								echo "<div class='field-group'>";
										echo "<label class='labelField' for='testo'>Testo *:</label>"; ?>
										<textarea name='testo' id='testo' class='inputArea' title="Inserire il testo della mail" tabindex="<?php echo $tab; $tab++; ?>" required></textarea>
										<?php
								echo "</div>";


								echo "<input class='btn-lg btn-black' type='submit' name='submit' id='submit' title='Pulsante di invio mail a iscritto' tabindex='".$tab."' value='Invia mail a ".$this->getNomeIscritto($PersonId,$marathonType)."' />"; $tab++;



							echo "</div>";
					echo "</fieldset>";
				echo "</form>";
				return $tab;
	        }

	        public function getNomeIscritto($id,$type){
	        	$result=$this->doQuery("select Nome from ".$type." where Numero_di_gara=".$id);
	        	$row=mysqli_fetch_row($result);
	        	return $row[0];
	        }

			public function showArticleForm(){
				$tab=13;
				echo "<form action='inserimentoArticolo.php' method='post' id='formInserimentoArticolo' enctype='multipart/form-data'>";
					echo "<fieldset>";
							echo "<div id='div-field'>";

								echo "<div class='field-group'>";
									echo "<label class='labelField' for='titolo'>Titolo *:</label>"; ?>
									<input type='text' name='titolo' id='titolo' class='inputField' title="Inserire il titolo dell'articolo" tabindex="<?php echo $tab; ?>" required />
									<?php
									$tab++;
								echo "</div>";

								echo "<div class='field-group'>";
									echo "<label class='labelField' for='immagine'>Immagine *:</label>";
									echo "<input type='file' name='immagine' id='immagine' title='Inserire una immagine' tabindex='".$tab."' class='inputField'/>";
								echo "</div>";
								$tab++;

								echo "<div class='field-group'>";
									echo "<label class='labelField' for='didascalia'>Didascalia *:</label>"; ?>
									<input type='text' name='didascalia' id='didascalia' class='inputField' title="Inserire la didascalia dell'immagine" tabindex="<?php echo $tab; $tab++; ?>" required />
								<?php
								echo "</div>";

								echo "<div class='field-group'>";
									echo "<label class='labelField' for='testo'>Testo *:</label>"; ?>
									<textarea name='testo' id='testo' class='inputArea' title="Inserire il testo dell'articolo" tabindex="<?php echo $tab; $tab++; ?>" required></textarea>
									<?php
								echo "</div>";

								echo "<div class='field-group'>";
									echo "<label class='labelField' for='data'>Data di pubblicazione*:</label>";
									echo "<select name='giorno' form='formInserimentoArticolo' class='selectField' id='data' tabindex='".$tab."' title='Inserire giorno' id='data'>";
									$tab++;
									for($i=1;$i<=31;$i++){
										echo "<option value='".$i."'>".$i."</option>";
									}
									echo "</select>";

									echo "<select name='mese' form='formInserimentoArticolo' tabindex='".$tab."' title='Inserire mese'>";
									$tab++;
									for($i=1;$i<=12;$i++){
										echo "<option value='".$i."'>".$i."</option>";
									}
									echo "</select>";
									echo "<select name='anno' form='formInserimentoArticolo' tabindex='".$tab."' title='Inserire anno'>";
									$tab++;
									for($i=1920;$i<=date('Y');$i++){
										echo "<option value='".$i."'>".$i."</option>";
									}
									echo "</select>";
								echo "</div>"; ?>

								<input class='btn-lg btn-black' type='submit' name='submit' id='submit' title="Bottone per l'inserimento di un nuovo articolo" tabindex="<?php echo $tab; $tab++; ?>" value='Inserisci' />

								<?php
							echo "</div>";
					echo "</fieldset>";
				echo "</form>";
				return $tab;
			}

			public function createUpdateMailForm(){
				$tab=11;
				echo "<form action='updateMail.php' method='post' id='formModificaMail'>";
					echo "<fieldset>";
						echo "<div id='div-field'>";

							echo "<div class='field-group'>";
								echo "<label class='labelField' for='mail1'>Vecchia e-mail *:</label>"; ?>
								<input type='text' name='mail1' id='mail1' class='inputField' title='Inserire un indirizzo e-mail valido' pattern="[a-zA-Z0-9_]+(?:\.[A-Za-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*@(?!([a-zA-Z0-9]*\.[a-zA-Z0-9]*\.[a-zA-Z0-9]*\.))(?:[A-Za-z0-9](?:[a-zA-Z0-9-]*[A-Za-z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?" tabindex="<?php echo $tab; $tab++; ?>" required />
								<?php
							echo "</div>";

							echo "<div class='field-group'>";
								echo "<label class='labelField' for='mail2'>Nuova e-mail *:</label>"; ?>
								<input type='text' name='mail2' id='mail2' class='inputField' title='Inserire un indirizzo e-mail valido' pattern="[a-zA-Z0-9_]+(?:\.[A-Za-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*@(?!([a-zA-Z0-9]*\.[a-zA-Z0-9]*\.[a-zA-Z0-9]*\.))(?:[A-Za-z0-9](?:[a-zA-Z0-9-]*[A-Za-z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?" tabindex="<?php echo $tab; $tab++; ?>" required/>
								<?php
							echo "</div>";

							echo "<div class='field-group'>";
								echo "<label class='labelField' for='mail3'>Ripeti e-mail *:</label>"; ?>
								<input type='text' name='mail3' id='mail3' class='inputField' title='Inserire un indirizzo e-mail valido' pattern="[a-zA-Z0-9_]+(?:\.[A-Za-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*@(?!([a-zA-Z0-9]*\.[a-zA-Z0-9]*\.[a-zA-Z0-9]*\.))(?:[A-Za-z0-9](?:[a-zA-Z0-9-]*[A-Za-z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?" tabindex="<?php echo $tab; $tab++; ?>" required />
								<?php
							echo "</div>";

							echo "<input type='submit' name='submit' id='submit' class='btn-lg btn-black' title='Aggiorna la tua e-mail' value='Aggiorna' tabindex='".$tab."'/>";
						echo "</div>";
					echo "</fieldset>";
				echo "</form>";
				$tab++;
				return $tab;
			}

			public function createUpdatePwdForm(){
				$tab=11;
				echo "<form action='updatePwd.php' method='post' id='formModificaPwd'>";
					echo "<fieldset>";
						echo "<div id='div-field'>";

							echo "<div class='field-group'>";
								echo "<label class='labelField' for='password1'>Vecchia password *:</label>";
								echo "<input type='password' name='password1' id='password1' class='inputField' title='Inserire la vecchia password' tabindex='".$tab."' required />"; $tab++;
							echo "</div>";

							echo "<div class='field-group'>";
								echo "<label class='labelField' for='password2'>Nuova password *:</label>";
								echo "<input type='password' name='password2' id='password2' class='inputField' title='Inserire la nuova password' tabindex='".$tab."' required/>"; $tab++;
							echo "</div>";

							echo "<div class='field-group'>";
								echo "<label class='labelField' for='password3'>Ripeti password *:</label>";
								echo "<input type='password' name='password3' id='password3' class='inputField' title='Ripetere la nuova password' tabindex='".$tab."' required />"; $tab++;
							echo "</div>";

							echo "<input type='submit' name='submit' id='submit' class='btn-lg btn-black' title='Aggiorna la tua password' value='Aggiorna' tabindex='".$tab."'/>"; $tab++;
						echo "</div>";
					echo "</fieldset>";
				echo "</form>";
				return $tab;
			}

			public function createUpdateUsernameForm(){
				$tab=12;
				echo "<form action='updateUsername.php' method='post' id='formModificaUsername'>";
					echo "<fieldset>";
						echo "<div id='div-field'>";

							echo "<div class='field-group'>";
								echo "<label class='labelField' for='user1'>Vecchio username *:</label>";
								echo "<input type='text' name='user1' id='user1' class='inputField' title='Inserire il vecchio username' tabindex='".$tab."'  required />"; $tab++;
							echo "</div>";

							echo "<div class='field-group'>";
								echo "<label class='labelField' for='user2'>Nuovo username *:</label>";
								echo "<input type='text' name='user2' id='user2' class='inputField' title='Inserire il nuovo username' tabindex='".$tab."' required/>"; $tab++;
							echo "</div>";

							echo "<div class='field-group'>";
								echo "<label class='labelField' for='user3'>Ripeti username *:</label>";
								echo "<input type='text' name='user3' id='user3' class='inputField' title='Ripetere il nuovo username' tabindex='".$tab."' required />"; $tab++;
							echo "</div>";

							echo "<input type='submit' name='submit' id='submit' class='btn-lg btn-black' title='Aggiorna il tuo username' tabindex='".$tab."' value='Aggiorna'/>"; $tab++;
						echo "</div>";
					echo "</fieldset>";
				echo "</form>";
				return $tab;
			}

			public function getPwd(){
				$result=$this->doQuery("select password from admin");
				$row=mysqli_fetch_row($result);
				return $row[0];
			}

			public function getMail(){
				$result=$this->doQuery("select mail from admin");
				$row=mysqli_fetch_row($result);
				return $row[0];
			}

			public function getUserId(){
				$result=$this->doQuery("select ID from admin");
				$row=mysqli_fetch_row($result);
				return $row[0];
			}

			public function getUsername(){
				$result=$this->doQuery("select username from admin");
				$row=mysqli_fetch_row($result);
				return $row[0];
			}

			public function getTitle($articleId){
				$result=$this->doQuery("select Titolo from articoli where ID=".$articleId.";");
				$row=mysqli_fetch_row($result);
				return $row[0];
			}

			public function doQuery($query){
				return $this->connessione->query($query);
			}

			public function dateBuild($day, $month, $year){
				$giorno="";
				if($day<10){
					$giorno="0".$day;
				}else{
					$giorno=$day;
				}
				$mese="";
				if($month<10){
					$mese="0".$month;
				}else{
					$mese=$month;
				}
				return $year."-".$mese."-".$giorno;
			}

			public function takeHotel(){
				$query = "SELECT Nome, Via, NumeroCivico, Email, Immagine, Prezzo, Stelle FROM alloggi";
				$result = $this->doQuery($query);
				$rows = mysqli_num_rows($result);
				if($rows == 0){
					echo "Nessun alloggio disponibile";
				}else{
					$tab=13;
					for($i = 0;$i < $rows;$i++){
						$row = mysqli_fetch_row($result);
						echo "<div class='div-alloggio rounded-container'>";
						echo "<h2 tabindex='".$tab."'>".$row[0]."</h2>";
						$tab++;
						echo "<hr />";
						echo "<img class='img-alloggio' src='assets/img/alloggi/$row[4]' alt=\"immagine dell'alloggio $row[0]\" />";
						echo "<ul class='ul-info'>
									<li><strong>Indirizzo:</strong> $row[1], $row[2]</li>
									<li><strong>Email:</strong> $row[3]</li>
									<li><strong>Prezzo (a persona): </strong>".floor($row[5])."€</li>
									<li><strong>Stelle:</strong> $row[6]</li>
								</ul>";
						echo "</div>";
					}
				}
				return $tab;
			}


			public function administrateHotel() {
				$query="SELECT ID,Nome FROM alloggi";
				$result=$this->connessione->query($query);
				$righe=mysqli_num_rows($result);
				if($righe==0){
					echo "<div class='alert alert-danger'>
						<h3 tabindex='0'>Non sono presenti alloggi nel database!</h3>
						<a href='pannelloAdmin.php' title='Torna a pannello admin'>Torna a pannello admin</a>
					</div>";
				}else{
					$tab=13;
					echo '<table id="HotelTable" class="table" summary="Tabella per la gestione degli alloggi"><caption tabindex="'.$tab.'">Tabella per la gestione degli alloggi</caption><thead><tr><th scope="col">Alloggio</th><th colspan="2" scope="colgroup" id="op">Operazioni</th></tr></thead><tbody>';
					$tab++;
					for($i=0; $i<$righe; $i++){
						$row=mysqli_fetch_row($result);
						$nome=strip_tags($row[1]);
						echo "<tr>";
						echo "<th scope='row'>".$nome."</th>";
						echo "<td><a class='btn-black' href='modificaAlloggio.php?id=".$row[0]."' tabindex='".$tab."' title='Modifica alloggio'>Modifica</a></td>"; //bottone modifica
						$tab++;
						echo "<td><a class='btn-red' href='gestioneAlloggi.php?id=".$row[0]."' tabindex='".$tab."' title='Elimina alloggio'>Elimina</a></td>"; //bottone elimina
						$tab++;
						echo "</tr>"; //fine riga
					}
					echo "</tbody></table>"; //fine tabella
					return $tab;
					//$this->closeConnection(); ********************** pensare a do mettere la chiusura del database **************
				}
			}

			public function editAlloggio($IdAlloggio){
				$tab=12;
				$result=$this->doQuery("SELECT Nome, Via, NumeroCivico, Email, Immagine, Prezzo, Stelle FROM alloggi WHERE ID=".$IdAlloggio.";");
				$row=mysqli_fetch_row($result);
				echo "<form action='modificaAlloggio.php?id=".$IdAlloggio."' method='post' id='formModificaAlloggio' enctype='multipart/form-data'>";
					echo "<fieldset>";
						echo "<legend><span>Modifica alloggio</span></legend>";
							echo "<div id='div-field'>";

								echo "<div class='field-group'>";
									echo "<label class='labelField' for='nome'>Nome *:</label>";?>
									<input type='text' name='nome' id='nome' class='inputField' title="Inserisci il nome dell'alloggio" tabindex="<?php echo $tab; $tab++; ?>" value="<?php echo $row[0]; ?>" required />
								<?php
								echo "</div>";

								echo "<div class='field-group'>";
									echo "<label class='labelField' for='via'>Via *:</label>";?>
									<input type='text' name='via' id='via' class='inputField' title="Inserisci la via dell'alloggio" tabindex="<?php echo $tab; $tab++; ?>" value="<?php echo $row[1]; ?>" required />
								<?php
								echo "</div>";

								echo "<div class='field-group'>";
									echo "<label class='labelField' for='numCiv'>Numero civico *:</label>";?>
									<input type='text' name='numCiv' id='numCiv' class='inputField' title="Inserisci il numero civico dell'alloggio" tabindex="<?php echo $tab; $tab++; ?>" value="<?php echo $row[2]; ?>" required />
								<?php
								echo "</div>";

								echo "<div class='field-group'>";
									echo "<label class='labelField' for='email'>Email *:</label>";?>
									<input type='text' name='email' id='email' class='inputField' pattern="[a-zA-Z0-9_]+(?:\.[A-Za-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*@(?!([a-zA-Z0-9]*\.[a-zA-Z0-9]*\.[a-zA-Z0-9]*\.))(?:[A-Za-z0-9](?:[a-zA-Z0-9-]*[A-Za-z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?" title="Inserire un indirizzo e-mail valido" tabindex="<?php echo $tab; $tab++; ?>" value="<?php echo $row[3]; ?>" required />
								<?php
								echo "</div>";

								echo "<div class='field-group'>";
									echo "<label class='labelField' for='immagine'>Immagine:</label>";?>
									<input type='file' name='immagine' id='immagine' title="Inserire un'immagine per l'alloggio" tabindex="<?php echo $tab; $tab++; ?>"  class='inputField' />
								<?php
								echo "</div>";

								echo "<div class='field-group'>";
									echo "<label class='labelField' for='prezzo'>Prezzo *:</label>";?>
									<input type='text' name='prezzo' id='prezzo' class='inputField' title="Inserire il prezzo dell'alloggio" value="<?php echo $row[5]; ?>" tabindex="<?php echo $tab; $tab++; ?>" required />
								<?php
								echo "</div>";

								echo "<div class='field-group'>";
									echo "<label class='labelField' for='stelle'>Stelle *:</label>";?>
									<?php
										echo "<select name='stelle' id='stelle' class='inputField' title='Inserire le stelle dell'alloggio tabindex=".$tab." required size='5'>";
										$tab++;
										for($i=1; $i<6; $i++) {
											if($i==1 && ($i." Stella") == $row[6]) {
												echo "<option value='".$i." Stella' selected='selected'>1 Stella</option>";
											}
											else{
												if(($i." Stelle") == $row[6]) {
													echo "<option value='".$i." Stelle' selected='selected'>".$i." Stelle</option>";
												}
												else{
													if($i == 1) {
														echo "<option value='".$i." Stella'>1 Stella</option>";
													}
													else{
														echo "<option value='".$i." Stelle'>".$i." Stelle</option>";
													}
												}
											}
										}
										echo "</select>";
									?>
								<?php
								echo "</div>";

								echo "<input class='btn-lg btn-black' type='submit' name='submit' id='submit' title='Pulsante di modifica alloggio' tabindex='".$tab."' value='Modifica' />"; $tab++;
							echo "</div>";
					echo "</fieldset>";
				echo "</form>";
				return $tab;
			}

			public function getNome($IdAlloggio){
				$result=$this->doQuery("SELECT Nome FROM alloggi WHERE ID=".$IdAlloggio.";");
				$row=mysqli_fetch_row($result);
				return $row[0];
			}

			public function showMessage() {
        		$result=$this->doQuery("SELECT ID, Email FROM messaggi;");
	        	if($result && mysqli_num_rows($result)>0) {
	        		$tab=12;
        			echo "<table class='messagesTable table' summary='Tabella per la gestione dei messaggi'><caption>Tabella per la gestione dei messaggi</caption><thead>";
	        		echo "<tr><th scope='col'>Numero</th><th scope='col'>Email</th><th colspan='2' scope='colgroup' id='op'>Operazioni</th></tr></thead>";
	        		for($i=0; $i<mysqli_num_rows($result); $i++) {
	        				$row=mysqli_fetch_row($result);
	        				echo "<tr>";
	        				echo "<td>".($i+1)."</td>";
	        				echo "<td>".html_entity_decode($row[1])."</td>";?>
	        				<td><a class='btn-black' href="Rispondi.php?id=<?php echo $row[0]; ?>&mail=<?php echo $row[1]; ?> " title="Invia una mail di risposta" tabindex="<?php echo $tab; $tab++; ?>">Rispondi</a></td>
	        				<td><a class='btn-red' href="gestioneMessaggi.php?id=<?php echo $row[0]; ?>" title="Elimina messaggio" tabindex="<?php echo $tab; $tab++; ?>">Elimina</a></td>
	        				<?php
	        				echo "</tr>";
	        			}
	        		echo "</table>";
	        		return $tab;
	        	}else{
	        		echo "<div class='alert alert-danger'>
						<h3 tabindex='0'>Nessun messaggio</h3>
						<a href='pannelloAdmin.php'>Torna a pannello admin</a>
					</div>";
	        	}
			}

			public function formRisposta($id) {
				$tab=12;
				$result = $this->doQuery("SELECT Nome, Cognome, Messaggio FROM messaggi WHERE ID='".$id."';");
				$row = mysqli_fetch_row($result);
	        	echo "<form action='Rispondi.php' method='post' id='formRisposta' title='Compila il form per rispondere al messaggio'>";
					echo "<fieldset>";
							echo "<div id='div-field'>";

								echo "<div class='field-group'>";
										echo "<label class='labelField' for='nome'>Nome :</label>"; ?>
										<input name='nome' id='nome' class='inputField' title="Nome del mittente del messaggio" tabindex="<?php echo $tab; $tab++; ?>" value="<?php echo $row[0]; ?>" readonly="readonly"/>
										<?php
								echo "</div>";

								echo "<div class='field-group'>";
										echo "<label class='labelField' for='cognome'>Cognome :</label>"; ?>
										<input name='cognome' id='cognome' class='inputField' title="Cognome del mittente del messaggio" tabindex="<?php echo $tab; $tab++; ?>" value="<?php echo $row[1]; ?>" readonly="readonly"/>
										<?php
								echo "</div>";

								echo "<div class='field-group'>";
										echo "<label class='labelField' for='messaggioMittente'>Messaggio originale :</label>"; ?>
										<textarea name='messaggioMittente' id='messaggioMittente' class='inputField' tabindex="<?php echo $tab; $tab++; ?>" title="Messaggio del mittente" readonly="readonly"><?php echo $row[2]; ?></textarea>
										<?php
								echo "</div>";

								echo "<div class='field-group'>";
										echo "<label class='labelField' for='messaggio'>Messaggio *:</label>"; ?>
										<textarea name='messaggio' id='messaggio' class='inputArea' tabindex="<?php echo $tab; $tab++; ?>" title="Inserire messaggio di risposta" placeholder="Inserire messaggio" required></textarea>
										<?php
								echo "</div>";


								echo "<input class='btn-lg btn-black' type='submit' name='submit' id='submit' value='Rispondi' title='Premi per rispondere' tabindex='".$tab."' />"; $tab++;



							echo "</div>";
					echo "</fieldset>";
				echo "</form>";
				return $tab;
			}

			public function codiceFiscale($cf){
			   if($cf=='') return false;
				 if(strlen($cf)!= 16) return false;
				 $cf=strtoupper($cf);
			   if(!preg_match("/[A-Z0-9]+$/", $cf))return false;
			   $s = 0;
			   for($i=1; $i<=13; $i+=2){
				 		$c=$cf[$i];
				 		if('0'<=$c and $c<='9')
				     	$s+=ord($c)-ord('0');
				 		else
				    	$s+=ord($c)-ord('A');
			   }
				 for($i=0; $i<=14; $i+=2){
					 $c=$cf[$i];
					 switch($c){
			       case '0':  $s += 1;  break;
				     case '1':  $s += 0;  break;
			       case '2':  $s += 5;  break;
				     case '3':  $s += 7;  break;
				     case '4':  $s += 9;  break;
				     case '5':  $s += 13;  break;
				     case '6':  $s += 15;  break;
				     case '7':  $s += 17;  break;
				     case '8':  $s += 19;  break;
				     case '9':  $s += 21;  break;
				     case 'A':  $s += 1;  break;
				     case 'B':  $s += 0;  break;
				     case 'C':  $s += 5;  break;
				     case 'D':  $s += 7;  break;
				     case 'E':  $s += 9;  break;
				     case 'F':  $s += 13;  break;
				     case 'G':  $s += 15;  break;
				     case 'H':  $s += 17;  break;
				     case 'I':  $s += 19;  break;
				     case 'J':  $s += 21;  break;
				     case 'K':  $s += 2;  break;
				     case 'L':  $s += 4;  break;
				     case 'M':  $s += 18;  break;
				     case 'N':  $s += 20;  break;
				     case 'O':  $s += 11;  break;
				     case 'P':  $s += 3;  break;
			       case 'Q':  $s += 6;  break;
				     case 'R':  $s += 8;  break;
				     case 'S':  $s += 12;  break;
				     case 'T':  $s += 14;  break;
				     case 'U':  $s += 16;  break;
				     case 'V':  $s += 10;  break;
				     case 'W':  $s += 22;  break;
				     case 'X':  $s += 25;  break;
				     case 'Y':  $s += 24;  break;
				     case 'Z':  $s += 23;  break;
					 }
				 }
			   if( chr($s%26+ord('A'))!=$cf[15] )return false;
 				return true;
			}
		}
	?>
