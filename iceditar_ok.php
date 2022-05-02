<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

	<?php
	//Si hi ha informacio modificada i enviada s'enviara a la BD
	if (isset ($_POST['icdata']) && !empty($_POST['icdata']) &&
		isset ($_POST['ichora']) && !empty($_POST['ichora']) &&
		isset ($_POST['iccentre']) && !empty($_POST['iccentre']) &&
		isset ($_POST['icdescripcio']) && !empty($_POST['icdescripcio']))
	{ 
	
	$ic_data = $_POST['icdata'];
	$ic_hora = $_POST['ichora'];
	$ic_centre = $_POST['iccentre'];
	$ic_descripcio = $_POST['icdescripcio'];
	$ic_id = $_POST['idenviableic'];
	
	//afegim slah a totes les cometes mitjançant escape
	$ic_data2 =  mysql_real_escape_string($ic_data);
	$ic_hora2 =  mysql_real_escape_string($ic_hora);
	$ic_centre2 =  mysql_real_escape_string($ic_centre);
	$ic_descripcio2 =  mysql_real_escape_string($ic_descripcio);		

	
	$con3ic=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexio");
	mysql_select_db($db,$con3ic)or die("Hi ha problemes per connectar amb la base de dades");	
	mysql_query("SET NAMES 'utf8'");	
	
	$registre4=mysql_query("UPDATE incidtecniques SET ICDATA='$ic_data2', ICHORA='$ic_hora2',
	ICCENTRE='$ic_centre2', ICDESC='$ic_descripcio2' 
	WHERE ICID='$ic_id'")or die("Error en la consulta: ".mysql_error());

	echo "Dades modificades correctament - <a href=\"pantalla.php#inctecniques\">Tornar</a>";
	}
	
	?>
<br />	
<br />	
	
<?php require_once("footer.php"); ?>