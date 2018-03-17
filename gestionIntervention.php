<?php
$bdd='projet';
$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
$type;

if(isset($_POST['modifierintervention'])){
	global $type;
	$type=$_POST['typeintervention'];
	$intervention="SELECT * FROM intervention WHERE type='$type'";
	$resultintervention=mysqli_query($idconnect,$intervention);
	if(mysqli_num_rows($resultintervention)==0){//si il n'y a pas de resultat
		//formulaire d'ajout d'un intervention
		echo '<script>alert("'.utf8_decode('intervention inexistante dans la base veuillez la creer!').'")</script>';
		mysqli_close($idconnect);
		echo '<form method="post" name="ajouter">
				<label for="type">type:</label>
				<input type="text" name="type" placeholder="intitulé de l\'intervention" value="'.$type.'"/>
				<br/>
				<label for="prix">prix:</label>
				<input type="text" name="prix" onblur="estUnNombre(this)"/>
				<br/>
				<label for="duree">duree:</label>
				<select name="duree">
					<option>15
					<option>20
					<option>30
					<option>40
					<option>50
					<option>60
				</select> min
				<label for="specialiteRequis">specialite requise</label>
				<select name="specialiteRe">';
			include 'specialiteRequis.php';
			echo'</select>
				<input name="validerajoutintervention" type="submit" value="ajouter"/>
			</form>
			';
			//$query="SELECT * FROM specialite WHERE type=''";
					//$result=!mysqli_query($idconnect,$query);
					//while($row=mysqli_fetch_row($result)){
					//	echo '<option>row[0]';
					//}
		}
	else{
		$rowintervention=mysqli_fetch_row($resultintervention);
		$type=$rowintervention[0];
		$prix=$rowintervention[1];
		$duree=$rowintervention[2];
		$specialite=$rowintervention[3];
		include 'modifierIntervention.php';
		echo '<form method="post" name="modifier">
				<label for="id">type</label>
				<input type="text" name="type" value="'.$type.'" readonly/>
				<br/>
				<label for="nomE">prix:</label>
				<input type="text" name="prix" value="'.$prix.'"/>
				<br/>
				<label for="prenomE">duree:</label>
				<select name="duree">
					<optgroup label="duree actuelle">
						<option selected>'.$duree.'</option>
					</optgroup>
					<optgroup label="duree possible">
						<option>1
						<option>2
						<option>3
						<option>4
						<option>5
						<option>6
						<option>7
						<option>8
						<option>9
						<option>10
						<option>11+
					</optgroup>
				</select>
				<br/>
				<label for="specialiteR">specialité requise</label>
				<select name="specialite">';
					include 'specialiteRequis.php';
		echo '</select>
				<br/>
				<input name="validermodificationIntervention" type="submit" value="modifier"/>
				<input name="validersuppressionIntervention" type="submit" value="supprimer"/>
			</form>
		';
	}	
}
include 'suppressionIntervention.php';
include 'modifierIntervention.php';
include 'ajouterIntervention.php';
?>