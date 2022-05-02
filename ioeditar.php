<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idmodificario']) ) {

	

	
	$laidio = $_POST['idmodificario'];
	
	$con2io=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2io)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3io=mysql_query("SELECT * FROM incidoperativa WHERE IOID='$laidio' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extracteio = mysql_fetch_assoc($registre3io);
}
?>
	<h1>Editar</h1>
	
	<form action="ioeditar_ok.php" autocomplete="off" method="post" name="formioed">
	Data: <input type="date" name="iodata" value ="<?php echo utf8_encode($extracteio['IODATA']); ?>" size="10" class="input" />
	Hora: <input type="time" name="iohora" size="4" value="<?php echo utf8_encode($extracteio['IOHORA']); ?>" maxlength="5" class="input" />
	Centre: 
		<select name="iocentre" class="input" >
	<?php If ($extracteio['IOCENTRE'] == "R") {
					echo "<option value=\"R\" selected=\"selected\">Reus</option>";
		}	 else { echo "<option value=\"R\">Reus</option>";
					}
		If ($extracteio['IOCENTRE'] == "ZF") {
					echo "<option value=\"ZF\" selected=\"selected\">Zona Franca</option>";
		}	 else { echo "<option value=\"ZF\">Zona Franca</option>";
					}		
		If ($extracteio['IOCENTRE'] == "112") {
					echo "<option value=\"112\" selected=\"selected\">112</option>";
		}	 else { echo "<option value=\"112\">112</option>";
					}		
	
	?>
		</select>
		
	<br />
	Descripció: <br /><textarea class="input"  name="iodescripcio" rows="8"cols="122" required="true"><?php echo utf8_encode($extracteio['IODESC']); ?>	</textarea>
	<br />
	<input type="hidden" name="idenviableio" value="<?php echo $extracteio['IOID']; ?>"  />
	<input type="submit" value="Modificar"  class="boto" />
	</form>
	<form action="pantalla.php">
	<input type="submit" value="Tornar" class="boto"  />
	</form>
	
	

<br /><br />
<?php require_once("footer.php"); ?>