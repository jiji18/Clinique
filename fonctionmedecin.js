function jourduplanning(){
	date=document.forms['planning'].elements['dateedt'].value;
	document.forms['planning'].elements['dateedt'].value;
}

function informationrdv(){
	information='<form method="post" name="informations"><input type="text"/><textarea name="synthese" value="'+synthese+'" <br/></textarea><input class="bouton" type="bouton" value="consulter" onclick=""/></form>';
	document.getElementById('informationRDV').innerHTML=information;
}

function consultation(){
	bilanconsulation='<input type="button"name=';
}

function afficherSynthese(div){
	if(document.getElementById(div).style.visibility=="visible"){
		document.getElementById(div).style.visibility="hidden";
		document.getElementById(div).style.height=0;
	}else{
		document.getElementById(div).style.visibility="visible";
		document.getElementById(div).style.height="auto";
	}
}
