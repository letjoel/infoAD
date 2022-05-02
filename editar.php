<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idmodificar']) ) {

	

	
	$laid = $_POST['idmodificar'];
	
	$con2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3=mysql_query("SELECT * FROM activitat WHERE ID='$laid' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extracte = mysql_fetch_assoc($registre3);
}
?>
	<h1>Editar</h1>
	
	<form action="editar_ok.php" autocomplete="off" method="post" name="form">
	Data: <input type="date" name="data" value ="<?php echo utf8_encode($extracte['DATA']); ?>" size="10" class="input" />
	Hora: <input type="time" name="hora" size="4" value="<?php echo utf8_encode($extracte['HORA']); ?>" maxlength="5" class="input" />
	Ext: <input type="text" name="extensio" size="5" value="<?php echo utf8_encode($extracte['EXTENSIO']); ?>" maxlength="6" class="input" />
	Expedient: <input type="text" name="expedient" size="12" value="<?php echo utf8_encode($extracte['EXPEDIENT']); ?>" maxlength="14" class="input" />
	Centre: 
		<select name="centre" class="input" >
	<?php If ($extracte['CENTRE'] == "R") {
					echo "<option value=\"R\" selected=\"selected\">Reus</option>";
		}	 else { echo "<option value=\"R\">Reus</option>";
					}
		If ($extracte['CENTRE'] == "ZF") {
					echo "<option value=\"ZF\" selected=\"selected\">Zona Franca</option>";
		}	 else { echo "<option value=\"ZF\">Zona Franca</option>";
					}		
		If ($extracte['CENTRE'] == "112") {
					echo "<option value=\"112\" selected=\"selected\">112</option>";
		}	 else { echo "<option value=\"112\">112</option>";
					}		
	
	?>
		</select>
	Codi: <input type="text" name="codi" value="<?php echo utf8_encode($extracte['CODI']); ?>" size="10" class="input"  />
	Municipi: 
		<select name="munixipi" class="input" >
		<?php
			$extn = utf8_encode($extracte['MUNICIPI']);
			$k = 0;
		for ($k=0;$k<7381;$k++) {
			//dins del bucle comprovem si es el valor seleccionat
			if($municipis[$k]==$extn) 
				{$seleccionado=" selected=\"selected\" ";} 
					else {$seleccionado=' ';}
			//ho afegim
			echo "<option value=\"$municipis[$k]\" $seleccionado >$municipis[$k]</option>\r";
		} 			
?>	
		</select>
		
	<br />
	Descripció: <br /><textarea class="input"  name="descripcio" rows="8"cols="122" required="true"><?php echo utf8_encode($extracte['DESCRIPCIO']); ?>	</textarea>
	<br />
	<input type="hidden" name="idenviable" value="<?php echo $extracte['ID']; ?>"  />
	<input type="submit" value="Modificar"  class="boto" />
	</form>
	<form action="pantalla.php">
	<input type="submit" value="Tornar" class="boto"  />
	</form>
	
	

<br /><br />
<?php require_once("footer.php"); ?>