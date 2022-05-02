<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idsimodificar']) ) {


	$laidmodsi = $_POST['idsimodificar'];
	
	$con2modsi=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2modsi)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3msi=mysql_query("SELECT * FROM simulacres WHERE SIID='$laidmodsi' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extractemsi = mysql_fetch_assoc($registre3msi);
}
?>
	<h1>Editar</h1>
	
	<form action="simulacresmod_ok.php" autocomplete="off" method="post" name="formsimumod">
	Data: <input type="date" name="simdata" value ="<?php echo utf8_encode($extractemsi['SIDATA']); ?>" size="8" class="input" />
	Hora: <input type="time" size="10" maxlength="30" name="simhora" value="<?php echo utf8_encode($extractemsi['SIHORA']); ?>" maxlength="5" class="input" />
	Ext: <input type="text" name="simextensio" size="5" value="<?php echo utf8_encode($extractemsi['SIEXTENSIO']); ?>" maxlength="6" class="input" />
	Centre: 
		<select name="simcentre" class="input" >
	<?php If ($extractemsi['SICENTRE'] == "R") {
					echo "<option value=\"R\" selected=\"selected\">Reus</option>";
		}	 else { echo "<option value=\"R\">Reus</option>";
					}
		If ($extractemsi['SICENTRE'] == "ZF") {
					echo "<option value=\"ZF\" selected=\"selected\">Zona Franca</option>";
		}	 else { echo "<option value=\"ZF\">Zona Franca</option>";
					}		
		If ($extractemsi['SICENTRE'] == "112") {
					echo "<option value=\"112\" selected=\"selected\">112</option>";
		}	 else { echo "<option value=\"112\">112</option>";
					}		
	
	?>
		</select>
	Operatiu: 
		<select name="simtipus" class="input" >
	<?php If ($extractemsi['SITIPUS'] == "Programat") {
					echo "<option value=\"Programat\" selected=\"selected\">Programat</option>";
		}	 else { echo "<option value=\"Programat\">Programat</option>";
					}
		If ($extractemsi['SITIPUS'] == "No programat") {
					echo "<option value=\"No programat\" selected=\"selected\">No programat</option>";
		}	 else { echo "<option value=\"No programat\">No programat</option>";
					}		
	
	?>
		</select>
	<br />
	Descripció: <br /><textarea class="input"  name="simdescripcio" rows="4"cols="122" required="true"><?php echo utf8_encode($extractemsi['SIDESC']); ?>	</textarea>
	<br />
	<input type="hidden" name="simidenviable" value="<?php echo $extractemsi['SIID']; ?>"  />
	<input type="submit" value="Modificar"  class="boto" />
	</form>
	<form action="pantalla.php">
	<input type="submit" value="Tornar" class="boto"  />
	</form>
	
	

<br /><br />
<?php require_once("footer.php"); ?>