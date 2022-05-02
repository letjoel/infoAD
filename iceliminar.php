<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idmodificaric']) ) {

	

	
	$laidic = $_POST['idmodificaric'];
	
	$con2ic=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2ic)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3ic=mysql_query("SELECT * FROM incidtecniques WHERE ICID='$laidic' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extracteic = mysql_fetch_assoc($registre3ic);
}
?>
	<h1>Eliminar</h1>
	
<h3>Està segur que vol eliminar les següents dades?</h3> <br/>
<div class="eliminar">
	<b>Data:</b> <?php echo utf8_encode($extracteic['ICDATA']); ?> &nbsp
	<b>Hora:</b> <?php echo utf8_encode($extracteic['ICHORA']); ?> &nbsp
	<b>Centre:</b> <?php echo utf8_encode($extracteic['ICCENTRE']); ?>
	<br />
	<b>Descripció:</b> <br /><?php echo utf8_encode($extracteic['ICDESC']); ?>
</div>	
	<br />

	<form action="iceliminar_ok.php" method="POST" name="forma5ic">
	<input type="hidden" name="idepereliminaric" value="<?php echo $extracteic['ICID']; ?>"  />
	<input type="hidden" name="eliminarsiic" value="1"  />	
	<input type="submit" class="boto" value="Eliminar" />	
	</form>
	
	<form action="pantalla.php">
	<input type="submit" class="boto" value="Tornar" />	
	</form>
	

<br />




<?php require_once("footer.php"); ?>