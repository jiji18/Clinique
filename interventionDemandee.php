<?php
	$idconnect=mysqli_connect('localhost','root',NULL,$bdd) or die('erreur !');
	mysqli_set_charset($idconnect,'UTF8');
	$query="SELECT type FROM intervention";
	$result=mysqli_query($idconnect,$query);
	while($row=mysqli_fetch_row($result)){
		echo '<option>'.$row[0].'</option>';
	}
?>