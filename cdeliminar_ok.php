<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("connexio.php"); ?>
	<?php
	if ( !empty($_POST['idepereliminarcd']) && $_POST['cdeliminarsi'] == 1 ) {

		
		$laidelicd = $_POST['idepereliminarcd'];
		
		$con4cde=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
		mysql_select_db($db,$con4cde)or die("Hi ha problemes per connectar amb la base de dades");	
		
		$registre4=mysql_query("DELETE FROM control WHERE CDID='$laidelicd'")or die("Error en la consulta: ".mysql_error());
		mysql_query("SET NAMES 'utf8'");
		echo "Dades eliminades correctament - <a href=\"pantalla.php#control\">Tornar</a>";
	}
	?>	
	
	
<br /><br />		
<?php require_once("footer.php"); ?>