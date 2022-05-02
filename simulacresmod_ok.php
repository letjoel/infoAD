<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
	//Si hi ha informacio modificada i enviada s'enviara a la BD
	if (isset ($_POST['simdata']) && !empty($_POST['simdata']))
	{ 
	
	$m_data = $_POST['simdata'];
	$m_hora = $_POST['simhora'];
	$m_centre = $_POST['simcentre'];
	$m_extensio = $_POST['simextensio'];
	$m_tipus = $_POST['simtipus'];
	$m_descripcio = $_POST['simdescripcio'];
	$m_id = $_POST['simidenviable'];
	
	//afegim slah a totes les cometes mitjançant escape
	$m_data2 =  mysql_real_escape_string($m_data);
	$m_hora2 =  mysql_real_escape_string($m_hora);
	$m_centre2 =  mysql_real_escape_string($m_centre);
	$m_extensio2 =  mysql_real_escape_string($m_extensio);
	$m_tipus2 =  mysql_real_escape_string($m_tipus);
	$m_descripcio2 =  mysql_real_escape_string($m_descripcio);
	
	
	$conmsi3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexio");
	mysql_select_db($db,$conmsi3)or die("Hi ha problemes per connectar amb la base de dades");	
	mysql_query("SET NAMES 'utf8'");	
	
	$registre4=mysql_query("UPDATE simulacres SET SIDATA='$m_data2', SIHORA='$m_hora2', SICENTRE='$m_centre2',
	SIEXTENSIO='$m_extensio2', SITIPUS='$m_tipus2', SIDESC='$m_descripcio2' 
	WHERE SIID='$m_id'")or die("Error en la consulta: ".mysql_error());

	echo "Dades modificades correctament - <a href=\"pantalla.php#simulacres\">Tornar</a>";
	}
	
?>
	
<br /><br />	
<?php require_once("footer.php"); ?>