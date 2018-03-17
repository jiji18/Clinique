<?php
$bdd='projet';
$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
$type;

if(isset($_POST['modifierpiece'])){
	global $type;
	$type=$_POST['intitulepiece'];
	$piece="SELECT * FROM piece WHERE intitule='$type'";
	$resultpiece=mysqli_query($idconnect,$piece);
	if(mysqli_num_rows($resultpiece)==0){//si il n'y a pas de resultat
		//formulaire d'ajout d'un piece
		echo '<script>alert("'.utf8_decode('piece inexistante dans la base veuillez la creer!').'")</script>';
		mysqli_close($idconnect);
		echo '<form method="post" name="ajouter">
				<label for="type">type:</label>
				<input type="text" name="type" placeholder="intitulé de la piece" value="'.$type.'"/>
				<br/>
				<select name="intervention">';
						include 'InterventionDemandee.php';
				echo '</select>
				<br/>
				<input name="validerajoutpiece" type="submit" value="ajouter"/>
			</form>
			';
			//$query="SELECT * FROM specialite WHERE type=''";
					//$result=!mysqli_query($idconnect,$query);
					//while($row=mysqli_fetch_row($result)){
					//	echo '<option>row[0]';
					//}
		}
	else{
		$rowpiece=mysqli_fetch_row($resultpiece);
		$type=$rowpiece[1];
		$intervention=$rowpiece[0];
		include 'modifierpieces.php';
		echo '<form method="post" name="modifier">
				<label for="id">type</label>
				<input type="text" name="type" value="'.$type.'" readonly/>
				<br/>
				<label for="intervention">intervention</label>
				<select name="intervention">';
					include 'interventionDemandee.php';
		echo '</select>
				<br/>
				<input name="validermodificationpiece" type="submit" value="modifier"/>
				<input name="validerSuppressionpiece" type="submit" value="supprimer"/>
			</form>
		';
	}	
}
include 'suppressionPiece.php';
include 'modifierpieces.php';
include 'ajouterpiece.php'
?>