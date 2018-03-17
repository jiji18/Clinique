<?php
	session_start();
	if(!isset($_SESSION['id']) or $_SESSION['type']!='agent'){
		header('location:Acceuil.php');
		exit();
	}
	if(isset($_SESSION['idM']) and isset($_SESSION['patient']) and isset($_SESSION['intervention'])){
		unset($_SESSION['idM']);
		unset($_SESSION['patient']);
		unset($_SESSION['intervention']);
	}
?>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Agent</title>
		<link rel="shortcut icon" type="image/x-icon" href="logo.png"/>
		 <!-- pour ajouter un logo devant le title-->
		<link rel="stylesheet" href="agent.css" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  		<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  		<script>
  		$(function() {
  			$( ".datepicker" ).datepicker({
  			altField: ".datepicker",
  			closeText: 'Fermer',
  			prevText: 'Précédent'.decode,
  			nextText: 'Suivant',
  			currentText: 'Aujourd\'hui',
  			monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
  			monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
  			dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
  			dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
  			dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
  			weekHeader: 'Sem.',
  			dateFormat: 'yy-mm-dd'
  			});
  		});
  		</script>
		<script src="verifSaisie.js"></script>
	</head>
	<body>
		<header>
			<div id="logo">
				<img alt="Acceuil" src="Acceuil.png"/>
			</div>
			<form method="post" id="deconnexion" action="Acceuil.php">
				<?php 
					echo'<p id="texte">
							Bienvenue '.$_SESSION['nom'].' '.$_SESSION['prenom'].'
						</p>';
				?>
				<p>
					<input type="submit" id="deconnecter" name="deconnecter" value="Se déconnecter"/>
				</p>
			</form>
		</header>
		<section>
			<div id="gestion">
				<form method="post" id="synthese">
					<p>
						<input type="text" name="nns" id="nns" placeholder="num sécu" onBlur="retablir(this);"/>
					</p>
					<p>
						<input type="submit" id="synthesePatient" name="synthesePatient" value="Synthèse patient" onClick="nnsIncorrect(document.getElementById('nns'));"/>
					</p>
				</form>
				<form method="post" id="rechercher">
						<p>
							<input type="text" name="nom" id="nom" placeholder="nom" onBlur="retablir(this);"/>
						</p>
						<p>
							<input type="text" name="naissance" class="datepicker" placeholder="Date de naissance" onBlur="retablir(this);"/>
						</p>
						<p>
							<input type="submit" id="rechercherPatient" name="rechercherPatient" value="Rechercher patient" onClick="vide(document.getElementById('nom'));"/>
						</p>
				</form>
				<form method="post" id="ajouter">
					<p>
						<input type="submit" id="ajouterPatient" name="ajouterPatient" value="Ajouter patient"/>
					</p>
				</form>
				<form method="post" id="rdv">
					<p>
						<input type="submit" id="ajouterRdv" name="ajouterRdv" value="Rendez-vous"/>
					</p>
				</form>
			</div>
			<div id="resultat"><?php include 'gestionPatient.php'; ?></div>
		</section>
	</body>
</html>			