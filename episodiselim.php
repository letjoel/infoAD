<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idereliminar']) ) 

{
	$laiderel = $_POST['idereliminar'];

	$con22er=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con22er)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre33er=mysql_query("SELECT * FROM episodis WHERE ERID='$laiderel' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extracteerel = mysql_fetch_assoc($registre33er);
}
?>
	<h1>Eliminar</h1>
	
<h3>Està segur que vol eliminar les següents dades?</h3> <br/>
<div class="eliminar">
	<b>Data:</b> <?php echo utf8_encode($extracteerel['ERDATA']); ?>
	<b>Hora:</b> <?php echo utf8_encode($extracteerel['ERHORA']); ?>
	<b>Acr&ograve;nim:</b> <?php echo utf8_encode($extracteerel['ERACRONIM']); ?>
	<b>Descripci&oacute;</b> <?php echo utf8_encode($extracteerel['ERDESC']); ?><br />
	<br />
</div><br />
	<form action="episodiselim_ok.php" method="POST" name="forma5erel">
	<input type="hidden" name="idepereliminarer" value="<?php echo $extracteerel['ERID']; ?>"  />
	<input type="hidden" name="ereliminarsi" value="1"  />	
	<input type="submit" class="boto" value="Eliminar" />	
	</form>
	
	<form action="pantalla.php">
	<input type="submit" class="boto" value="Tornar" />	
	</form>






<br />
<?php require_once("footer.php"); ?>