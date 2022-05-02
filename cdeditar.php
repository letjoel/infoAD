<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['cdidmodificar']) ) {

	
	$laidcded = $_POST['cdidmodificar'];
	
	$con2cded=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2cded)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3cded=mysql_query("SELECT * FROM control WHERE CDID='$laidcded' limit 1")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extractecded = mysql_fetch_assoc($registre3cded);
}
?>
	<h1>Editar</h1>
	
	<form action="cdeditar_ok.php" autocomplete="off" method="post" name="formcded">
	Data: <input type="date" name="cdeddata" value ="<?php echo utf8_encode($extractecded['CDDATA']); ?>" size="8" class="input" />
	Hora: <input type="time" size="10" maxlength="30" name="cdedhora" value="<?php echo utf8_encode($extractecded['CDHORA']); ?>" maxlength="5" class="input" />
	Centre: 
		<select name="cdedtipus" class="input" >
	<?php If ($extractecded['CDTIPUS'] == "Plans d'emergència activats") {
					echo "<option value=\"Plans d'emergència activats\" selected=\"selected\">Plans d'emergència activats</option>";
		}	 else { echo "<option value=\"Plans d'emergència activats\">Plans d'emergència activats</option>";
					}
		If ($extractecded['CDTIPUS'] == "Episodis rellevants activats") {
					echo "<option value=\"Episodis rellevants activats\" selected=\"selected\">Episodis rellevants activats</option>";
		}	 else { echo "<option value=\"Episodis rellevants activats\">Episodis rellevants activats</option>";
					}		
		If ($extractecded['CDTIPUS'] == "Telèfons d'agències no operatius") {
					echo "<option value=\"Telèfons d'agències no operatius\" selected=\"selected\">Telèfons d'agències no operatius</option>";
		}	 else { echo "<option value=\"Telèfons d'agències no operatius\">Telèfons d'agències no operatius</option>";
					}		
		If ($extractecded['CDTIPUS'] == "Altres contingències eventuals") {
					echo "<option value=\"Altres contingències eventuals\" selected=\"selected\">Altres contingències eventuals</option>";
		}	 else { echo "<option value=\"Altres contingències eventuals\">Altres contingències eventuals</option>";
					}		
	
	?>
		</select>
	<br />
	Descripci&oacute;: <br /><textarea class="input"  name="cdeddesc" rows="2"cols="122" required="true"><?php echo utf8_encode($extractecded['CDDESC']); ?></textarea>
	<br />
	<input type="hidden" name="cdedidenviable" value="<?php echo $extractecded['CDID']; ?>"  />
	<input type="submit" value="Modificar"  class="boto" />
	</form>
	<form action="pantalla.php">
	<input type="submit" value="Tornar" class="boto"  />
	</form>
	
	

<br /><br />
<?php require_once("footer.php"); ?>