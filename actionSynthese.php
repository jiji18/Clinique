<?php
	$bdd='projet';
	$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
	mysqli_set_charset($idconnect,'UTF8');
	$NNS=$_POST['nnsRequis'];
	if(isset($_POST['modifierPatient'])){
		$adresse=$_POST['modifierAdresse'];$num=$_POST['modifierNumero'];
		$mail=$_POST['modifierMail'];$profession=$_POST['modifierProfession'];
		$situation=$_POST['modifierSituation'];$solde=$_POST['modifierSolde'];
		$query="SELECT solde FROM patient WHERE NNS='$NNS'";
		$result=mysqli_query($idconnect,$query);
		$row=mysqli_fetch_row($result);
		$query="UPDATE patient
		SET adresse='$adresse',numero='$num',mail='$mail',profession='$profession',situation='$situation' WHERE NNS='$NNS'";
		mysqli_query($idconnect,$query);
		if($row[0]<=$solde){
			$query="UPDATE patient
			SET solde='$solde' WHERE NNS='$NNS'";
			mysqli_query($idconnect,$query);
			echo '<script>alert("'.utf8_decode('Modification réussi !').'");</script>';
		}else{
			echo '<script>alert("'.utf8_decode('Impossible de modifier le solde ! Ce nouveau solde est inférieur à l\'ancien.').'");</script>';
		}
	}
	if(isset($_POST['payerRdv'])){
		$query="SELECT solde FROM patient WHERE NNS='$NNS'";
		$result=mysqli_query($idconnect,$query);
		$row=mysqli_fetch_row($result);
		$solde=$row[0];
		if($solde>=$_POST['dette']){
			$dette=$_POST['dette'];
			$query="UPDATE patient SET solde=solde-'$dette',dette=0";
			mysqli_query($idconnect, $query);
			$date=date('Y-m-d H:i:s');
			$query="INSERT INTO paiement VALUES('$NNS','$solde','$date')";
			mysqli_query($idconnect, $query);
			echo '<script>alert("'.utf8_decode('Paiement réussi !').'");</script>';
		}else{
			echo '<script>alert("'.utf8_decode('Votre solde est insuffisant !\n Veuillez modifier celui-ci avant de passer au paiement').'");</script>';
		}
	}
	echo '<script>window.location.replace("agent.php")</script>';
	mysqli_close($idconnect);
?>