<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("connexio.php"); ?>
	<?php
	if ( !empty($_POST['idepereliminarab']) && $_POST['abeliminarsi'] == 1 ) {

		
		$laidelimab = $_POST['idepereliminarab'];
		
		$con4abe=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
		mysql_select_db($db,$con4abe)or die("Hi ha problemes per connectar amb la base de dades");	
		
		$registre4=mysql_query("DELETE FROM borsa WHERE ABID='$laidelimab'")or die("Error en la consulta: ".mysql_error());
		mysql_query("SET NAMES 'utf8'");
		echo "Dades eliminades correctament - <a href=\"pantalla.php#borsa\">Tornar</a>";
	}
	?>	
	
	
<br /><br />		
<?php require_once("footer.php"); ?>