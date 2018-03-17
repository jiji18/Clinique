<?php
$bdd='projet';
$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
mysqli_set_charset($idconnect,'UTF8');
if(isset($_POST['modifieremploye'])){
	$_SESSION['idR']=$_POST['idR'];
	$id=$_POST['idR'];
	$employe="SELECT * FROM employe WHERE identifiant='$id'";
	$resultemploye=mysqli_query($idconnect,$employe);
	if(mysqli_num_rows($resultemploye)==0){//si il n'y a pas de resultat
		echo '<script>alert("'.utf8_decode('employé non trouvé!').'")</script>';
	}
	else{//l'employé est unique 
		$rowemploye=mysqli_fetch_row($resultemploye);
		$id=$rowemploye[0];
		$mdp=$rowemploye[1];
		$nom=$rowemploye[2];
		$prenom=$rowemploye[3];
		$type=$rowemploye[4];
		echo '<form method="post" name="modifier">
				<label for="id">identifiant</label>
				<input type="text" name="id" value="'.$id.'" readonly/>
				<br/>
				<label for="nomE">nom:</label>
				<input type="text" name="nom" value="'.$nom.'" onblur="identificateur(document.forms[\'modifier\'])"/>
				<br/>
				<label for="prenomE">prenom:</label>
				<input type="text" name="prenom" value="'.$prenom.'" onblur="identificateur(document.forms[\'modifier\'])"/>
				<br/>
				<label for="mdpE">mot de passe</label>
				<input type="password" name="mdp" placeholder="nouveau mot de passe"/>
				<br/>
				<label for=type>type d\'employé</label>
				<select name="type">
					<option>'.$type.'
				</select>
		';
		if($type=="medecin"){
			$spe=$rowemploye[5];
			echo '<select name="specialite">
					<option>'.$spe.'
				</select>
			';
		}
		echo '<input name="valildermodificationEmploye" type="submit" onclick="identificateur()" value="modifier"/>
			<input name="validersupressionEmploye" type="submit" value="supprimer"/>
			</form>
		';
	}
}
include 'modifierEmploye.php';
include 'suppressionEmploye.php';

if(isset($_POST['ajouteremploye'])){
	echo '<form method="post" name="ajouteremploye">
			<label for="nome">nom:</label>
			<input type="text" name="nom" onblur="identificateur(document.forms[\'ajouteremploye\'])"/>
			<br/>
			<label for="prenomE">prenom</label>
			<input type="text" name="prenom" onblur="identificateur(document.forms[\'ajouteremploye\'])"/>
			<br/>
			<label for="idE">identifiant</label>
			<input type="text" name="id" placeholder="prenom.nom" readonly/>
			<br/>
			<label for="mdpE">mot de passe</label>
			<input type="password" name="mdp" placeholder="mot de passe"/>
			<br/>
			<select name="type" onclick="specialiste(this)">
				<option>medecin</option>
				<option>agent</option>
				<option>directeur</option>
			</select>
			<div id="spe">
				<select name="specialiste">
					<option>autre';
					include 'specialiteRequis.php';
			echo '</select>
				<input name="nouvellespe" type="text" placeholder="ajouter une nouvelle specialite du medecin"/>
			</div>
			<input type="submit" name="validerajoutemploye"/>
		</form>
	';
}
include 'ajouterEmploye.php';
?>