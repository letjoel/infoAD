<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("connexio.php"); ?>
	<?php
	if ( !empty($_POST['idepereliminar']) && $_POST['eliminarsi'] == 1 ) {

		
		$laidelim = $_POST['idepereliminar'];
		
		$con4=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
		mysql_select_db($db,$con4)or die("Hi ha problemes per connectar amb la base de dades");	
		
		$registre4=mysql_query("DELETE FROM activitat WHERE ID='$laidelim'")or die("Error en la consulta: ".mysql_error());
		mysql_query("SET NAMES 'utf8'");
		echo "Dades eliminades correctament - <a href=\"pantalla.php#ires\">Tornar</a>";
	}
	?>	
	
	
	
<br /><br />	
<?php require_once("footer.php"); ?>