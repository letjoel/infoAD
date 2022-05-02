<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idmodificario']) ) {

	

	
	$laidio = $_POST['idmodificario'];
	
	$con2io=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2io)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3io=mysql_query("SELECT * FROM incidoperativa WHERE IOID='$laidio' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extracteio = mysql_fetch_assoc($registre3io);
}
?>
	<h1>Eliminar</h1>
	
<h3>Està segur que vol eliminar les següents dades?</h3> <br/>
<div class="eliminar">
	<b>Data:</b> <?php echo utf8_encode($extracteio['IODATA']); ?> &nbsp
	<b>Hora:</b> <?php echo utf8_encode($extracteio['IOHORA']); ?> &nbsp
	<b>Centre:</b> <?php echo utf8_encode($extracteio['IOCENTRE']); ?>
	<br />
	<b>Descripció:</b> <br /><?php echo utf8_encode($extracteio['IODESC']); ?>
</div>	
	<br />

	<form action="ioeliminar_ok.php" method="POST" name="forma5io">
	<input type="hidden" name="idepereliminario" value="<?php echo $extracteio['IOID']; ?>"  />
	<input type="hidden" name="eliminarsiio" value="1"  />	
	<input type="submit" class="boto" value="Eliminar" />	
	</form>
	
	<form action="pantalla.php">
	<input type="submit" class="boto" value="Tornar" />	
	</form>
	

<br />




<?php require_once("footer.php"); ?>