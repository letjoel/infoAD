<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['iditeliminar']) ) 

{
	$laidit = $_POST['iditeliminar'];

	$con22it=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con22it)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre33it=mysql_query("SELECT * FROM incidtaxis WHERE ITID='$laidit' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extracteit = mysql_fetch_assoc($registre33it);
}
?>
	<h1>Eliminar</h1>
	
<h3>Està segur que vol eliminar les següents dades?</h3> <br/>
<div class="eliminar">
	<b>Data:</b> <?php echo utf8_encode($extracteit['ITDATA']); ?> &nbsp
	<b>Hora:</b> <?php echo utf8_encode($extracteit['ITHORA']); ?> &nbsp
	<b>Ext:</b> <?php echo utf8_encode($extracteit['ITEXTENSIO']); ?> &nbsp
	<b>Centre:</b> <?php echo utf8_encode($extracteit['ITCENTRE']); ?> &nbsp
	<b>Tipus:</b> <?php echo utf8_encode($extracteit['ITTIPUS']); ?> &nbsp
	<b>Llicència:</b> <?php echo utf8_encode($extracteit['ITLLICENCIES']); ?> &nbsp
	<b>Id.Carta:</b> <?php echo utf8_encode($extracteit['ITEXP']); ?> &nbsp
	<b>Nº Trucades:</b> <?php echo utf8_encode($extracteit['ITNUMTRUC']); ?> 
	<br />

</div><br />
	<form action="incidtaxiselim_ok.php" method="POST" name="forma5it">
	<input type="hidden" name="idepereliminarit" value="<?php echo $extracteit['ITID']; ?>"  />
	<input type="hidden" name="iteliminar" value="1"  />	
	<input type="submit" class="boto" value="Eliminar" />	
	</form>
	
	<form action="pantalla.php">
	<input type="submit" class="boto" value="Tornar" />	
	</form>






<br />
<?php require_once("footer.php"); ?>