<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("connexio.php"); ?>
	<?php
	if ( !empty($_POST['idepereliminarsi']) && $_POST['sieliminarsi'] == 1 ) {

		
		$laidelimsi = $_POST['idepereliminarsi'];
		
		$con4sie=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
		mysql_select_db($db,$con4sie)or die("Hi ha problemes per connectar amb la base de dades");	
		
		$registre4=mysql_query("DELETE FROM simulacres WHERE SIID='$laidelimsi'")or die("Error en la consulta: ".mysql_error());
		mysql_query("SET NAMES 'utf8'");
		echo "Dades eliminades correctament - <a href=\"pantalla.php#simulacres\">Tornar</a>";
	}
	?>	
	
	
<br /><br />		
<?php require_once("footer.php"); ?>