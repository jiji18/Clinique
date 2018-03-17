<?php
session_start();
if(!isset($_SESSION['id']) or $_SESSION['type']!='medecin'){
		header('location:Acceuil.php');
		exit();
}else{
	$identifiant=$_SESSION['id'];
}
?>

<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Medecin</title>
		<link rel="stylesheet" href="medecin.css" />
		<link rel="shortcut icon" type="image/x-icon" href="logo.png"/>
		<script lang="javascript" src="fonctionmedecin.js"></script> 
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
		<div id="emploiedutemp">
			<form method="post" name="EDT">
				<label for="">vos rendez-vous du </label>
				<input type="date" value="" name="dateedt"/>
				<input type="submit" value="consulter" name="rdvdate"onclick="" class="bouton"/>
			</form>
			
		</div>
		<div id="information">
			<?php include 'emploiedutemp.php';?>
		</div>
		<div id="synthese">
			<?php include 'syntheseRdv.php'?>
		</div>
		<div name="consultation">
			<form method="post" name="planningcollegue">
				
			</form>
		</div>
		<div name="indisponibilite">
			<fieldset>
				<legend>reservation creneaux</legend>
				<form method="post" name="reservercreneaux">
					<label for="jour">jour:</label>
					<input type="date" name="jour"/>
					<select name="heure">
						<option>8
						<option>9
						<option>10
						<option>11
						<option>13
						<option>14
						<option>15
						<option>16
						<option>17
						<option>18
						<option>19
					</select>
					<input type="submit" value="demander" name="demander"/>
				</form>
				<?php include 'demandeReservation.php';?>
			</fieldset>
		</div>
		<div name="EDTcollegue">
			
		</div>
	</body>
</html>
<?php mysqli_close($idconnect) ?>		