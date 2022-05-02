<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("connexio.php"); ?>

<?php	$datamostra = date('Y-m-d'); ?>
<?php   $datasense3 =  mysql_real_escape_string($datamostra); ?>
<?php
	if (!empty($_POST['incid_n']) ) { 	$incid_n = $_POST['incid_n'];} else { 	$incid_n = "Sense incid&egrave;ncies";}
	$incid_n2 =  mysql_real_escape_string($incid_n);
	if (!empty($_POST['fra1_n_zf']) ) { 	$fra1_n_zf = $_POST['fra1_n_zf'];} else { 	$fra1_n_zf = 0;}
	if (!empty($_POST['fra2_n_zf']) ) { 	$fra2_n_zf = $_POST['fra2_n_zf'];} else { 	$fra2_n_zf = 0;}
	if (!empty($_POST['fra3_n_zf']) ) { 	$fra3_n_zf = $_POST['fra3_n_zf'];} else { 	$fra3_n_zf = 0;}
	if (!empty($_POST['fra4_n_zf']) ) { 	$fra4_n_zf = $_POST['fra4_n_zf'];} else { 	$fra4_n_zf = 0;}
	if (!empty($_POST['fra5_n_zf']) ) { 	$fra5_n_zf = $_POST['fra5_n_zf'];} else { 	$fra5_n_zf = 0;}
	if (!empty($_POST['fra6_n_zf']) ) { 	$fra6_n_zf = $_POST['fra6_n_zf'];} else { 	$fra6_n_zf = 0;}
	if (!empty($_POST['fra7_n_zf']) ) { 	$fra7_n_zf = $_POST['fra7_n_zf'];} else { 	$fra7_n_zf = 0;}
	if (!empty($_POST['fra8_n_zf']) ) { 	$fra8_n_zf = $_POST['fra8_n_zf'];} else { 	$fra8_n_zf = 0;}
	if (!empty($_POST['fra1_n_r']) ) { 	$fra1_n_r = $_POST['fra1_n_r'];} else { 	$fra1_n_r = 0;}
	if (!empty($_POST['fra2_n_r']) ) { 	$fra2_n_r = $_POST['fra2_n_r'];} else { 	$fra2_n_r = 0;}
	if (!empty($_POST['fra3_n_r']) ) { 	$fra3_n_r = $_POST['fra3_n_r'];} else { 	$fra3_n_r = 0;}
	if (!empty($_POST['fra4_n_r']) ) { 	$fra4_n_r = $_POST['fra4_n_r'];} else { 	$fra4_n_r = 0;}
	if (!empty($_POST['fra5_n_r']) ) { 	$fra5_n_r = $_POST['fra5_n_r'];} else { 	$fra5_n_r = 0;}
	if (!empty($_POST['fra6_n_r']) ) { 	$fra6_n_r = $_POST['fra6_n_r'];} else { 	$fra6_n_r = 0;}
	if (!empty($_POST['fra7_n_r']) ) { 	$fra7_n_r = $_POST['fra7_n_r'];} else { 	$fra7_n_r = 0;}
	if (!empty($_POST['fra8_n_r']) ) { 	$fra8_n_r = $_POST['fra8_n_r'];} else { 	$fra8_n_r = 0;}
	if (!empty($_POST['incid_m']) ) { 	$incid_m = $_POST['incid_m'];} else { $incid_m = "Sense incid&egrave;ncies";}
	$incid_m2 =  mysql_real_escape_string($incid_m);	
	if (!empty($_POST['fra1_m_zf']) ) { 	$fra1_m_zf = $_POST['fra1_m_zf'];} else { $fra1_m_zf = 0;}
	if (!empty($_POST['fra2_m_zf']) ) { 	$fra2_m_zf = $_POST['fra2_m_zf'];} else { $fra2_m_zf = 0;}
	if (!empty($_POST['fra3_m_zf']) ) { 	$fra3_m_zf = $_POST['fra3_m_zf'];} else { $fra3_m_zf = 0;}
	if (!empty($_POST['fra4_m_zf']) ) { 	$fra4_m_zf = $_POST['fra4_m_zf'];} else { $fra4_m_zf = 0;}
	if (!empty($_POST['fra5_m_zf']) ) { 	$fra5_m_zf = $_POST['fra5_m_zf'];} else { $fra5_m_zf = 0;}
	if (!empty($_POST['fra6_m_zf']) ) { 	$fra6_m_zf = $_POST['fra6_m_zf'];} else { $fra6_m_zf = 0;}
	if (!empty($_POST['fra7_m_zf']) ) { 	$fra7_m_zf = $_POST['fra7_m_zf'];} else { $fra7_m_zf = 0;}
	if (!empty($_POST['fra8_m_zf']) ) { 	$fra8_m_zf = $_POST['fra8_m_zf'];} else { $fra8_m_zf = 0;}
	if (!empty($_POST['fra1_m_r']) ) { 	$fra1_m_r = $_POST['fra1_m_r'];} else { $fra1_m_r = 0;}
	if (!empty($_POST['fra2_m_r']) ) { 	$fra2_m_r = $_POST['fra2_m_r'];} else { $fra2_m_r = 0;}
	if (!empty($_POST['fra3_m_r']) ) { 	$fra3_m_r = $_POST['fra3_m_r'];} else { $fra3_m_r = 0;}
	if (!empty($_POST['fra4_m_r']) ) { 	$fra4_m_r = $_POST['fra4_m_r'];} else { $fra4_m_r = 0;}
	if (!empty($_POST['fra5_m_r']) ) { 	$fra5_m_r = $_POST['fra5_m_r'];} else { $fra5_m_r = 0;}
	if (!empty($_POST['fra6_m_r']) ) { 	$fra6_m_r = $_POST['fra6_m_r'];} else { $fra6_m_r = 0;}
	if (!empty($_POST['fra7_m_r']) ) { 	$fra7_m_r = $_POST['fra7_m_r'];} else { $fra7_m_r = 0;}
	if (!empty($_POST['fra8_m_r']) ) { 	$fra8_m_r = $_POST['fra8_m_r'];} else { $fra8_m_r = 0;}
	if (!empty($_POST['incid_t']) ) { 	$incid_t = $_POST['incid_t'];} else { $incid_t = "Sense incid&egrave;ncies";}
	$incid_t2 =  mysql_real_escape_string($incid_t);	
	if (!empty($_POST['fra1_t_zf']) ) { 	$fra1_t_zf = $_POST['fra1_t_zf'];} else { $fra1_t_zf = 0;}
	if (!empty($_POST['fra2_t_zf']) ) { 	$fra2_t_zf = $_POST['fra2_t_zf'];} else { $fra2_t_zf = 0;}
	if (!empty($_POST['fra3_t_zf']) ) { 	$fra3_t_zf = $_POST['fra3_t_zf'];} else { $fra3_t_zf = 0;}
	if (!empty($_POST['fra4_t_zf']) ) { 	$fra4_t_zf = $_POST['fra4_t_zf'];} else { $fra4_t_zf = 0;}
	if (!empty($_POST['fra5_t_zf']) ) { 	$fra5_t_zf = $_POST['fra5_t_zf'];} else { $fra5_t_zf = 0;}
	if (!empty($_POST['fra6_t_zf']) ) { 	$fra6_t_zf = $_POST['fra6_t_zf'];} else { $fra6_t_zf = 0;}
	if (!empty($_POST['fra7_t_zf']) ) { 	$fra7_t_zf = $_POST['fra7_t_zf'];} else { $fra7_t_zf = 0;}
	if (!empty($_POST['fra8_t_zf']) ) { 	$fra8_t_zf = $_POST['fra8_t_zf'];} else { $fra8_t_zf = 0;}
	if (!empty($_POST['fra1_t_r']) ) { 	$fra1_t_r = $_POST['fra1_t_r'];} else { $fra1_t_r = 0;}
	if (!empty($_POST['fra2_t_r']) ) { 	$fra2_t_r = $_POST['fra2_t_r'];} else { $fra2_t_r = 0;}
	if (!empty($_POST['fra3_t_r']) ) { 	$fra3_t_r = $_POST['fra3_t_r'];} else { $fra3_t_r = 0;}
	if (!empty($_POST['fra4_t_r']) ) { 	$fra4_t_r = $_POST['fra4_t_r'];} else { $fra4_t_r = 0;}
	if (!empty($_POST['fra5_t_r']) ) { 	$fra5_t_r = $_POST['fra5_t_r'];} else { $fra5_t_r = 0;}
	if (!empty($_POST['fra6_t_r']) ) { 	$fra6_t_r = $_POST['fra6_t_r'];} else { $fra6_t_r = 0;}
	if (!empty($_POST['fra7_t_r']) ) { 	$fra7_t_r = $_POST['fra7_t_r'];} else { $fra7_t_r = 0;}
	if (!empty($_POST['fra8_t_r']) ) { 	$fra8_t_r = $_POST['fra8_t_r'];} else { $fra8_t_r = 0;}



	
	$persid = $_POST['persid'];




	//actualitza o inserta incidencies de personal
	//nit
	if ($persid != "falso") {
	
	$con3x=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexio");
	mysql_select_db($db,$con3x)or die("Hi ha problemes per connectar amb la base de dades");	
	mysql_query("SET NAMES 'utf8'");	
	
	$actualitza=mysql_query("UPDATE personal SET FRA1_M_ZF=$fra1_m_zf, FRA2_M_ZF=$fra2_m_zf, FRA3_M_ZF=$fra3_m_zf, FRA4_M_ZF=$fra4_m_zf,
	FRA5_M_ZF=$fra5_m_zf, FRA6_M_ZF=$fra6_m_zf, FRA7_M_ZF=$fra7_m_zf, FRA8_M_ZF=$fra8_m_zf, FRA1_M_R=$fra1_m_r,
	FRA2_M_R=$fra2_m_r, FRA3_M_R=$fra3_m_r, FRA4_M_R=$fra4_m_r, FRA5_M_R=$fra5_m_r, FRA6_M_R=$fra6_m_r,
	FRA7_M_R=$fra7_m_r, FRA8_M_R=$fra8_m_r, FRA1_N_ZF=$fra1_n_zf, FRA2_N_ZF=$fra2_n_zf, FRA3_N_ZF=$fra3_n_zf,
	FRA4_N_ZF=$fra4_n_zf, FRA5_N_ZF=$fra5_n_zf, FRA6_N_ZF=$fra6_n_zf, FRA7_N_ZF=$fra7_n_zf, FRA8_N_ZF=$fra8_n_zf,
	FRA1_N_R=$fra1_n_r, FRA2_N_R=$fra2_n_r, FRA3_N_R=$fra3_n_r, FRA4_N_R=$fra4_n_r, FRA5_N_R=$fra5_n_r,
	FRA6_N_R=$fra6_n_r, FRA7_N_R=$fra7_n_r, FRA8_N_R=$fra8_n_r, FRA1_T_ZF=$fra1_t_zf, FRA2_T_ZF=$fra2_t_zf,
	FRA3_T_ZF=$fra3_t_zf, FRA4_T_ZF=$fra4_t_zf, FRA5_T_ZF=$fra5_t_zf, FRA6_T_ZF=$fra6_t_zf, FRA7_T_ZF=$fra7_t_zf,
	FRA8_T_ZF=$fra8_t_zf, FRA1_T_R=$fra1_t_r, FRA2_T_R=$fra2_t_r, FRA3_T_R=$fra3_t_r, FRA4_T_R=$fra4_t_r, FRA5_T_R=$fra5_t_r,
	FRA6_T_R=$fra6_t_r, FRA7_T_R=$fra7_t_r, FRA8_T_R=$fra8_t_r, INCID_N='$incid_n2', INCID_T='$incid_t2', INCID_M='$incid_m2'
	WHERE PERSID='$persid'")or die("Error en la consulta: ".mysql_error());
	} else {

	$con4x=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexio");
	mysql_select_db($db,$con4x)or die("Hi ha problemes per connectar amb la base de dades");	
	mysql_query("SET NAMES 'utf8'");	
	
	$registra=mysql_query("INSERT INTO personal VALUES ('','$datasense3','$fra1_m_zf','$fra2_m_zf','$fra3_m_zf',
	'$fra4_m_zf','$fra5_m_zf','$fra6_m_zf','$fra7_m_zf','$fra8_m_zf','$fra1_m_r','$fra2_m_r','$fra3_m_r',
	'$fra4_m_r','$fra5_m_r','$fra6_m_r','$fra7_m_r','$fra8_m_r','$fra1_t_zf','$fra2_t_zf','$fra3_t_zf',
	'$fra4_t_zf','$fra5_t_zf','$fra6_t_zf','$fra7_t_zf','$fra8_t_zf','$fra1_t_r','$fra2_t_r','$fra3_t_r',
	'$fra4_t_r','$fra5_t_r','$fra6_t_r','$fra7_t_r','$fra8_t_r','$fra1_n_zf','$fra2_n_zf','$fra3_n_zf',
	'$fra4_n_zf','$fra5_n_zf','$fra6_n_zf','$fra7_n_zf','$fra8_n_zf','$fra1_n_r','$fra2_n_r','$fra3_n_r',
	'$fra4_n_r','$fra5_n_r','$fra6_n_r','$fra7_n_r','$fra8_n_r','$incid_m2','$incid_t2','$incid_n2')",$con4x);		
	}
	


	echo "Dades modificades correctament - <a href=\"pantalla.php#personal\">Tornar</a><br /><br />";
 


?>
<?php require_once("footer.php"); ?>