<?php 
if(isset($_POST['validersupressionEmploye'])){
	mysqli_set_charset($idconnect,'UTF8');
	$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
	$id=$_POST['id'];
	$query="DELETE FROM employe WHERE identifiant='$id'";
	mysqli_query($idconnect,$query);
	echo '<script>alert("'.utf8_decode('employe a ete supprimé').'")</script>';
}
?>
