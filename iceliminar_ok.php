<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("connexio.php"); ?>
	<?php
	if ( !empty($_POST['idepereliminaric']) && $_POST['eliminarsiic'] == 1 ) {

		
		$laidelimic = $_POST['idepereliminaric'];
		
		$con4ic=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
		mysql_select_db($db,$con4ic)or die("Hi ha problemes per connectar amb la base de dades");	
		
		$registre4ic=mysql_query("DELETE FROM incidtecniques WHERE ICID='$laidelimic'")or die("Error en la consulta: ".mysql_error());
		mysql_query("SET NAMES 'utf8'");
		echo "Dades eliminades correctament - <a href=\"pantalla.php#inctecniques\">Tornar</a>";
	}
	?>	
	
	
	
<br /><br />	
<?php require_once("footer.php"); ?>