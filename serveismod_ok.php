<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
	//Si hi ha informacio modificada i enviada s'enviara a la BD
	if (isset ($_POST['somdata']) && !empty($_POST['somdata']))
	{ 
	
	$m_data = $_POST['somdata'];
	$m_hora = $_POST['somhora'];
	$m_centre = $_POST['somcentre'];
	$m_extensio = $_POST['somextensio'];
	$m_operatiu = $_POST['somoperatiu'];
	$m_descripcio = $_POST['somdescripcio'];
	$m_id = $_POST['somidenviable'];
	
	//afegim slah a totes les cometes mitjançant escape
	$m_data2 =  mysql_real_escape_string($m_data);
	$m_hora2 =  mysql_real_escape_string($m_hora);
	$m_centre2 =  mysql_real_escape_string($m_centre);
	$m_extensio2 =  mysql_real_escape_string($m_extensio);
	$m_operatiu2 =  mysql_real_escape_string($m_operatiu);
	$m_descripcio2 =  mysql_real_escape_string($m_descripcio);
	
	
	$conmso3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexio");
	mysql_select_db($db,$conmso3)or die("Hi ha problemes per connectar amb la base de dades");	
	mysql_query("SET NAMES 'utf8'");	
	
	$registre4=mysql_query("UPDATE serveis SET SODATA='$m_data2', SOHORA='$m_hora2', SOCENTRE='$m_centre2',
	SOEXTENSIO='$m_extensio2', SOCOS='$m_operatiu2', SODESCRIPCIO='$m_descripcio2' 
	WHERE SOID='$m_id'")or die("Error en la consulta: ".mysql_error());

	echo "Dades modificades correctament - <a href=\"pantalla.php#serveis\">Tornar</a>";
	}
	
?>
	
<br /><br />	
<?php require_once("footer.php"); ?>