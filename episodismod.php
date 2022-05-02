<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idermodificar']) ) {


	$laidmoder = $_POST['idermodificar'];
	
	$con2moder=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2moder)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3mer=mysql_query("SELECT * FROM episodis WHERE ERID='$laidmoder' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extractemer = mysql_fetch_assoc($registre3mer);
}
?>
	<h1>Editar</h1>
	
	<form action="episodismod_ok.php" autocomplete="off" method="post" name="formmodepis">
	Data: <input type="date" name="ermdata" maxlength="10" value ="<?php echo utf8_encode($extractemer['ERDATA']); ?>" size="8" class="input" />
	Hora: <input type="time" size="8" maxlength="8" name="ermhora" value="<?php echo utf8_encode($extractemer['ERHORA']); ?>" maxlength="5" class="input" />
	Acr&ograve;nim: <input type="text" size="30" name="ermacronim" value="<?php echo utf8_encode($extractemer['ERACRONIM']); ?>" size="10" class="input"  />
	<br />
	Descripci&oacute;: <br /><textarea class="input"  name="ermdesc" rows="2"cols="122" required="true"><?php echo utf8_encode($extractemer['ERDESC']); ?></textarea>
	<br />
	<input type="hidden" name="ermidenviable" value="<?php echo $extractemer['ERID']; ?>"  />
	<input type="submit" value="Modificar"  class="boto" />
	</form>
	<form action="pantalla.php">
	<input type="submit" value="Tornar" class="boto"  />
	</form>
	
	

<br /><br />
<?php require_once("footer.php"); ?>