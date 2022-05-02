<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idmodificaric']) ) {

	

	
	$laidic = $_POST['idmodificaric'];
	
	$con2ic=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2ic)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3ic=mysql_query("SELECT * FROM incidtecniques WHERE ICID='$laidic' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extracteic = mysql_fetch_assoc($registre3ic);
}
?>
	<h1>Editar</h1>
	
	<form action="iceditar_ok.php" autocomplete="off" method="post" name="formiced">
	Data: <input type="date" name="icdata" value ="<?php echo utf8_encode($extracteic['ICDATA']); ?>" size="10" class="input" />
	Hora: <input type="time" name="ichora" size="4" value="<?php echo utf8_encode($extracteic['ICHORA']); ?>" maxlength="5" class="input" />
	Centre: 
		<select name="iccentre" class="input" >
	<?php If ($extracteic['ICCENTRE'] == "Reus") {
					echo "<option value=\"R\" selected=\"selected\">Reus</option>";
		}	 else { echo "<option value=\"R\">Reus</option>";
					}
		If ($extracteic['ICCENTRE'] == "ZonaFranca") {
					echo "<option value=\"ZF\" selected=\"selected\">Zona Franca</option>";
		}	 else { echo "<option value=\"ZF\">Zona Franca</option>";
					}		
		If ($extracteic['ICCENTRE'] == "112") {
					echo "<option value=\"112\" selected=\"selected\">112</option>";
		}	 else { echo "<option value=\"112\">112</option>";
					}		
	
	?>
		</select>
		
	<br />
	Descripció: <br /><textarea class="input"  name="icdescripcio" rows="4"cols="122" required="true"><?php echo utf8_encode($extracteic['ICDESC']); ?>	</textarea>
	<br />
	<input type="hidden" name="idenviableic" value="<?php echo $extracteic['ICID']; ?>"  />
	<input type="submit" value="Modificar"  class="boto" />
	</form>
	<form action="pantalla.php">
	<input type="submit" value="Tornar" class="boto"  />
	</form>
	
	

<br /><br />
<?php require_once("footer.php"); ?>