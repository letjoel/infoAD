<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

	<?php
	//Si hi ha informacio modificada i enviada s'enviara a la BD
	if (isset ($_POST['iodata']) && !empty($_POST['iodata']) &&
		isset ($_POST['iohora']) && !empty($_POST['iohora']) &&
		isset ($_POST['iocentre']) && !empty($_POST['iocentre']) &&
		isset ($_POST['iodescripcio']) && !empty($_POST['iodescripcio']))
	{ 
	
	$io_data = $_POST['iodata'];
	$io_hora = $_POST['iohora'];
	$io_centre = $_POST['iocentre'];
	$io_descripcio = $_POST['iodescripcio'];
	$io_id = $_POST['idenviableio'];
	
	//afegim slah a totes les cometes mitjançant escape
	$io_data2 =  mysql_real_escape_string($io_data);
	$io_hora2 =  mysql_real_escape_string($io_hora);
	$io_centre2 =  mysql_real_escape_string($io_centre);
	$io_descripcio2 =  mysql_real_escape_string($io_descripcio);		

	
	$con3io=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexio");
	mysql_select_db($db,$con3io)or die("Hi ha problemes per connectar amb la base de dades");	
	mysql_query("SET NAMES 'utf8'");	
	
	$registre4=mysql_query("UPDATE incidoperativa SET IODATA='$io_data2', IOHORA='$io_hora2',
	IOCENTRE='$io_centre2', IODESC='$io_descripcio2' 
	WHERE IOID='$io_id'")or die("Error en la consulta: ".mysql_error());

	echo "Dades modificades correctament - <a href=\"pantalla.php#incoperatives\">Tornar</a>";
	}
	
	?>
<br />	
<br />	
	
<?php require_once("footer.php"); ?>