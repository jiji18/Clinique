<?php
	$bdd='projet';
	$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
	
	if(isset($_POST['synthesePatient'])){
		$nns=$_POST['nns'];
		$query="SELECT * FROM patient  where NNS='$nns'";
		$result=mysqli_query($idconnect,$query);
		if(mysqli_num_rows($result)!=0){
			$row=mysqli_fetch_row($result);
			echo '<form method="post" id="afficherSynthese" action="actionSynthese.php">
						<fieldset>
							<legend>Synthèse du patient</legend>
							<p>
								<label>Numéro de sécurité social : </label>
								<input type="text" name="nnsRequis" value="'.$row[0].'" readonly="readonly"/>
						    </p>
						    <p>
								<label>Nom : </label>
								<input type="text" value="'.utf8_encode($row[1]).'" readonly="readonly"/>
						    </p>
						    <p>
								<label>Prénom : </label>
								<input type="text" value="'.utf8_encode($row[2]).'" readonly="readonly"/>
						    </p>
						    <p>
								<label>Date de naissance : </label>
								<input type="text" value="'.$row[3].'" readonly="readonly"/>
						    </p>
						    <p>
								<label>Adresse : </label>
								<input type="text" name="modifierAdresse" value="'.utf8_encode($row[4]).'"/>
						    </p>
						    <p>
								<label>Numéro de téléphone : </label>
								<input type="text" name="modifierNumero" value="'.$row[5].'"/>
						    </p>
						    <p>
								<label>e-mail : </label>
								<input type="text" name="modifierMail" value="'.utf8_encode($row[6]).'"/>
						    </p>
						    <p>
								<label>Profession : </label>
								<select name="modifierProfession">
									<option '; if(utf8_encode($row[7])=='Salarié(e)') echo 'selected="selected"';echo '>Salarié(e)</option>
									<option '; if(utf8_encode($row[7])=='Etudiant(e)') echo 'selected="selected"';echo '>Etudiant(e)</option>
									<option '; if(utf8_encode($row[7])=='Sans emplois') echo 'selected="selected"';echo '>Sans emplois</option>
									<option '; if(utf8_encode($row[7])=='Retraité(e)') echo 'selected="selected"';echo '>Retraité(e)</option>
								</select>
						    </p>
						    <p>
								<label>Situation : </label>
								<select name="modifierSituation">
									<option '; if(utf8_encode($row[8])=='Marié(e)') echo 'selected="selected"';echo '>Marié(e)</option>
									<option '; if(utf8_encode($row[8])=='Célibataire') echo 'selected="selected"';echo '>Célibataire</option>
									<option '; if(utf8_encode($row[8])=='Divrocé(e)') echo 'selected="selected"';echo '>Divrocé(e)</option>
									<option '; if(utf8_encode($row[8])=='Veuf/Veuve') echo 'selected="selected"';echo '>Veuf/Veuve</option>
								</select>
						    </p>
						    <p>
								<label>Solde : </label>
								<input type="text" name="modifierSolde" value="'.$row[9].'"/>€
							</p>
							<p>
								<label class="form_label_nostyle">&nbsp;</label><input type="submit" name="modifierPatient" value="modifier"/>
							</p>			
									
						</fieldset>
					    <fieldset>
							<legend>Voir les consultations et actes éffectués</legend>';
			$query="SELECT date,intervention,motif FROM rdv where NNS='$nns'";
			$result=mysqli_query($idconnect,$query);
			if(mysqli_num_rows($result)!=0){
				while($row=mysqli_fetch_row($result)){
					$date=new DateTime($row[0]);
					$y=$date->format('Y');
					$m=$date->format('n');
					$d=$date->format('j');
					$h=$date->format('H');
					$mktime=mktime($h,0,0,$m,$d,$y);
					echo '<p><input type="text" value="'.utf8_encode($row[1]).' '.date('\l\e d\/m\/Y \à H:i',$mktime).'" readonly="readonly"/></p>';
				}
			}
			echo '</fieldset><fieldset><legend>Montant restant à payer</legend>';
			$query="SELECT dette FROM patient WHERE NNS='$nns'";
			$result=mysqli_query($idconnect,$query);
			if(mysqli_num_rows($result)!=0){
				$row=mysqli_fetch_row($result);
				echo '<p><input type="text" name="dette" value="'.$row[0].'"/> €</p>';
			}
			echo '<p>
					<label class="form_label_nostyle">&nbsp;</label><input type="submit" name="payerRdv" value="règler le paiement"/>
				</p>';
			
			echo '</fieldset><fieldset><legend>Historique du solde de compte</legend>';
			$query="SELECT date,solde FROM paiement WHERE NNS='$nns'";
			$result=mysqli_query($idconnect,$query);
			if(mysqli_num_rows($result)!=0){
				while($row=mysqli_fetch_row($result)){
					$date2=new DateTime($row[0]);
					$y=$date2->format('Y');
					$m=$date2->format('n');
					$d=$date2->format('j');
					$h=$date2->format('H');
					$i=$date2->format('i');
					$mktime=mktime($h,$i,0,$m,$d,$y);
					echo '<p><input type="text" value="'.$row[1].' € '.date('\l\e d\/m\/Y \à H:i',$mktime).'" readonly/></p>';
				}
			}
			echo '</fieldset></form>';
		}else{
			echo '<script>alert("Numéro de sécurité social incorrect !");</script>';
		}
	}
	
	if(isset($_POST['rechercherPatient'])){
		$nom=$_POST['nom'];
		$ddn=$_POST['naissance'];
		$query="SELECT NNS FROM patient where nom='$nom' and ddn='$ddn'";
		$result=mysqli_query($idconnect,$query);
		if(mysqli_num_rows($result)!=0){
			echo '<form method="post" id="rechercherPatient">
						<fieldset>
						<legend>Numéro de sécurité social trouvés</legend>
							<p>';
			while($row=mysqli_fetch_row($result)){
				echo 		'<input type="text" value="'.$row[0].'" readonly="readonly"/>';
			}
			echo       '</p>
						</fildset>
					</form>';
		}else{
			echo '<script>alert("Nom et/ou date de naissance incorrect !");</script>';
		}
	}
	
	if(isset($_POST['ajouterPatient'])){
		echo
		'<form method="post" id="ajouterPatient" action="ajouterPatient.php">
		 	<fieldset>
				<legend>Nouveau Client</legend>
				<p>
					<label class="form_label_nostyle">&nbsp;</label><input type="text" name="nns" id="nns" placeholder="num secu" onBlur="nnsIncorrect(this)" required/>
				</p>
				<p>
					<label class="form_label_nostyle">&nbsp;</label><input type="text" name="nom" id="nom" placeholder="nom" onBlur="vide(this)" required/>
				</p>
				<p>
					<label class="form_label_nostyle">&nbsp;</label><input type="text" name="prenom" id="prenom" placeholder="prénom" onBlur="vide(this)" required/>
				</p>
				<p>
					<label class="form_label_nostyle">né(e) le </label><input type="text" name="ddn" class="datepicker" onBlur="vide(this)" required/>
				</p>
				<p>
					<label class="form_label_nostyle">&nbsp;</label><input type="text" name="adresse" id="adresse" placeholder="adresse" onBlur="vide(this)" required/>
				</p>
				<p>
					<label class="form_label_nostyle">&nbsp;</label><input type="tel" name="num" id="num" placeholder="num tel" onBlur="telIncorrect(this)" required/>
				</p>
				<p>
					<label class="form_label_nostyle">&nbsp;</label><input type="email" name="mail" id="mail" placeholder="e-mail"/>
				</p>
				<p>
					<label class="form_label_nostyle" >Profession :</label>
					<select name="profession">
						<option>Salarié(e)</option>
						<option>Etudiant(e)</option>
						<option>Sans emplois</option>
						<option>Retraité(e)</option>
					</select>
				</p>
				<p>
					<label class="form_label_nostyle" >Situation :</label>
					<select name="situation">
						<option>Marié(e)</option>
						<option>Célibataire</option>
						<option>Divrocé(e)</option>
						<option>Veuf/Veuve</option>
					</select>
				</p>
				<p>
					<label class="form_label_nostyle">&nbsp;</label><input type="text" name="solde" id="solde" placeholder="solde" onBlur="soldeInCorrect(this)" required/>€
				</p>
				<p>
					<label class="form_label_nostyle">&nbsp;</label><input type="submit" id="ajouter" name="ajouter" value="Ajouter"/>
				</p>
			</fieldset>	
		 </form>';
	}
	
	if(isset($_POST['ajouterRdv'])){
		echo '<form method="post" id="ajouterRdv" name="ajouterRdv" action="planning.php">
				<fieldset>
					<legend>Prendre rendez-vous</legend>
				<p>
					<label for="patient">Numéro de secu  : </label><select name="patient"><option></option>';
		$result=mysqli_query($idconnect, "SELECT NNS FROM patient");
		if(mysqli_num_rows($result)!=0){
			while($row=mysqli_fetch_row($result)){
				echo '<option value="'.$row[0].'">'.$row[0].'</option>';
			}	
		}
		echo '</select></p><p><label for="medecin">Medecins : </label>
					<select name="medecin"><option></option>';
		$query="SELECT type FROM specialistes";
		$result=mysqli_query($idconnect, $query);
		if(mysqli_num_rows($result)!=0){
			while($row=mysqli_fetch_row($result)){
				echo '<optgroup label="'.utf8_encode($row[0]).'">';
				$query="SELECT identifiant,nom,prenom FROM employe WHERE specialite='$row[0]'";
				$result2=mysqli_query($idconnect, $query);
				while($row2=mysqli_fetch_row($result2)){
					echo '<option value="'.utf8_encode($row2[0]).'"> Dr '.utf8_encode($row2[1]).' '.utf8_encode($row2[2]).'</option>';
				}
				echo '</optgroug>';
			}
		}
		echo '</select></p>
				<p><label for="intervention">Intervention  : </label><select name="intervention"><option value=""></option>';
		$query="SELECT type FROM intervention";
		$result=mysqli_query($idconnect,$query);
		if(mysqli_num_rows($result)!=0){
			while($row=mysqli_fetch_row($result)){
				echo '<option value="'.utf8_encode($row[0]).'">'.utf8_encode($row[0]).'</option>';
			}
		}
		echo '<option value="Autre">Autre</option></select></select></p>';
		echo'<p><label class="form_label_nostyle">&nbsp;</label><input type="submit" value="Afficher"/></p>
				</fieldset>
			</form>';
	}
	mysqli_close($idconnect);
?>