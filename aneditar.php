<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idmodificaran']) ) {

	$laidan = $_POST['idmodificaran'];
	
	$con2an=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2an)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3an=mysql_query("SELECT * FROM annexes WHERE ANID='$laidan' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extractean = mysql_fetch_assoc($registre3an);
}
?>
	<h1>Editar</h1>
	
	<form action="aneditar_ok.php" autocomplete="off" method="post" name="formaned">
	Data: <input type="date" name="andata" value ="<?php echo utf8_encode($extractean['ANDATA']); ?>" size="10" class="input" />
	Arxiu: <input type="text" name="anarxiu" size="80" maxlength="199" class="input" value="<?php echo utf8_encode($extractean['ANARXIU']); ?>" />	
	<br />
	Descripció: <br /><textarea class="input"  name="andescripcio" rows="4"cols="122" required="true"><?php echo utf8_encode($extractean['ANDESC']); ?>	</textarea>
	<br />
	<input type="hidden" name="idenviablean" value="<?php echo $extractean['ANID']; ?>"  />
	<input type="submit" value="Modificar"  class="boto" />
	</form>
	<form action="pantalla.php">
	<input type="submit" value="Tornar" class="boto"  />
	</form>
	
	

<br /><br />
<?php require_once("footer.php"); ?>