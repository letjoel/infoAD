<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

	<?php
	//Si hi ha informacio modificada i enviada s'enviara a la BD
	if (isset ($_POST['txdata']) && !empty($_POST['txdata']) &&
		isset ($_POST['txhora']) && !empty($_POST['txhora']) &&
		isset ($_POST['txcentre']) && !empty($_POST['txcentre']) &&
		isset ($_POST['txextensio']) && !empty($_POST['txextensio']) &&
		isset ($_POST['txdescripcio']) && !empty($_POST['txdescripcio']))
	{ 
	
	$tx_data = $_POST['txdata'];
	$tx_hora = $_POST['txhora'];
	$tx_centre = $_POST['txcentre'];
	$tx_extensio = $_POST['txextensio'];
	$tx_descripcio = $_POST['txdescripcio'];
	$tx_id = $_POST['idenviabletx'];
	
	//afegim slah a totes les cometes mitjançant escape
	$tx_data2 =  mysql_real_escape_string($tx_data);
	$tx_hora2 =  mysql_real_escape_string($tx_hora);
	$tx_centre2 =  mysql_real_escape_string($tx_centre);
	$tx_extensio2 =  mysql_real_escape_string($tx_extensio);
	$tx_descripcio2 =  mysql_real_escape_string($tx_descripcio);		

	
	$con3tx=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexio");
	mysql_select_db($db,$con3tx)or die("Hi ha problemes per connectar amb la base de dades");	
	mysql_query("SET NAMES 'utf8'");	
	
	$registre4=mysql_query("UPDATE taxi SET TXDATA='$tx_data2', TXHORA='$tx_hora2',
	TXCENTRE='$tx_centre2', TXEXTENSIO='$tx_extensio2', TXDESC='$tx_descripcio2' 
	WHERE TXID='$tx_id'")or die("Error en la consulta: ".mysql_error());

	echo "Dades modificades correctament - <a href=\"pantalla.php#taxi\">Tornar</a>";
	}
	
	?>
<br />	
<br />	
	
<?php require_once("footer.php"); ?>