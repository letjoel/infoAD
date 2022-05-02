<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idmodificaran']) ) {

	

	
	$laidan = $_POST['idmodificaran'];
	
	$con2an=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2an)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3an=mysql_query("SELECT * FROM annexes WHERE ANID='$laidan' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extractean = mysql_fetch_assoc($registre3an);
}
?>
	<h1>Eliminar</h1>
	
<h3>Està segur que vol eliminar les següents dades?</h3> <br/>
<div class="eliminar">
	<b>Data:</b> <?php echo utf8_encode($extractean['ANDATA']); ?> &nbsp
	<b>Arxiu:</b> <?php echo utf8_encode($extractean['ANARXIU']); ?>
	<br />
	<b>Descripció:</b> <br /><?php echo utf8_encode($extractean['ANDESC']); ?>
</div>	
	<br />

	<form action="aneliminar_ok.php" method="POST" name="forma5io">
	<input type="hidden" name="idepereliminaran" value="<?php echo $extractean['ANID']; ?>"  />
	<input type="hidden" name="eliminarsian" value="1"  />	
	<input type="submit" class="boto" value="Eliminar" />	
	</form>
	
	<form action="pantalla.php">
	<input type="submit" class="boto" value="Tornar" />	
	</form>
	

<br />




<?php require_once("footer.php"); ?>