<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idsomodificar']) ) {


	$laidmodso = $_POST['idsomodificar'];
	
	$con2modso=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2modso)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3mso=mysql_query("SELECT * FROM serveis WHERE SOID='$laidmodso' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extractemso = mysql_fetch_assoc($registre3mso);
}
?>
	<h1>Editar</h1>
	
	<form action="serveismod_ok.php" autocomplete="off" method="post" name="formborsamod">
	Data: <input type="date" name="somdata" value ="<?php echo utf8_encode($extractemso['SODATA']); ?>" size="8" class="input" />
	Hora: <input type="time" size="10" maxlength="30" name="somhora" value="<?php echo utf8_encode($extractemso['SOHORA']); ?>" maxlength="5" class="input" />
	Ext: <input type="text" name="somextensio" size="5" value="<?php echo utf8_encode($extractemso['SOEXTENSIO']); ?>" maxlength="6" class="input" />
	Centre: 
		<select name="somcentre" class="input" >
	<?php If ($extractemso['SOCENTRE'] == "R") {
					echo "<option value=\"R\" selected=\"selected\">Reus</option>";
		}	 else { echo "<option value=\"R\">Reus</option>";
					}
		If ($extractemso['SOCENTRE'] == "ZF") {
					echo "<option value=\"ZF\" selected=\"selected\">Zona Franca</option>";
		}	 else { echo "<option value=\"ZF\">Zona Franca</option>";
					}		
		If ($extractemso['SOCENTRE'] == "112") {
					echo "<option value=\"112\" selected=\"selected\">112</option>";
		}	 else { echo "<option value=\"112\">112</option>";
					}		
	
	?>
		</select>
	Operatiu: 
		<select name="somoperatiu" class="input" >
	<?php If ($extractemso['SOCOS'] == "Agents Rurals") {
					echo "<option value=\"Agents Rurals\" selected=\"selected\">Agents Rurals</option>";
		}	 else { echo "<option value=\"Agents Rurals\">Agents Rurals</option>";
					}
		If ($extractemso['SOCOS'] == "Bombers") {
					echo "<option value=\"Bombers\" selected=\"selected\">Bombers</option>";
		}	 else { echo "<option value=\"Bombers\">Bombers</option>";
					}		
		If ($extractemso['SOCOS'] == "Creu Roja") {
					echo "<option value=\"Creu Roja\" selected=\"selected\">Creu Roja</option>";
		}	 else { echo "<option value=\"Creu Roja\">Creu Roja</option>";
					}	
		If ($extractemso['SOCOS'] == "Mossos de Seguretat") {
					echo "<option value=\"Mossos de Seguretat\" selected=\"selected\">Mossos de Seguretat</option>";
		}	 else { echo "<option value=\"Mossos de Seguretat\">Mossos de Seguretat</option>";
					}	
		If ($extractemso['SOCOS'] == "Mossos de Trànsit") {
					echo "<option value=\"Mossos de Trànsit\" selected=\"selected\">Mossos de Trànsit</option>";
		}	 else { echo "<option value=\"Mossos de Trànsit\">Mossos de Trànsit</option>";
					}
		If ($extractemso['SOCOS'] == "Policia Local") {
					echo "<option value=\"Policia Local\" selected=\"selected\">Policia Local</option>";
		}	 else { echo "<option value=\"Policia Local\">Policia Local</option>";
					}
		If ($extractemso['SOCOS'] == "Policia Nacional") {
					echo "<option value=\"Policia Nacional\" selected=\"selected\">Policia Nacional</option>";
		}	 else { echo "<option value=\"Policia Nacional\">Policia Nacional</option>";
					}
		If ($extractemso['SOCOS'] == "Salvament Marítim") {
					echo "<option value=\"Salvament Marítim\" selected=\"selected\">Salvament Marítim</option>";
		}	 else { echo "<option value=\"Salvament Marítim\">Salvament Marítim</option>";
					}
		If ($extractemso['SOCOS'] == "Sanitat") {
					echo "<option value=\"Sanitat\" selected=\"selected\">Sanitat</option>";
		}	 else { echo "<option value=\"Sanitat\">Sanitat</option>";
					}
		If ($extractemso['SOCOS'] == "Sords") {
					echo "<option value=\"Sords\" selected=\"selected\">Sords</option>";
		}	 else { echo "<option value=\"Sords\">Sords</option>";
					}
		If ($extractemso['SOCOS'] == "Altres") {
					echo "<option value=\"Altres\" selected=\"selected\">Altres</option>";
		}	 else { echo "<option value=\"Altres\">Altres</option>";
					}					
	
	?>
		</select>
	<br />
	Descripció: <br /><textarea class="input"  name="somdescripcio" rows="4"cols="122" required="true"><?php echo utf8_encode($extractemso['SODESCRIPCIO']); ?>	</textarea>
	<br />
	<input type="hidden" name="somidenviable" value="<?php echo $extractemso['SOID']; ?>"  />
	<input type="submit" value="Modificar"  class="boto" />
	</form>
	<form action="pantalla.php">
	<input type="submit" value="Tornar" class="boto"  />
	</form>
	
	

<br /><br />
<?php require_once("footer.php"); ?>