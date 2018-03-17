function surligne(champ,erreur){
	if(erreur){
		champ.style.backgroundColor="#fba";
	}else{
		champ.style.backgroundColor="";
	}
}

function vide(champ){
	if(champ.value==""){
		surligne(champ,true);
		champ.required=true;
	}else{
		surligne(champ,false);
		champ.setCustomValidity('');
		champ.required=false;
	}
}

function champIncomplet(champ,min,max){
	if(champ.value.length<min || champ.value.length>max){
		surligne(champ,true);
		champ.setCustomValidity('ce champ est incomplet !');
		champ.required=true;
	}else{
		surligne(champ,false);
		champ.setCustomValidity('');
		champ.required=false;
	}
}

function telIncorrect(champ){
	var tel=champ.value;
	if(isNaN(tel) || tel.length!=10 || tel.charAt(0)!=0){
		surligne(champ,true);
		champ.setCustomValidity('Numéro de télphone incorrecte !');
		champ.required=true;
	}else{
		surligne(champ,false);
		champ.setCustomValidity('');
		champ.required=false;
	}
}

function nnsIncorrect(champ){
	var nns=champ.value;
	if(isNaN(nns) || nns.length!=15){
		surligne(champ,true);
		champ.required=true;
		champ.setCustomValidity('ce champ est incomplet !');
	}else{
		surligne(champ,false);
		champ.setCustomValidity('');
		champ.required=false;
	}
}

function soldeInCorrect(champ){
	var solde=champ.value;
	if(isNaN(solde) || solde<=0){
		surligne(champ,true);
		champ.setCustomValidity('ce champ doit comporter un solde positif !');
		champ.required=true;
	}else{
		surligne(champ,false);
		champ.setCustomValidity('');
		champ.required=false;
	}
}

function retablir(champ){
	surligne(champ,false);
	champ.setCustomValidity('');
	champ.required=false;
}