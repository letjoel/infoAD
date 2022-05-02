<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

	<?php
	//Si hi ha informacio modificada i enviada s'enviara a la BD
	if (isset ($_POST['andata']) && !empty($_POST['andata']) &&
		isset ($_POST['andescripcio']) && !empty($_POST['andescripcio']))
	{ 
	
	$an_data = $_POST['andata'];
	$an_arxiu = $_POST['anarxiu'];
	$an_descripcio = $_POST['andescripcio'];
	$an_id = $_POST['idenviablean'];
	
	//afegim slah a totes les cometes mitjançant escape
	$an_data2 =  mysql_real_escape_string($an_data);
	$an_arxiu2 =  mysql_real_escape_string($an_arxiu);
	$an_descripcio2 =  mysql_real_escape_string($an_descripcio);		

	
	$con3an=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexio");
	mysql_select_db($db,$con3an)or die("Hi ha problemes per connectar amb la base de dades");	
	mysql_query("SET NAMES 'utf8'");	
	
	$registrean4=mysql_query("UPDATE annexes SET ANDATA='$an_data2', ANARXIU='$an_arxiu2',
	ANDESC='$an_descripcio2' 
	WHERE ANID='$an_id'")or die("Error en la consulta: ".mysql_error());

	echo "Dades modificades correctament - <a href=\"pantalla.php#annexes\">Tornar</a>";
	}
	
	?>
<br />	
<br />	
	
<?php require_once("footer.php"); ?>