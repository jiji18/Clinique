<?php
//beaucoup de code en commentaire pour m'aider a saisir les differente  fonctions des datetime
$bdd='projet';
$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
	if(isset($_POST['demander'])){
		$id=$_SESSION['id'];
		$creneaux=true;
		$datedujour=$_POST['jour'];//du datetime
		$heure=$_POST['heure'];
		$horaire=new datetime();
		$horaire->settime($heure,00);
		$h=date_format($horaire,'h:i:s');
		//$timestamp=strtotime($datedujour);//du time en secon (non utilisé uste pour connaitre)
		$libre="SELECT intervention,date FROM rdv WHERE date_format(date,'Y-m-d')='$datedujour'";
		
		
		//$timestamp=strtotime(date_format($date,'Y-m-d'));
		//$test=date('Y-m-d',$timestamp);
		//echo 'le test donne '.$test;
		
		//echo 'le timer est '.$heure;
		//echo 'timestamp '.strtotime(date_format($date,'Y-m-d'));
		//echo 'date est '.date_format($date,'Y-m-d ');
		
		
		$tablerdv="SELECT intervention,date FROM rdv WHERE idM='$id'";
		$resultlibre=mysqli_query($idconnect,$tablerdv);
		//je recherche parmi tout les rdv si celui-ci empiete sur l'heure demandée
		while($row=mysqli_fetch_row($resultlibre)){
			$intervention=$row['0'];
			$rdv=$row['1'];
			$jourrdv=new datetime($rdv);
			$datedujourrdv=date_format($jourrdv,'Y-m-d');
			
			//on regarde si la date du rdv est celle du jour demandé
			if($datedujourrdv==$datedujour){
				$duree="SELECT duree FROM intervention WHERE type='$intervention'";
				$resultduree=mysqli_query($idconnect,$duree);
				$ligneduree=mysqli_fetch_row($resultduree);
				$dure=$ligneduree['0'];
				$heurerdv=date_format($jourrdv,'h:i:s');
				if($h==$heurerdv){
					$creneaux=false;
					echo '<script>alert("'.utf8_decode('vous avez deja un rendez-vous de prevue').'")</script>';
				}
				/*$periode=new datetime($h);
				$periode->add(new DateIntervale('P'.$dure.'H)'));
				if (date('H', strtotime($ . "+ $periode days")) < )
				if($h<$heurerdv and $heurerdv<$periode){
					$creneaux=false;
				}
				*/
			}	
		}
		if($creneaux==true){
			$indi=new datetime($datedujour);
			$indi->settime($heure,00);
			$indispo=date_format($indi,'Y-m-d h:i:s');
			
			$query="INSERT INTO indisponibilite (idM,dateD) VALUES ('$id','$indispo')";
			mysqli_query($idconnect,$query);
			echo '<script>alert("'.utf8_decode('creneau horaire reservé!').'")</script>';
		}
	}

?>