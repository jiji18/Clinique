<?php
	if(isset($_POST['validerajoutintervention'])){
		mysqli_set_charset($idconnect,'UTF8');
		$type=$_POST['type'];
		$duree=$_POST['duree'];
		$prix=$_POST['prix'];
		$spec=$_POST['specialiteRe'];
		$ajout="INSERT INTO intervention (type,prix,duree,specialiteRequis) VALUES ('$type','$prix','$duree','$spec')";
		$resultajout=mysqli_query($idconnect,$ajout);
		$existe="SElECT * FROM intervention WHERE type='$type'";
		$resultexiste=mysqli_query($idconnect,$existe);
		
		if(mysqli_num_rows($resultexiste)==0){
			echo $type.' '.$spec;
			mysqli_query($idconnect,$ajout);
			echo '<script>alert("'.utf8_decode('l\'intervention a bien ete ajouté').'")</script>';
		}
		else{
			echo '<script>alert("'.utf8_decode('intervention deja existante dans la base').'")</script>';
		}
	}
?>