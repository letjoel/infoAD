<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idmodificarob']) ) {

	

	
	$laidob = $_POST['idmodificarob'];
	
	$con2ob=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2ob)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3ob=mysql_query("SELECT * FROM observacions WHERE OBID='$laidob' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extracteob = mysql_fetch_assoc($registre3ob);
}
?>
	<h1>Editar</h1>
	
	<form action="obeditar_ok.php" autocomplete="off" method="post" name="formobed">
	Data: <input type="date" name="obdata" value ="<?php echo utf8_encode($extracteob['OBDATA']); ?>" size="10" class="input" />
	Hora: <input type="time" name="obhora" size="4" value="<?php echo utf8_encode($extracteob['OBHORA']); ?>" maxlength="5" class="input" />
	Centre: 
		<select name="obcentre" class="input" >
	<?php If ($extracteob['OBCENTRE'] == "R") {
					echo "<option value=\"R\" selected=\"selected\">Reus</option>";
		}	 else { echo "<option value=\"R\">Reus</option>";
					}
		If ($extracteob['OBCENTRE'] == "ZF") {
					echo "<option value=\"ZF\" selected=\"selected\">Zona Franca</option>";
		}	 else { echo "<option value=\"ZF\">Zona Franca</option>";
					}		
		If ($extracteob['OBCENTRE'] == "112") {
					echo "<option value=\"112\" selected=\"selected\">112</option>";
		}	 else { echo "<option value=\"112\">112</option>";
					}		
	
	?>
		</select>
		
	<br />
	Descripció: <br /><textarea class="input"  name="obdescripcio" rows="8"cols="122" required="true"><?php echo utf8_encode($extracteob['OBDESC']); ?>	</textarea>
	<br />
	<input type="hidden" name="idenviableob" value="<?php echo $extracteob['OBID']; ?>"  />
	<input type="submit" value="Modificar"  class="boto" />
	</form>
	<form action="pantalla.php">
	<input type="submit" value="Tornar" class="boto"  />
	</form>
	
	

<br /><br />
<?php require_once("footer.php"); ?>