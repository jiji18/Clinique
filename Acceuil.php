<?php
	session_start();
	
	if(isset($_SESSION['idM']) and isset($_SESSION['patient']) and isset($_SESSION['intervention'])){
		unset($_SESSION['idM']);
		unset($_SESSION['patient']);
		unset($_SESSION['intervention']);
	}
	/*chaque page agent, directeur, ou medecin devra avoir un bouton
	de deconnexion avec comme name deconnecter, pour pouvoir détruire
	sa session comme ci-dessous*/
	if(isset($_POST['deconnecter'])){
		session_destroy();
	}
	if(isset($_POST['connecter'])){
		$bdd='projet';
		$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
		$id=$_POST['id'];
		$pass=$_POST['pass'];
		$query="SELECT identifiant,mdp,nom,prenom,type FROM employe where identifiant='$id'";
		$result=mysqli_query($idconnect,$query);
		if(mysqli_num_rows($result)!=0){
			while($row=mysqli_fetch_row($result)){
				$id=$row[0];
				$mdp=$row[1];
				$nom=$row[2];
				$prenom=$row[3];
				$type=$row[4];
				if($mdp == md5($pass)){
					$_SESSION['id']=$id;
					$_SESSION['nom']=$nom;
					$_SESSION['prenom']=$prenom;
					$_SESSION['type']=$type;
					switch ($type){
						case 'agent':
							header('location: agent.php');
							break;
						case 'medecin':
							header('location: medecin.php');
							break;
						case 'directeur':
							header('location: directeur.php');
							break;
					}
				}else{
					echo'<script>alert("Mot de passe incorrect !");</script>';
				}
			}
		}else{
			echo'<script>alert("Identifiant incorrect !");</script>';
		}
		mysqli_close($idconnect);
	}
?>

<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Acceuil</title>
		<link rel="shortcut icon" type="image/x-icon" href="logo.png"/>
		 <!-- pour ajouter un logo devant le title-->
		<link rel="stylesheet" href="Acceuil.css" />
		<script src="verifSaisie.js"></script>
	</head>
	<body>
		<header>
			<img alt="Acceuil" src="Acceuil.png"/>
		</header>
		<section>
			<form method="post" id="connexion" action="Acceuil.php">
				<fieldset>
				<legend>Authentification</legend>
					<p>
						<input type="text" name="id" id="id" placeholder="Identifiant" onBlur="retablir(this);"/>
					</p>
					<p>
						<input type="password" name="pass" id="pass" placeholder="Mot de passe" onBlur="retablir(this);"/>
					</p>
					<p>
						<input type="submit" id="connecter" name="connecter" value="Se connecter" onClick="vide(document.getElementById('id'));vide(document.getElementById('pass'));"/>
					</p>
				</fieldset>
			</form>
		</section>
	</body>
</html>	