<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idabmodificar']) ) {


	$laidmodab = $_POST['idabmodificar'];
	
	$con2modab=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2modab)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3mab=mysql_query("SELECT * FROM borsa WHERE ABID='$laidmodab' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extractemab = mysql_fetch_assoc($registre3mab);
}
?>
	<h1>Editar</h1>
	
	<form action="borsamod_ok.php" autocomplete="off" method="post" name="formborsamod">
	Data: <input type="date" name="abmdata" value ="<?php echo utf8_encode($extractemab['ABDATA']); ?>" size="8" class="input" />
	Horari: <input type="time" size="10" maxlength="30" name="abmhorari" value="<?php echo utf8_encode($extractemab['ABHORARI']); ?>" maxlength="5" class="input" />
	Centre: 
		<select name="abmcentre" class="input" >
	<?php If ($extractemab['ABCENTRE'] == "R") {
					echo "<option value=\"R\" selected=\"selected\">Reus</option>";
		}	 else { echo "<option value=\"R\">Reus</option>";
					}
		If ($extractemab['ABCENTRE'] == "ZF") {
					echo "<option value=\"ZF\" selected=\"selected\">Zona Franca</option>";
		}	 else { echo "<option value=\"ZF\">Zona Franca</option>";
					}		
		If ($extractemab['ABCENTRE'] == "112") {
					echo "<option value=\"112\" selected=\"selected\">112</option>";
		}	 else { echo "<option value=\"112\">112</option>";
					}		
	
	?>
		</select>
	Gestors activats: <input type="text" size="30" name="abmactivats" value="<?php echo utf8_encode($extractemab['ABACTIVATS']); ?>" size="10" class="input"  />
	<br />
	Motiu: <br /><textarea class="input"  name="abmmotiu" rows="2"cols="122" required="true"><?php echo utf8_encode($extractemab['ABMOTIU']); ?></textarea>
	<br />
	<input type="hidden" name="abmidenviable" value="<?php echo $extractemab['ABID']; ?>"  />
	<input type="submit" value="Modificar"  class="boto" />
	</form>
	<form action="pantalla.php">
	<input type="submit" value="Tornar" class="boto"  />
	</form>
	
	

<br /><br />
<?php require_once("footer.php"); ?>