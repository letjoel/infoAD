<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

	<?php
	//Si hi ha informacio modificada i enviada s'enviara a la BD
	if (isset ($_POST['vadata']) && !empty($_POST['vadata']) )
	{ 
	
	$e_vadata = $_POST['vadata'];
	$e_vallicencies = $_POST['vallicencies'];
	$e_vaok = $_POST['vaok'];
	$e_vako = $_POST['vako'];
	$e_vagestor = $_POST['vagestor'];
	$e_vatorn = $_POST['vatorn'];
	$e_vanp = $_POST['vanp'];
	$e_idva = $_POST['idenviableva'];
	
	//afegim slah a totes les cometes mitjançant escape
	$e_vadata2 =  mysql_real_escape_string($e_vadata);
	$e_vallicencies2 =  mysql_real_escape_string($e_vallicencies);
	$e_vaok2 =  mysql_real_escape_string($e_vaok);
	$e_vako2 =  mysql_real_escape_string($e_vako);
	$e_vagestor2 =  mysql_real_escape_string($e_vagestor);
	$e_vatorn2 =  mysql_real_escape_string($e_vatorn);
	
	if ($e_vallicencies2 != 0) 
	{
	$refectivitata = $e_vaok2 + $e_vako2;
	$refectivitatb = $refectivitata * 100;
	$refectivitat = $refectivitatb / $e_vallicencies2;
	} else 
		{
		$refectivitat	 = 0;
		}

	$con3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexio");
	mysql_select_db($db,$con3)or die("Hi ha problemes per connectar amb la base de dades");	
	mysql_query("SET NAMES 'utf8'");	
	
	$registre4=mysql_query("UPDATE validacions SET VADATA='$e_vadata2', VALLICENCIES='$e_vallicencies2', VAOK='$e_vaok2',
		VAKO='$e_vako2', VAEFECT ='$refectivitat', VAGESTOR='$e_vagestor2', VANP='$e_vanp', VATORN='$e_vatorn2', VAAUTOR='$nomusuari' 
		WHERE VAID='$e_idva'")or die("Error en la consulta: ".mysql_error());

	echo "Dades modificades correctament - <a href=\"pantalla.php#validacions\">Tornar</a>";
	}
	
	?>
	<br />
	<br />
<?php require_once("footer.php"); ?>