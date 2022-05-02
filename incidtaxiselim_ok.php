<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("connexio.php"); ?>
	<?php
	if ( !empty($_POST['idepereliminarit']) && $_POST['iteliminar'] == 1 ) {

		
		$laidelimit = $_POST['idepereliminarit'];
		
		$con4ite=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
		mysql_select_db($db,$con4ite)or die("Hi ha problemes per connectar amb la base de dades");	
		
		$registreit4e=mysql_query("DELETE FROM incidtaxis WHERE ITID='$laidelimit'")or die("Error en la consulta: ".mysql_error());
		mysql_query("SET NAMES 'utf8'");
		echo "Dades eliminades correctament - <a href=\"pantalla.php#inctaxi\">Tornar</a>";
	}
	?>	
	
	
<br /><br />		
<?php require_once("footer.php"); ?>