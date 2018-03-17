function identifiant(champ){
	if(champ.value==""){
		surligne(champ,true);
		champ.setCustomValidity('vous devez remplir ce champ!');
		champ.required=true;
	}
}

function formulaireemploye(){
	texte = '<label for="id">ID employe:</label> <input type="text" name="identifiantemploye"/><input type="submit" name="rechercher" value="rechercher"/>';
	document.getElementById('saisiremploye').innerHTML=texte;
}

function nouveauemploye(){
	texte = '<label for="nom">Nom:</label> <input type="text" name="nom"/> <br/> <label for="prenom">Prenom:</label> <input type="text" name="prenom" onblur="identificateur(document.forms[\'nouveau\'])"/> <br/> <label for="id">id:</label> <input type="text" name="id" readonly/> <br/> <label for="mdp">mot de passe:</label> <input type="password" name="mdp"/> <br/> <label for="type">type:</label> <select name="type" onclick="specialite()"> <option>directeur <option>agent <option>medecin </select> <div id="specialité"></div> <input type="submit" name="ajouteremploye" class="boutton"/></div>';
	document.getElementById('nouveauemploye').innerHTML=texte;
}
function identificateur(formulaire){
	var nom=formulaire.elements['nom'].value;
	var prenom=formulaire.elements['prenom'].value;
	identifiant=prenom+'.'+nom;
	formulaire.elements['id'].value=identifiant;
}

function specialiste(champ){
	node=document.getElementById("spe");
	if(this.value=="medecin"){
		node.style.visibility="visible";
		node.style.height = "4";
		node.style.width = "auto";
		document.forms['ajouteremploye'].elements['nom']="medecin";
	}else{
		node.style.visibility = "hidden";
		node.style.height = "0";
		this.value="";
	}
}

function verificationemploye(formulaire){
	verif=true;
	var specialite;
	nom=formulaire.elements['nom'];
	prenom=formulaire.elements['prenom'];
	mdp=formulaire.elements['mdp'];
	type=formulaire.elements['type'];
	identificateur(formulaire);
	return true;
}


function verificationintervention(formulaire){
	var type=formulaire.element['type'].value;
	var prix=formulaire.element['prix'].value;
	var durée=formulaire.element['duree'].value;
	return true;
}

function estUnNombre(champ){
	if(isNaN(champ.value)){
		surligne(champ,true);
		champ.required=true;
		champ.setCustomValidity('vous devez saisir en entier!');
		champ.required=false;
	}else{
		surligne(champ,false);
		champ.setCustomValidity('');
		champ.required=false;
	}
}