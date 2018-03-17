<?php
	$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
	mysqli_set_charset($idconnect,'UTF8');
	if(isset($_POST['validerajoutemploye'])){
		$nom=$_POST['nom'];
		$prenom=$_POST['prenom'];
		$id=$_POST['id'];
		$type=$_POST['type'];
		$mdp=md5($_POST['mdp']);
		$specialite;
		$existe="SELECT * FROM employe WHERE identifiant='".$id."'";
		$result=mysqli_query($idconnect,$existe);
		
		if(mysqli_num_rows($result)==0){//on verifie l'unicité de l'identifiant
			if($type=="medecin"){//on associe un medecin avec un attribut specialité
				if($_POST['specialiste']="autre"){
					$specialite=$_POST['nouvellespe'];
					$inexistant="SELECT * FROM specialistes WHERE type='$specialite'";
					$resultinexistant=mysqli_query($idconnect,$inexistant);
					if(mysqli_num_rows($resultinexistant)==0){
						$nouveauspecialiste="INSERT INTO specialistes(type) VALUES ('$specialite')";
						mysqli_query($idconnect,$nouveauspecialiste);
					}
				}
				else{
					$specialite=$_POST['specialiste'];
				}
				$query="INSERT INTO employe (identifiant, mdp, nom, prenom, type, specialite) VALUES ('$id', '$mdp', '$nom', '$prenom', '$type', '$specialite')";
			}else{//sinon on laisse cette attribut vide
				$query="INSERT INTO employe (identifiant, mdp, nom, prenom, type, specialite) VALUES ('$id', '$mdp', '$nom', '$prenom', '$type', '')";
				echo '<script>alert("'.utf8_decode('l\'ajout a bien ete ajouté!').'")</script>';
			}
			mysqli_query($idconnect, $query);
		}else{//si l'id est deja present dans la base de donnée
			echo '<script>alert("'.utf8_decode('employe deja existant dans la base').'")</script>';
		}
		//mysli_close($idconnect);
	}

?>