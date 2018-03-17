<?php
	if(isset($_POST['validermodificationIntervention'])){
		$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
		mysqli_set_charset($idconnect,'UTF8');
		$bdd='projet';
		$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
		
		mysqli_set_charset($idconnect,'UTF8');
		$type=$_POST['type'];
		$prix=$_POST['prix'];
		$duree=$_POST['duree'];
		$spec=$_POST['specialite'];
		
		$miseajour="UPDATE intervention SET prix='$prix', duree='$duree' WHERE type='$type'";
		$test="UPDATE intervention SET prix=$prix,duree='$duree' WHERE type='$type'";
		mysqli_query($idconnect,$test);
		echo '<script>alert("'.utf8_decode('l\intervention a ete modifié').'")</script>';
			
		mysqli_close($idconnect);
	}
?>