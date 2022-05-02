<div class="sessio"><?php
session_start();
$nomusuari= $_SESSION['username'];
if (isset($_SESSION['username'])) {
	echo "<span class=\"sessio\"> Connectat: ".$nomusuari;
	echo " || </span>";
	echo "<a href=\"desconnecta.php\">Desconnecta</a>&nbsp;"; 
} else {	
	header ('location:index.php');
	//echo "No tens perm&iacute;s per visualitzar aquesta p&agrave;gina. <a href=\"index.php\">Accedeix</a>";
	}
?></div>
