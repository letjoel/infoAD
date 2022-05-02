<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
	//Si hi ha informacio modificada i enviada s'enviara a la BD
	if (isset ($_POST['itmdata']) && !empty($_POST['itmdata']))
	{ 
	
	$itm_data = $_POST['itmdata'];
	$itm_hora = $_POST['itmhora'];
	$itm_centre = $_POST['itmcentre'];
	$itm_extensio = $_POST['itmextensio'];
	$itm_tipus = $_POST['itmtipus'];
	$itmllicencia = $_POST['itmllicencia'];
	$itmexpedient = $_POST['itmexpedient'];
	$itmnumtruc = $_POST['itmnumtruc'];
	$itm_id = $_POST['itmidenviable'];
	
	//afegim slah a totes les cometes mitjançant escape
	$itm_data2 =  mysql_real_escape_string($itm_data);
	$itm_hora2 =  mysql_real_escape_string($itm_hora);
	$itm_centre2 =  mysql_real_escape_string($itm_centre);
	$itm_extensio2 =  mysql_real_escape_string($itm_extensio);
	$itm_tipus2 =  mysql_real_escape_string($itm_tipus);
	$itmllicencia2 =  mysql_real_escape_string($itmllicencia);
	$itmexpedient2 =  mysql_real_escape_string($itmexpedient);
	$itmnumtruc2 =  mysql_real_escape_string($itmnumtruc);

	
	
	$conmit3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexio");
	mysql_select_db($db,$conmit3)or die("Hi ha problemes per connectar amb la base de dades");	
	mysql_query("SET NAMES 'utf8'");	
	
	$registreit4=mysql_query("UPDATE incidtaxis SET ITDATA='$itm_data2', ITHORA='$itm_hora2', ITCENTRE='$itm_centre2',
	ITEXTENSIO='$itm_extensio2', ITTIPUS='$itm_tipus2', ITEXP='$itmexpedient2', ITNUMTRUC='$itmnumtruc2', ITLLICENCIES='$itmllicencia2'
	WHERE ITID='$itm_id'")or die("Error en la consulta: ".mysql_error());

	echo "Dades modificades correctament - <a href=\"pantalla.php#inctaxi\">Tornar</a>";
	}
	
?>
	
<br /><br />	
<?php require_once("footer.php"); ?>