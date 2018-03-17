<?php
	if(isset($_POST['validerajoutpiece'])){
		mysqli_set_charset($idconnect,'UTF8');
		$type=$_POST['type'];
		$intervention=$_POST['intervention'];
		$ajout="INSERT INTO piece (intitule,intervention) VALUES ('$type','$intervention')";
		$resultajout=mysqli_query($idconnect,$ajout);
		$existe="SElECT * FROM piece WHERE intitule='$type' AND intervention='$intervention'";
		$resultexiste=mysqli_query($idconnect,$existe);
		
		if(mysqli_num_rows($resultexiste)==0){
			mysqli_query($idconnect,$ajout);
			echo '<script>alert("'.utf8_decode('la pieces a bien ete ajout�').'")</script>';
		}
		else{
			echo '<script>alert("'.utf8_decode('piece deja existante pour cette intervention').'")</script>';
		}
	}
?>