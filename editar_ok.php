<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

	<?php
	//Si hi ha informacio modificada i enviada s'enviara a la BD
	if (isset ($_POST['data']) && !empty($_POST['data']) &&
		isset ($_POST['hora']) && !empty($_POST['hora']) &&
		//isset ($_POST['extensio']) && !empty($_POST['extensio']) &&
		//isset ($_POST['expedient']) && !empty($_POST['expedient']) &&
		isset ($_POST['centre']) && !empty($_POST['centre']) &&
		//isset ($_POST['codi']) && !empty($_POST['codi']) &&
		//isset ($_POST['municipi']) && !empty($_POST['municipi']) &&
		isset ($_POST['descripcio']) && !empty($_POST['descripcio']))
	{ 
	
	$e_data = $_POST['data'];
	$e_hora = $_POST['hora'];
	$e_extensio = $_POST['extensio'];
	$e_expedient = $_POST['expedient'];
	$e_centre = $_POST['centre'];
	$e_codi = $_POST['codi'];
	$e_municipi = $_POST['munixipi'];
	$e_descripcio = $_POST['descripcio'];
	$e_id = $_POST['idenviable'];
	
	//afegim slah a totes les cometes mitjançant escape
	$e_data2 =  mysql_real_escape_string($e_data);
	$e_hora2 =  mysql_real_escape_string($e_hora);
	$e_extensio2 =  mysql_real_escape_string($e_extensio);
	$e_expedient2 =  mysql_real_escape_string($e_expedient);
	$e_centre2 =  mysql_real_escape_string($e_centre);
	$e_codi2 =  mysql_real_escape_string($e_codi);
	$e_municipi2 =  mysql_real_escape_string($e_municipi);
	$e_descripcio2 =  mysql_real_escape_string($e_descripcio);		


	
	$con3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexio");
	mysql_select_db($db,$con3)or die("Hi ha problemes per connectar amb la base de dades");	
	mysql_query("SET NAMES 'utf8'");	
	
	$registre4=mysql_query("UPDATE activitat SET DATA='$e_data2', HORA='$e_hora2', EXTENSIO='$e_extensio2',
	EXPEDIENT='$e_expedient2', CENTRE='$e_centre2', CODI='$e_codi2', MUNICIPI='$e_municipi2', DESCRIPCIO='$e_descripcio2' 
	WHERE ID='$e_id'")or die("Error en la consulta: ".mysql_error());

	echo "Dades modificades correctament - <a href=\"pantalla.php#ires\">Tornar</a>";
	}
	
	?>
<br />	
<br />	
	
<?php require_once("footer.php"); ?>