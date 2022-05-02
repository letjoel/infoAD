<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idtxeliminar']) ) {

	

	
	$laidtx = $_POST['idtxeliminar'];
	
	$con2tx=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2tx)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3tx=mysql_query("SELECT * FROM taxi WHERE TXID='$laidtx' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extractetx = mysql_fetch_assoc($registre3tx);
}
?>
	<h1>Eliminar</h1>
	
<h3>Està segur que vol eliminar les següents dades?</h3> <br/>
<div class="eliminar">
	<b>Data:</b> <?php echo utf8_encode($extractetx['TXDATA']); ?> &nbsp
	<b>Hora:</b> <?php echo utf8_encode($extractetx['TXHORA']); ?> &nbsp
	<b>Ext:</b> <?php echo utf8_encode($extractetx['TXEXTENSIO']); ?> &nbsp
	<b>Centre:</b> <?php echo utf8_encode($extractetx['TXCENTRE']); ?>
	<br />
	<b>Descripció:</b> <br /><?php echo utf8_encode($extractetx['TXDESC']); ?>
</div>	
	<br />

	<form action="taxieliminar_ok.php" method="POST" name="forma5tx">
	<input type="hidden" name="idepereliminartx" value="<?php echo $extractetx['TXID']; ?>"  />
	<input type="hidden" name="eliminarsitx" value="1"  />	
	<input type="submit" class="boto" value="Eliminar" />	
	</form>
	
	<form action="pantalla.php">
	<input type="submit" class="boto" value="Tornar" />	
	</form>
	

<br />




<?php require_once("footer.php"); ?>