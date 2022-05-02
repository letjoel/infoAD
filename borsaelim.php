<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idabeliminar']) ) 

{
	$laidab = $_POST['idabeliminar'];

	$con22ab=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con22ab)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre33ab=mysql_query("SELECT * FROM borsa WHERE ABID='$laidab' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extracteab = mysql_fetch_assoc($registre33ab);
}
?>
	<h1>Eliminar</h1>
	
<h3>Està segur que vol eliminar les següents dades?</h3> <br/>
<div class="eliminar">
	<b>Data:</b> <?php echo utf8_encode($extracteab['ABDATA']); ?>
	<b>Horari:</b> <?php echo utf8_encode($extracteab['ABHORARI']); ?>
	<b>Centre:</b> <?php echo utf8_encode($extracteab['ABCENTRE']); ?>
	<b>Gestors activats:</b> <?php echo utf8_encode($extracteab['ABACTIVATS']); ?><br />
	<b>Motius:</b> <?php echo utf8_encode($extracteab['ABMOTIU']); ?>
	<br />
</div><br />
	<form action="borsaelim_ok.php" method="POST" name="forma5ab">
	<input type="hidden" name="idepereliminarab" value="<?php echo $extracteab['ABID']; ?>"  />
	<input type="hidden" name="abeliminarsi" value="1"  />	
	<input type="submit" class="boto" value="Eliminar" />	
	</form>
	
	<form action="pantalla.php">
	<input type="submit" class="boto" value="Tornar" />	
	</form>






<br />
<?php require_once("footer.php"); ?>