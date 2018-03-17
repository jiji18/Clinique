<?php
	session_start();
	if(!isset($_SESSION['id']) or $_SESSION['type']!='directeur'){
		header('location:Acceuil.php');
		exit();
	}
?>

<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Directeur</title>
		<link rel="shortcut icon" type="image/x-icon" href="logo.png"/>
		<link rel="stylesheet"  href="directeur.css" />
		<script src="fonctiondirecteur.js"></script>
		<!--copier coller de agent  -->
		
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
		<fieldset>
		<!--le directeur peut ajouter ou modifier du employe-->
			<legend>Gestion du employe</legend>
			<div id="modification">
				<form method="post" name="rechercher">
					<label for="rechercheemploye">pour modifier les informations du employe:</label>
					<br/>
					<input type="text" name="idR" placeholder="prenom.nom" />
					<input type="submit" name="modifieremploye" value="modifier" class="boutton" onclick="identifiant(this)"/>
				</form>
			</div>
			<div id="ajout">
				<form method="post" name="ajouter">
					<label for="ajoutemploye">pour ajouter un employé</label>
					<br/>
					<input type="submit" name="ajouteremploye" value="ajouter" class="boutton" />
				</form>
			</div>
			<div id="modifierajouter">
				<?php include 'gestionEmploye.php'; ?>
			</div>
		</fieldset>
		<fieldset>
			<legend>gestion des interventions</legend>
			<div id="modifierintervention">
			<form method="post" name="intervention" >
				<label for="interventions">pour rechercher ou ajouter une intervention</label>
				<br/>
				<input type="text" name="typeintervention" placeholder="intervention"/>
				<input type="submit" name="modifierintervention" value="rechercher" class="boutton"/>
			</form>
			</div>
			<div id="modifierajouterintervention">
				<?php include 'gestionIntervention.php'; ?>
			</div>
		</fieldset>
		<fieldset>
			<legend>gestion des pieces</legend>
			<div id="modifierintervention">
			<form method="post" name="intitulepiece" >
				<label for="pieces">pour rechercher ou ajouter une pieces</label>
				<br/>
				<input type="text" name="intitulepiece" placeholder="pieces"/>
				<input type="submit" name="modifierpiece" value="rechercher" class="boutton"/>
			</form>
			</div>
			<div id="modifierajouterpieces">
				<?php include 'gestionPieces.php'; ?>
			</div>
		</fieldset>
		
	</body>
</html>		