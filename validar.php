<?php 
session_start();
include ("connexio.php");
if (isset($_POST['user']) && !empty($_POST['user']) &&
	isset($_POST['pass']) && !empty($_POST['pass'])) {
	

		
	$con=mysql_connect($host, $user, $pw)or die("Hi ha hagut problemes amb el servidor");
	mysql_select_db($db,$con)or die("Hi ha hagut problemes amb la connexió a la Base de Dades");
	//mysql_query("SET NAMES 'utf8'");
	$sel=mysql_query("SELECT USER,PW FROM registre WHERE USER='$_POST[user]'",$con);
	$sesion=mysql_fetch_array($sel);
	
	$pwen=md5($_POST['pass']);
	
	if ($pwen == $sesion['PW']) {
		$_SESSION['username'] = $_POST['user'];
		//echo "Dades correctes. Ha accedit correctament - <a href=\"pantalla.php\">Entrar</a>";
		header ("location:pantalla.php");
	} else {
		echo "Dades incorrectes, comprovi les dades introduides.- <a href=\"index.php\">Tornar</a>";
	}

	
	} else{
		echo "Cal introduir usuari i password - <a href=\"index.php\">Tornar</a>";
	}


?>

