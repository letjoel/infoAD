<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
	//Si hi ha informacio modificada i enviada s'enviara a la BD
	if (isset ($_POST['ermdata']) && !empty($_POST['ermdata']) &&
		isset ($_POST['ermhora']) && !empty($_POST['ermhora'])  )
	{ 
	
	$erm_data = $_POST['ermdata'];
	$erm_hora = $_POST['ermhora'];
	$erm_acronim = $_POST['ermacronim'];
	$erm_desc = $_POST['ermdesc'];
	
	$erm_id = $_POST['ermidenviable'];
	
	//afegim slah a totes les cometes mitjançant escape
	$erm_data2 =  mysql_real_escape_string($erm_data);
	$erm_hora2 =  mysql_real_escape_string($erm_hora);
	$erm_acronim2 =  mysql_real_escape_string($erm_acronim);
	$erm_desc2 =  mysql_real_escape_string($erm_desc);
	
	
	$conmer3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexio");
	mysql_select_db($db,$conmer3)or die("Hi ha problemes per connectar amb la base de dades");	
	mysql_query("SET NAMES 'utf8'");	
	
	$registreer4=mysql_query("UPDATE episodis SET ERDATA='$erm_data2', ERHORA='$erm_hora2', ERACRONIM='$erm_acronim2',
	ERDESC='$erm_desc2'
	WHERE ERID='$erm_id'")or die("Error en la consulta: ".mysql_error());

	echo "Dades modificades correctament - <a href=\"pantalla.php#episodis\">Tornar</a>";
	}
	
?>
	
<br /><br />	
<?php require_once("footer.php"); ?>