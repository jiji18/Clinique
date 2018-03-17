<?php
$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
	if(isset($_POST['valildermodificationEmploye'])){
		$bdd='projet';
		$idR=$_SESSION['idR'];
		$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
		mysqli_set_charset($idconnect,'UTF8');
		$id=$_POST['id'];
		echo $id.'-'.$idR;
		$nom=$_POST['nom'];
		$prenom=$_POST['prenom'];
		$mdp=md5($_POST['mdp']);
		$type=$_POST['type'];
		$specialite="";
		if($type=="medecin"){
			$specialite=$_POST['specialite'];
		}
		echo $specialite;
		if($id!=$idR){
			echo $idR.'  lgodug'.$id;
			$suppression="DELETE FROM employe WHERE identifiant='$idR'";
			if($mdp==""){
				echo 'if';
				$ancienmdp="SELECT mdp FROM employe WHERE $identifiant='$id'";
				$row=mysqli_fetch_rows;
				$mdpa=$mdp[0];
				$creation="INSERT INTO employe (identifiant,mdp,nom,prenom,type,specialite) VALUES ('$id','$mdpA','$nom,'$prenom','$type','$specialite')";
			}
			else{
				$creation="INSERT INTO employe (identifiant,mdp,nom,prenom,type,specialite) VALUES ('$id','$mdp','$nom','$prenom','$type', '$specialite')";
			}
			$existe="SELECT * FROM employe WHERE identifiant='$id'";
			$resultexiste=mysqli_query($idconnect,$existe);
			if(mysqli_num_rows($resultexiste)){
				echo '<script>alert("'.utf8_decode('employe deja existant').'")</script>';
			}
			else{
				mysqli_query($idconnect,$suppression);
				mysqli_query($idconnect,$creation);
				echo '<script>alert("'.utf8_decode('modification effectuée!').'")</script>';
			}
		}
		else{
			echo $id;
			if($mdp==""){
				echo 'vide';
				$miseajour="UPDATE employe SET nom='$nom', prenom='$prenom' WHERE identifiant='$id'";
			}else{
				echo 'rempli';
				$miseajour="UPDATE employe SET nom='$nom', prenom='$prenom' mdp='$mdp', WHERE identifiant='$id'";
			}
			mysqli_query($idconnect,$miseajour);
			echo '<script>alert("'.utf8_decode('modification effectuée!').'")</script>';
		}
		//echo '<script>window.location.replace("directeur.php")</script>';
		mysqli_close($idconnect);
	}
?>