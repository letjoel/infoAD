<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
	//Si hi ha informacio modificada i enviada s'enviara a la BD
	if (isset ($_POST['cdeddata']) && !empty($_POST['cdeddata']))
	{ 
	
	$cded_data = $_POST['cdeddata'];
	$cded_hora = $_POST['cdedhora'];
	$cded_tipus = $_POST['cdedtipus'];
	$cded_desc = $_POST['cdeddesc'];
	$cded_id = $_POST['cdedidenviable'];
	
	//afegim slah a totes les cometes mitjançant escape
	$cded_data2 =  mysql_real_escape_string($cded_data);
	$cded_hora2 =  mysql_real_escape_string($cded_hora);
	$cded_tipus2 =  mysql_real_escape_string($cded_tipus);
	$cded_desc2 =  mysql_real_escape_string($cded_desc);
	
	
	$concdedok=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexio");
	mysql_select_db($db,$concdedok)or die("Hi ha problemes per connectar amb la base de dades");	
	mysql_query("SET NAMES 'utf8'");	
	
	$registre4=mysql_query("UPDATE control SET CDDATA='$cded_data2', CDHORA='$cded_hora2', CDTIPUS='$cded_tipus2',
	CDDESC='$cded_desc2'
	WHERE CDID='$cded_id'")or die("Error en la consulta: ".mysql_error());

	echo "Dades modificades correctament - <a href=\"pantalla.php#control\">Tornar</a>";
	}
	
?>
	
<br /><br />	
<?php require_once("footer.php"); ?>