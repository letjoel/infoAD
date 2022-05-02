<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['cdidmodificar']) ) 

{
	$laidcdel = $_POST['cdidmodificar'];

	$con22cd=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con22cd)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre33cd=mysql_query("SELECT * FROM control WHERE CDID='$laidcdel' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extractecdel = mysql_fetch_assoc($registre33cd);
}
?>
	<h1>Eliminar</h1>
	
<h3>Està segur que vol eliminar les següents dades?</h3> <br/>
<div class="eliminar">
	<b>Data:</b> <?php echo utf8_encode($extractecdel['CDDATA']); ?>
	<b>Hora:</b> <?php echo utf8_encode($extractecdel['CDHORA']); ?>
	<b>Tipus:</b> <?php echo utf8_encode($extractecdel['CDTIPUS']); ?><br />
	<b>Descripci&oacute;:</b> <?php echo utf8_encode($extractecdel['CDDESC']); ?>
	<br />
</div>
	<br />
	<form action="cdeliminar_ok.php" method="POST" name="forma5cdel">
	<input type="hidden" name="idepereliminarcd" value="<?php echo $extractecdel['CDID']; ?>"  />
	<input type="hidden" name="cdeliminarsi" value="1"  />	
	<input type="submit" class="boto" value="Eliminar" />	
	</form>
	
	<form action="pantalla.php">
	<input type="submit" class="boto" value="Tornar" />	
	</form>






<br />
<?php require_once("footer.php"); ?>