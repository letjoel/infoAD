<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("connexio.php"); ?>
	<?php
	if ( !empty($_POST['idepereliminario']) && $_POST['eliminarsiio'] == 1 ) {

		
		$laidelimio = $_POST['idepereliminario'];
		
		$con4io=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
		mysql_select_db($db,$con4io)or die("Hi ha problemes per connectar amb la base de dades");	
		
		$registre4io=mysql_query("DELETE FROM incidoperativa WHERE IOID='$laidelimio'")or die("Error en la consulta: ".mysql_error());
		mysql_query("SET NAMES 'utf8'");
		echo "Dades eliminades correctament - <a href=\"pantalla.php#incoperatives\">Tornar</a>";
	}
	?>	
	
	
	
<br /><br />	
<?php require_once("footer.php"); ?>