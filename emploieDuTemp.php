<?php 
	$id=$_SESSION['id'];
	$idconnect=mysqli_connect('localhost','root',NULL,'projet');
	$jour=date('Y-m-d');
	echo $jour;
	
	if(isset($_POST['rdvdate'])){
		$jour=$_POST['dateedt'];
	}
	
	echo $jour;
	//double parcour de table;
	//$edt="SELECT rdv.NNS, rdv.date, rdv.intervention, indisponibilite.dateD FROM rdv,indisponibilite WHERE indisponibilite.idM='$identifiant' AND rdv.identifiant='$$identifiant'";
	
	
	//$indispo="SELECT * FROM indisponibilite WHERE idM='$identifiant'";
	
	$rdv="SELECT * FROM rdv WHERE idM='$id'";
	$resultrdv=mysqli_query($idconnect,$rdv);//recherche les rendez-vous de la table;
	//$resultindispo=mysqli_query($idconnect,$indispo);//recherche les indisponibilite de la table;
	if(mysqli_num_rows($resultrdv)!=0){
		$div=1;
		while($rowrdv=mysqli_fetch_row($resultrdv)){
			$NNS=$rowrdv[0];
			$date=new datetime($rowrdv[2]);
			$intervention=$rowrdv[3];
			$motif=$rowrdv[4];
			$compteR=$rowrdv[5];
			$suivi=$rowrdv[6];
			$_SESSION['test']=$identifiant;
			$h=date_format($date,'Y-m-d');
			if($jour==$h){
				$patient="SELECT * FROM patient WHERE NNS='$NNS'";
				$resultpatient=mysqli_query($idconnect,$patient);
					$rowpatient=mysqli_fetch_row($resultpatient);
					$_SESSION['nom']=$rowpatient[1];
					$nom=$rowpatient[1];
					$_SESSION['prenom']=$rowpatient[2];
					$prenom=$rowpatient[2];
					$_SESSION['ddn']=$rowpatient[3];
					$ddn=$rowpatient[3];
					$_SESSION['adresse']=$rowpatient[4];
					$adresse=$rowpatient[4];
					$_SESSION['numero']=$rowpatient[5];
					$numero=$rowpatient[5];
					$_SESSION['mail']=$rowpatient[6];
					$mail=$rowpatient[6];
					$_SESSION['profession']=$rowpatient[7];
					$profession=$rowpatient[7];
					$_SESSION['situation']=$rowpatient[8];
					$mail=$rowpatient[8];
					$_SESSION['solde']=$rowpatient[9];
					$solde=$rowpatient[9];
					echo '
					<div class="rdv" onclick="afficherSynthese(\''.$div.'\')">
						<br/><input type="text" value="'.$nom.' '.$prenom.' pour un(e) '.$intervention.'" class="horaire" name="'.$NNS.'"/>
						<div class="synthe" id="'.$div.'" visibility="hidden">';
						include 'syntheseRdv.php';
						echo '
						</div>
					</div>';
			}
			else{
				echo '<div class="class" > <input type="text" value="pas de rendez vous ce '.$jour.'" class="horaire"/>
				</div>';
			}
			$div=$div+1;
		}
	}
	/*unset($_SESSION['nom']);
	unset($_SESSION['prenom']);
	unset($_SESSION['ddn']);
	unset($_SESSION['adresse']);
	unset($_SESSION['numero']);
	unset($_SESSION['mail']);
	unset($_SESSION['profession']);
	unset($_SESSION['situation']);
	unset($_SESSION['solde']);
	*/
?>