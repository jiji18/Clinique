<?php
	session_start();
	$bdd='projet';
	$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
	mysqli_set_charset($idconnect,'UTF8');
	if(isset($_POST['choix'])){
		 $creneau=$_POST['choix'];
		 $NNS=$_SESSION['patient'];
		 $idM=$_SESSION['idM'];
		 $intervention=$_SESSION['intervention'];
		 $query="INSERT INTO rdv VALUES('$NNS','$idM','$creneau','$intervention','','','')";
		 mysqli_query($idconnect, $query);
		 if($intervention!='Autre'){
			$query="SELECT prix FROM intervention WHERE type='$intervention'";
		 	$result=mysqli_query($idconnect, $query);
		 	$row=mysqli_fetch_row($result);
		 	$prix=$row[0];
		 	$query="UPDATE patient SET dette=dette+'$prix' WHERE NNS='$NNS'";
		 	mysqli_query($idconnect, $query);
		 }
		 $query="SELECT intitule FROM piece WHERE intervention='$intervention'";
		 $result=mysqli_query($idconnect, $query);
		 $piece='';
		 if(mysqli_num_rows($result)!=0){
		 	while($row=mysqli_fetch_row($result)){
		 		if($piece==''){
		 			$piece=utf8_encode($row[0]);
		 		}else{
		 			$piece=$piece.','.utf8_encode($row[0]);
		 		}
		 	}
		 }
		 if($piece=='') echo '<script>alert("'.utf8_decode('Rendez-vous ajouté !\n Aucune pièce à apporter').'")</script>';
		 else echo '<script>alert("'.utf8_decode('Rendez-vous ajouté !\nListe des pièces à apporter et consignes de bases:').utf8_encode($piece).'")</script>';
		 echo '<script>window.location.replace("agent.php")</script>';
		 exit();
	}else{
		echo '<script>alert("Veuillez cocher un créneau horaire !")</script>';
		echo '<script>window.location.replace("planning.php")</script>';
		exit();
	}
	mysqli_close($idconnect);
?>