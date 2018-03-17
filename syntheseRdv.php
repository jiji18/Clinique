<?php
	$bdd='projet';
	$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
	$nom=$_SESSION['nom'];
	$prenom=$_SESSION['prenom'];
	$ddn=$_SESSION['ddn'];
	$situation=$_SESSION['situation'];
	echo '<form method="post" name="synthese">
			<label for="nom">nom:</label>
			<input type="text" value="'.utf8_encode($nom).'" readonly/><br/>
			<label for="prenom">prenom</label>
			<input type="text" value="'.utf8_encode($prenom).'" readonly/><br/>
			<label for="ddn">date de naissance</label>
			<input type="text" value="'.utf8_encode($ddn).'" readonly/><br/>
			<label for="situation">situation:</label>
			<input type="text" value="'.utf8_encode($situation).'" readonly/><br/>
			<label for="nom">numero:</label>
			<input type="text" value="'.utf8_encode($_SESSION['numero']).'" readonly/><br/>
			<label for="nom">mail:</label>
			<input type="text" value="'.utf8_encode($_SESSION['mail']).'" readonly/><br/>
			<label for="nom">profession</label>
			<input type="text" value="'.utf8_encode($_SESSION['profession']).'" readonly/><br/>
			<label for="nom">situation:</label>
			<input type="text" value="'.utf8_encode($_SESSION['situation']).'" readonly/><br/>
			<label for="nom">solde:</label>
			<input type="text" value="'.utf8_encode($_SESSION['solde']).'" readonly/>
			<input type="submit" name="consultation" value="consulter"/>
			<br/>
		</form>
	';
?>

