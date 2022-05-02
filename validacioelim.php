<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idvaeliminar']) ) {

	

	
	$laidvael = $_POST['idvaeliminar'];
	
	$con2vael=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2vael)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3vael=mysql_query("SELECT * FROM validacions WHERE VAID='$laidvael' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extractevael = mysql_fetch_assoc($registre3vael);
}
?>
	<h1>Eliminar</h1>
	
<h3>Està segur que vol eliminar les següents dades?</h3> <br/>
<div class="eliminar">
	<b>Data:</b> <?php echo utf8_encode($extractevael['VADATA']); ?>&nbsp
	<b>Llicències:</b> <?php echo utf8_encode($extractevael['VALLICENCIES']); ?>&nbsp
	<b>OK:</b> <?php echo utf8_encode($extractevael['VAOK']); ?>&nbsp
	<b>KO:</b> <?php echo utf8_encode($extractevael['VAKO']); ?>&nbsp
	<b>Efectivitat:</b> <?php echo utf8_encode($extractevael['VAEFECT']); ?>&nbsp
	<b>Torn:</b> <?php echo utf8_encode($extractevael['VATORN']); ?>&nbsp
	<b>Gestor:</b> <?php echo utf8_encode($extractevael['VAGESTOR']); ?>&nbsp
<?php 
	echo "<b>Possibilitat de realitzar taxis: </b> ";
	if ($extractevael['VANP'] == 1) 
	{
	echo "NP"; 
	}else 
		{
		echo "P";
		}
	?>
</div>	
	<br />

	<form action="validacioelim_ok.php" method="POST" name="forma5vael">
	<input type="hidden" name="idepereliminarvael" value="<?php echo $extractevael['VAID']; ?>"  />
	<input type="hidden" name="eliminarsivael" value="1"  />	
	<input type="submit" class="boto" value="Eliminar" />	
	</form>
	
	<form action="pantalla.php">
	<input type="submit" class="boto" value="Tornar" />	
	</form>
	


<br />
<br />



<?php require_once("footer.php"); ?>