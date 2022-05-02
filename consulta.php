<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include_once("connexio.php"); ?>

<h1><img src="imatges/cercaicon.gif"> Consulta</h1><br />

<form action="consulta_mod.php" method="post" autocomplete="off" name="form">
	Data: <input type="date" name="dataconsulta" size="10" value="aaaa-mm-dd"/>
	
	<input type="submit" value="Consulta" /><input type="reset" value="Esborrar" />

	</form>	<br/>



<?php require_once("footer.php"); ?>