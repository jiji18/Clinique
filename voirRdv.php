<?php
	$events=$events.'<div class="allEvents" id="events'.$d.'-'.$m.'-'.$year.'"><form method="post" action="ajouterRdv.php"><fieldset><legend>Rendez-vous</legend>';
	$hour=8;
	while($hour!=21){
		$plageHoraire=date('Y-m-d H:i:s',mktime($hour,0,0,$m,$d,$year));
		if(isset($rdv[$plageHoraire])){
			$events=$events.'<p><label>'.$hour.'h 00 : </label><input type="text" value="'.$rdv[$plageHoraire].'" background-color=#fba" readonly/></p>';
		}elseif(isset($indispo[$plageHoraire])){
			$events=$events.'<p><label>'.$hour.'h 00 : </label><input type="text" value="Indisponible" readonly/></p>';
		}else{
			$events=$events.
			'<p><label><input type="radio" name="choix" value="'.$plageHoraire.'"/>'.$hour.'h 00 : </label>
					<input type="text" value="Disponible" readonly/></p>';
		}
		if($hour==11) $hour=$hour+2;
		else $hour++;
	}
	$events=$events.'<p id="bouton"><label class="form_label_nostyle">&nbsp;</label><input type="submit" value="ajouter rdv"/>';
	$events=$events.'</fieldset></form></div>';
?>