<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idtxmodificar']) ) {

	

	
	$laidtx = $_POST['idtxmodificar'];
	
	$con2tx=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2tx)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3tx=mysql_query("SELECT * FROM taxi WHERE TXID='$laidtx' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extractetx = mysql_fetch_assoc($registre3tx);
}
?>
	<h1>Editar</h1>
	
	<form action="taxieditar_ok.php" autocomplete="off" method="post" name="formtxed">
	Data: <input type="date" name="txdata" value ="<?php echo utf8_encode($extractetx['TXDATA']); ?>" size="10" class="input" />
	Hora: <input type="time" name="txhora" size="4" value="<?php echo utf8_encode($extractetx['TXHORA']); ?>" maxlength="5" class="input" />
	Ext: <input type="text" name="txextensio" size="5" value="<?php echo utf8_encode($extractetx['TXEXTENSIO']); ?>" maxlength="6" class="input" />
	Centre: 
		<select name="txcentre" class="input" >
	<?php If ($extractetx['TXCENTRE'] == "Reus") {
					echo "<option value=\"R\" selected=\"selected\">Reus</option>";
		}	 else { echo "<option value=\"R\">Reus</option>";
					}
		If ($extractetx['TXCENTRE'] == "ZonaFranca") {
					echo "<option value=\"ZF\" selected=\"selected\">Zona Franca</option>";
		}	 else { echo "<option value=\"ZF\">Zona Franca</option>";
					}		
		If ($extractetx['TXCENTRE'] == "112") {
					echo "<option value=\"112\" selected=\"selected\">112</option>";
		}	 else { echo "<option value=\"112\">112</option>";
					}		
	
	?>
		</select>
		
	<br />
	Descripció: <br /><textarea class="input"  name="txdescripcio" rows="8"cols="122" required="true"><?php echo utf8_encode($extractetx['TXDESC']); ?>	</textarea>
	<br />
	<input type="hidden" name="idenviabletx" value="<?php echo $extractetx['TXID']; ?>"  />
	<input type="submit" value="Modificar"  class="boto" />
	</form>
	<form action="pantalla.php">
	<input type="submit" value="Tornar" class="boto"  />
	</form>
	
	

<br /><br />
<?php require_once("footer.php"); ?>