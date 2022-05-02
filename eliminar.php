<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idmodificar']) ) {

	

	
	$laid = $_POST['idmodificar'];
	
	$con2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3=mysql_query("SELECT * FROM activitat WHERE ID='$laid' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extracte = mysql_fetch_assoc($registre3);
}
?>
	<h1>Eliminar</h1>
	
<h3>Està segur que vol eliminar les següents dades?</h3> <br/>
<div class="eliminar">
	<b>Data:</b> <?php echo utf8_encode($extracte['DATA']); ?>
	<b>Hora:</b> <?php echo utf8_encode($extracte['HORA']); ?>
	<b>Ext:</b> <?php echo utf8_encode($extracte['EXTENSIO']); ?>
	<b>Expedient:</b> <?php echo utf8_encode($extracte['EXPEDIENT']); ?>
	<b>Centre:</b> <?php echo utf8_encode($extracte['CENTRE']); ?>
	<b>Codi:</b> <?php echo utf8_encode($extracte['CODI']); ?>
	<b>Municipi:</b> 
		<?php
		$extn = utf8_encode($extracte['MUNICIPI']);
		echo "$extn";
		?>
	<br />
	<b>Descripció:</b> <br /><?php echo utf8_encode($extracte['DESCRIPCIO']); ?>
</div>	
	<br />

	<form action="eliminar_ok.php" method="POST" name="forma5">
	<input type="hidden" name="idepereliminar" value="<?php echo $extracte['ID']; ?>"  />
	<input type="hidden" name="eliminarsi" value="1"  />	
	<input type="submit" class="boto" value="Eliminar" />	
	</form>
	
	<form action="pantalla.php">
	<input type="submit" class="boto" value="Tornar" />	
	</form>
	






<?php require_once("footer.php"); ?>