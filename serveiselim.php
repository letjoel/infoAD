<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idsoeliminar']) ) 

{
	$laidso = $_POST['idsoeliminar'];

	$con22so=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con22so)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre33so=mysql_query("SELECT * FROM serveis WHERE SOID='$laidso' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extracteso = mysql_fetch_assoc($registre33so);
}
?>
	<h1>Eliminar</h1>
	
<h3>Està segur que vol eliminar les següents dades?</h3> <br/>
<div class="eliminar">
	<b>Data:</b> <?php echo utf8_encode($extracteso['SODATA']); ?> &nbsp
	<b>Hora:</b> <?php echo utf8_encode($extracteso['SOHORA']); ?> &nbsp
	<b>Ext:</b> <?php echo utf8_encode($extracteso['SOEXTENSIO']); ?> &nbsp
	<b>Centre:</b> <?php echo utf8_encode($extracteso['SOCENTRE']); ?> &nbsp
	<b>Cos Operatiu:</b> <?php echo utf8_encode($extracteso['SOCOS']); ?>
	<br />
	<b>Descripció:</b> <?php echo utf8_encode($extracteso['SODESCRIPCIO']); ?>
	<br />
</div><br />
	<form action="serveiselim_ok.php" method="POST" name="forma5so">
	<input type="hidden" name="idepereliminarso" value="<?php echo $extracteso['SOID']; ?>"  />
	<input type="hidden" name="soeliminarsi" value="1"  />	
	<input type="submit" class="boto" value="Eliminar" />	
	</form>
	
	<form action="pantalla.php">
	<input type="submit" class="boto" value="Tornar" />	
	</form>






<br />
<?php require_once("footer.php"); ?>