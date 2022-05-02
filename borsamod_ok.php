<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
	//Si hi ha informacio modificada i enviada s'enviara a la BD
	if (isset ($_POST['abmdata']) && !empty($_POST['abmdata']))
	{ 
	
	$m_data = $_POST['abmdata'];
	$m_horari = $_POST['abmhorari'];
	$m_centre = $_POST['abmcentre'];
	$m_activats = $_POST['abmactivats'];
	$m_motiu = $_POST['abmmotiu'];
	$m_id = $_POST['abmidenviable'];
	
	//afegim slah a totes les cometes mitjançant escape
	$m_data2 =  mysql_real_escape_string($m_data);
	$m_horari2 =  mysql_real_escape_string($m_horari);
	$m_centre2 =  mysql_real_escape_string($m_centre);
	$m_activats2 =  mysql_real_escape_string($m_activats);
	$m_motiu2 =  mysql_real_escape_string($m_motiu);
	
	
	$conmab3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexio");
	mysql_select_db($db,$conmab3)or die("Hi ha problemes per connectar amb la base de dades");	
	mysql_query("SET NAMES 'utf8'");	
	
	$registre4=mysql_query("UPDATE borsa SET ABDATA='$m_data2', ABHORARI='$m_horari2', ABCENTRE='$m_centre2',
	ABACTIVATS='$m_activats2', ABMOTIU='$m_motiu2' 
	WHERE ABID='$m_id'")or die("Error en la consulta: ".mysql_error());

	echo "Dades modificades correctament - <a href=\"pantalla.php#borsa\">Tornar</a>";
	}
	
?>
	
<br /><br />	
<?php require_once("footer.php"); ?>