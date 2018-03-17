<?php
	$bdd='projet';
	$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
	mysqli_set_charset($idconnect,'UTF8');
	$NNS=$_POST['nns'];$nom=$_POST['nom'];$prenom=$_POST['prenom'];$ddn=$_POST['ddn'];
	$adresse=$_POST['adresse'];$num=$_POST['num'];$mail=$_POST['mail'];$profession=$_POST['profession'];
	$situation=$_POST['situation'];$solde=$_POST['solde'];
	$query="SELECT NNS FROM patient where NNS='$NNS'";
	$result=mysqli_query($idconnect,$query);
	if(mysqli_num_rows($result)==0){
		$query="INSERT INTO patient VALUES('$NNS','$nom','$prenom','$ddn','$adresse','$num','$mail','$profession','$situation','$solde',0)";
		mysqli_query($idconnect,$query);
		echo '<script>alert("'.utf8_decode('Ajout réussi !').'")</script>';
	}else{
		echo '<script>alert("'.utf8_decode('Numéro de sécurité sociale déjà existant').'")</script>';
	}
	echo '<script>window.location.replace("agent.php")</script>';
	mysqli_close($idconnect);
?>