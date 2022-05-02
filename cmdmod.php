<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("connexio.php"); ?>
<?php	$datashow6z = date('Y-m-d'); ?>

<?php
	// Comandaments - Modificació pas 1
	$datasense6z =  mysql_real_escape_string($datashow6z);

	$con6z=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con6z)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registro6z=mysql_query("SELECT * FROM comandaments WHERE CMDDATA='$datasense6z'")or die("Error en la consulta: ".mysql_error());
	//$extracte6z = mysql_fetch_assoc($registro6z);
	
	while($fila2=mysql_fetch_array($registro6z))
	{	$idcmd2 = $fila2['CMDID'];
		$qui2 = $fila2['CMDQUI'];
		$rang2 = $fila2['CMDRANG'];
		
		if ($rang2=="SPVNR"){
			$SPVNR= "$qui2";
			$idSPVNR= "$idcmd2";
		}		
		if ($rang2=="SPVMR"){
			$SPVMR= "$qui2";
			$idSPVMR= "$idcmd2";
		}
		if ($rang2=="SPVTR"){
			$SPVTR= "$qui2";
			$idSPVTR= "$idcmd2";			
		}		

		if ($rang2=="SPVMZF"){
			$SPVMZF= "$qui2";
			$idSPVMZF= "$idcmd2";			
		}
		if ($rang2=="SPVTZF"){
			$SPVTZF= "$qui2";
			$idSPVTZF= "$idcmd2";			
		}		
		if ($rang2=="SPVNZF"){
			$SPVNZF= "$qui2";
			$idSPVNZF= "$idcmd2";			
		}	
		if ($rang2=="CORMR"){
			$CORMR= "$qui2";
			$idCORMR= "$idcmd2";			
		}	
		if ($rang2=="CORTR"){
			$CORTR= "$qui2";
			$idCORTR= "$idcmd2";			
		}	
		if ($rang2=="CORNR"){
			$CORNR= "$qui2";
			$idCORNR= "$idcmd2";			
		}
		if ($rang2=="CORMZF"){
			$CORMZF= "$qui2";
			$idCORMZF= "$idcmd2";			
		}	
		if ($rang2=="CORTZF"){
			$CORTZF= "$qui2";
			$idCORTZF= "$idcmd2";			
		}	
		if ($rang2=="CORNZF"){
			$CORNZF= "$qui2";
			$idCORNZF= "$idcmd2";			
		}
		if ($rang2=="TSSON"){
			$TSSON= "$qui2";
			$idTSSON= "$idcmd2";			
		}
		if ($rang2=="TSSOM"){
			$TSSOM= "$qui2";
			$idTSSOM= "$idcmd2";			
		}
		if ($rang2=="TSSOT"){
			$TSSOT= "$qui2";
			$idTSSOT= "$idcmd2";			
		}
		
	}	
?>		



<form action="cmdmod_ok.php" autocomplete="off" method="post" name="formcmd">
<u>Reus</u> <br />
Supervisi&oacute; Nit <input type="text" name="SPVNR" value="<?php if (isset($SPVNR) && !empty ($SPVNR)) {echo "$SPVNR";} else{"1";} ?>" size="100" class="input"><input type="hidden" name="idSPVNR" value="<?php if (isset($idSPVNR) && !empty ($idSPVNR)) {echo "$idSPVNR";} else{"";} ?>"><br />
Supervisi&oacute; Mat&iacute; <input type="text" name="SPVMR" value="<?php if (isset($SPVMR) && !empty ($SPVMR)) {echo "$SPVMR";} ?>" size="100" class="input"><input type="hidden" name="idSPVMR" value="<?php if (isset($idSPVMR) && !empty ($idSPVMR)) {echo "$idSPVMR";} else{"";} ?>"><br />

Supervisi&oacute; Tarda <input type="text" name="SPVTR" value="<?php if (isset($SPVTR) && !empty ($SPVTR)) {echo "$SPVTR";} ?>" size="100" class="input"><input type="hidden" name="idSPVTR" value="<?php if (isset($idSPVTR) && !empty ($idSPVTR)) {echo "$idSPVTR";} else{"";} ?>"><br />
Coordinaci&oacute; Nit <input type="text" name="CORNR" value="<?php if (isset($CORNR) && !empty ($CORNR)) {echo "$CORNR";} ?>" size="100" class="input"><input type="hidden" name="idCORNR" value="<?php if (isset($idCORNR) && !empty ($idCORNR)) {echo "$idCORNR";} else{"";} ?>"><br />
Coordinaci&oacute; Mat&iacute; <input type="text" name="CORMR" value="<?php if (isset($CORMR) && !empty ($CORMR)) {echo "$CORMR";} ?>" size="100" class="input"><input type="hidden" name="idCORMR" value="<?php if (isset($idCORMR) && !empty ($idCORMR)) {echo "$idCORMR";} else{"";} ?>"><br />
Coordinaci&oacute; Tarda <input type="text" name="CORTR" value="<?php if (isset($CORTR) && !empty ($CORTR)) {echo "$CORTR";} ?>" size="100" class="input"><input type="hidden" name="idCORTR" value="<?php if (isset($idCORTR) && !empty ($idCORTR)) {echo "$idCORTR";} else{"";} ?>"><br />
<br />
<u>Zona Franca</u> <br />
Supervisi&oacute; Nit <input type="text" name="SPVNZF" value="<?php if (isset($SPVNZF) && !empty ($SPVNZF)) {echo "$SPVNZF";} ?>" size="100" class="input"><input type="hidden" name="idSPVNZF" value="<?php if (isset($idSPVNZF) && !empty ($idSPVNZF)) {echo "$idSPVNZF";} else{"";} ?>"><br />
Supervisi&oacute; Mat&iacute; <input type="text" name="SPVMZF" value="<?php if (isset($SPVMZF) && !empty ($SPVMZF)) {echo "$SPVMZF";} ?>" size="100" class="input"><input type="hidden" name="idSPVMZF" value="<?php if (isset($idSPVMZF) && !empty ($idSPVMZF)) {echo "$idSPVMZF";} else{"";} ?>"><br />
Supervisi&oacute; Tarda <input type="text" name="SPVTZF" value="<?php if (isset($SPVTZF) && !empty ($SPVTZF)) {echo "$SPVTZF";} ?>" size="100" class="input"><input type="hidden" name="idSPVTZF" value="<?php if (isset($idSPVTZF) && !empty ($idSPVTZF)) {echo "$idSPVTZF";} else{"";} ?>"><br />
Coordinaci&oacute; Nit <input type="text" name="CORNZF" value="<?php if (isset($CORNZF) && !empty ($CORNZF)) {echo "$CORNZF";} ?>" size="100" class="input"><input type="hidden" name="idCORNZF" value="<?php if (isset($idCORNZF) && !empty ($idCORNZF)) {echo "$idCORNZF";} else{"";} ?>"><br />
Coordinaci&oacute; Mat&iacute; <input type="text" name="CORMZF" value="<?php if (isset($CORMZF) && !empty ($CORMZF)) {echo "$CORMZF";} ?>" size="100" class="input"><input type="hidden" name="idCORMZF" value="<?php if (isset($idCORMZF) && !empty ($idCORMZF)) {echo "$idCORMZF";} else{"";} ?>"><br />
Coordinaci&oacute; Tarda <input type="text" name="CORTZF" value="<?php if (isset($CORTZF) && !empty ($CORTZF)) {echo "$CORTZF";} ?>" size="100" class="input"><input type="hidden" name="idCORTZF" value="<?php if (isset($idCORTZF) && !empty ($idCORTZF)) {echo "$idCORTZF";} else{"";} ?>"><br />
<br />
<u>TSSO</u> <br />
Nit <input type="text" name="TSSON" value="<?php if (isset($TSSON) && !empty ($TSSON)) {echo "$TSSON";} ?>" size="100" class="input"><input type="hidden" name="idTSSON" value="<?php if (isset($idTSSON) && !empty ($idTSSON)) {echo "$idTSSON";} else{"";} ?>"><br />
Mat&iacute; <input type="text" name="TSSOM" value="<?php if (isset($TSSOM) && !empty ($TSSOM)) {echo "$TSSOM";} ?>" size="100" class="input"><input type="hidden" name="idTSSOM" value="<?php if (isset($idTSSOM) && !empty ($idTSSOM)) {echo "$idTSSOM";} else{"";} ?>"><br />
Tarda <input type="text" name="TSSOT" value="<?php if (isset($TSSOT) && !empty ($TSSOT)) {echo "$TSSOT";} ?>" size="100" class="input"><input type="hidden" name="idTSSOT" value="<?php if (isset($idTSSOT) && !empty ($idTSSOT)) {echo "$idTSSOT";} else{"";} ?>"><br />
<br />
<input type="submit" value="Modificar" class="input" />
</form>
	<form action="pantalla.php">
	<input type="submit" value="Tornar" class="boto"  />	
	</form>
<br /><br />

<?php require_once("footer.php"); ?>