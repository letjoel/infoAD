<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("connexio.php"); ?>
	<?php
	if ( !empty($_POST['idepereliminaran']) && $_POST['eliminarsian'] == 1 ) {

		
		$laideliman = $_POST['idepereliminaran'];
		
		$con4an=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
		mysql_select_db($db,$con4an)or die("Hi ha problemes per connectar amb la base de dades");	
		
		$registre4an=mysql_query("DELETE FROM annexes WHERE ANID='$laideliman'")or die("Error en la consulta: ".mysql_error());
		mysql_query("SET NAMES 'utf8'");
		echo "Dades eliminades correctament - <a href=\"pantalla.php\">Tornar</a>";
	}
	?>	
	
	
	
<br /><br />	
<?php require_once("footer.php"); ?>