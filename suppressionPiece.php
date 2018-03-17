<?php 
if(isset($_POST['validerSuppressionpiece'])){
	mysqli_set_charset($idconnect,'UTF8');
	$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
	$type=$_POST['type'];
	$query="DELETE FROM piece WHERE intitule='$type'";
	mysqli_query($idconnect,$query);
	echo '<script>alert("'.utf8_decode('intervention a ete supprimee').'")</script>';
}
?>
