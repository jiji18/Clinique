<?php 
if(isset($_POST['validersuppressionIntervention'])){
	mysqli_set_charset($idconnect,'UTF8');
	$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
	$type=$_POST['type'];
	$query="DELETE FROM intervention WHERE type='$type'";
	mysqli_query($idconnect,$query);
	echo '<script>alert("'.utf8_decode('intervention a ete supprimee').'")</script>';
}
?>
