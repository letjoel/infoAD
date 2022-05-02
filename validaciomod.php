<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>

<?php
if ( !empty($_POST['idvamodificar']) ) {

	$laidva = $_POST['idvamodificar'];
	
	$con2va=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2va)or die("Hi ha problemes per connectar amb la base de dades");	
	
	$registre3va=mysql_query("SELECT * FROM validacions WHERE VAID='$laidva' ")or die("Error en la consulta: ".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	$extractevam = mysql_fetch_assoc($registre3va);
}

	echo "<h1>Editar</h1>";

	echo "<form action=\"validaciomod_ok.php\" autocomplete=\"off\" method=\"post\" name=\"formvamod\">";


if ($extractevam['VANP'] == 2) 
{   

	echo "Data: <input type=\"date\" name=\"vadata\" value =\"";
	echo utf8_encode($extractevam['VADATA']); 
	echo "\" size=\"10\" class=\"input\" />";
	echo "&nbsp";
	echo "Llicències: <input type=\"text\" name=\"vallicencies\" size=\"5\" value=\"";
	echo utf8_encode($extractevam['VALLICENCIES']);
	echo "\" maxlength=\"3\" class=\"input\" />";
	echo "&nbsp";
	echo "OK: <input type=\"text\" name=\"vaok\" size=\"5\" value=\"";
	echo utf8_encode($extractevam['VAOK']); 
	echo "\" maxlength=\"3\" class=\"input\" />";
	echo "&nbsp";
	echo "KO: <input type=\"text\" name=\"vako\" size=\"5\" value=\"";
	echo utf8_encode($extractevam['VAKO']);
	echo "\" maxlength=\"3\" class=\"input\" />";
	echo "&nbsp";
	echo "Gestor: <input type=\"text\" name=\"vagestor\" size=\"15\" value=\"";
	echo utf8_encode($extractevam['VAGESTOR']);
	echo "\" maxlength=\"99\" class=\"input\" />";
	echo "&nbsp";
	echo "Torn:";
	echo "<select name=\"vatorn\" class=\"input\" >";
	
		If (utf8_encode($extractevam['VATORN']) == "Nit") {
					echo "<option value=\"Nit\" selected=\"selected\">Nit</option>";
		}	 else { echo "<option value=\"Nit\">Nit</option>";
					}
		If (utf8_encode($extractevam['VATORN']) == "Matí") {
					echo "<option value=\"Matí\" selected=\"selected\">Matí</option>";
		}	 else { echo "<option value=\"Matí\">Matí</option>";
					}		
		If (utf8_encode($extractevam['VATORN']) == "Tarda") {
					echo "<option value=\"Tarda\" selected=\"selected\">Tarda</option>";
		}	 else { echo "<option value=\"Tarda\">Tarda</option>";
					}		
	

		echo "</select>";
	
	echo "&nbsp";
	echo "P: <input type=\"radio\" name=\"vanp\" checked=\"yes\" value=\"2\" class=\"input\" />" ;
	echo "&nbsp";
	echo "NP: <input type=\"radio\" name=\"vanp\" value=\"1\" class=\"input\" />" ;
	

	echo "<br />";
	echo "<br />";

	echo "<input type=\"hidden\" name=\"idenviableva\" value=\"";
	echo $extractevam['VAID']; 
	echo "\"  />";
	echo "<input type=\"submit\" value=\"Modificar\"  class=\"boto\" />";
	echo "</form>";
	echo "<form action=\"pantalla.php\">";
	echo "<input type=\"submit\" value=\"Tornar\" class=\"boto\"  />";

} 	else {
	// En cas que sigui NP
	echo "Data: <input type=\"date\" name=\"vadata\" value =\"";
	echo utf8_encode($extractevam['VADATA']); 
	echo "\" size=\"10\" class=\"input\" />";
	echo "&nbsp";
	echo "Llicències: <input type=\"text\" name=\"vallicencies\" size=\"5\" value=\"";
	//echo utf8_encode($extractevam['VALLICENCIES']);
	echo "\" maxlength=\"3\" class=\"input\" />";
	echo "&nbsp";
	echo "OK: <input type=\"text\" name=\"vaok\" size=\"5\" value=\"";
	//echo utf8_encode($extractevam['VAOK']); 
	echo "\" maxlength=\"3\" class=\"input\" />";
	echo "&nbsp";
	echo "KO: <input type=\"text\" name=\"vako\" size=\"5\" value=\"";
	//echo utf8_encode($extractevam['VAKO']);
	echo "\" maxlength=\"3\" class=\"input\" />";
	echo "&nbsp";
	echo "Gestor: <input type=\"text\" name=\"vagestor\" size=\"15\" value=\"";
	//echo utf8_encode($extractevam['VAGESTOR']);
	echo "\" maxlength=\"99\" class=\"input\" />";
	echo "&nbsp";
	echo "Torn:";
	echo "<select name=\"vatorn\" class=\"input\" >";
	
		If (utf8_encode($extractevam['VATORN']) == "Nit") {
					echo "<option value=\"Nit\" selected=\"selected\">Nit</option>";
		}	 else { echo "<option value=\"Nit\">Nit</option>";
					}
		If (utf8_encode($extractevam['VATORN']) == "Matí") {
					echo "<option value=\"Matí\" selected=\"selected\">Matí</option>";
		}	 else { echo "<option value=\"Matí\">Matí</option>";
					}		
		If (utf8_encode($extractevam['VATORN']) == "Tarda") {
					echo "<option value=\"Tarda\" selected=\"selected\">Tarda</option>";
		}	 else { echo "<option value=\"Tarda\">Tarda</option>";
					}		
	

		echo "</select>";

	echo "&nbsp";
	echo "P: <input type=\"radio\" name=\"vanp\" value=\"2\" class=\"input\" />" ;
	echo "&nbsp";
	echo "NP: <input type=\"radio\" name=\"vanp\" checked=\"yes\" value=\"1\" class=\"input\" />" ;		

	echo "<br />";
	echo "<br />";

	echo "<input type=\"hidden\" name=\"idenviableva\" value=\"";
	echo $extractevam['VAID']; 
	echo "\"  />";
	echo "<input type=\"submit\" value=\"Modificar\"  class=\"boto\" />";
	echo "</form>";
	echo "<form action=\"pantalla.php\">";
	echo "<input type=\"submit\" value=\"Tornar\" class=\"boto\"  />";	
	
	
	
	
	
	}
	
	
	
	echo "</form>";	
	
	
	?>	

	
<br /><br />
<?php require_once("footer.php"); ?>