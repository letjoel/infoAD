<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['iditmodificar']) ) {


	$laidmodit = $_POST['iditmodificar'];
	
	$con2modit=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2modit)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3mit=mysql_query("SELECT * FROM incidtaxis WHERE ITID='$laidmodit' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extractemit = mysql_fetch_assoc($registre3mit);
}
?>
	<h1>Editar</h1>
	
	<form action="incidtaxismod_ok.php" autocomplete="off" method="post" name="formitmumod">
	Data: <input type="date" name="itmdata" value ="<?php echo utf8_encode($extractemit['ITDATA']); ?>" size="8" class="input" /><br />
	Hora: <input type="time" size="10" maxlength="30" name="itmhora" value="<?php echo utf8_encode($extractemit['ITHORA']); ?>" maxlength="5" class="input" />
	Ext: <input type="text" name="itmextensio" size="5" value="<?php echo utf8_encode($extractemit['ITEXTENSIO']); ?>" maxlength="6" class="input" />
	Centre: 
		<select name="itmcentre" class="input" >
	<?php If ($extractemit['ITCENTRE'] == "R") {
					echo "<option value=\"R\" selected=\"selected\">Reus</option>";
		}	 else { echo "<option value=\"R\">Reus</option>";
					}
		If ($extractemit['ITCENTRE'] == "ZF") {
					echo "<option value=\"ZF\" selected=\"selected\">Zona Franca</option>";
		}	 else { echo "<option value=\"ZF\">Zona Franca</option>";
					}		
		If ($extractemit['ITCENTRE'] == "112") {
					echo "<option value=\"112\" selected=\"selected\">112</option>";
		}	 else { echo "<option value=\"112\">112</option>";
					}		
	
	?>
		</select>
	Tipus: 
		<select name="itmtipus" class="input" >
	<?php If ($extractemit['ITTIPUS'] == "Taxi no respon") {
					echo "<option value=\"Taxi no respon\" selected=\"selected\">Taxi no respon</option>";
		}	 else { echo "<option value=\"Taxi no respon\">Taxi no respon</option>";
					}
		If ($extractemit['ITTIPUS'] == "Taxi no monitoritzat") {
					echo "<option value=\"Taxi no monitoritzat\" selected=\"selected\">Taxi no monitoritzat</option>";
		}	 else { echo "<option value=\"Taxi no monitoritzat\">Taxi no monitoritzat</option>";
					}		
		If ($extractemit['ITTIPUS'] == "Taxi repetitiu") {
					echo "<option value=\"Taxi repetitiu\" selected=\"selected\">Taxi repetitiu</option>";
		}	 else { echo "<option value=\"Taxi repetitiu\">Taxi repetitiu</option>";
					}		
		
	?>
		</select>
	Llicència*: <input type="text" name="itmllicencia" size="8" maxlength="14" class="input" value="<?php echo utf8_encode($extractemit['ITLLICENCIES']); ?>" />	<br />
	Id.Carta: <input type="text" name="itmexpedient" size="14" value="<?php echo utf8_encode($extractemit['ITEXP']); ?>" maxlength="14" class="input" />
	Núm. trucades: <input type="number" class="input" name="itmnumtruc" size="1" maxlength="3" min="0" max="999" value="<?php echo utf8_encode($extractemit['ITNUMTRUC']); ?>" /> 
	
	<br />
	<input type="hidden" name="itmidenviable" value="<?php echo $extractemit['ITID']; ?>"  />
	<input type="submit" value="Modificar"  class="boto" />
	</form>
	<form action="pantalla.php">
	<input type="submit" value="Tornar" class="boto"  />
	</form>
	
	

<br /><br />
<?php require_once("footer.php"); ?>