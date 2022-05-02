<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("connexio.php"); ?>
	<?php
	if ( !empty($_POST['idepereliminarob']) && $_POST['eliminarsiob'] == 1 ) {

		
		$laidelimob = $_POST['idepereliminarob'];
		
		$con4ob=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
		mysql_select_db($db,$con4ob)or die("Hi ha problemes per connectar amb la base de dades");	
		
		$registre4ob=mysql_query("DELETE FROM observacions WHERE OBID='$laidelimob'")or die("Error en la consulta: ".mysql_error());
		mysql_query("SET NAMES 'utf8'");
		echo "Dades eliminades correctament - <a href=\"pantalla.php#observacions\">Tornar</a>";
	}
	?>	
	
	
	
<br /><br />	
<?php require_once("footer.php"); ?>