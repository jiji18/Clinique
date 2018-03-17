<?php
	class Medecin{
		
		function indisponibilite($idM){
			$res=array();
			$bdd='projet';
			$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
			$query="SELECT creneau FROM indisponibilite where idM='$idM'";
			$result=mysqli_query($idconnect, $query);
			if(mysqli_num_rows($result)!=0){
				while ($row=mysqli_fetch_row($result)){
					$res[$row[0]]='indisponible';
				}
			}
			mysqli_close($idconnect);
			if(empty($res)) return NULL;
			else return $res;
		}
		
		function rdv($idM){
			$res=array();
			$bdd='projet';
			$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
			$result=mysqli_query($idconnect,"SELECT date,intervention FROM rdv where idM='$idM'");
			while($row=mysqli_fetch_row($result)){
				$res[$row[0]]=utf8_encode($row[1]);
			}
			mysqli_close($idconnect);
			if(empty($res)) return NULL;
			else return $res;
		}
		
	}
?>