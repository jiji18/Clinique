<?php
	if(isset($_POST['validermodificationpiece'])){
		$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
		mysqli_set_charset($idconnect,'UTF8');
		$bdd='projet';
		$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
		echo 'c--------';
		mysqli_set_charset($idconnect,'UTF8');
		$type=$_POST['type'];
		$intervention=$_POST['intervention'];
		
		
		$miseajour="UPDATE piece SET intervention='$intervention' WHERE intitule='$type'";
		mysqli_query($idconnect,$miseajour);
		echo '<script>alert("'.utf8_decode('la piece a ete modifiée').'")</script>';
			
		mysqli_close($idconnect);
	}
?>