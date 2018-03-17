<?php
	class Date{
		var $days = array('Lundi','Mardi','Mercredi','Jeudi','Vendredi','samedi','dimanche');
		var $months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
		
		function getAll($year){
			$res=array();
			$date= new DateTime($year.'-01-01');
			while($date->format('Y')<= $year){
				$y=$date->format('Y');
				$m=$date->format('n');
				$d=$date->format('j');
				$w=str_replace('0', '7',$date->format('w'));
				$res[$y][$m][$d]=$w;
				$date->add(new DateInterval('P1D'));//Periode 1 DAY 
			}
			return  $res;
		}
		
		function jourFerie($year){
			$feteDuTravail=date('Y-m-d',mktime(0,0,0,5,1,$year));
			$res[$feteDuTravail]='fête du travail';
			$juillet=date('Y-m-d',mktime(0,0,0,7,14,$year));
			$res[$juillet]='fête du travail';
			$noel=date('Y-m-d',mktime(0,0,0,12,25,$year));
			$res[$noel]='noêl';
			$noel=date('Y-m-d',mktime(0,0,0,1,1,$year));
			$res[$noel]='an';
			return $res;
		}
		
	}
?>