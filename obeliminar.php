<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['ideliminarob']) ) {

	

	
	$laidob = $_POST['ideliminarob'];
	
	$con2ob=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2ob)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3ob=mysql_query("SELECT * FROM observacions WHERE OBID='$laidob' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extracteob = mysql_fetch_assoc($registre3ob);
}
?>
	<h1>Eliminar</h1>
	
<h3>Està segur que vol eliminar les següents dades?</h3> <br/>
<div class="eliminar">
	<b>Data:</b> <?php echo utf8_encode($extracteob['OBDATA']); ?> &nbsp
	<b>Hora:</b> <?php echo utf8_encode($extracteob['OBHORA']); ?> &nbsp
	<b>Centre:</b> <?php echo utf8_encode($extracteob['OBCENTRE']); ?>
	<br />
	<b>Descripció:</b> <br /><?php echo utf8_encode($extracteob['OBDESC']); ?>
</div>	
	<br />

	<form action="obeliminar_ok.php" method="POST" name="forma5ob">
	<input type="hidden" name="idepereliminarob" value="<?php echo $extracteob['OBID']; ?>"  />
	<input type="hidden" name="eliminarsiob" value="1"  />	
	<input type="submit" class="boto" value="Eliminar" />	
	</form>
	
	<form action="pantalla.php">
	<input type="submit" class="boto" value="Tornar" />	
	</form>
	

<br />




<?php require_once("footer.php"); ?>