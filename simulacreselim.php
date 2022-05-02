<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idsieliminar']) ) 

{
	$laidsi = $_POST['idsieliminar'];

	$con22si=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con22si)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre33si=mysql_query("SELECT * FROM simulacres WHERE SIID='$laidsi' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extractesi = mysql_fetch_assoc($registre33si);
}
?>
	<h1>Eliminar</h1>
	
<h3>Està segur que vol eliminar les següents dades?</h3> <br/>
<div class="eliminar">
	<b>Data:</b> <?php echo utf8_encode($extractesi['SIDATA']); ?> &nbsp
	<b>Hora:</b> <?php echo utf8_encode($extractesi['SIHORA']); ?> &nbsp
	<b>Ext:</b> <?php echo utf8_encode($extractesi['SIEXTENSIO']); ?> &nbsp
	<b>Centre:</b> <?php echo utf8_encode($extractesi['SICENTRE']); ?> &nbsp
	<b>Tipus:</b> <?php echo utf8_encode($extractesi['SITIPUS']); ?> 
	<br />
	<b>Descripció:</b> <?php echo utf8_encode($extractesi['SIDESC']); ?>
	<br />
</div><br />
	<form action="simulacreselim_ok.php" method="POST" name="forma5so">
	<input type="hidden" name="idepereliminarsi" value="<?php echo $extractesi['SIID']; ?>"  />
	<input type="hidden" name="sieliminarsi" value="1"  />	
	<input type="submit" class="boto" value="Eliminar" />	
	</form>
	
	<form action="pantalla.php">
	<input type="submit" class="boto" value="Tornar" />	
	</form>






<br />
<?php require_once("footer.php"); ?>