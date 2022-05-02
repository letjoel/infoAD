<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("connexio.php"); ?>
	<?php
	if ( !empty($_POST['idepereliminartx']) && $_POST['eliminarsitx'] == 1 ) {

		
		$laidelimtx = $_POST['idepereliminartx'];
		
		$con4tx=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
		mysql_select_db($db,$con4tx)or die("Hi ha problemes per connectar amb la base de dades");	
		
		$registre4io=mysql_query("DELETE FROM taxi WHERE TXID='$laidelimtx'")or die("Error en la consulta: ".mysql_error());
		mysql_query("SET NAMES 'utf8'");
		echo "Dades eliminades correctament - <a href=\"pantalla.php#taxi\">Tornar</a>";
	}
	?>	
	
	
	
<br /><br />	
<?php require_once("footer.php"); ?>