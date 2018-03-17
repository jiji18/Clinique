<?php
	session_start();
	if(!isset($_SESSION['id']) or $_SESSION['type']!='agent'){
		header('location:Acceuil.php');
		exit();
	}
	
	if(isset($_POST['patient'])){
		if($_POST['patient']!=''){
			$_SESSION['patient']=$_POST['patient'];
		}else{
			echo '<script>alert("'.utf8_decode('Saisir un numéro de sécurité social !').'")</script>';
			echo '<script>window.location.replace("agent.php")</script>';
			exit();
		}
	}
	if(isset($_POST['medecin'])){
		if($_POST['medecin']!=''){
			$_SESSION['idM']=$_POST['medecin'];
		}else{
			echo '<script>alert("'.utf8_decode('Aucun médecin n\'a été saisie !').'")</script>';
			echo '<script>window.location.replace("agent.php")</script>';
			exit();
		}
	}
	if(isset($_POST['intervention'])){
		if($_POST['intervention']!=''){
			$bdd='projet';
			$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
			mysqli_set_charset($idconnect,'UTF8');
			$idM=$_POST['medecin'];
			$query="SELECT specialite FROM employe WHERE identifiant='$idM'";
			$result=mysqli_query($idconnect, $query);
			$row=mysqli_fetch_row($result);
			$inter=$_POST['intervention'];
			$spe=$row[0];
			$query2="SELECT specialiteRequis FROM intervention WHERE type='$inter'";
			$result2=mysqli_query($idconnect, $query2);
			$row2=mysqli_fetch_row($result2);
			if($row2[0]==$spe or $inter=='Autre'){ 
				$_SESSION['intervention']=$_POST['intervention'];	
			}else{
				echo '<script>alert("'.utf8_decode('Cette intervention ne peut pas être réalisé par ce médecin !').'")</script>';
				echo '<script>window.location.replace("agent.php")</script>';
				exit();
			}
			mysqli_close($idconnect);
		}else{
			echo '<script>alert("'.utf8_decode('Saisir un type d\'intervention !').'")</script>';
			echo '<script>window.location.replace("agent.php")</script>';
			exit();
		}
	}
	
	if(!isset($_SESSION['idM']) or !isset($_SESSION['patient']) or !isset($_SESSION['intervention'])){
		header('Location: agent.php');
		exit();
	}
?>
<!DOCTYPE html>

<html lang="fr">
<head>
	<meta charset="UTF-8" />
	<title>Planning</title>
	<link rel="shortcut icon" type="image/x-icon" href="logo.png"/>
		 <!-- pour ajouter un logo devant le title-->
	<link rel="stylesheet" href="planning.css" />
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript">
	jQuery (function($){
		var maintenant= new Date();
		var currentMonth=eval(maintenant.getMonth()+1) ;
		$('.month').hide();
		$('#month'+currentMonth).show();
		$('.months a#linkMonth'+currentMonth).addClass('active');
		$('.months a').click(function(){
			var month= $(this).attr('id').replace('linkMonth','');
			if(month != currentMonth){
				$('.allEvents').hide();
				$('#month'+currentMonth).slideUp();
				$('#month'+month).slideDown();
				$('.months a').removeClass('active');
				$('.months a#linkMonth'+month).addClass('active');
				currentMonth=month;
			}
			return false;
		});
		$('.allEvents').hide();
		var currentEvent='';
		$('.day a').click(function(){
			var events= $(this).attr('id').replace('linkEvents','');
			if(events != currentEvent){
				$('.allEvents').hide();
				$('#events'+events).slideUp();
				$('#events'+events).slideDown();
				currentEvent=events;
			}	
			return false;
		});
	});
	</script>
</head>
<body>
	<?php
		$bdd='projet';
		$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
		$idM='';
		$NNS='';
		$year=date('Y');
		if(isset($_SESSION['idM']) and isset($_SESSION['patient'])){
			$idM=$_SESSION['idM'];
			$NNS=$_SESSION['patient'];
		}
		//Pour changer d'année
		if(isset($_GET['back'])){
			$year=$_GET['back'];
		}
		if(isset($_GET['next'])){
			$year=$_GET['next'];
		}
		//récupération de notre classe objet date en français
		require ('date.php');
		$date=new Date();
		//récupération de notre classe objet medecin où l'on a des méthodes pour récupérer ses infos
		require ('agendaMedecin.php');
		$medecin=new Medecin();
		//récupération de mon tableau [année][mois][jour]
		$dates=$date->getAll($year);
		//On récupère les jours fériés de cette année
		$jourFerie=$date->jourFerie($year);
		//On récupère les indisponnibilités du médecin dans un tableau associatif
		$indispo=$medecin->indisponibilite($idM);
		//On récupère les rdv du médecin dans un tableau associatif
		$rdv=$medecin->rdv($idM);
		//permettra de stocker nos rdv cacher dans des div 
		$events='';
	?>
	<div class="year">
		<form method="get">
			<p>
				<?php if($year>date('Y')):?>
					<a class="link" href="planning.php?back=<?php  echo $year-1;?>"><?php echo $year-1;?></a>
				<?php endif;?>
				<?php echo $year; ?>
				<a class="link" href="planning.php?next=<?php  echo $year+1;?>"><?php echo $year+1;?></a>
				<a class="link" id="retour" href="agent.php">Retour</a><!-- Pour retourner au menu agent -->
			</p>
		</form>
	</div>
	<div class="months">
		<ul>
			<?php foreach ($date->months as $id=>$m):?>
				<li><a id="linkMonth<?php echo $id+1; ?>"><?php if($m !="Juillet") echo utf8_encode(substr(utf8_decode($m),0,3)); else echo substr($m,0,4); ?></a></li>
			<?php endforeach;?>
		</ul>
	</div>
	<div class="days">
		<?php $dates= current($dates); ?>
		<?php foreach ($dates as $m=>$days):?>
			<div class="month" id="month<?php echo $m; ?>">
				<table>
					<tr>
						<?php foreach ($date->days as $d): ?>
							<th><?php echo substr($d, 0, 3); ?></th>
						<?php endforeach;?>
					</tr>
					<tr>
						<?php $end=end($days);/*Va donner le dernier jour de la semaine*/ foreach ($days as $d=>$w):?>
							<?php if($d==1 and $w!=1):?><!-- Si le premier jour du mois ne tombe pas un lundi -->
								<td colspan="<?php echo $w-1; ?>" class="padding"></td><!--class padding pour enlever les bordures en css -->
							<?php endif;?>
							<td <?php if(date('Y-m-d')==date('Y-m-d',mktime(0,0,0,$m,$d,$year))) echo 'id="today"';?>>
								<div class="day">
									<?php if($w!=6 and $w!=7 and date('Y-m-d')<date('Y-m-d',mktime(0,0,0,$m,$d,$year))
										 and !isset($jourFerie[date('Y-m-d',mktime(0,0,0,$m,$d,$year))])):?>
										<a href="#" class="linkEvents" id="linkEvents<?php echo $d; ?>-<?php echo $m; ?>-<?php echo $year; ?>"><?php echo $d;?></a>
									<?php else:?>
										<a href="#" class="noEvents"><?php echo $d;?></a>
									<?php endif;?>		
								</div>
								<?php if($w!=6 and $w!=7 and date('Y-m-d')<=date('Y-m-d',mktime(0,0,0,$m,$d,$year))
										 and !isset($jourFerie[date('Y-m-d',mktime(0,0,0,$m,$d,$year))])):?>
									<!-- On vérifie que ce jour n'est pas déjà passé ou tombe un week-end ou est un jour férié -->
									<?php require ('voirRdv.php');?>
								<?php endif;?>	
							</td>
							<?php if($w==7):?>
								</tr><tr>
							<?php endif;?>
						<?php endforeach;?>
						<?php if($end!=7):?><!-- Si le dernier jour du mois n'est pas un dimanche -->
							<td colspan="<?php echo $end-1; ?>" class="padding"></td><!--class padding pour enlever les bordures en css -->
						<?php endif;?>
					</tr>
				</table>
			</div>
		<?php endforeach; ?>		
	</div>
<?php echo $events;mysqli_close($idconnect);?>
</body>
</html>	