<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("connexio.php"); ?>

<?php	$datamostra = $_POST['dataconsultada']; ?>
<?php   $datasense3 =  mysql_real_escape_string($datamostra); ?>
<?php

	$cmd_SPVNR = $_POST['SPVNR'];
	$cmd_SPVMR = $_POST['SPVMR'];
	$cmd_SPVTR = $_POST['SPVTR'];
	$cmd_SPVNZF = $_POST['SPVNZF'];
	$cmd_SPVMZF = $_POST['SPVMZF'];
	$cmd_SPVTZF = $_POST['SPVTZF'];
	$cmd_CORNR = $_POST['CORNR'];
	$cmd_CORMR = $_POST['CORMR'];
	$cmd_CORTR = $_POST['CORTR'];
	$cmd_CORNZF = $_POST['CORNZF'];
	$cmd_CORMZF = $_POST['CORMZF'];
	$cmd_CORTZF = $_POST['CORTZF'];
	$cmd_TSSON = $_POST['TSSON'];
	$cmd_TSSOM = $_POST['TSSOM'];
	$cmd_TSSOT = $_POST['TSSOT'];
	
	$id_SPVNR = $_POST['idSPVNR'];
	$id_SPVMR = $_POST['idSPVMR'];
	$id_SPVTR = $_POST['idSPVTR'];
	$id_SPVNZF = $_POST['idSPVNZF'];
	$id_SPVMZF = $_POST['idSPVMZF'];
	$id_SPVTZF = $_POST['idSPVTZF'];
	$id_CORNR = $_POST['idCORNR'];
	$id_CORMR = $_POST['idCORMR'];
	$id_CORTR = $_POST['idCORTR'];
	$id_CORNZF = $_POST['idCORNZF'];
	$id_CORMZF = $_POST['idCORMZF'];
	$id_CORTZF = $_POST['idCORTZF'];
	$id_TSSON = $_POST['idTSSON'];
	$id_TSSOM = $_POST['idTSSOM'];
	$id_TSSOT = $_POST['idTSSOT'];


	//afegim slash a totes les cometes mitjançant escape
	$cmd_SPVNR2 =  mysql_real_escape_string($cmd_SPVNR);
	$cmd_SPVTR2 =  mysql_real_escape_string($cmd_SPVTR);
	$cmd_SPVMR2 =  mysql_real_escape_string($cmd_SPVMR);
	$cmd_SPVNZF2 =  mysql_real_escape_string($cmd_SPVNZF);
	$cmd_SPVMZF2 =  mysql_real_escape_string($cmd_SPVMZF);
	$cmd_SPVTZF2 =  mysql_real_escape_string($cmd_SPVTZF);
	$cmd_CORNR2 =  mysql_real_escape_string($cmd_CORNR);
	$cmd_CORMR2 =  mysql_real_escape_string($cmd_CORMR);
	$cmd_CORTR2 =  mysql_real_escape_string($cmd_CORTR);
	$cmd_CORNZF2 =  mysql_real_escape_string($cmd_CORNZF);
	$cmd_CORMZF2 =  mysql_real_escape_string($cmd_CORMZF);
	$cmd_CORTZF2 =  mysql_real_escape_string($cmd_CORTZF);
	$cmd_TSSON2 =  mysql_real_escape_string($cmd_TSSON);
	$cmd_TSSOM2 =  mysql_real_escape_string($cmd_TSSOM);
	$cmd_TSSOT2 =  mysql_real_escape_string($cmd_TSSOT);

	$con3x=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexio");
	mysql_select_db($db,$con3x)or die("Hi ha problemes per connectar amb la base de dades");	
	mysql_query("SET NAMES 'utf8'");	
	
	if (isset($cmd_SPVNR2) && !empty($cmd_SPVNR2) && isset($id_SPVNR) && !empty($id_SPVNR) ) {
	$actualitzaSPVNR=mysql_query("UPDATE comandaments SET CMDQUI='$cmd_SPVNR2' 
	WHERE CMDID='$id_SPVNR'")or die("Error en la consulta: ".mysql_error());
	} elseif (isset($cmd_SPVNR2) && !empty($cmd_SPVNR2)) {
	$registreSPVNR=mysql_query("INSERT INTO comandaments VALUES ('','SPVNR','$cmd_SPVNR2','$datasense3')",$con3x);		
	}
	

	if (isset($cmd_SPVMR2) && !empty($cmd_SPVMR2) && isset($id_SPVMR) && !empty($id_SPVMR) ) {
	$actualitzaSPVMR=mysql_query("UPDATE comandaments SET CMDQUI='$cmd_SPVMR2' 
	WHERE CMDID='$id_SPVMR'")or die("Error en la consulta: ".mysql_error());
	} elseif (isset($cmd_SPVMR2) && !empty($cmd_SPVMR2)) {
	$registreSPVMR=mysql_query("INSERT INTO comandaments VALUES ('','SPVMR','$cmd_SPVMR2','$datasense3')",$con3x);		
	}


	if (isset($cmd_SPVTR2) && !empty($cmd_SPVTR2) && isset($id_SPVTR) && !empty($id_SPVTR) ) {
	$actualitzaSPVTR=mysql_query("UPDATE comandaments SET CMDQUI='$cmd_SPVTR2' 
	WHERE CMDID='$id_SPVTR'")or die("Error en la consulta: ".mysql_error());
	} elseif (isset($cmd_SPVTR2) && !empty($cmd_SPVTR2)) {
	$registreSPVTR=mysql_query("INSERT INTO comandaments VALUES ('','SPVTR','$cmd_SPVTR2','$datasense3')",$con3x);		
	}	


	if (isset($cmd_SPVNZF2) && !empty($cmd_SPVNZF2) && isset($id_SPVNZF) && !empty($id_SPVNZF) ) {
	$actualitzaSPVNZF=mysql_query("UPDATE comandaments SET CMDQUI='$cmd_SPVNZF2' 
	WHERE CMDID='$id_SPVNZF'")or die("Error en la consulta: ".mysql_error());
	} elseif (isset($cmd_SPVNZF2) && !empty($cmd_SPVNZF2)) {
	$registreSPVNZF=mysql_query("INSERT INTO comandaments VALUES ('','SPVNZF','$cmd_SPVNZF2','$datasense3')",$con3x);		
	}	

	if (isset($cmd_SPVMZF2) && !empty($cmd_SPVMZF2) && isset($id_SPVMZF) && !empty($id_SPVMZF) ) {
	$actualitzaSPVMZF=mysql_query("UPDATE comandaments SET CMDQUI='$cmd_SPVMZF2' 
	WHERE CMDID='$id_SPVMZF'")or die("Error en la consulta: ".mysql_error());
	} elseif (isset($cmd_SPVMZF2) && !empty($cmd_SPVMZF2)) {
	$registreSPVMZF=mysql_query("INSERT INTO comandaments VALUES ('','SPVMZF','$cmd_SPVMZF2','$datasense3')",$con3x);		
	}	
	
	if (isset($cmd_SPVTZF2) && !empty($cmd_SPVTZF2) && isset($id_SPVTZF) && !empty($id_SPVTZF) ) {
	$actualitzaSPVTZF=mysql_query("UPDATE comandaments SET CMDQUI='$cmd_SPVTZF2' 
	WHERE CMDID='$id_SPVTZF'")or die("Error en la consulta: ".mysql_error());
	} elseif (isset($cmd_SPVTZF2) && !empty($cmd_SPVTZF2)) {
	$registreSPVTZF=mysql_query("INSERT INTO comandaments VALUES ('','SPVTZF','$cmd_SPVTZF2','$datasense3')",$con3x);		
	}
	
	if (isset($cmd_CORNR2) && !empty($cmd_CORNR2) && isset($id_CORNR) && !empty($id_CORNR) ) {
	$actualitzaCORNR=mysql_query("UPDATE comandaments SET CMDQUI='$cmd_CORNR2' 
	WHERE CMDID='$id_CORNR'")or die("Error en la consulta: ".mysql_error());
	} elseif (isset($cmd_CORNR2) && !empty($cmd_CORNR2)) {
	$registreCORNR=mysql_query("INSERT INTO comandaments VALUES ('','CORNR','$cmd_CORNR2','$datasense3')",$con3x);		
	}	
	
	if (isset($cmd_CORMR2) && !empty($cmd_CORMR2) && isset($id_CORMR) && !empty($id_CORMR) ) {
	$actualitzaCORMR=mysql_query("UPDATE comandaments SET CMDQUI='$cmd_CORMR2' 
	WHERE CMDID='$id_CORMR'")or die("Error en la consulta: ".mysql_error());
	} elseif (isset($cmd_CORMR2) && !empty($cmd_CORMR2)) {
	$registreCORMR=mysql_query("INSERT INTO comandaments VALUES ('','CORMR','$cmd_CORMR2','$datasense3')",$con3x);		
	}	

	if (isset($cmd_CORTR2) && !empty($cmd_CORTR2) && isset($id_CORTR) && !empty($id_CORTR) ) {
	$actualitzaCORTR=mysql_query("UPDATE comandaments SET CMDQUI='$cmd_CORTR2' 
	WHERE CMDID='$id_CORTR'")or die("Error en la consulta: ".mysql_error());
	} elseif (isset($cmd_CORTR2) && !empty($cmd_CORTR2)) {
	$registreCORTR=mysql_query("INSERT INTO comandaments VALUES ('','CORTR','$cmd_CORTR2','$datasense3')",$con3x);		
	}	
	
	if (isset($cmd_CORNZF2) && !empty($cmd_CORNZF2) && isset($id_CORNZF) && !empty($id_CORNZF) ) {
	$actualitzaCORNZF=mysql_query("UPDATE comandaments SET CMDQUI='$cmd_CORNZF2' 
	WHERE CMDID='$id_CORNZF'")or die("Error en la consulta: ".mysql_error());
	} elseif (isset($cmd_CORNZF2) && !empty($cmd_CORNZF2)) {
	$registreCORNZF=mysql_query("INSERT INTO comandaments VALUES ('','CORNZF','$cmd_CORNZF2','$datasense3')",$con3x);		
	}

	if (isset($cmd_CORMZF2) && !empty($cmd_CORMZF2) && isset($id_CORMZF) && !empty($id_CORMZF) ) {
	$actualitzaCORMZF=mysql_query("UPDATE comandaments SET CMDQUI='$cmd_CORMZF2' 
	WHERE CMDID='$id_CORMZF'")or die("Error en la consulta: ".mysql_error());
	} elseif (isset($cmd_CORMZF2) && !empty($cmd_CORMZF2)) {
	$registreCORMZF=mysql_query("INSERT INTO comandaments VALUES ('','CORMZF','$cmd_CORMZF2','$datasense3')",$con3x);		
	}		

	if (isset($cmd_CORTZF2) && !empty($cmd_CORTZF2) && isset($id_CORTZF) && !empty($id_CORTZF) ) {
	$actualitzaCORTZF=mysql_query("UPDATE comandaments SET CMDQUI='$cmd_CORTZF2' 
	WHERE CMDID='$id_CORTZF'")or die("Error en la consulta: ".mysql_error());
	} elseif (isset($cmd_CORTZF2) && !empty($cmd_CORTZF2)) {
	$registreCORTZF=mysql_query("INSERT INTO comandaments VALUES ('','CORTZF','$cmd_CORTZF2','$datasense3')",$con3x);		
	}	

	if (isset($cmd_TSSON2) && !empty($cmd_TSSON2) && isset($id_TSSON) && !empty($id_TSSON) ) {
	$actualitzaTSSON=mysql_query("UPDATE comandaments SET CMDQUI='$cmd_TSSON2' 
	WHERE CMDID='$id_TSSON'")or die("Error en la consulta: ".mysql_error());
	} elseif (isset($cmd_TSSON2) && !empty($cmd_TSSON2)) {
	$registreTSSON=mysql_query("INSERT INTO comandaments VALUES ('','TSSON','$cmd_TSSON2','$datasense3')",$con3x);		
	}
	
	if (isset($cmd_TSSOM2) && !empty($cmd_TSSOM2) && isset($id_TSSOM) && !empty($id_TSSOM) ) {
	$actualitzaTSSOM=mysql_query("UPDATE comandaments SET CMDQUI='$cmd_TSSOM2' 
	WHERE CMDID='$id_TSSOM'")or die("Error en la consulta: ".mysql_error());
	} elseif (isset($cmd_TSSOM2) && !empty($cmd_TSSOM2)) {
	$registreTSSOM=mysql_query("INSERT INTO comandaments VALUES ('','TSSOM','$cmd_TSSOM2','$datasense3')",$con3x);		
	}

	if (isset($cmd_TSSOT2) && !empty($cmd_TSSOT2) && isset($id_TSSOT) && !empty($id_TSSOT) ) {
	$actualitzaTSSOT=mysql_query("UPDATE comandaments SET CMDQUI='$cmd_TSSOT2' 
	WHERE CMDID='$id_TSSOT'")or die("Error en la consulta: ".mysql_error());
	} elseif (isset($cmd_TSSOT2) && !empty($cmd_TSSOT2)) {
	$registreTSSOT=mysql_query("INSERT INTO comandaments VALUES ('','TSSOT','$cmd_TSSOT2','$datasense3')",$con3x);		
	}
	
	

	echo "Dades modificades correctament - <a href=\"pantalla.php\">Tornar</a><br /><br />";
 


?>
<?php require_once("footer.php"); ?>
