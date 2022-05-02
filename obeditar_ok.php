<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

	<?php
	//Si hi ha informacio modificada i enviada s'enviara a la BD
	if (isset ($_POST['obdata']) && !empty($_POST['obdata']) &&
		isset ($_POST['obhora']) && !empty($_POST['obhora']) &&
		isset ($_POST['obcentre']) && !empty($_POST['obcentre']) &&
		isset ($_POST['obdescripcio']) && !empty($_POST['obdescripcio']))
	{ 
	
	$ob_data = $_POST['obdata'];
	$ob_hora = $_POST['obhora'];
	$ob_centre = $_POST['obcentre'];
	$ob_descripcio = $_POST['obdescripcio'];
	$ob_id = $_POST['idenviableob'];
	
	//afegim slah a totes les cometes mitjançant escape
	$ob_data2 =  mysql_real_escape_string($ob_data);
	$ob_hora2 =  mysql_real_escape_string($ob_hora);
	$ob_centre2 =  mysql_real_escape_string($ob_centre);
	$ob_descripcio2 =  mysql_real_escape_string($ob_descripcio);		

	
	$con3ob=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexio");
	mysql_select_db($db,$con3ob)or die("Hi ha problemes per connectar amb la base de dades");	
	mysql_query("SET NAMES 'utf8'");	
	
	$registre4=mysql_query("UPDATE observacions SET OBDATA='$ob_data2', OBHORA='$ob_hora2',
	OBCENTRE='$ob_centre2', OBDESC='$ob_descripcio2' 
	WHERE OBID='$ob_id'")or die("Error en la consulta: ".mysql_error());

	echo "Dades modificades correctament - <a href=\"pantalla.php#observacions\">Tornar</a>";
	}
	
	?>
<br />	
<br />	
	
<?php require_once("footer.php"); ?>