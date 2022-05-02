<?php require_once("header.php"); ?>
<?php include ("connexio.php"); ?>

<h1>Informes d'Activitat 112</h1><br />

Registre <br/><br/>
<form action="" method="post" name="regi">
Nom: <input type="text" name="nom"/> <br/>
Cognom: <input type="text" name="cognom"/> <br/>
Usuari: <input type="text" name="user"/> <br/>
Password: <input type="password" name="pw"/> <br/>
Confirmar Password: <input type="password" name="pw2"/> <br/>
<input type="submit" value="Registrar"/>

</form>

<?php

if (isset($_POST['nom']) && !empty($_POST['nom']) && 
	isset ($_POST['cognom']) && !empty($_POST['cognom']) &&
	isset ($_POST['user']) && !empty($_POST['user']) &&
	isset ($_POST['pw']) && !empty($_POST['pw']) && $_POST['pw'] == $_POST['pw2']  ) {

	$pwe= md5($_POST['pw']);
	
	$con=mysql_connect($host, $user, $pw)or die("Hi ha hagut problemes amb el servidor");
	mysql_select_db($db,$con)or die("Hi ha hagut problemes amb la connexió a la Base de Dades");
	mysql_query("SET NAMES 'utf8'");
	mysql_query("INSERT INTO registre (REALNAME,REALCOGN,USER,PW) VALUES ('$_POST[nom]','$_POST[cognom]','$_POST[user]','$pwe')",$con);
	
	echo "Registre correcte. Benvingut. Ara ja pot accedir amb les dades introduides. - <a href=\"\">Accedir</a>";
	
	
	
} 


?>

<?php require_once("footer.php"); ?>