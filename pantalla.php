<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("includes/_arrays.php"); ?>
<?php include("connexio.php"); ?>
<?php	$datashow = date('Y-m-d'); ?>
<!-- Autor: Joel Herrero  -->
<!-- Menú flotant  -->
<div class="banner">
<p>
<em>Accés Ràpid:</em>
<a href="#control">Control diari</a>
<a href="#comandaments">Comand- aments</a>
<a href="#personal">Personal</a>
<a href="#borsa">Borsa</a>
<a href="#episodis">Episodis Rellevants</a>
<a href="#ires">IREs</a>
<a href="#serveis">Serveis Operatius</a>
<a href="#taxi">Sistemes Especials</a>
<a href="#validacions">Validacions</a>
<a href="#simulacres">Simulacres</a>
<a href="#observacions">Gestions Spv</a>
<a href="#incoperatives">Incidències Operatives</a>
<a href="#inctecniques">Incidències Tècniques</a>
<a href="#inctaxi">Incidències Taxi</a>
<a href="#annexes">Annexes</a>
<em></em>
<a href="refresca.php">-REFRESCA-</a>
</div>
<!-- Fi Menú flotant   -->



<div class="barrah2">	
	<h4>DATA: <?php echo "$datashow";   ?></h4>
		<form action="exportar.php" method="post" target="_blank" name="formcmdm">
		<input type="submit" value="Exportar a Word" class="boto"/>
		
	</form><br />

</div>
<br />
<br />
	
<div class="barrahc">
<A NAME="control"></A><h2>Control Diari</h2>


	<!--###########CONTROL DIARI Formulari############-->
	<?php 	$datasensecd =  mysql_real_escape_string($datashow); ?>
	
	<form action="" method="post" autocomplete="off" name="cdform">
		Data*: <input type="date" name="cddata" size="8" class="input" required="true" value="<?php echo "$datashow"; ?>" />
		Hora*: <input type="time" name="cdhora" size="4" value="hh:mm" required="true" maxlength="5" class="input" onClick="this.select()" />
		Tipus*: <select name="cdtipus" class="input">
					<option value="Plans d'emergència activats">Plans d'emerg&egrave;ncia activats</option>
					<option value="Episodis rellevants activats">Episodis rellevants activats</option>
					<option value="Telèfons d'agències no operatius">Telèfons d'ag&egrave;ncies no operatius</option>
					<option value="Altres contingències eventuals">Altres conting&egrave;ncies eventuals</option>
				</select>
		<br />
		Descripció*: <br /><textarea name="cddescripcio" rows="2"cols="122" required="true" class="input"></textarea>
		<br />
		<input type="submit" value="Insertar" class="boto"/><input type="reset" value="Esborrar" class="boto" />
	</form>
<br />	
	
<?php
	// ######### 2ª part: comprovem que s'hagi escrit algo en alguns camps

if (isset ($_POST['cddata']) && !empty($_POST['cddata']) &&
	isset ($_POST['cdhora']) && !empty($_POST['cdhora']) &&
	isset ($_POST['cddescripcio']) && !empty($_POST['cddescripcio']))
{
	//hora local en que es fa el registre i que es guardarà la bd
	/*
	A php.ini cal modificar la zona horaria:
	date.timezone = Europe/Madrid
	*/
	$cddatains = date('Y-m-d');
	$cdhorains = date('H:i:s');

	//anomenem variables
	$cddata = $_POST['cddata'];
	$cdhora = $_POST['cdhora'];
	$cdtipus = $_POST['cdtipus'];
	$cddescripcio = $_POST['cddescripcio'];	
	
	//afegim slash a totes les cometes i apostrofs mitjançant escape
	$cddata2 =  mysql_real_escape_string($cddata);
	$cdhora2 =  mysql_real_escape_string($cdhora);
	$cdtipus2 =  mysql_real_escape_string($cdtipus);
	$cddescripcio2 =  mysql_real_escape_string($cddescripcio);
	
	//connectem per introduir dades
	$cdcon=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$cdcon)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	mysql_query("INSERT INTO control VALUES ('','$cddatains','$cdhorains','$nomusuari','$cdtipus2','$cddata2','$cdhora2','$cddescripcio2')",$cdcon);
	//echo "Dades insertades correctament";
	
	//reset del formulari per evitar F5
	$_POST = array();
	@header ("location:ok_control.php");
}

	// ###### 3er pas: Control Diari ->Taula que es mostra en pantalla sempre, referent al dia actual
	$cddataxcons = date('Y-m-d');
	$cddatasensexf =  mysql_real_escape_string($cddataxcons);

	$cdcon2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$cdcon2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$cdregistro2=mysql_query("SELECT * FROM control ORDER BY CDDATA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border = '1' class=\"ampletaula\"> \n";
	

	echo "<th colspan=\"6\" class=\"taula\"><div align=\"left\">Control Diari</div></th> \n";	
	
	echo "<tr> \n";

	//echo "<td><b>Data</b></td> \n";

	echo "<td class=\"taula\" width=\"8%\"><b>Data</b></td> \n";
	
	echo "<td class=\"taula\" width=\"8%\"><b>Hora</b></td> \n";

	echo "<td class=\"taula\"><b>Tipus</b></td> \n";

	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";

	echo "<td class=\"taula\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\"><b>Eliminar</b></td> \n";	
	
	echo "</tr> \n";

	
	while ($cdrowb = mysql_fetch_row($cdregistro2)){
	
	echo "<tr> \n";

	//Data
	echo "<td>$cdrowb[5]</td> \n";
	//Hora
	$cdrowb[6]=substr($cdrowb[6],0,5);
	echo "<td>$cdrowb[6]h</td> \n";
	//Tipus
	echo "<td>$cdrowb[4]</td> \n";
	
	//Descripció
	echo "<td>";
	echo (nl2br($cdrowb[7]));
	echo "</td> \n";

	echo "<td><form action=\"cdeditar.php\" method=\"post\" name=\"formcd2\">
		<input type=\"hidden\" name=\"cdidmodificar\" value=\"$cdrowb[0]\"/>
		<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>
		</form></td> \n";
	
	echo "<td><form action=\"cdeliminar.php\" method=\"post\" name=\"formcd3\">
		<input type=\"hidden\" name=\"cdidmodificar\" value=\"$cdrowb[0]\"/>
		<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>
		</form></td> \n";
	
	echo "</tr> \n";

	}

	echo "</table> \n";
	
?>
<br />
</div>
<br />
<br />



<!-- Comandaments -->
<div class="barrah2">
<A NAME="comandaments"></A><h2>Comandaments</h2>

<form action="cmdmod.php" method="post" name="formcmdm">
		<input type="submit" value="Modificar" class="boto"/>
	</form><br />	



<?php
	// Comandaments ->Taula que es mostra en pantalla sempre, referent al dia actual
	$datasense2 =  mysql_real_escape_string($datashow);

	$con6=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con6)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registro6=mysql_query("SELECT * FROM comandaments WHERE CMDDATA='$datasense2'")or die("Error en la consulta: ".mysql_error());
			

?>
<?php

	while($fila=mysql_fetch_array($registro6))
	{$idcmd = $fila['CMDID'];
	$qui = $fila['CMDQUI'];
	$rang = $fila['CMDRANG'];
		if ($rang=="SPVMR"){
			$SPVmatiReus= "$qui";
		}
		if ($rang=="SPVTR"){
			$SPVtardaReus= "$qui";
		}		
		if ($rang=="SPVNR"){
			$SPVnitReus= "$qui";
		}	
		if ($rang=="SPVMZF"){
			$SPVmatiZF= "$qui";
		}
		if ($rang=="SPVTZF"){
			$SPVtardaZF= "$qui";
		}		
		if ($rang=="SPVNZF"){
			$SPVnitZF= "$qui";
		}	
		if ($rang=="CORMR"){
			$CORmatiR= "$qui";
		}	
		if ($rang=="CORTR"){
			$CORtardaR= "$qui";
		}	
		if ($rang=="CORNR"){
			$CORnitR= "$qui";
		}
		if ($rang=="CORMZF"){
			$CORmatiZF= "$qui";
		}	
		if ($rang=="CORTZF"){
			$CORtardaZF= "$qui";
		}	
		if ($rang=="CORNZF"){
			$CORnitZF= "$qui";
		}
		if ($rang=="TSSON"){
			$TSSOnit= "$qui";
		}
		if ($rang=="TSSOM"){
			$TSSOmati= "$qui";
		}
		if ($rang=="TSSOT"){
			$TSSOtarda= "$qui";
		}
		
	}



	echo "<table border='1' class='ampletaula' id='table1'> \n";
	echo "<tr> \n";
		echo "<th class=\"taula\" colspan=\"4\" align=\"center\"> \n";
		echo	"<strong>Comandaments</strong></th> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td class=\"taula\" colspan=\"2\" align=\"center\">SUPERVISI&Oacute; ZONA FRANCA</td> \n";
		echo "<td class=\"taula\" colspan=\"2\" align=\"center\">SUPERVISI&Oacute; REUS</td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td width=\"72\">00-08h:</td> \n";
		echo "<td width=\"415\">";
			if (isset($SPVnitZF) && !empty ($SPVnitZF)) 
			
				{echo "$SPVnitZF";
			}		
		echo "</td> \n";
		echo "<td width=\"72\">00-08h:</td> \n";
		echo "<td width=\"413\">";
			if (isset($SPVnitReus) && !empty ($SPVnitReus)) 
			
				{echo "$SPVnitReus";
			}		
		echo "</td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td width=\"72\">08-16h:</td> \n";	
		echo "<td>";
			if (isset($SPVmatiZF) && !empty ($SPVmatiZF)) 
			
				{echo "$SPVmatiZF";
			}	
		echo "</td> \n";
		echo "<td width=\"72\">08-16h:</td> \n";
		echo "<td>";
			if (isset($SPVmatiReus) && !empty ($SPVmatiReus)) 
			
				{echo "$SPVmatiReus";
			}
		echo "</td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td width=\"72\">16-00h:</td> \n";
		echo "<td>";
			if (isset($SPVtardaZF) && !empty ($SPVtardaZF)) 
			
				{echo "$SPVtardaZF";
			}
		echo "</td> \n";
		echo "<td width=\"72\">16-00h:</td> \n";		
		echo "<td>";
			if (isset($SPVtardaReus) && !empty ($SPVtardaReus)) 
			
				{echo "$SPVtardaReus";
			}
		echo "</td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td class=\"taula\" colspan=\"2\" align=\"center\">COORDINACI&Oacute; ZONA FRANCA</td> \n";
		echo "<td class=\"taula\" colspan=\"2\" align=\"center\">COORDINACI&Oacute; REUS</td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td width=\"72\">00-08h:</td> \n";
		echo "<td>";
			if (isset($CORnitZF) && !empty ($CORnitZF)) 
			
				{echo "$CORnitZF";
			}
		echo "</td> \n";
		echo "<td width=\"72\">00-08h:</td> \n";
		echo "<td>";
			if (isset($CORnitR) && !empty ($CORnitR)) 
			
				{echo "$CORnitR";
			}
		echo "</td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td width=\"72\">08-16h:</td> \n";
		echo "<td>";
			if (isset($CORmatiZF) && !empty ($CORmatiZF)) 
			
				{echo "$CORmatiZF";
			}
		echo "</td> \n";
		echo "<td width=\"72\">08-16h:</td> \n";
		echo "<td>";
			if (isset($CORmatiR) && !empty ($CORmatiR)) 
			
				{echo "$CORmatiR";
			}
		echo "</td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td width=\"72\">16-00h:</td> \n";
		echo "<td>";
			if (isset($CORtardaZF) && !empty ($CORtardaZF)) 
			
				{echo "$CORtardaZF";
			}
		echo "</td> \n";
		echo "<td width=\"72\">16-00h:</td> \n";
		echo "<td>";
			if (isset($CORtardaR) && !empty ($CORtardaR)) 
			
				{echo "$CORtardaR";
			}
		echo "</td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td class=\"taula\" align=\"center\" colspan=\"4\"> \n";
		echo "TSSO</td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td width=\"72\">23-07h:</td> \n";	
		echo "<td colspan=\"3\">";
			if (isset($TSSOnit) && !empty ($TSSOnit)) 
				{echo "$TSSOnit";
			}
		echo "</td> \n";
		echo "</tr> \n";	
	echo "<tr> \n";
		echo "<td width=\"72\">07-15h:</td> \n";	
		echo "<td colspan=\"3\">";
			if (isset($TSSOmati) && !empty ($TSSOmati)) 
				{echo "$TSSOmati";
			}
		echo "</td> \n";
		echo "</tr> \n";		
	echo "<tr> \n";
		echo "<td width=\"72\">15-23h:</td> \n";	
		echo "<td colspan=\"3\">";
			if (isset($TSSOtarda) && !empty ($TSSOtarda)) 
				{echo "$TSSOtarda";
			}
		echo "</td> \n";
		echo "</tr> \n";				

	echo "</table> \n";

	
?>
<br />
</div>
<br />
<br />
<!-- ############ INCIDÈNCIES PERSONAL ########### -->	
<div class="barrah2">
<A NAME="personal"></A><h2>Incidències Personal</h2>
<form action="personalmod.php" method="post" name="formiper">
		<input type="submit" value="Modificar" class="boto"/>
	</form><br />

	
<?php
	// Incidències Personal ->Taula que es mostra en pantalla sempre, referent al dia actual
	$datasenseir =  mysql_real_escape_string($datashow);

	$con6ir=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con6ir)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registro6ir=mysql_query("SELECT * FROM personal WHERE PERSDATA='$datasenseir'")or die("Error en la consulta: ".mysql_error());
			
	$extracteir = mysql_fetch_assoc($registro6ir);
	
?>
	
<table border="1" width="1000" id="table1">
	<tr>
		<th colspan="11" class="taula"><strong>Incidencies Personal</strong></th>
	</tr>
	<tr>
		<td width="148" class="taula">Torn</td>
		<td width="117" class="taula">Centre</td>
		<td width="258" colspan="8" class="taula">Nombre de posicions</td>
		<td width="971" class="taula">Incid&egrave;ncies</td>
	</tr>
	<tr>
		<td rowspan="3" width="148">Nit</td>
		<td width="117">Hora</td>
		<td width="40">00h</td>
		<td width="40">01h</td>
		<td width="40">02h</td>
		<td width="40">03h</td>
		<td width="40">04h</td>
		<td width="40">05h</td>
		<td width="40">06h</td>
		<td width="40">07h</td>
		<td width="971" rowspan="4">
		<?php 
			if (isset($extracteir['INCID_N']) && !empty ($extracteir['INCID_N'])) 
			
				{echo $extracteir['INCID_N'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="117">ZF</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA1_N_ZF']) && !empty ($extracteir['FRA1_N_ZF'])) 
			
				{echo $extracteir['FRA1_N_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA2_N_ZF']) && !empty ($extracteir['FRA2_N_ZF'])) 
			
				{echo $extracteir['FRA2_N_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA3_N_ZF']) && !empty ($extracteir['FRA3_N_ZF'])) 
			
				{echo $extracteir['FRA3_N_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA4_N_ZF']) && !empty ($extracteir['FRA4_N_ZF'])) 
			
				{echo $extracteir['FRA4_N_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA5_N_ZF']) && !empty ($extracteir['FRA5_N_ZF'])) 
			
				{echo $extracteir['FRA5_N_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA6_N_ZF']) && !empty ($extracteir['FRA6_N_ZF'])) 
			
				{echo $extracteir['FRA6_N_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA7_N_ZF']) && !empty ($extracteir['FRA7_N_ZF'])) 
			
				{echo $extracteir['FRA7_N_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA8_N_ZF']) && !empty ($extracteir['FRA8_N_ZF'])) 
			
				{echo $extracteir['FRA8_N_ZF'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="117">Reus</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA1_N_R']) && !empty ($extracteir['FRA1_N_R'])) 
			
				{echo $extracteir['FRA1_N_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA2_N_R']) && !empty ($extracteir['FRA2_N_R'])) 
			
				{echo $extracteir['FRA2_N_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA3_N_R']) && !empty ($extracteir['FRA3_N_R'])) 
			
				{echo $extracteir['FRA3_N_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA4_N_R']) && !empty ($extracteir['FRA4_N_R'])) 
			
				{echo $extracteir['FRA4_N_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA5_N_R']) && !empty ($extracteir['FRA5_N_R'])) 
			
				{echo $extracteir['FRA5_N_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA6_N_R']) && !empty ($extracteir['FRA6_N_R'])) 
			
				{echo $extracteir['FRA6_N_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA7_N_R']) && !empty ($extracteir['FRA7_N_R'])) 
			
				{echo $extracteir['FRA7_N_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA8_N_R']) && !empty ($extracteir['FRA8_N_R'])) 
			
				{echo $extracteir['FRA8_N_R'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="265" colspan="2">Total Nit</td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA1_N_ZF']) &&
				!empty ($extracteir['FRA1_N_R'])  ) 			
			{echo $extracteir['FRA1_N_R']+$extracteir['FRA1_N_ZF'];
			} 
			
			if (!empty ($extracteir['FRA1_N_ZF']) &&
				empty ($extracteir['FRA1_N_R'])  )
					{
					echo $extracteir['FRA1_N_ZF'];						
					}
					
			if (empty ($extracteir['FRA1_N_ZF']) &&
				!empty ($extracteir['FRA1_N_R'])  )
					{
					echo $extracteir['FRA1_N_R'];						
					}					
		 ?>		
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA2_N_ZF']) &&
				!empty ($extracteir['FRA2_N_R'])  ) 			
			{echo $extracteir['FRA2_N_R']+$extracteir['FRA2_N_ZF'];
			} 
			
			if (!empty ($extracteir['FRA2_N_ZF']) &&
				empty ($extracteir['FRA2_N_R'])  )
					{
					echo $extracteir['FRA2_N_ZF'];						
					}
					
			if (empty ($extracteir['FRA2_N_ZF']) &&
				!empty ($extracteir['FRA2_N_R'])  )
					{
					echo $extracteir['FRA2_N_R'];						
					}					
		 ?>		
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA3_N_ZF']) &&
				!empty ($extracteir['FRA3_N_R'])  ) 			
			{echo $extracteir['FRA3_N_R']+$extracteir['FRA3_N_ZF'];
			} 
			
			if (!empty ($extracteir['FRA3_N_ZF']) &&
				empty ($extracteir['FRA3_N_R'])  )
					{
					echo $extracteir['FRA3_N_ZF'];						
					}
					
			if (empty ($extracteir['FRA3_N_ZF']) &&
				!empty ($extracteir['FRA3_N_R'])  )
					{
					echo $extracteir['FRA3_N_R'];						
					}					
		 ?>		
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA4_N_ZF']) &&
				!empty ($extracteir['FRA4_N_R'])  ) 			
			{echo $extracteir['FRA4_N_R']+$extracteir['FRA4_N_ZF'];
			} 
			
			if (!empty ($extracteir['FRA4_N_ZF']) &&
				empty ($extracteir['FRA4_N_R'])  )
					{
					echo $extracteir['FRA4_N_ZF'];						
					}
					
			if (empty ($extracteir['FRA4_N_ZF']) &&
				!empty ($extracteir['FRA4_N_R'])  )
					{
					echo $extracteir['FRA4_N_R'];						
					}					
		 ?>	
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA5_N_ZF']) &&
				!empty ($extracteir['FRA5_N_R'])  ) 			
			{echo $extracteir['FRA5_N_R']+$extracteir['FRA5_N_ZF'];
			} 
			
			if (!empty ($extracteir['FRA5_N_ZF']) &&
				empty ($extracteir['FRA5_N_R'])  )
					{
					echo $extracteir['FRA5_N_ZF'];						
					}
					
			if (empty ($extracteir['FRA5_N_ZF']) &&
				!empty ($extracteir['FRA5_N_R'])  )
					{
					echo $extracteir['FRA5_N_R'];						
					}					
		 ?>	
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA6_N_ZF']) &&
				!empty ($extracteir['FRA6_N_R'])  ) 			
			{echo $extracteir['FRA6_N_R']+$extracteir['FRA6_N_ZF'];
			} 
			
			if (!empty ($extracteir['FRA6_N_ZF']) &&
				empty ($extracteir['FRA6_N_R'])  )
					{
					echo $extracteir['FRA6_N_ZF'];						
					}
					
			if (empty ($extracteir['FRA6_N_ZF']) &&
				!empty ($extracteir['FRA6_N_R'])  )
					{
					echo $extracteir['FRA6_N_R'];						
					}					
		 ?>	
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA7_N_ZF']) &&
				!empty ($extracteir['FRA7_N_R'])  ) 			
			{echo $extracteir['FRA7_N_R']+$extracteir['FRA7_N_ZF'];
			} 
			
			if (!empty ($extracteir['FRA7_N_ZF']) &&
				empty ($extracteir['FRA7_N_R'])  )
					{
					echo $extracteir['FRA7_N_ZF'];						
					}
					
			if (empty ($extracteir['FRA7_N_ZF']) &&
				!empty ($extracteir['FRA7_N_R'])  )
					{
					echo $extracteir['FRA7_N_R'];						
					}					
		 ?>	
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA8_N_ZF']) &&
				!empty ($extracteir['FRA8_N_R'])  ) 			
			{echo $extracteir['FRA8_N_R']+$extracteir['FRA8_N_ZF'];
			} 
			
			if (!empty ($extracteir['FRA8_N_ZF']) &&
				empty ($extracteir['FRA8_N_R'])  )
					{
					echo $extracteir['FRA8_N_ZF'];						
					}
					
			if (empty ($extracteir['FRA8_N_ZF']) &&
				!empty ($extracteir['FRA8_N_R'])  )
					{
					echo $extracteir['FRA8_N_R'];						
					}					
		 ?>	
		</strong></td>
	</tr>
	<tr>
		<td width="148" rowspan="3">Mati</td>
		<td width="117">Hora</td>
		<td width="40">08h</td>
		<td width="40">09h</td>
		<td width="40">10h</td>
		<td width="40">11h</td>
		<td width="40">12h</td>
		<td width="40">13h</td>
		<td width="40">14h</td>
		<td width="40">15h</td>
		<td width="971" rowspan="4">
		<?php 
			if (isset($extracteir['INCID_M']) && !empty ($extracteir['INCID_M'])) 
			
				{echo $extracteir['INCID_M'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="117">ZF</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA1_M_ZF']) && !empty ($extracteir['FRA1_M_ZF'])) 
			
				{echo $extracteir['FRA1_M_ZF'];
			}
		 ?>		
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA2_M_ZF']) && !empty ($extracteir['FRA2_M_ZF'])) 
			
				{echo $extracteir['FRA2_M_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA3_M_ZF']) && !empty ($extracteir['FRA3_M_ZF'])) 
			
				{echo $extracteir['FRA3_M_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA4_M_ZF']) && !empty ($extracteir['FRA4_M_ZF'])) 
			
				{echo $extracteir['FRA4_M_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA5_M_ZF']) && !empty ($extracteir['FRA5_M_ZF'])) 
			
				{echo $extracteir['FRA5_M_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA6_M_ZF']) && !empty ($extracteir['FRA6_M_ZF'])) 
			
				{echo $extracteir['FRA6_M_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA7_M_ZF']) && !empty ($extracteir['FRA7_M_ZF'])) 
			
				{echo $extracteir['FRA7_M_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA8_M_ZF']) && !empty ($extracteir['FRA8_M_ZF'])) 
			
				{echo $extracteir['FRA8_M_ZF'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="117">Reus</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA1_M_R']) && !empty ($extracteir['FRA1_M_R'])) 
			
				{echo $extracteir['FRA1_M_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA2_M_R']) && !empty ($extracteir['FRA2_M_R'])) 
			
				{echo $extracteir['FRA2_M_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA3_M_R']) && !empty ($extracteir['FRA3_M_R'])) 
			
				{echo $extracteir['FRA3_M_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA4_M_R']) && !empty ($extracteir['FRA4_M_R'])) 
			
				{echo $extracteir['FRA4_M_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA5_M_R']) && !empty ($extracteir['FRA5_M_R'])) 
			
				{echo $extracteir['FRA5_M_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA6_M_R']) && !empty ($extracteir['FRA6_M_R'])) 
			
				{echo $extracteir['FRA6_M_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA7_M_R']) && !empty ($extracteir['FRA7_M_R'])) 
			
				{echo $extracteir['FRA7_M_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA8_M_R']) && !empty ($extracteir['FRA8_M_R'])) 
			
				{echo $extracteir['FRA8_M_R'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="265" colspan="2">Total Mati</td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA1_M_ZF']) &&
				!empty ($extracteir['FRA1_M_R'])  ) 			
			{echo $extracteir['FRA1_M_R']+$extracteir['FRA1_M_ZF'];
			} 
			
			if (!empty ($extracteir['FRA1_M_ZF']) &&
				empty ($extracteir['FRA1_M_R'])  )
					{
					echo $extracteir['FRA1_M_ZF'];						
					}
					
			if (empty ($extracteir['FRA1_M_ZF']) &&
				!empty ($extracteir['FRA1_M_R'])  )
					{
					echo $extracteir['FRA1_M_R'];						
					}					
		 ?>	
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA2_M_ZF']) &&
				!empty ($extracteir['FRA2_M_R'])  ) 			
			{echo $extracteir['FRA2_M_R']+$extracteir['FRA2_M_ZF'];
			} 
			
			if (!empty ($extracteir['FRA2_M_ZF']) &&
				empty ($extracteir['FRA2_M_R'])  )
					{
					echo $extracteir['FRA2_M_ZF'];						
					}
					
			if (empty ($extracteir['FRA2_M_ZF']) &&
				!empty ($extracteir['FRA2_M_R'])  )
					{
					echo $extracteir['FRA2_M_R'];						
					}					
		 ?>	
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA3_M_ZF']) &&
				!empty ($extracteir['FRA3_M_R'])  ) 			
			{echo $extracteir['FRA3_M_R']+$extracteir['FRA3_M_ZF'];
			} 
			
			if (!empty ($extracteir['FRA3_M_ZF']) &&
				empty ($extracteir['FRA3_M_R'])  )
					{
					echo $extracteir['FRA3_M_ZF'];						
					}
					
			if (empty ($extracteir['FRA3_M_ZF']) &&
				!empty ($extracteir['FRA3_M_R'])  )
					{
					echo $extracteir['FRA3_M_R'];						
					}					
		 ?>	
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA4_M_ZF']) &&
				!empty ($extracteir['FRA4_M_R'])  ) 			
			{echo $extracteir['FRA4_M_R']+$extracteir['FRA4_M_ZF'];
			} 
			
			if (!empty ($extracteir['FRA4_M_ZF']) &&
				empty ($extracteir['FRA4_M_R'])  )
					{
					echo $extracteir['FRA4_M_ZF'];						
					}
					
			if (empty ($extracteir['FRA4_M_ZF']) &&
				!empty ($extracteir['FRA4_M_R'])  )
					{
					echo $extracteir['FRA4_M_R'];						
					}					
		 ?>	
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA5_M_ZF']) &&
				!empty ($extracteir['FRA5_M_R'])  ) 			
			{echo $extracteir['FRA5_M_R']+$extracteir['FRA5_M_ZF'];
			} 
			
			if (!empty ($extracteir['FRA5_M_ZF']) &&
				empty ($extracteir['FRA5_M_R'])  )
					{
					echo $extracteir['FRA5_M_ZF'];						
					}
					
			if (empty ($extracteir['FRA5_M_ZF']) &&
				!empty ($extracteir['FRA5_M_R'])  )
					{
					echo $extracteir['FRA5_M_R'];						
					}					
		 ?>	
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA6_M_ZF']) &&
				!empty ($extracteir['FRA6_M_R'])  ) 			
			{echo $extracteir['FRA6_M_R']+$extracteir['FRA6_M_ZF'];
			} 
			
			if (!empty ($extracteir['FRA6_M_ZF']) &&
				empty ($extracteir['FRA6_M_R'])  )
					{
					echo $extracteir['FRA6_M_ZF'];						
					}
					
			if (empty ($extracteir['FRA6_M_ZF']) &&
				!empty ($extracteir['FRA6_M_R'])  )
					{
					echo $extracteir['FRA6_M_R'];						
					}					
		 ?>	
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA7_M_ZF']) &&
				!empty ($extracteir['FRA7_M_R'])  ) 			
			{echo $extracteir['FRA7_M_R']+$extracteir['FRA7_M_ZF'];
			} 
			
			if (!empty ($extracteir['FRA7_M_ZF']) &&
				empty ($extracteir['FRA7_M_R'])  )
					{
					echo $extracteir['FRA7_M_ZF'];						
					}
					
			if (empty ($extracteir['FRA7_M_ZF']) &&
				!empty ($extracteir['FRA7_M_R'])  )
					{
					echo $extracteir['FRA7_M_R'];						
					}					
		 ?>	
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA8_M_ZF']) &&
				!empty ($extracteir['FRA8_M_R'])  ) 			
			{echo $extracteir['FRA8_M_R']+$extracteir['FRA8_M_ZF'];
			} 
			
			if (!empty ($extracteir['FRA8_M_ZF']) &&
				empty ($extracteir['FRA8_M_R'])  )
					{
					echo $extracteir['FRA8_M_ZF'];						
					}
					
			if (empty ($extracteir['FRA8_M_ZF']) &&
				!empty ($extracteir['FRA8_M_R'])  )
					{
					echo $extracteir['FRA8_M_R'];						
					}					
		 ?>	
		</strong></td>
	</tr>
	<tr>
		<td width="148" rowspan="3">Tarda</td>
		<td width="117">Hora</td>
		<td width="40">16h</td>
		<td width="40">17h</td>
		<td width="40">18h</td>
		<td width="40">19h</td>
		<td width="40">20h</td>
		<td width="40">21h</td>
		<td width="40">22h</td>
		<td width="40">23h</td>
		<td width="971" rowspan="4">
		<?php 
			if (isset($extracteir['INCID_T']) && !empty ($extracteir['INCID_T'])) 
			
				{echo $extracteir['INCID_T'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="117">ZF</td>
		<td width="40">		
		<?php 
			if (isset($extracteir['FRA1_T_ZF']) && !empty ($extracteir['FRA1_T_ZF'])) 
			
				{echo $extracteir['FRA1_T_ZF'];
			}
		 ?>	
		 </td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA2_T_ZF']) && !empty ($extracteir['FRA2_T_ZF'])) 
			
				{echo $extracteir['FRA2_T_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA3_T_ZF']) && !empty ($extracteir['FRA3_T_ZF'])) 
			
				{echo $extracteir['FRA3_T_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA4_T_ZF']) && !empty ($extracteir['FRA4_T_ZF'])) 
			
				{echo $extracteir['FRA4_T_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA5_T_ZF']) && !empty ($extracteir['FRA5_T_ZF'])) 
			
				{echo $extracteir['FRA5_T_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA6_T_ZF']) && !empty ($extracteir['FRA6_T_ZF'])) 
			
				{echo $extracteir['FRA6_T_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA7_T_ZF']) && !empty ($extracteir['FRA7_T_ZF'])) 
			
				{echo $extracteir['FRA7_T_ZF'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA8_T_ZF']) && !empty ($extracteir['FRA8_T_ZF'])) 
			
				{echo $extracteir['FRA8_T_ZF'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="117">Reus</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA1_T_R']) && !empty ($extracteir['FRA1_T_R'])) 
			
				{echo $extracteir['FRA1_T_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA2_T_R']) && !empty ($extracteir['FRA2_T_R'])) 
			
				{echo $extracteir['FRA2_T_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA3_T_R']) && !empty ($extracteir['FRA3_T_R'])) 
			
				{echo $extracteir['FRA3_T_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA4_T_R']) && !empty ($extracteir['FRA4_T_R'])) 
			
				{echo $extracteir['FRA4_T_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA5_T_R']) && !empty ($extracteir['FRA5_T_R'])) 
			
				{echo $extracteir['FRA5_T_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA6_T_R']) && !empty ($extracteir['FRA6_T_R'])) 
			
				{echo $extracteir['FRA6_T_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA7_T_R']) && !empty ($extracteir['FRA7_T_R'])) 
			
				{echo $extracteir['FRA7_T_R'];
			}
		 ?>	
		</td>
		<td width="40">
		<?php 
			if (isset($extracteir['FRA8_T_R']) && !empty ($extracteir['FRA8_T_R'])) 
			
				{echo $extracteir['FRA8_T_R'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="265" colspan="2">Total Tarda</td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA1_T_ZF']) &&
				!empty ($extracteir['FRA1_T_R'])  ) 			
			{echo $extracteir['FRA1_T_R']+$extracteir['FRA1_T_ZF'];
			} 
			
			if (!empty ($extracteir['FRA1_T_ZF']) &&
				empty ($extracteir['FRA1_T_R'])  )
					{
					echo $extracteir['FRA1_T_ZF'];						
					}
					
			if (empty ($extracteir['FRA1_T_ZF']) &&
				!empty ($extracteir['FRA1_T_R'])  )
					{
					echo $extracteir['FRA1_T_R'];						
					}					
		 ?>		
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA2_T_ZF']) &&
				!empty ($extracteir['FRA2_T_R'])  ) 			
			{echo $extracteir['FRA2_T_R']+$extracteir['FRA2_T_ZF'];
			} 
			
			if (!empty ($extracteir['FRA2_T_ZF']) &&
				empty ($extracteir['FRA2_T_R'])  )
					{
					echo $extracteir['FRA2_T_ZF'];						
					}
					
			if (empty ($extracteir['FRA2_T_ZF']) &&
				!empty ($extracteir['FRA2_T_R'])  )
					{
					echo $extracteir['FRA2_T_R'];						
					}					
		 ?>		
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA3_T_ZF']) &&
				!empty ($extracteir['FRA3_T_R'])  ) 			
			{echo $extracteir['FRA3_T_R']+$extracteir['FRA3_T_ZF'];
			} 
			
			if (!empty ($extracteir['FRA3_T_ZF']) &&
				empty ($extracteir['FRA3_T_R'])  )
					{
					echo $extracteir['FRA3_T_ZF'];						
					}
					
			if (empty ($extracteir['FRA3_T_ZF']) &&
				!empty ($extracteir['FRA3_T_R'])  )
					{
					echo $extracteir['FRA3_T_R'];						
					}					
		 ?>		
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA4_T_ZF']) &&
				!empty ($extracteir['FRA4_T_R'])  ) 			
			{echo $extracteir['FRA4_T_R']+$extracteir['FRA4_T_ZF'];
			} 
			
			if (!empty ($extracteir['FRA4_T_ZF']) &&
				empty ($extracteir['FRA4_T_R'])  )
					{
					echo $extracteir['FRA4_T_ZF'];						
					}
					
			if (empty ($extracteir['FRA4_T_ZF']) &&
				!empty ($extracteir['FRA4_T_R'])  )
					{
					echo $extracteir['FRA4_T_R'];						
					}					
		 ?>		
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA5_T_ZF']) &&
				!empty ($extracteir['FRA5_T_R'])  ) 			
			{echo $extracteir['FRA5_T_R']+$extracteir['FRA5_T_ZF'];
			} 
			
			if (!empty ($extracteir['FRA5_T_ZF']) &&
				empty ($extracteir['FRA5_T_R'])  )
					{
					echo $extracteir['FRA5_T_ZF'];						
					}
					
			if (empty ($extracteir['FRA5_T_ZF']) &&
				!empty ($extracteir['FRA5_T_R'])  )
					{
					echo $extracteir['FRA5_T_R'];						
					}					
		 ?>		
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA6_T_ZF']) &&
				!empty ($extracteir['FRA6_T_R'])  ) 			
			{echo $extracteir['FRA6_T_R']+$extracteir['FRA6_T_ZF'];
			} 
			
			if (!empty ($extracteir['FRA6_T_ZF']) &&
				empty ($extracteir['FRA6_T_R'])  )
					{
					echo $extracteir['FRA6_T_ZF'];						
					}
					
			if (empty ($extracteir['FRA6_T_ZF']) &&
				!empty ($extracteir['FRA6_T_R'])  )
					{
					echo $extracteir['FRA6_T_R'];						
					}					
		 ?>		
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA7_T_ZF']) &&
				!empty ($extracteir['FRA7_T_R'])  ) 			
			{echo $extracteir['FRA7_T_R']+$extracteir['FRA7_T_ZF'];
			} 
			
			if (!empty ($extracteir['FRA7_T_ZF']) &&
				empty ($extracteir['FRA7_T_R'])  )
					{
					echo $extracteir['FRA7_T_ZF'];						
					}
					
			if (empty ($extracteir['FRA7_T_ZF']) &&
				!empty ($extracteir['FRA7_T_R'])  )
					{
					echo $extracteir['FRA7_T_R'];						
					}					
		 ?>		
		</strong></td>
		<td width="40"><strong>
		<?php 
			if (!empty ($extracteir['FRA8_T_ZF']) &&
				!empty ($extracteir['FRA8_T_R'])  ) 			
			{echo $extracteir['FRA8_T_R']+$extracteir['FRA8_T_ZF'];
			} 
			
			if (!empty ($extracteir['FRA8_T_ZF']) &&
				empty ($extracteir['FRA8_T_R'])  )
					{
					echo $extracteir['FRA8_T_ZF'];						
					}
					
			if (empty ($extracteir['FRA8_T_ZF']) &&
				!empty ($extracteir['FRA8_T_R'])  )
					{
					echo $extracteir['FRA8_T_R'];						
					}					
		 ?>		
		</strong></td>
	</tr>
</table>
<br />
</div>	
<br />
<br />
	
	

<!-- ############ ACTIVACIO BORSA ########### -->
<div class="barrah2">
<A NAME="borsa"></A><h2>Activació de Borsa</h2>

<form action="" method="post" autocomplete="off" name="formab">
		Data*: <input type="date" name="abdata" size="8" required="true" class="input" value="<?php echo "$datashow"; ?>" />
		Horari*: <input type="text" name="abhorari" size="10" required="true" maxlength="30" class="input" />
		Centre*: <select name="abcentre" class="input">
					<option value="112">112</option>
					<option value="ZF">Zona Franca</option>
					<option value="R">Reus</option>
				</select>
		Nombre de gestors activats: <input type="text" name="abgestors" size="30" class="input" /><br />
		Motiu*: <br /><textarea name="abmotiu" class="input" rows="2"cols="122" required="true"></textarea>
		
		<br />
		<input type="submit" value="Insertar" class="boto"/><input type="reset" value="Esborrar" class="boto" />
	</form><br />

<?php
	
// comprovem que s'hagi escrit algo en alguns camps

if (isset ($_POST['abdata']) && !empty($_POST['abdata']) && 
	isset ($_POST['abhorari']) && !empty($_POST['abhorari']) &&
	isset ($_POST['abgestors']) && !empty($_POST['abgestors'])
	)
{
	//hora local en que es fa el registre i que es guardarà la bd
	/*
	A php.ini cal modificar la zona horaria:
	date.timezone = Europe/Madrid
	*/
	$abdatains = date('Y-m-d');
	$abhorains = date('H:i:s');

	//anomenem variables
	$abdata = $_POST['abdata'];
	$abhorari = $_POST['abhorari'];
	$abcentre = $_POST['abcentre'];
	$abgestors = $_POST['abgestors'];
	$abmotiu = $_POST['abmotiu'];
	
	//afegim slash a totes les cometes i apostrofs mitjançant escape
	$abdata2 =  mysql_real_escape_string($abdata);
	$abhorari2 =  mysql_real_escape_string($abhorari);
	$abcentre2 =  mysql_real_escape_string($abcentre);
	$abgestors2 =  mysql_real_escape_string($abgestors);
	$abmotiu2 =  mysql_real_escape_string($abmotiu);

	//connectem per introduir dades IRE
	$abconx=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$abconx)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	mysql_query("INSERT INTO borsa VALUES ('','$abdata','$abdatains','$abhorains','$nomusuari','$abhorari2','$abcentre2','$abgestors2','$abmotiu2')",$abconx);
	//echo "Dades insertades correctament";
	
 
	//reset del formulari per evitar F5
	$_POST = array();
	@header ("location:ok_borsa.php");
}
?>
	
	
<?php
	// ######### Activació Borsa -> taula que es mostra sempre en pantalla principal
	$datasenseab =  mysql_real_escape_string($datashow);
	
	$conab=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conab)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroab=mysql_query("SELECT * FROM borsa WHERE ABDATA='$datasenseab' ORDER BY ABHORAINS ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	
	echo "<th colspan=\"6\" class=\"taula\"><div align=\"left\">Activació de Borsa</div></th> \n";	
	
	echo "<tr> \n";

	echo "<td class=\"taula\" width=\"10%\"><b>Horari</b></td> \n";
	
	echo "<td class=\"taula\" width=\"4%\"><b>Cen</b></td> \n";	

	echo "<td class=\"taula\"width=\"27%\"><b>Nombre de gestors activats</b></td> \n";	
	
	echo "<td class=\"taula\"width=\"45%\"><b>Motiu</b></td> \n";	
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";	
	
	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";	
	
	echo "</tr> \n";
	
	//definim variable unica per permetre una fila anomenada Sense activacio en cas que no hi hagi cap dada
	$extracteabp = mysql_fetch_assoc($registroab);
	if (isset($extracteabp['ABDATA']) && !empty($extracteabp['ABDATA']) && $extracteabp['ABDATA'] == $datasenseab) 	
	{	
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseabz2 =  mysql_real_escape_string($datashow);
			
			$coneabz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$coneabz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroab2z=mysql_query("SELECT * FROM borsa WHERE ABDATA='$datasenseabz2' ")or die("Error en la consulta: ".mysql_error());
	
		while ($rowab = mysql_fetch_row($registroab2z))
		{	
			echo  "<tr> \n";
			echo  "<td>$rowab[5]</td> \n";
			echo  "<td>$rowab[6]</td> \n";
			echo  "<td>$rowab[7]</td> \n";
			echo  "<td>$rowab[8]</td> \n";
			echo  "<td><form action=\"borsamod.php\" method=\"post\" name=\"formab1\">";
			echo  "<input type=\"hidden\" name=\"idabmodificar\" value=\"$rowab[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"borsaelim.php\" method=\"post\" name=\"formab2\">";
			echo  "<input type=\"hidden\" name=\"idabeliminar\" value=\"$rowab[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\">Sense activació</td> \n 
				</tr> \n";
	}

	

	echo "</table> \n";	
	

	?>
<br />	
</div>
<!-- ____________ Fi activació borsa _________________ -->
<br />	
<br />	

<!-- ############ EPISODIS RELLEVANTS ########### -->
<div class="barrah2">
<A NAME="episodis"></A><h2>Episodis Rellevants</h2>

<form action="" method="post" autocomplete="off" name="former">
		Data*: <input type="date" name="erdata" size="8" maxlength="10" class="input" required="true" value="<?php echo "$datashow"; ?>" />
		Hora*: <input type="time" name="erhora" size="4" maxlength="5" class="input" required="true" value="hh:mm" onClick="this.select()" />
		Acr&ograve;nim: <input type="text" maxlength="30" name="eracronim" size="10" class="input" /><br />
		Descripci&oacute;*: <br /><textarea name="erdescripcio" class="input" rows="2"cols="122" required="true"></textarea>	
		<br />
		<input type="submit" value="Insertar" class="boto"/><input type="reset" value="Esborrar" class="boto" />
	</form><br />

<?php
	
// comprovem que s'hagi escrit algo en alguns camps

if (isset ($_POST['erhora']) && !empty($_POST['erhora']) && 
	isset ($_POST['erdata']) && !empty($_POST['erdata']) && 
	isset ($_POST['erdescripcio']) && !empty($_POST['erdescripcio']) 
	)
{
	//hora local en que es fa el registre i que es guardarà la bd
	/*
	A php.ini cal modificar la zona horaria:
	date.timezone = Europe/Madrid
	*/
	$erdatains = date('Y-m-d');
	$erhorains = date('H:i:s');

	//anomenem variables
	$erhora = $_POST['erhora'];
	$erdata = $_POST['erdata'];	
	$eracronim = $_POST['eracronim'];
	$erdescripcio = $_POST['erdescripcio'];
	
	//afegim slash a totes les cometes i apostrofs mitjançant escape
	$erhora2 =  mysql_real_escape_string($erhora);
	$erdata2 =  mysql_real_escape_string($erdata);
	$eracronim2 =  mysql_real_escape_string($eracronim);
	$erdescripcio2 =  mysql_real_escape_string($erdescripcio);


	//connectem per introduir dades IRE
	$erconx=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$erconx)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	mysql_query("INSERT INTO episodis VALUES ('','$erdatains','$erhorains','$nomusuari','$erhora2','$erdata2','$eracronim2','$erdescripcio2')",$erconx);
	//echo "Dades insertades correctament";
	
 
	//reset del formulari per evitar F5
	$_POST = array();
	@header ("location:ok_episodis.php");
}
?>
	
<?php
	// ######### Episodis Rellevants -> taula que es mostra sempre en pantalla principal
	$datasenseer =  mysql_real_escape_string($datashow);
	
	$conere=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conere)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroer2=mysql_query("SELECT * FROM episodis WHERE ERDATA='$datasenseer' ")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	
	echo "<th colspan=\"5\" class=\"taula\"><div align=\"left\">Episodis Rellevants</div></th> \n";	
	
	echo "<tr> \n";

	echo "<td class=\"taula\" width=\"8%\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\" width=\"10%\"><b>Acr&ograve;nim</b></td> \n";	

	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";	
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";	
	
	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";	
	
	echo "</tr> \n";
	
	//definim variable unica per permetre una fila anomenada Sense Episodis rellevants en cas que no hi hagi cap dada
	$extracteerp = mysql_fetch_assoc($registroer2);
	if (isset($extracteerp['ERDATA']) && !empty($extracteerp['ERDATA'])	&& 
				$extracteerp['ERDATA'] == $datasenseer) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseer2 =  mysql_real_escape_string($datashow);
			
			$conerez=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conerez)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroer2z=mysql_query("SELECT * FROM episodis WHERE ERDATA='$datasenseer2' ")or die("Error en la consulta: ".mysql_error());
			
		while ($rower = mysql_fetch_row($registroer2z))
		{	
			echo  "<tr> \n";
			$rower[4]=substr($rower[4],0,5);
			echo  "<td>$rower[4]h</td> \n";
			echo  "<td>$rower[6]</td> \n";
			echo  "<td>";			
			echo (nl2br($rower[7]));
			echo  "</td> \n";			
			echo  "<td><form action=\"episodismod.php\" method=\"post\" name=\"former1\">";
			echo  "<input type=\"hidden\" name=\"idermodificar\" value=\"$rower[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"episodiselim.php\" method=\"post\" name=\"former2\">";
			echo  "<input type=\"hidden\" name=\"idereliminar\" value=\"$rower[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"5\">Sense Episodis</td> \n 
				</tr> \n";
	}

	

	echo "</table> \n";	


//____________ Fi episodis rellevants _________________
	?>
<br />	
</div>
<br />	
<br />	
	
<div class="barrah2">
<A NAME="ires"></A><h2>Incidents Rellevants</h2>


	<!--INCIDENTS RELLEVANTS Formulari-->
	<form action="" method="post" autocomplete="off" name="form">
		Data*: <input type="date" name="data" size="8" required="true" class="input" value="<?php echo "$datashow"; ?>" /><br />
		Hora*: <input type="time" name="hora" size="4" value="hh:mm" required="true" maxlength="5" class="input" onClick="this.select()" />
		Ext: <input type="text" name="extensio" size="5" value="00000" maxlength="6" class="input" onClick="this.select()" />
		<!-- la extensió maxima de l'expedient s'hauria de revisar -->
		Exp: <input type="text" name="expedient" size="14" value="0000000000000" maxlength="14" class="input" onClick="this.select()" />
		Centre*: <select name="centre" class="input">
					<option value="112">112</option>
					<option value="ZF">Zona Franca</option>
					<option value="R">Reus</option>
				</select>
		Codi: <input type="text" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" name="codi" size="8" maxlength="15" class="input" />
		Municipi: 
		<select name="municipi" id="muni" class="input">
			<?php
			for ($i=1;$i<=7381;$i++) {
			echo "<option value=\"".$municipis[$i-1].
			"\">".$municipis[$i-1]."</option>\r";
			}
			?>
		</select>
		<br />
		Descripció*: <br /><textarea name="descripcio" rows="8"cols="122" required="true" class="input"></textarea>
		<br />
		<input type="submit" value="Insertar" class="boto"/><input type="reset" value="Esborrar" class="boto" />
	</form>
	<br />
	
<?php
	
	// 2ª part: comprovem que s'hagi escrit algo en alguns camps

if (isset ($_POST['data']) && !empty($_POST['data']) &&
	isset ($_POST['hora']) && !empty($_POST['hora']) &&
	//isset ($_POST['extensio']) && !empty($_POST['extensio']) &&
	//isset ($_POST['expedient']) && !empty($_POST['expedient']) &&
	isset ($_POST['centre']) && !empty($_POST['centre']) &&
	//isset ($_POST['codi']) && !empty($_POST['codi']) &&
	//isset ($_POST['municipi']) && !empty($_POST['municipi']) &&
	isset ($_POST['descripcio']) && !empty($_POST['descripcio']))
{
	//hora local en que es fa el registre i que es guardarà la bd
	/*
	A php.ini cal modificar la zona horaria:
	date.timezone = Europe/Madrid
	*/
	$datains = date('Y-m-d');
	$horains = date('H:i:s');

	//anomenem variables
	$data = $_POST['data'];
	$hora = $_POST['hora'];
	$extensio = $_POST['extensio'];
	$expedient = $_POST['expedient'];
	$centre = $_POST['centre'];
	$codi = $_POST['codi'];
	$municipi = $_POST['municipi'];
	$descripcio = $_POST['descripcio'];	
	
	//afegim slash a totes les cometes i apostrofs mitjançant escape
	$data2 =  mysql_real_escape_string($data);
	$hora2 =  mysql_real_escape_string($hora);
	$extensio2 =  mysql_real_escape_string($extensio);
	$expedient2 =  mysql_real_escape_string($expedient);
	$centre2 =  mysql_real_escape_string($centre);
	$codi2 =  mysql_real_escape_string($codi);
	$municipi2 =  mysql_real_escape_string($municipi);
	$descripcio2 =  mysql_real_escape_string($descripcio);		
	
	//connectem per introduir dades IRE
	$con=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	mysql_query("INSERT INTO activitat VALUES ('','$data2','$hora2','$extensio2','$centre2','$expedient2','$codi2','$municipi2','$descripcio2','$nomusuari','$datains','$horains')",$con);
	//echo "Dades insertades correctament";
	
 
	//reset del formulari per evitar F5
	$_POST = array();
	@header ("location:ok_ire.php");
}

?>
<br />
<?php
	// 3er pas: Incidents rellevants ->Taula que es mostra en pantalla sempre, referent al dia actual
	$dataxcons = date('Y-m-d');
	$datasense =  mysql_real_escape_string($dataxcons);

	$con2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registro2=mysql_query("SELECT * FROM activitat WHERE DATA='$datasense' ORDER BY HORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"9\" class=\"taula\"><div align=\"left\">Incidents Rellevants</div></th> \n";	
	
	echo "<tr> \n";

	//echo "<td><b>Data</b></td> \n";

	echo "<td class=\"taula\" width=\"8%\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\" width=\"5%\"><b>Ext</b></td> \n";

	echo "<td class=\"taula\" width=\"4%\"><b>Cen</b></td> \n";

	echo "<td class=\"taula\"><b>Expedient</b></td> \n";

	echo "<td class=\"taula\"><b>Codi</b></td> \n";

	echo "<td class=\"taula\" width=\"8%\"><b>Municipi</b></td> \n";	
	
	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";

	
	while ($rowb = mysql_fetch_row($registro2)){
	
	echo "<tr> \n";

	//data de l'incident 
	//echo "<td>$rowb[1]</td> \n";
	//hora
	$rowb[2]=substr($rowb[2],0,5);
	echo "<td>$rowb[2]" . "h</td> \n";
	//extensio
	echo "<td>$rowb[3]</td> \n";
	//Expedient
	echo "<td>$rowb[4]</td> \n";
	//centre
	echo "<td>$rowb[5]</td> \n";
	//Codi
	echo "<td>$rowb[6]</td> \n";
	//Municipi
	echo "<td>$rowb[7]</td> \n";
	//Descripció
	echo "<td>";
	echo (nl2br($rowb[8]));
	echo "</td> \n";

	echo "<td><form action=\"editar.php\" method=\"post\" name=\"form2\">
		<input type=\"hidden\" name=\"idmodificar\" value=\"$rowb[0]\"/>
		<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>
		</form></td> \n";
	
	echo "<td><form action=\"eliminar.php\" method=\"post\" name=\"form3\">
		<input type=\"hidden\" name=\"idmodificar\" value=\"$rowb[0]\"/>
		<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>
		</form></td> \n";
	
	echo "</tr> \n";

	}

	echo "</table> \n";
	
?>
<br />
</div>	
<br />
<br />


<!-- ######### SERVEIS OPERATIUS ########## -->
<div class="barrah2">
<A NAME="serveis"></A><h2>Serveis Operatius</h2>

	<form action="" method="post" autocomplete="off" name="formso">
		Data*: <input type="date" name="sodata" size="8" class="input" value="<?php echo "$datashow"; ?>" />
		Hora*: <input type="time" name="sohora" size="4" value="hh:mm" required="true" maxlength="5" class="input" onClick="this.select()" />
		Ext: <input type="text" name="soextensio" size="5" value="00000" maxlength="6" class="input" onClick="this.select()" />
		Centre*: <select name="socentre" class="input">
					<option value="112">112</option>
					<option value="ZF">Zona Franca</option>
					<option value="R">Reus</option>
				</select>
		Operatiu*: <select name="socos" class="input">
					<option value="Agents Rurals">Agents Rurals</option>
					<option value="Bombers">Bombers</option>
					<option value="Creu Roja">Creu Roja</option>
					<option value="Mossos de Seguretat">Mossos de Seguretat</option>
					<option value="Mossos de Transit">Mossos de Trànsit</option>
					<option value="Policia Local">Policia Local</option>
					<option value="Policia Nacional">Policia Nacional</option>
					<option value="Salvament Maritim">Salvament Marítim</option>
					<option value="Sanitat">Sanitat</option>
					<option value="Altres">Altres</option>
				</select>
		<br />
		Descripció*: <br /><textarea name="sodescripcio" rows="4"cols="122" required="true" class="input"></textarea>
		<br />
		<input type="submit" value="Insertar" class="boto"/><input type="reset" value="Esborrar" class="boto" />
	</form>
	<br />
	
<?php
	
	// 2ª part: comprovem que s'hagi escrit algo en alguns camps

if (isset ($_POST['sodata']) && !empty($_POST['sodata']) &&
	isset ($_POST['sohora']) && !empty($_POST['sohora']) &&
	isset ($_POST['sodescripcio']) && !empty($_POST['sodescripcio']))
{
	//hora local en que es fa el registre i que es guardarà la bd
	/*
	A php.ini cal modificar la zona horaria:
	date.timezone = Europe/Madrid
	*/
	$sodatains = date('Y-m-d');
	$sohorains = date('H:i:s');

	//anomenem variables
	$sodata = $_POST['sodata'];
	$sohora = $_POST['sohora'];
	$soextensio = $_POST['soextensio'];
	$socentre = $_POST['socentre'];
	$socos = $_POST['socos'];
	$sodescripcio = $_POST['sodescripcio'];	
	
	//afegim slash a totes les cometes i apostrofs mitjançant escape
	$sodata2 =  mysql_real_escape_string($sodata);
	$sohora2 =  mysql_real_escape_string($sohora);
	$soextensio2 =  mysql_real_escape_string($soextensio);
	$socentre2 =  mysql_real_escape_string($socentre);
	$socos2 =  mysql_real_escape_string($socos);
	$sodescripcio2 =  mysql_real_escape_string($sodescripcio);
	
	
	//connectem per introduir dades IRE
	$socon=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$socon)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	mysql_query("INSERT INTO serveis VALUES ('','$sodatains','$sohorains','$sodata2','$sohora2','$soextensio2','$socos2','$socentre2','$sodescripcio2','$nomusuari')",$socon);
	//echo "Dades insertades correctament";
	
 
	//reset del formulari per evitar F5
	$_POST = array();
	@header ("location:ok_serveis.php");
}

?>
<br />
<?php
	// 3er pas: SERVEIS OPERATIUS ->Taula AGENTS RURALS
	$dataxso = date('Y-m-d');
	$datasenseso =  mysql_real_escape_string($dataxso);

	$conso2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso2=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso' AND SOCOS='Agents Rurals'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"6\" class=\"taula\"><div align=\"left\">Agents Rurals</div></th> \n";	
	
	echo "<tr> \n";

	//echo "<td><b>Data</b></td> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\"><b>Ext</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso = mysql_fetch_assoc($registroso2);
	if (isset($extracteso['SODATA']) && !empty($extracteso['SODATA'])	&& 
				$extracteso['SODATA'] == $datasenseso) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso2 =  mysql_real_escape_string($datashow);
			
			$conesoz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso2z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso2' AND SOCOS='Agents Rurals'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso = mysql_fetch_row($registroerso2z))
		{	
			echo  "<tr> \n";
			$rowso[4]=substr($rowso[4],0,5);
			echo  "<td>$rowso[4]h</td> \n";
			echo  "<td>$rowso[5]</td> \n";
			echo  "<td>$rowso[7]</td> \n";
			//Descripció
			echo "<td>";
			echo (nl2br($rowso[8]));
			echo "</td> \n";		
			echo  "<td><form action=\"serveismod.php\" method=\"post\" name=\"formso1\">";
			echo  "<input type=\"hidden\" name=\"idsomodificar\" value=\"$rowso[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"serveiselim.php\" method=\"post\" name=\"formso2\">";
			echo  "<input type=\"hidden\" name=\"idsoeliminar\" value=\"$rowso[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";

	echo "<br />";
	
	// 3er pas: SERVEIS OPERATIUS ->Taula BOMBERS
	$dataxso2 = date('Y-m-d');
	$datasensesob =  mysql_real_escape_string($dataxso2);

	$conso3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso3)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso3=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasensesob' AND SOCOS='Bombers'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"6\" class=\"taula\"><div align=\"left\">Bombers</div></th> \n";	
	
	echo "<tr> \n";

	//echo "<td><b>Data</b></td> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\"><b>Ext</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso3 = mysql_fetch_assoc($registroso3);
	if (isset($extracteso3['SODATA']) && !empty($extracteso3['SODATA'])	&& 
				$extracteso3['SODATA'] == $datasensesob) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso23 =  mysql_real_escape_string($datashow);
			
			$conesoz3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz3)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso3z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso23' AND SOCOS='Bombers' ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso3 = mysql_fetch_row($registroerso3z))
		{	
			echo  "<tr> \n";
			$rowso3[4]=substr($rowso3[4],0,5);
			echo  "<td>$rowso3[4]h</td> \n";
			echo  "<td>$rowso3[5]</td> \n";
			echo  "<td>$rowso3[7]</td> \n";
			//Descripció
			echo "<td>";
			echo (nl2br($rowso3[8]));
			echo "</td> \n";		
			echo  "<td><form action=\"serveismod.php\" method=\"post\" name=\"formso13\">";
			echo  "<input type=\"hidden\" name=\"idsomodificar\" value=\"$rowso3[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"serveiselim.php\" method=\"post\" name=\"formso23\">";
			echo  "<input type=\"hidden\" name=\"idsoeliminar\" value=\"$rowso3[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";	
	
	echo "<br />";
	// 3er pas: SERVEIS OPERATIUS ->Taula CREU ROJA
	$dataxso4 = date('Y-m-d');
	$datasensesoc =  mysql_real_escape_string($dataxso4);

	$conso4=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso4)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso4=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasensesoc' AND SOCOS='Creu Roja'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"6\" class=\"taula\"><div align=\"left\">Creu Roja</div></th> \n";	
	
	echo "<tr> \n";

	//echo "<td><b>Data</b></td> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\"><b>Ext</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso4 = mysql_fetch_assoc($registroso4);
	if (isset($extracteso4['SODATA']) && !empty($extracteso4['SODATA'])	&& 
				$extracteso4['SODATA'] == $datasensesoc) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso24 =  mysql_real_escape_string($datashow);
			
			$conesoz4=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz4)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso4z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso24' AND SOCOS='Creu Roja' ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso4 = mysql_fetch_row($registroerso4z))
		{	
			echo  "<tr> \n";
			$rowso4[4]=substr($rowso4[4],0,5);
			echo  "<td>$rowso4[4]h</td> \n";
			echo  "<td>$rowso4[5]</td> \n";
			echo  "<td>$rowso4[7]</td> \n";
			//Descripció
			echo "<td>";
			echo (nl2br($rowso4[8]));
			echo "</td> \n";		
			echo  "<td><form action=\"serveismod.php\" method=\"post\" name=\"formso14\">";
			echo  "<input type=\"hidden\" name=\"idsomodificar\" value=\"$rowso4[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"serveiselim.php\" method=\"post\" name=\"formso24\">";
			echo  "<input type=\"hidden\" name=\"idsoeliminar\" value=\"$rowso4[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";	
	
	echo "<br />";
	// 3er pas: SERVEIS OPERATIUS ->Taula MOSSOS SEGURETAT
	$dataxso5 = date('Y-m-d');
	$datasensesod =  mysql_real_escape_string($dataxso5);

	$conso5=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso5)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso5=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasensesod' AND SOCOS='Mossos de Seguretat'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"6\" class=\"taula\"><div align=\"left\">Mossos de Seguretat</div></th> \n";	
	
	echo "<tr> \n";

	//echo "<td><b>Data</b></td> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\"><b>Ext</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso5 = mysql_fetch_assoc($registroso5);
	if (isset($extracteso5['SODATA']) && !empty($extracteso5['SODATA'])	&& 
				$extracteso5['SODATA'] == $datasensesod) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso25 =  mysql_real_escape_string($datashow);
			
			$conesoz5=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz5)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso5z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso25' AND SOCOS='Mossos de Seguretat' ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso5 = mysql_fetch_row($registroerso5z))
		{	
			echo  "<tr> \n";
			$rowso5[4]=substr($rowso5[4],0,5);
			echo  "<td>$rowso5[4]h</td> \n";
			echo  "<td>$rowso5[5]</td> \n";
			echo  "<td>$rowso5[7]</td> \n";
			//Descripció
			echo "<td>";
			echo (nl2br($rowso5[8]));
			echo "</td> \n";		
			echo  "<td><form action=\"serveismod.php\" method=\"post\" name=\"formso15\">";
			echo  "<input type=\"hidden\" name=\"idsomodificar\" value=\"$rowso5[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"serveiselim.php\" method=\"post\" name=\"formso25\">";
			echo  "<input type=\"hidden\" name=\"idsoeliminar\" value=\"$rowso5[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";	

	echo "<br />";
	// 3er pas: SERVEIS OPERATIUS ->Taula MOSSOS TRANSIT
	$dataxso6 = date('Y-m-d');
	$datasensesoe =  mysql_real_escape_string($dataxso6);

	$conso6=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso6)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso6=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasensesoe' AND SOCOS='Mossos de Transit'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"6\" class=\"taula\"><div align=\"left\">Mossos de Trànsit</div></th> \n";	
	
	echo "<tr> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\"><b>Ext</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso6 = mysql_fetch_assoc($registroso6);
	if (isset($extracteso6['SODATA']) && !empty($extracteso6['SODATA'])	&& 
				$extracteso6['SODATA'] == $datasensesoe) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso26 =  mysql_real_escape_string($datashow);
			
			$conesoz6=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz6)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso6z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso26' AND SOCOS='Mossos de Transit' ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso6 = mysql_fetch_row($registroerso6z))
		{	
			echo  "<tr> \n";
			$rowso6[4]=substr($rowso6[4],0,5);
			echo  "<td>$rowso6[4]h</td> \n";
			echo  "<td>$rowso6[5]</td> \n";
			echo  "<td>$rowso6[7]</td> \n";
			//Descripció
			echo "<td>";
			echo (nl2br($rowso6[8]));
			echo "</td> \n";		
			echo  "<td><form action=\"serveismod.php\" method=\"post\" name=\"formso16\">";
			echo  "<input type=\"hidden\" name=\"idsomodificar\" value=\"$rowso6[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"serveiselim.php\" method=\"post\" name=\"formso26\">";
			echo  "<input type=\"hidden\" name=\"idsoeliminar\" value=\"$rowso6[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";	
	echo "<br />";	

	// 3er pas: SERVEIS OPERATIUS ->Taula POLICIA LOCAL
	$dataxso7 = date('Y-m-d');
	$datasensesod =  mysql_real_escape_string($dataxso7);

	$conso7=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso7)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso7=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasensesod' AND SOCOS='Policia Local'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"6\" class=\"taula\"><div align=\"left\">Policia Local</div></th> \n";	
	
	echo "<tr> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\"><b>Ext</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso7 = mysql_fetch_assoc($registroso7);
	if (isset($extracteso7['SODATA']) && !empty($extracteso7['SODATA'])	&& 
				$extracteso7['SODATA'] == $datasensesod) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso27 =  mysql_real_escape_string($datashow);
			
			$conesoz7=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz7)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso7z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso27' AND SOCOS='Policia Local' ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso7 = mysql_fetch_row($registroerso7z))
		{	
			echo  "<tr> \n";
			$rowso7[4]=substr($rowso7[4],0,5);
			echo  "<td>$rowso7[4]h</td> \n";
			echo  "<td>$rowso7[5]</td> \n";
			echo  "<td>$rowso7[7]</td> \n";
			//Descripció
			echo "<td>";
			echo (nl2br($rowso7[8]));
			echo "</td> \n";		
			echo  "<td><form action=\"serveismod.php\" method=\"post\" name=\"formso17\">";
			echo  "<input type=\"hidden\" name=\"idsomodificar\" value=\"$rowso7[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"serveiselim.php\" method=\"post\" name=\"formso27\">";
			echo  "<input type=\"hidden\" name=\"idsoeliminar\" value=\"$rowso7[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";	
	
	echo "<br />";	

	// 3er pas: SERVEIS OPERATIUS ->Taula POLICIA NACIONAL
	$dataxso8 = date('Y-m-d');
	$datasensesoe =  mysql_real_escape_string($dataxso8);

	$conso8=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso8)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso8=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasensesoe' AND SOCOS='Policia Nacional'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"6\" class=\"taula\"><div align=\"left\">Policia Nacional</div></th> \n";	
	
	echo "<tr> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\"><b>Ext</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso8 = mysql_fetch_assoc($registroso8);
	if (isset($extracteso8['SODATA']) && !empty($extracteso8['SODATA'])	&& 
				$extracteso8['SODATA'] == $datasensesoe) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso28 =  mysql_real_escape_string($datashow);
			
			$conesoz8=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz8)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso8z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso28' AND SOCOS='Policia Nacional' ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso8 = mysql_fetch_row($registroerso8z))
		{	
			echo  "<tr> \n";
			$rowso8[4]=substr($rowso8[4],0,5);
			echo  "<td>$rowso8[4]h</td> \n";
			echo  "<td>$rowso8[5]</td> \n";
			echo  "<td>$rowso8[7]</td> \n";
			//Descripció
			echo "<td>";
			echo (nl2br($rowso8[8]));
			echo "</td> \n";		
			echo  "<td><form action=\"serveismod.php\" method=\"post\" name=\"formso18\">";
			echo  "<input type=\"hidden\" name=\"idsomodificar\" value=\"$rowso8[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"serveiselim.php\" method=\"post\" name=\"formso28\">";
			echo  "<input type=\"hidden\" name=\"idsoeliminar\" value=\"$rowso8[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";
	
	echo "<br />";	

	// 3er pas: SERVEIS OPERATIUS ->Taula SALVAMENT MARITIM
	$dataxso9 = date('Y-m-d');
	$datasensesof =  mysql_real_escape_string($dataxso8);

	$conso9=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso9)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso9=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasensesof' AND SOCOS='Salvament Maritim'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"6\" class=\"taula\"><div align=\"left\">Salvament Marítim</div></th> \n";	
	
	echo "<tr> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\"><b>Ext</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso9 = mysql_fetch_assoc($registroso9);
	if (isset($extracteso9['SODATA']) && !empty($extracteso9['SODATA'])	&& 
				$extracteso9['SODATA'] == $datasensesof) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso29 =  mysql_real_escape_string($datashow);
			
			$conesoz9=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz9)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso9z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso29' AND SOCOS='Salvament Maritim' ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso9 = mysql_fetch_row($registroerso9z))
		{	
			echo  "<tr> \n";
			$rowso9[4]=substr($rowso9[4],0,5);
			echo  "<td>$rowso9[4]h</td> \n";
			echo  "<td>$rowso9[5]</td> \n";
			echo  "<td>$rowso9[7]</td> \n";
			//Descripció
			echo "<td>";
			echo (nl2br($rowso9[8]));
			echo "</td> \n";		
			echo  "<td><form action=\"serveismod.php\" method=\"post\" name=\"formso19\">";
			echo  "<input type=\"hidden\" name=\"idsomodificar\" value=\"$rowso9[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"serveiselim.php\" method=\"post\" name=\"formso29\">";
			echo  "<input type=\"hidden\" name=\"idsoeliminar\" value=\"$rowso9[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";	
	
	echo "<br />";	

	// 3er pas: SERVEIS OPERATIUS ->Taula SANITAT
	$dataxso10 = date('Y-m-d');
	$datasensesog =  mysql_real_escape_string($dataxso10);

	$conso10=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso10)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso10=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasensesog' AND SOCOS='Sanitat'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"6\" class=\"taula\"><div align=\"left\">Sanitat</div></th> \n";	
	
	echo "<tr> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\"><b>Ext</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso10 = mysql_fetch_assoc($registroso10);
	if (isset($extracteso10['SODATA']) && !empty($extracteso10['SODATA'])	&& 
				$extracteso10['SODATA'] == $datasensesog) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso210 =  mysql_real_escape_string($datashow);
			
			$conesoz10=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz10)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso10z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso210' AND SOCOS='Sanitat' ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso10 = mysql_fetch_row($registroerso10z))
		{	
			echo  "<tr> \n";
			$rowso10[4]=substr($rowso10[4],0,5);
			echo  "<td>$rowso10[4]h</td> \n";
			echo  "<td>$rowso10[5]</td> \n";
			echo  "<td>$rowso10[7]</td> \n";
			//Descripció
			echo "<td>";
			echo (nl2br($rowso10[8]));
			echo "</td> \n";		
			echo  "<td><form action=\"serveismod.php\" method=\"post\" name=\"formso110\">";
			echo  "<input type=\"hidden\" name=\"idsomodificar\" value=\"$rowso10[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"serveiselim.php\" method=\"post\" name=\"formso210\">";
			echo  "<input type=\"hidden\" name=\"idsoeliminar\" value=\"$rowso10[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";		
	
	echo "<br />";	


	// 3er pas: SERVEIS OPERATIUS ->Taula ALTRES
	$dataxso12 = date('Y-m-d');
	$datasensesoi =  mysql_real_escape_string($dataxso12);

	$conso12=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso12)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso12=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasensesoi' AND SOCOS='Altres'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"6\" class=\"taula\"><div align=\"left\">Altres</div></th> \n";	
	
	echo "<tr> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\"><b>Ext</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso12 = mysql_fetch_assoc($registroso12);
	if (isset($extracteso12['SODATA']) && !empty($extracteso12['SODATA'])	&& 
				$extracteso12['SODATA'] == $datasensesoi) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso212 =  mysql_real_escape_string($datashow);
			
			$conesoz12=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz12)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso12z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso212' AND SOCOS='Altres' ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso12 = mysql_fetch_row($registroerso12z))
		{	
			echo  "<tr> \n";
			$rowso12[4]=substr($rowso12[4],0,5);
			echo  "<td>$rowso12[4]h</td> \n";
			echo  "<td>$rowso12[5]</td> \n";
			echo  "<td>$rowso12[7]</td> \n";
			//Descripció
			echo "<td>";
			echo (nl2br($rowso12[8]));
			echo "</td> \n";		
			echo  "<td><form action=\"serveismod.php\" method=\"post\" name=\"formso112\">";
			echo  "<input type=\"hidden\" name=\"idsomodificar\" value=\"$rowso12[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"serveiselim.php\" method=\"post\" name=\"formso212\">";
			echo  "<input type=\"hidden\" name=\"idsoeliminar\" value=\"$rowso12[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";		
?>
<br />	
</div>
<br />
<br />

<!-- ######### SISTEMES ESPECIALS (ANTIC TAXI) ########## -->
<div class="barrah2">
<A NAME="taxi"></A><h2>Sistemes Especials</h2>

	<form action="" method="post" autocomplete="off" name="formtx">
		Data*: <input type="date" name="txdata" size="8" class="input" value="<?php echo "$datashow"; ?>" />
		Hora*: <input type="time" name="txhora" size="4" value="hh:mm" required="true" maxlength="5" class="input" onClick="this.select()" />
		Ext: <input type="text" name="txextensio" size="5" value="00000" maxlength="6" class="input" onClick="this.select()"  />
		Centre*: <select name="txcentre" class="input">
					<option value="112">112</option>
					<option value="ZF">Zona Franca</option>
					<option value="R">Reus</option>
				</select>
		<br />
		Descripció*: <br /><textarea name="txdescripcio" rows="2"cols="122" required="true" class="input"></textarea>
		<br />
		<input type="submit" value="Insertar" class="boto"/><input type="reset" value="Esborrar" class="boto" />
	</form>
	<br />
	
<?php
	
	// 2ª part: comprovem que s'hagi escrit algo en alguns camps

if (isset ($_POST['txdata']) && !empty($_POST['txdata']) &&
	isset ($_POST['txhora']) && !empty($_POST['txhora']) &&
	isset ($_POST['txdescripcio']) && !empty($_POST['txdescripcio']))
{
	//hora local en que es fa el registre i que es guardarà la bd
	/*
	A php.ini cal modificar la zona horaria:
	date.timezone = Europe/Madrid
	*/
	$txdatains = date('Y-m-d');
	$txhorains = date('H:i:s');

	//anomenem variables
	$txdata = $_POST['txdata'];
	$txhora = $_POST['txhora'];
	$txextensio = $_POST['txextensio'];
	$txcentre = $_POST['txcentre'];
	$txdescripcio = $_POST['txdescripcio'];	
	
	//afegim slash a totes les cometes i apostrofs mitjançant escape
	$txdata2 =  mysql_real_escape_string($txdata);
	$txhora2 =  mysql_real_escape_string($txhora);
	$txextensio2 =  mysql_real_escape_string($txextensio);
	$txcentre2 =  mysql_real_escape_string($txcentre);
	$txdescripcio2 =  mysql_real_escape_string($txdescripcio);
	
	
	//connectem per introduir dades IRE
	$txcon=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$txcon)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	mysql_query("INSERT INTO taxi VALUES ('','$txdatains','$txhorains','$txdata2','$txhora2','$txextensio2','$txcentre2','$txdescripcio2','$nomusuari')",$txcon);
	//echo "Dades insertades correctament";
	
 
	//reset del formulari per evitar F5
	$_POST = array();
	@header ("location:ok_taxi.php");
}

?>
<br />
<?php
	// 3er pas: TAXI -> taula que mostra els introduits
 	$dataxtx = date('Y-m-d');
	$datasensetx =  mysql_real_escape_string($dataxtx);

	$contx2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$contx2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registrotx2=mysql_query("SELECT * FROM taxi WHERE TXDATA='$datasensetx' ORDER BY TXHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"6\" class=\"taula\"><div align=\"left\">Sistemes Especials</div></th> \n";	
	
	echo "<tr> \n";



	echo "<td class=\"taula\" width=\"8%\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\" width=\"5%\"><b>Ext</b></td> \n";

	echo "<td class=\"taula\" width=\"4%\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extractetx = mysql_fetch_assoc($registrotx2);
	if (isset($extractetx['TXDATA']) && !empty($extractetx['TXDATA'])	&& 
				$extractetx['TXDATA'] == $datasensetx) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasensetx2 =  mysql_real_escape_string($datashow);
			
			$conetxz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conetxz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroertx2z=mysql_query("SELECT * FROM taxi WHERE TXDATA='$datasensetx2'ORDER BY TXHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowtx = mysql_fetch_row($registroertx2z))
		{	
			echo  "<tr> \n";
			$rowtx[4]=substr($rowtx[4],0,5);
			echo  "<td>$rowtx[4]h</td> \n";
			echo  "<td>$rowtx[5]</td> \n";
			echo  "<td>$rowtx[6]</td> \n";
			//Descripció
			echo "<td>";
			echo (nl2br($rowtx[7]));
			echo "</td> \n";		
			echo  "<td><form action=\"taxieditar.php\" method=\"post\" name=\"formtx1\">";
			echo  "<input type=\"hidden\" name=\"idtxmodificar\" value=\"$rowtx[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"taxieliminar.php\" method=\"post\" name=\"formtx2\">";
			echo  "<input type=\"hidden\" name=\"idtxeliminar\" value=\"$rowtx[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";

	echo "<br />";
	
	// ######### VALIDACIONS LLICÈNCIA (ANTIC VALIDACIONS DE TAXI)
	
?>	
	
</div>	

<br />
<br />
<div class="barrah2">
<A NAME="validacions"></A><h2>Validacions de Llicència</h2>

	<form action="" method="post" autocomplete="off" name="formva">
		Data*: <input type="date" name="vadata" size="8" class="input" required="true" value="<?php echo "$datashow"; ?>" />
		Llic&egrave;ncies:  <input type="number" name="vallic" size="3" value="0" maxlength="3" min="0" max="999" class="input" />
		OK: <input type="number" name="vaok" size="3" value="0" maxlength="3" value="0" min="0" max="999" class="input" />
		KO: <input type="number" name="vako" size="3" value="0" maxlength="3" value="0"  min="0" max="999" class="input" />
		Gestor: <input type="text" name="vagestor" size="16" class="input" />
		Torn*: <select name="vatorn" class="input">
					<option value="Nit">Nit</option>
					<option value="Matí">Mat&iacute;</option>
					<option value="Tarda">Tarda</option>
				</select> &nbsp
		P: <input type="radio" name="vanp" checked="yes" value="2" class="input" />		
		NP: <input type="radio" name="vanp" value="1" class="input" />		

		&nbsp &nbsp &nbsp
		<input type="submit" value="Insertar" class="boto"/><input type="reset" value="Esborrar" class="boto" />
	</form>
	<br />
	
<?php
	
	// 2ª part: comprovem que s'hagi escrit algo en alguns camps

if (isset ($_POST['vadata']) && !empty($_POST['vadata']) )
{

	//anomenem variables
	$vadata = $_POST['vadata'];
	$vallic = $_POST['vallic'];
	$vaok = $_POST['vaok'];
	$vako = $_POST['vako'];
	$vagestor = $_POST['vagestor'];	
	$vatorn = $_POST['vatorn'];	
	
	$vanp = $_POST['vanp'];

	
	$efectivitata = $vaok + $vako;
	$efectivitatb = $efectivitata * 100;
	$efectivitat = $efectivitatb / $vallic;
	
	//afegim slash a totes les cometes i apostrofs mitjançant escape
	$vadata2 =  mysql_real_escape_string($vadata);
	$vagestor2 =  mysql_real_escape_string($vagestor);
	$vatorn2 =  mysql_real_escape_string($vatorn);

	//select a sql per saber si ja hi ha dades o no, per saber si fer un INSERT o un UPDATE 

	$vacon0=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$vacon0)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
			//num de rows indiquen si hi ha dades o no
	$registrova0=mysql_query("SELECT * FROM validacions WHERE VADATA='$vadata2' AND VATORN='$vatorn2' ")or die("Error en la consulta: ".mysql_error());
	$columnestorn = mysql_num_rows($registrova0);
	
	
	if ($columnestorn == false)  
	{	  

		//si no hi ha dades connectem per introduir dades
	$vacon=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$vacon)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registrova0in=mysql_query("INSERT INTO validacions VALUES ('','$vadata2','$vallic','$vaok','$vako','$efectivitat','$vagestor2','$vanp','$vatorn2','$nomusuari')",$vacon);

	
	$_POST = array();
	@header ("location:ok_validacions.php");
	
	}else { 
		//si hi ha dades connectem per actualitzarles
		$vacona=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
		mysql_select_db($db,$vacona)or die("Hi ha problemes per connectar amb la base de dades");
		
		mysql_query("SET NAMES 'utf8'");
				
		$registre4vacona=mysql_query("UPDATE validacions SET VADATA='$vadata2', VALLICENCIES='$vallic', VAOK='$vaok',
		VAKO='$vako', VAEFECT='$efectivitat', VAGESTOR='$vagestor2', VANP='$vanp', VATORN='$vatorn2', VAAUTOR='$nomusuari' 
		WHERE VADATA='$vadata2' AND VATORN='$vatorn2'  ")or die("Error en la consulta: ".mysql_error());		
		
		$_POST = array();
		@header ("location:ok.php");		
	
			}
	
	
	
	
}

?>
<br />

<table class="ampletaula" border = '1'>
	<th colspan="8" class="taula"><div align="left">Validacions de llicència</div></th>
	<tr>
		<td class="taula"><b>Torn</b></td>
		<td class="taula"><b>Llic&egrave;ncies</b></td>
		<td class="taula"><b>OK</b></td>
		<td class="taula"><b>KO</b></td>
		<td class="taula"><b>Efectivitat %</b></td>
		<td class="taula"><b>Gestor</b></td>
		<td class="taula" width="7%"><b>Modificar</b></td>
		<td class="taula" width="7%"><b>Eliminar</b></td>
	</tr>
	<?php
	// 3er pas: VALIDACIONS -> taula que mostra els introduits
	
	// NIT
 	$dataxva = date('Y-m-d');
	$datasenseva =  mysql_real_escape_string($dataxva);

	$conva=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conva)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registrova=mysql_query("SELECT * FROM validacions WHERE VADATA='$datasenseva' AND VATORN='Nit' limit 1")or die("Error en la consulta: ".mysql_error());

	$extracteva = mysql_fetch_assoc($registrova);	

if (isset($extracteva['VADATA']) )
{
	if ( $extracteva['VANP'] == 2 )
	{			
			$dataxvaz = date('Y-m-d');
			$datasensevaz =  mysql_real_escape_string($dataxvaz);	
			
			$conevaz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conevaz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroervaz=mysql_query("SELECT * FROM validacions WHERE VADATA='$datasensevaz' AND VATORN='Nit'  limit 1")or die("Error en la consulta: ".mysql_error());
			
			while ($rowva = mysql_fetch_row($registroervaz))
			{	
				$llicenit = $rowva[2];
				$oknit = $rowva[3];
				$konit = $rowva[4];			
			
				echo  "<tr> \n";
				echo  "<td>Nit</td> \n";
				echo  "<td>$rowva[2]</td> \n";
				echo  "<td>$rowva[3]</td> \n";
				echo  "<td>$rowva[4]</td> \n";
				echo  "<td>$rowva[5] %</td> \n";
				echo  "<td>$rowva[6]</td> \n";

				echo  "<td><form action=\"validaciomod.php\" method=\"post\" name=\"formva1\">";
				echo  "<input type=\"hidden\" name=\"idvamodificar\" value=\"$rowva[0]\"/>";
				echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
				echo  "</form></td> \n";	
				echo  "<td><form action=\"validacioelim.php\" method=\"post\" name=\"formva2\">";
				echo  "<input type=\"hidden\" name=\"idvaeliminar\" value=\"$rowva[0]\"/>";
				echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
				echo  "</form></td> \n";
				echo  "</tr> \n";		
			}	
		} else {	
			$dataxvax = date('Y-m-d');
			$datasensevax =  mysql_real_escape_string($dataxvax);	
			
			$conevax=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conevax)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroervax=mysql_query("SELECT * FROM validacions WHERE VADATA='$datasensevax' AND VATORN='Nit' limit 1 ")or die("Error en la consulta: ".mysql_error());
			
			while ($rowvax = mysql_fetch_row($registroervax))
			{
				echo "<tr> \n"; 
				echo  "<td>Nit</td> \n";
				echo  "<td>NP</td> \n";
				echo  "<td>NP</td> \n";
				echo  "<td>NP</td> \n";
				echo  "<td>NP</td> \n";
				echo  "<td>NP</td> \n";
					echo  "<td><form action=\"validaciomod.php\" method=\"post\" name=\"formva1x\">";
					echo  "<input type=\"hidden\" name=\"idvamodificar\" value=\"$rowvax[0]\"/>";
					echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
					echo  "</form></td> \n";	
					echo  "<td><form action=\"validacioelim.php\" method=\"post\" name=\"formva2x\">";
					echo  "<input type=\"hidden\" name=\"idvaeliminar\" value=\"$rowvax[0]\"/>";
					echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
					echo  "</form></td> \n";
				echo "</tr> \n";
			}
	}
} else {
			echo "<tr> \n"; 
			echo  "<td>Nit</td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
		echo "</tr> \n";
}

	// MATI
 	$dataxva2 = date('Y-m-d');
	$datasenseva2 =  mysql_real_escape_string($dataxva2);

	$conva2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conva2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registrova2=mysql_query("SELECT * FROM validacions WHERE VADATA='$datasenseva2' AND VATORN='Matí' limit 1")or die("Error en la consulta: ".mysql_error());

	$extracteva2 = mysql_fetch_assoc($registrova2);	

if (isset($extracteva2['VADATA']) )
{
	if ( $extracteva2['VANP'] == 2 )
	{			
			$dataxvaz2 = date('Y-m-d');
			$datasensevaz2 =  mysql_real_escape_string($dataxvaz2);	
			
			$conevaz2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conevaz2)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroervaz2=mysql_query("SELECT * FROM validacions WHERE VADATA='$datasensevaz2' AND VATORN='Matí' limit 1 ")or die("Error en la consulta: ".mysql_error());
			
			while ($rowva2 = mysql_fetch_row($registroervaz2))
			{	
				$llicemati = $rowva2[2];
				$okmati = $rowva2[3];
				$komati = $rowva2[4];			
			
				echo  "<tr> \n";
				echo  "<td>Matí</td> \n";
				echo  "<td>$rowva2[2]</td> \n";
				echo  "<td>$rowva2[3]</td> \n";
				echo  "<td>$rowva2[4]</td> \n";
				echo  "<td>$rowva2[5] %</td> \n";
				echo  "<td>$rowva2[6]</td> \n";

				echo  "<td><form action=\"validaciomod.php\" method=\"post\" name=\"formva12\">";
				echo  "<input type=\"hidden\" name=\"idvamodificar\" value=\"$rowva2[0]\"/>";
				echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
				echo  "</form></td> \n";	
				echo  "<td><form action=\"validacioelim.php\" method=\"post\" name=\"formva22\">";
				echo  "<input type=\"hidden\" name=\"idvaeliminar\" value=\"$rowva2[0]\"/>";
				echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
				echo  "</form></td> \n";
				echo  "</tr> \n";		
			}	
		} else {	
			$dataxvax2 = date('Y-m-d');
			$datasensevax2 =  mysql_real_escape_string($dataxvax2);	
			
			$conevax2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conevax2)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroervax2=mysql_query("SELECT * FROM validacions WHERE VADATA='$datasensevax2' AND VATORN='Matí' limit 1 ")or die("Error en la consulta: ".mysql_error());
			
			while ($rowvax2 = mysql_fetch_row($registroervax2))
			{
				echo "<tr> \n"; 
				echo  "<td>Matí</td> \n";
				echo  "<td>NP</td> \n";
				echo  "<td>NP</td> \n";
				echo  "<td>NP</td> \n";
				echo  "<td>NP</td> \n";
				echo  "<td>NP</td> \n";
					echo  "<td><form action=\"validaciomod.php\" method=\"post\" name=\"formva1x2\">";
					echo  "<input type=\"hidden\" name=\"idvamodificar\" value=\"$rowvax2[0]\"/>";
					echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
					echo  "</form></td> \n";	
					echo  "<td><form action=\"validacioelim.php\" method=\"post\" name=\"formva2x2\">";
					echo  "<input type=\"hidden\" name=\"idvaeliminar\" value=\"$rowvax2[0]\"/>";
					echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
					echo  "</form></td> \n";			
				echo "</tr> \n";
			}
	}
} else {
			echo "<tr> \n"; 
			echo  "<td>Matí</td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
		echo "</tr> \n";
}

	// TARDA
 	$dataxva3 = date('Y-m-d');
	$datasenseva3 =  mysql_real_escape_string($dataxva3);

	$conva3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conva3)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registrova3=mysql_query("SELECT * FROM validacions WHERE VADATA='$datasenseva3' AND VATORN='Tarda' limit 1")or die("Error en la consulta: ".mysql_error());

	$extracteva3 = mysql_fetch_assoc($registrova3);	

if (isset($extracteva3['VADATA']) )
{
	if ( $extracteva3['VANP'] == 2 )
	{			
			$dataxvaz3 = date('Y-m-d');
			$datasensevaz3 =  mysql_real_escape_string($dataxvaz3);	
			
			$conevaz3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conevaz3)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroervaz3=mysql_query("SELECT * FROM validacions WHERE VADATA='$datasensevaz3' AND VATORN='Tarda' limit 1 ")or die("Error en la consulta: ".mysql_error());
			
			while ($rowva3 = mysql_fetch_row($registroervaz3))
			{	
				$llicetarda = $rowva3[2];
				$oktarda = $rowva3[3];
				$kotarda = $rowva3[4];
				echo  "<tr> \n";
				echo  "<td>Tarda</td> \n";
				echo  "<td>$rowva3[2]</td> \n";
				echo  "<td>$rowva3[3]</td> \n";
				echo  "<td>$rowva3[4]</td> \n";
				echo  "<td>$rowva3[5] %</td> \n";
				echo  "<td>$rowva3[6]</td> \n";

				echo  "<td><form action=\"validaciomod.php\" method=\"post\" name=\"formva13\">";
				echo  "<input type=\"hidden\" name=\"idvamodificar\" value=\"$rowva3[0]\"/>";
				echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
				echo  "</form></td> \n";	
				echo  "<td><form action=\"validacioelim.php\" method=\"post\" name=\"formva23\">";
				echo  "<input type=\"hidden\" name=\"idvaeliminar\" value=\"$rowva3[0]\"/>";
				echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
				echo  "</form></td> \n";
				echo  "</tr> \n";		
			}	
		} else 
		{
		
			$dataxvax3 = date('Y-m-d');
			$datasensevax3 =  mysql_real_escape_string($dataxvax3);	
			
			$conevax3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conevax3)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroervax3=mysql_query("SELECT * FROM validacions WHERE VADATA='$datasensevax3' AND VATORN='Tarda' limit 1 ")or die("Error en la consulta: ".mysql_error());
			
			while ($rowvax3 = mysql_fetch_row($registroervax3))
			{
				echo "<tr> \n"; 
				echo  "<td>Tarda</td> \n";
				echo  "<td>NP</td> \n";
				echo  "<td>NP</td> \n";
				echo  "<td>NP</td> \n";
				echo  "<td>NP</td> \n";
				echo  "<td>NP</td> \n";
					echo  "<td><form action=\"validaciomod.php\" method=\"post\" name=\"formva1x3\">";
					echo  "<input type=\"hidden\" name=\"idvamodificar\" value=\"$rowvax3[0]\"/>";
					echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
					echo  "</form></td> \n";	
					echo  "<td><form action=\"validacioelim.php\" method=\"post\" name=\"formva2x3\">";
					echo  "<input type=\"hidden\" name=\"idvaeliminar\" value=\"$rowvax3[0]\"/>";
					echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
					echo  "</form></td> \n";		
				echo "</tr> \n";
			}
		}
} else {
			echo "<tr> \n"; 
			echo  "<td>Tarda</td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
			echo  "<td></td> \n";
		echo "</tr> \n";
}	

 
	// TOTALS
		
		//comprovem total llicencies
		if (empty($llicenit)) {
		$llicenit = 0;
		}
		if (empty($llicemati)) {
		$llicemati = 0;
		}		
		if (empty($llicetarda)) {
		$llicetarda = 0;
		}
	
		$llicenciestotalspre = $llicenit + $llicemati + $llicetarda;
		
		if (empty ($llicenciestotalspre)) {
		$llicenciestotals = 0;
		}else ($llicenciestotals = $llicenciestotalspre);
		

		//comprovem total Ok		
		if (empty($oknit)) {
		$oknit = 0;
		}
		if (empty($okmati)) {
		$okmati = 0;
		}		
		if (empty($oktarda)) {
		$oktarda = 0;
		}		

		$oktotalspre = $oknit + $okmati + $oktarda;
		
		if (empty ($oktotalspre)) {
		$oktotals = 0;
		}else ($oktotals = $oktotalspre);


		//comprovem total Ko		
		if (empty($konit)) {
		$konit = 0;
		}
		if (empty($komati)) {
		$komati = 0;
		}		
		if (empty($kotarda)) {
		$kotarda = 0;
		}		

		$kototalspre = $konit + $komati + $kotarda;
		
		if (empty ($kototalspre)) {
		$kototals = 0;
		}else ($kototals = $kototalspre);


		//comprovem total efectivitat					

		if (isset($oktotals)  && isset($kototals) && isset($llicenciestotals)   )
		{
			if ($llicenciestotals == 0) 
			{ 
			$efectivitattotal5 = 0 ." %";			
			}	else 
					{
					$efectivitattotal = $oktotals + $kototals;
					$efectivitattotal2 = $efectivitattotal * 100;
					$efectivitattotal3 = $efectivitattotal2 / $llicenciestotals;	
					$efectivitattotal4 = round ($efectivitattotal3);
					$efectivitattotal5 = $efectivitattotal4." %";
					}
			
		}else ($efectivitattotal5 = NULL );			

		//celdes resultats
		
			echo "<tr> \n"; 
			echo  "<td><b>Totals</b></td> \n";
			echo  "<td><strong>";
			echo $llicenciestotals;
			echo "</strong></td> \n";
			echo  "<td><strong>";
			echo $oktotals;			
			echo "</strong></td> \n";
			echo  "<td><strong>";
			echo $kototals;					
			echo "</strong></td> \n";
			echo  "<td><strong>";
			echo $efectivitattotal5;
			echo "</strong></td> \n";
			echo  "<td colspan ='3' ></td> \n";

		echo "</tr> \n";	
	
	
	
?>
	
</table>
<br />

</div>
<br />
<br />

<!-- ######### SIMULACRES ########## -->
<div class="barrah2">
<A NAME="simulacres"></A><h2>Simulacres</h2>

	<form action="" method="post" autocomplete="off" name="formsi">
		Data*: <input type="date" name="sidata" size="8" required="true"  class="input" value="<?php echo "$datashow"; ?>" />
		Hora*: <input type="time" name="sihora" size="4" value="hh:mm" required="true" maxlength="5" class="input" onClick="this.select()" />
		Ext: <input type="text" name="siextensio" size="5" value="00000" maxlength="6" class="input" onClick="this.select()" />
		Centre*: <select name="sicentre" class="input">
					<option value="112">112</option>
					<option value="ZF">Zona Franca</option>
					<option value="R">Reus</option>
				</select>
		Tipus*: <select name="sitipus" class="input">
					<option value="Programat">Programat</option>
					<option value="No Programat">No Programat</option>
				</select>
		<br />
		Descripció*: <br /><textarea name="sidescripcio" rows="4"cols="122" required="true" class="input"></textarea>
		<br />
		<input type="submit" value="Insertar" class="boto"/><input type="reset" value="Esborrar" class="boto" />
	</form>
	<br />
	
<?php
	
	// 2ª part: comprovem que s'hagi escrit algo en alguns camps

if (isset ($_POST['sidata']) && !empty($_POST['sidata']) &&
	isset ($_POST['sihora']) && !empty($_POST['sihora']) &&
	isset ($_POST['sidescripcio']) && !empty($_POST['sidescripcio']))
{
	//hora local en que es fa el registre i que es guardarà la bd
	/*
	A php.ini cal modificar la zona horaria:
	date.timezone = Europe/Madrid
	*/
	$sidatains = date('Y-m-d');
	$sihorains = date('H:i:s');

	//anomenem variables
	$sidata = $_POST['sidata'];
	$sihora = $_POST['sihora'];
	$siextensio = $_POST['siextensio'];
	$sicentre = $_POST['sicentre'];
	$sitipus = $_POST['sitipus'];
	$sidescripcio = $_POST['sidescripcio'];	
	
	//afegim slash a totes les cometes i apostrofs mitjançant escape
	$sidata2 =  mysql_real_escape_string($sidata);
	$sihora2 =  mysql_real_escape_string($sihora);
	$siextensio2 =  mysql_real_escape_string($siextensio);
	$sicentre2 =  mysql_real_escape_string($sicentre);
	$sitipus2 =  mysql_real_escape_string($sitipus);
	$sidescripcio2 =  mysql_real_escape_string($sidescripcio);
	
	
	//connectem per introduir dades 
	$sicon=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$sicon)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	mysql_query("INSERT INTO simulacres VALUES ('','$sidatains','$sihorains','$sidata2','$sihora2','$siextensio2','$sitipus2','$sicentre2','$sidescripcio2','$nomusuari')",$sicon);
	//echo "Dades insertades correctament";
	
 
	//reset del formulari per evitar F5
	$_POST = array();
	@header ("location:ok_simulacres.php");
}

?>
<br />
<?php
	// 3er pas: SIMULACRES ->Taula PROGRAMATS
	$dataxsi = date('Y-m-d');
	$datasensesi =  mysql_real_escape_string($dataxsi);

	$consi2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$consi2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registrosi2=mysql_query("SELECT * FROM simulacres WHERE SIDATA='$datasensesi' AND SITIPUS='Programat'  ORDER BY SIHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"6\" class=\"taula\"><div align=\"left\">Programats</div></th> \n";	
	
	echo "<tr> \n";

	//echo "<td><b>Data</b></td> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\"><b>Ext</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extractesi = mysql_fetch_assoc($registrosi2);
	if (isset($extractesi['SIDATA']) && !empty($extractesi['SIDATA'])	&& 
				$extractesi['SIDATA'] == $datasensesi) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasensesi2 =  mysql_real_escape_string($datashow);
			
			$conesiz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesiz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroersi2z=mysql_query("SELECT * FROM simulacres WHERE SIDATA='$datasensesi2' AND SITIPUS='Programat'  ORDER BY SIHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowsi = mysql_fetch_row($registroersi2z))
		{	
			echo  "<tr> \n";
			$rowsi[4]=substr($rowsi[4],0,5);
			echo  "<td>$rowsi[4]h</td> \n";
			echo  "<td>$rowsi[5]</td> \n";
			echo  "<td>$rowsi[7]</td> \n";
			//Descripció
			echo "<td>";
			echo (nl2br($rowsi[8]));
			echo "</td> \n";		
			echo  "<td><form action=\"simulacresmod.php\" method=\"post\" name=\"formsi1\">";
			echo  "<input type=\"hidden\" name=\"idsimodificar\" value=\"$rowsi[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"simulacreselim.php\" method=\"post\" name=\"formsi2\">";
			echo  "<input type=\"hidden\" name=\"idsieliminar\" value=\"$rowsi[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";

	echo "<br />";
	
	// 3er pas: SIMULACRES ->Taula NO PROGRAMATS
	$dataxsi2b = date('Y-m-d');
	$datasensesib =  mysql_real_escape_string($dataxsi2b);

	$consi3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$consi3)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registrosi3=mysql_query("SELECT * FROM simulacres WHERE SIDATA='$datasensesib' AND SITIPUS='No Programat'  ORDER BY SIHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"6\" class=\"taula\"><div align=\"left\">No Programats</div></th> \n";	
	
	echo "<tr> \n";

	//echo "<td><b>Data</b></td> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\"><b>Ext</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extractesi3 = mysql_fetch_assoc($registrosi3);
	if (isset($extractesi3['SIDATA']) && !empty($extractesi3['SIDATA'])	&& 
				$extractesi3['SIDATA'] == $datasensesib) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasensesi23 =  mysql_real_escape_string($datashow);
			
			$conesiz3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesiz3)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroersi3z=mysql_query("SELECT * FROM simulacres WHERE SIDATA='$datasensesi23' AND SITIPUS='No Programat' ORDER BY SIHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowsi3 = mysql_fetch_row($registroersi3z))
		{	
			echo  "<tr> \n";
			$rowsi3[4]=substr($rowsi3[4],0,5);
			echo  "<td>$rowsi3[4]h</td> \n";
			echo  "<td>$rowsi3[5]</td> \n";
			echo  "<td>$rowsi3[7]</td> \n";
			//Descripció
			echo "<td>";
			echo (nl2br($rowsi3[8]));
			echo "</td> \n";		
			echo  "<td><form action=\"simulacresmod.php\" method=\"post\" name=\"formsi13\">";
			echo  "<input type=\"hidden\" name=\"idsimodificar\" value=\"$rowsi3[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"simulacreselim.php\" method=\"post\" name=\"formsi23\">";
			echo  "<input type=\"hidden\" name=\"idsieliminar\" value=\"$rowsi3[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";	
	
	echo "<br />";

?>

</div>
<br />
<br />



<div class="barrah2">
<A NAME="observacions"></A><h2>Gestions de Supervisió</h2>


	<!--GESTIONS DE SUPERVISIO (ANTIC OBSERVACIONS)Formulari-->
	<form action="" method="post" autocomplete="off" name="formob">
		Data*: <input type="date" name="dataob" size="8" required="true" class="input" value="<?php echo "$datashow"; ?>" />
		Hora*: <input type="time" name="horaob" size="4" value="hh:mm" required="true" maxlength="5" class="input" onClick="this.select()" />
		Centre*: <select name="centreob" class="input">
					<option value="112">112</option>
					<option value="ZF">Zona Franca</option>
					<option value="R">Reus</option>
				</select>
		<br />
		Descripció*: <br /><textarea name="descripcioob" rows="4"cols="122" required="true" class="input"></textarea>
		<br />
		<input type="submit" value="Insertar" class="boto"/><input type="reset" value="Esborrar" class="boto" />
	</form>
	<br />
	
<?php
	
	// 2ª part: comprovem que s'hagi escrit algo en alguns camps

if (isset ($_POST['dataob']) && !empty($_POST['dataob']) &&
	isset ($_POST['horaob']) && !empty($_POST['horaob']) &&
	isset ($_POST['centreob']) && !empty($_POST['centreob']) &&
	isset ($_POST['descripcioob']) && !empty($_POST['descripcioob']))
{

	$datainsob2 = date('Y-m-d');
	$horainsob2 = date('H:i:s');

	//anomenem variables
	$dataob = $_POST['dataob'];
	$horaob = $_POST['horaob'];
	$centreob = $_POST['centreob'];
	$descripcioob = $_POST['descripcioob'];	
	
	//afegim slash a totes les cometes i apostrofs mitjançant escape
	$dataob2 =  mysql_real_escape_string($dataob);
	$horaob2 =  mysql_real_escape_string($horaob);
	$centreob2 =  mysql_real_escape_string($centreob);
	$descripcioob2 =  mysql_real_escape_string($descripcioob);		
	
	//connectem per introduir dades IRE
	$conob=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conob)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	mysql_query("INSERT INTO observacions VALUES ('','$datainsob2','$horainsob2','$dataob2','$horaob2','$centreob2','$descripcioob2','$nomusuari')",$conob);
	//echo "Dades insertades correctament";
	
 
	//reset del formulari per evitar F5
	$_POST = array();
	@header ("location:ok_observacions.php");
}

?>
<br />
<?php
	// 3er pas: Observacions ->Taula que es mostra en pantalla sempre, referent al dia actual
	$dataxconsob = date('Y-m-d');
	$datasenseob =  mysql_real_escape_string($dataxconsob);

	$con2ob=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2ob)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registro2ob=mysql_query("SELECT * FROM observacions WHERE OBDATA='$datasenseob' ORDER BY OBHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"5\" class=\"taula\"><div align=\"left\">Gestions de Supervisió</div></th> \n";	
	
	echo "<tr> \n";

	//echo "<td><b>Data</b></td> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";
	
		//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteob3 = mysql_fetch_assoc($registro2ob);
	if (isset($extracteob3['OBDATA']) && !empty($extracteob3['OBDATA'])	&& 
				$extracteob3['OBDATA'] == $datasenseob) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseob23 =  mysql_real_escape_string($datashow);
			
			$coneobz3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$coneobz3)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroersi3z=mysql_query("SELECT * FROM observacions WHERE OBDATA='$datasenseob23' ORDER BY OBHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowob3 = mysql_fetch_row($registroersi3z))
		{	
			echo  "<tr> \n";
			$rowob3[4]=substr($rowob3[4],0,5);
			echo  "<td>$rowob3[4]h</td> \n";
			echo  "<td>$rowob3[5]</td> \n";
			//Descripció
			echo "<td>";
			echo (nl2br($rowob3[6]));
			echo "</td> \n";		
			echo  "<td><form action=\"obeditar.php\" method=\"post\" name=\"formob13\">";
			echo  "<input type=\"hidden\" name=\"idmodificarob\" value=\"$rowob3[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"obeliminar.php\" method=\"post\" name=\"formob23\">";
			echo  "<input type=\"hidden\" name=\"ideliminarob\" value=\"$rowob3[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"5\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";	
	
	echo "<br />";

?>
<br />
</div>	
<br />
<br />


<div class="barrah2">
<A NAME="incoperatives"></A><h2>Incidències d'Operativa</h2>


	<!--INCIDÈNCIES D'OPERATIVA Formulari-->
	<form action="" method="post" autocomplete="off" name="formio">
		Data*: <input type="date" name="dataio" size="8" required="true" class="input" value="<?php echo "$datashow"; ?>" />
		Hora*: <input type="time" name="horaio" size="4" value="hh:mm" required="true" maxlength="5" class="input" onClick="this.select()" />
		Centre*: <select name="centreio" class="input">
					<option value="112">112</option>
					<option value="ZF">Zona Franca</option>
					<option value="R">Reus</option>
				</select>
		<br />
		Descripció*: <br /><textarea name="descripcioio" rows="4"cols="122" required="true" class="input"></textarea>
		<br />
		<input type="submit" value="Insertar" class="boto"/><input type="reset" value="Esborrar" class="boto" />
	</form>
	<br />
	
<?php
	
	// 2ª part: comprovem que s'hagi escrit algo en alguns camps

if (isset ($_POST['dataio']) && !empty($_POST['dataio']) &&
	isset ($_POST['horaio']) && !empty($_POST['horaio']) &&
	isset ($_POST['centreio']) && !empty($_POST['centreio']) &&
	isset ($_POST['descripcioio']) && !empty($_POST['descripcioio']))
{

	$datainsio2 = date('Y-m-d');
	$horainsio2 = date('H:i:s');

	//anomenem variables
	$dataio = $_POST['dataio'];
	$horaio = $_POST['horaio'];
	$centreio = $_POST['centreio'];
	$descripcioio = $_POST['descripcioio'];	
	
	//afegim slash a totes les cometes i apostrofs mitjançant escape
	$dataio2 =  mysql_real_escape_string($dataio);
	$horaio2 =  mysql_real_escape_string($horaio);
	$centreio2 =  mysql_real_escape_string($centreio);
	$descripcioio2 =  mysql_real_escape_string($descripcioio);		
	
	//connectem per introduir dades IRE
	$conio=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conio)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	mysql_query("INSERT INTO incidoperativa VALUES ('','$datainsio2','$horainsio2','$dataio2','$horaio2','$centreio2','$descripcioio2','$nomusuari')",$conio);
	//echo "Dades insertades correctament";
	
 
	//reset del formulari per evitar F5
	$_POST = array();
	@header ("location:ok_incoperatives.php");
}

?>
<br />
<?php
	// 3er pas: Taula que es mostra en pantalla sempre, referent al dia actual
	$dataxconsio = date('Y-m-d');
	$datasenseio =  mysql_real_escape_string($dataxconsio);

	$con2io=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2io)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registro2io=mysql_query("SELECT * FROM incidoperativa WHERE IODATA='$datasenseio' ORDER BY IOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"5\" class=\"taula\"><div align=\"left\">Incidències d'Operativa</div></th> \n";	
	
	echo "<tr> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";
	
		//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteio3 = mysql_fetch_assoc($registro2io);
	if (isset($extracteio3['IODATA']) && !empty($extracteio3['IODATA'])	&& 
				$extracteio3['IODATA'] == $datasenseio) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseio23 =  mysql_real_escape_string($datashow);
			
			$coneioz3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$coneioz3)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroio3z=mysql_query("SELECT * FROM incidoperativa WHERE IODATA='$datasenseio23' ORDER BY IOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowio3 = mysql_fetch_row($registroio3z))
		{	
			echo  "<tr> \n";
			$rowio3[4]=substr($rowio3[4],0,5);
			echo  "<td>$rowio3[4]h</td> \n";
			echo  "<td>$rowio3[5]</td> \n";
			//Descripció
			echo "<td>";
			echo (nl2br($rowio3[6]));
			echo "</td> \n";		
			echo  "<td><form action=\"ioeditar.php\" method=\"post\" name=\"formio13\">";
			echo  "<input type=\"hidden\" name=\"idmodificario\" value=\"$rowio3[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"ioeliminar.php\" method=\"post\" name=\"formio23\">";
			echo  "<input type=\"hidden\" name=\"idmodificario\" value=\"$rowio3[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"5\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";	
	
	echo "<br />";

?>
<br />
</div>	
<br />
<br />


<div class="barrah2">
<A NAME="inctecniques"></A><h2>Incidències Tècniques</h2>


	<!--INCIDÈNCIES TÈCNIQUES Formulari   IC-->
	<form action="" method="post" autocomplete="off" name="formic">
		Data*: <input type="date" name="dataic" size="8" required="true" class="input" value="<?php echo "$datashow"; ?>" />
		Hora*: <input type="time" name="horaic" size="4" value="hh:mm" required="true" maxlength="5" class="input" onClick="this.select()" />
		Centre*: <select name="centreic" class="input">
					<option value="112">112</option>
					<option value="ZF">Zona Franca</option>
					<option value="R">Reus</option>
				</select>
		<br />
		Descripció*: <br /><textarea name="descripcioic" rows="4"cols="122" required="true" class="input"></textarea>
		<br />
		<input type="submit" value="Insertar" class="boto"/><input type="reset" value="Esborrar" class="boto" />
	</form>
	<br />
	
<?php
	
	// 2ª part: comprovem que s'hagi escrit algo en alguns camps

if (isset ($_POST['dataic']) && !empty($_POST['dataic']) &&
	isset ($_POST['horaic']) && !empty($_POST['horaic']) &&
	isset ($_POST['centreic']) && !empty($_POST['centreic']) &&
	isset ($_POST['descripcioic']) && !empty($_POST['descripcioic']))
{

	$datainsic = date('Y-m-d');
	$horainsic = date('H:i:s');

	//anomenem variables
	$dataic = $_POST['dataic'];
	$horaic = $_POST['horaic'];
	$centreic = $_POST['centreic'];
	$descripcioic = $_POST['descripcioic'];	
	
	//afegim slash a totes les cometes i apostrofs mitjançant escape
	$dataic2 =  mysql_real_escape_string($dataic);
	$horaic2 =  mysql_real_escape_string($horaic);
	$centreic2 =  mysql_real_escape_string($centreic);
	$descripcioic2 =  mysql_real_escape_string($descripcioic);		
	
	//connectem per introduir dades 
	$conic=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conic)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	mysql_query("INSERT INTO incidtecniques VALUES ('','$datainsic','$horainsic','$dataic2','$horaic2','$centreic2','$descripcioic2','$nomusuari')",$conic);
	//echo "Dades insertades correctament";
	
 
	//reset del formulari per evitar F5
	$_POST = array();
	@header ("location:ok_inctecniques.php");
}

?>
<br />
<?php
	// 3er pas: Taula que es mostra en pantalla sempre, referent al dia actual
	$dataxconsic = date('Y-m-d');
	$datasenseic =  mysql_real_escape_string($dataxconsic);

	$con2ic=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2ic)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registro2ic=mysql_query("SELECT * FROM incidtecniques WHERE ICDATA='$datasenseic' ORDER BY ICHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"5\" class=\"taula\"><div align=\"left\">Incidències Tècniques</div></th> \n";	
	
	echo "<tr> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";
	
		//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteic3 = mysql_fetch_assoc($registro2ic);
	if (isset($extracteic3['ICDATA']) && !empty($extracteic3['ICDATA'])	&& 
				$extracteic3['ICDATA'] == $datasenseic) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseic23 =  mysql_real_escape_string($datashow);
			
			$coneicz3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$coneicz3)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroic3z=mysql_query("SELECT * FROM incidtecniques WHERE ICDATA='$datasenseic23' ORDER BY ICHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowic3 = mysql_fetch_row($registroic3z))
		{	
			echo  "<tr> \n";
			$rowic3[4]=substr($rowic3[4],0,5);
			echo  "<td>$rowic3[4]h</td> \n";
			echo  "<td>$rowic3[5]</td> \n";
			//Descripció
			echo "<td>";
			echo (nl2br($rowic3[6]));
			echo "</td> \n";		
			echo  "<td><form action=\"iceditar.php\" method=\"post\" name=\"formic13\">";
			echo  "<input type=\"hidden\" name=\"idmodificaric\" value=\"$rowic3[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"iceliminar.php\" method=\"post\" name=\"formic23\">";
			echo  "<input type=\"hidden\" name=\"idmodificaric\" value=\"$rowic3[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"5\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";	
	
	echo "<br />";

?>
<br />
</div>	
<br />
<br />

<!-- ######### INCIDENCIES TAXI ########## -->
<div class="barrah2">
<A NAME="inctaxi"></A><h2>Incidències en la gestió dels taxis</h2>

	<form action="" method="post" autocomplete="off" name="formit">
		Data*: <input type="date" name="itdata" size="8" required="true"  class="input" value="<?php echo "$datashow"; ?>" /><br />
		Hora*: <input type="time" name="ithora" size="4" value="hh:mm" required="true" maxlength="5" class="input" onClick="this.select()" />
		Ext: <input type="text" name="itextensio" size="5" value="00000" maxlength="6" class="input"  onClick="this.select()" />
		Centre*: <select name="itcentre" class="input">
					<option value="112">112</option>
					<option value="ZF">Zona Franca</option>
					<option value="R">Reus</option>
				</select>
		Tipus*: <select name="ittipus" class="input">
					<option value="Taxi no respon">Taxi no respon</option>
					<option value="Taxi no monitoritzat">Taxi no monitoritzat</option>
					<option value="Taxi repetitiu">Taxi repetitiu</option>
				</select>
		Llicència: <input type="text" name="itllicencia" size="8" maxlength="14" class="input" />				
		Id.Carta: <input type="text" name="itexpedient" size="14" value="0000000000000" maxlength="14" class="input"  onClick="this.select()"/>
		Nº trucades: <input type="number" class="input" name="itnumtruc" size="1" maxlength="3" min="0" max="999" value="" /> 
		<br />
		<input type="submit" value="Insertar" class="boto"/><input type="reset" value="Esborrar" class="boto" />
	</form>
	<br />
	
<?php
	
	// 2ª part: comprovem que s'hagi escrit algo en alguns camps

if (isset ($_POST['itdata']) && !empty($_POST['itdata']) &&
	isset ($_POST['ithora']) && !empty($_POST['ithora']) &&
	isset ($_POST['itllicencia']) && !empty($_POST['itllicencia']))
{

	$itdatains = date('Y-m-d');
	$ithorains = date('H:i:s');

	//anomenem variables
	$itdata = $_POST['itdata'];
	$ithora = $_POST['ithora'];
	$itextensio = $_POST['itextensio'];
	$itcentre = $_POST['itcentre'];
	$ittipus = $_POST['ittipus'];
	$itllicencia = $_POST['itllicencia'];	
	$itexpedient = $_POST['itexpedient'];	
	$itnumtruc = $_POST['itnumtruc'];	
	
	//afegim slash a totes les cometes i apostrofs mitjançant escape
	$itdata2 =  mysql_real_escape_string($itdata);
	$ithora2 =  mysql_real_escape_string($ithora);
	$itextensio2 =  mysql_real_escape_string($itextensio);
	$itcentre2 =  mysql_real_escape_string($itcentre);
	$ittipus2 =  mysql_real_escape_string($ittipus);
	$itllicencia2 =  mysql_real_escape_string($itllicencia);
	$itexpedient2 =  mysql_real_escape_string($itexpedient);
	$itnumtruc2 =  mysql_real_escape_string($itnumtruc);
	
	
	//connectem per introduir dades 
	$itcon=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$itcon)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	mysql_query("INSERT INTO incidtaxis VALUES ('','$itdatains','$ithorains','$itdata2','$ithora2','$itextensio2','$ittipus2','$itcentre2','$itexpedient2','$itnumtruc2','$itllicencia2','$nomusuari')",$itcon);
	//echo "Dades insertades correctament";
	
 
	//reset del formulari per evitar F5
	$_POST = array();
	@header ("location:ok_inctaxi.php");
}

?>
<br />
<?php
	// 3er pas: INCIDÈNCIES TAXI -> TAULA TAXIS NO RESPON
	$dataxit = date('Y-m-d');
	$datasenseit =  mysql_real_escape_string($dataxit);

	$conit2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conit2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroit2=mysql_query("SELECT * FROM incidtaxis WHERE ITDATA='$datasenseit' AND ITTIPUS='Taxi no respon'  ORDER BY ITHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"8\" class=\"taula\"><div align=\"left\">Taxi no respon</div></th> \n";	
	
	echo "<tr> \n";

	//echo "<td><b>Data</b></td> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\"><b>Ext</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Llicència</b></td> \n";
	
	echo "<td class=\"taula\"><b>Id.Carta</b></td> \n";
	
	echo "<td class=\"taula\"><b>Nº Trucades</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteit = mysql_fetch_assoc($registroit2);
	if (isset($extracteit['ITDATA']) && !empty($extracteit['ITDATA'])	&& 
				$extracteit['ITDATA'] == $datasenseit) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseit2 =  mysql_real_escape_string($datashow);
			
			$coneitz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$coneitz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerit2z=mysql_query("SELECT * FROM incidtaxis WHERE ITDATA='$datasenseit2' AND ITTIPUS='Taxi no respon'  ORDER BY ITHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowit = mysql_fetch_row($registroerit2z))
		{	
			echo  "<tr> \n";
			$rowit[4]=substr($rowit[4],0,5);
			echo  "<td>$rowit[4]h</td> \n";
			echo  "<td>$rowit[5]</td> \n";
			echo  "<td>$rowit[7]</td> \n";
			echo  "<td>$rowit[10]</td> \n";
			echo  "<td>$rowit[8]</td> \n";
			echo  "<td>$rowit[9]</td> \n";
		
			echo  "<td><form action=\"incidtaxismod.php\" method=\"post\" name=\"formit1\">";
			echo  "<input type=\"hidden\" name=\"iditmodificar\" value=\"$rowit[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"incidtaxiselim.php\" method=\"post\" name=\"formit2\">";
			echo  "<input type=\"hidden\" name=\"iditeliminar\" value=\"$rowit[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"8\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";

	echo "<br />";
	
	// 3er pas: INCIDENCIES TAXI ->Taula NO MONITORITZA
	$dataxit2b = date('Y-m-d');
	$datasenseitb =  mysql_real_escape_string($dataxit2b);

	$conit3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conit3)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroit3=mysql_query("SELECT * FROM incidtaxis WHERE ITDATA='$datasenseitb' AND ITTIPUS='Taxi no monitoritzat'  ORDER BY ITHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"8\" class=\"taula\"><div align=\"left\">Taxis no monitoritzats automàticament</div></th> \n";	
	
	echo "<tr> \n";

	//echo "<td><b>Data</b></td> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\"><b>Ext</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Llicència</b></td> \n";
	
	echo "<td class=\"taula\"><b>Id.Carta</b></td> \n";
	
	echo "<td class=\"taula\"><b>Nº Trucades</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteit3 = mysql_fetch_assoc($registroit3);
	if (isset($extracteit3['ITDATA']) && !empty($extracteit3['ITDATA'])	&& 
				$extracteit3['ITDATA'] == $datasenseitb) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseit23 =  mysql_real_escape_string($datashow);
			
			$coneitz3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$coneitz3)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerit3z=mysql_query("SELECT * FROM incidtaxis WHERE ITDATA='$datasenseit23' AND ITTIPUS='Taxi no monitoritzat' ORDER BY ITHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowit3 = mysql_fetch_row($registroerit3z))
		{	
			echo  "<tr> \n";
			$rowit3[4]=substr($rowit3[4],0,5);
			echo  "<td>$rowit3[4]h</td> \n";
			echo  "<td>$rowit3[5]</td> \n";
			echo  "<td>$rowit3[7]</td> \n";
			echo  "<td>$rowit3[10]</td> \n";
			echo  "<td>$rowit3[8]</td> \n";
			echo  "<td>$rowit3[9]</td> \n";
	
			echo  "<td><form action=\"incidtaxismod.php\" method=\"post\" name=\"formit13\">";
			echo  "<input type=\"hidden\" name=\"iditmodificar\" value=\"$rowit3[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"incidtaxiselim.php\" method=\"post\" name=\"formit23\">";
			echo  "<input type=\"hidden\" name=\"iditeliminar\" value=\"$rowit3[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"8\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";	
	
	echo "<br />";

	
		// 3er pas: INCIDENCIES TAXI ->Taula REPETITIUS
	$dataxit2c = date('Y-m-d');
	$datasenseitc =  mysql_real_escape_string($dataxit2c);

	$conit4=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conit4)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroit4=mysql_query("SELECT * FROM incidtaxis WHERE ITDATA='$datasenseitc' AND ITTIPUS='Taxi repetitiu'  ORDER BY ITHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"8\" class=\"taula\"><div align=\"left\">Taxis repetitius</div></th> \n";	
	
	echo "<tr> \n";

	//echo "<td><b>Data</b></td> \n";

	echo "<td class=\"taula\"><b>Hora</b></td> \n";
	
	echo "<td class=\"taula\"><b>Ext</b></td> \n";

	echo "<td class=\"taula\"><b>Cen</b></td> \n";
	
	echo "<td class=\"taula\"><b>Llicència</b></td> \n";
	
	echo "<td class=\"taula\"><b>Id.Carta</b></td> \n";
	
	echo "<td class=\"taula\"><b>Nº Trucades</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteit4 = mysql_fetch_assoc($registroit4);
	if (isset($extracteit4['ITDATA']) && !empty($extracteit4['ITDATA'])	&& 
				$extracteit4['ITDATA'] == $datasenseitc) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseit234 =  mysql_real_escape_string($datashow);
			
			$coneitz4=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$coneitz4)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerit4z=mysql_query("SELECT * FROM incidtaxis WHERE ITDATA='$datasenseit234' AND ITTIPUS='Taxi repetitiu' ORDER BY ITHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowit4 = mysql_fetch_row($registroerit4z))
		{	
			echo  "<tr> \n";
			$rowit4[4]=substr($rowit4[4],0,5);
			echo  "<td>$rowit4[4]h</td> \n";
			echo  "<td>$rowit4[5]</td> \n";
			echo  "<td>$rowit4[7]</td> \n";
			echo  "<td>$rowit4[10]</td> \n";
			echo  "<td>$rowit4[8]</td> \n";
			echo  "<td>$rowit4[9]</td> \n";
	
			echo  "<td><form action=\"incidtaxismod.php\" method=\"post\" name=\"formit13\">";
			echo  "<input type=\"hidden\" name=\"iditmodificar\" value=\"$rowit4[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"incidtaxiselim.php\" method=\"post\" name=\"formit23\">";
			echo  "<input type=\"hidden\" name=\"iditeliminar\" value=\"$rowit4[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"8\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";	
	
	echo "<br />";
	
	
?>

</div>
<br />
<br />

<div class="barrah2">
<A NAME="annexes"></A><h2>Annexes</h2>


	<!--ANNEXES Formulari-->
	<form action="" method="post" autocomplete="off" name="forman">
		Data*: <input type="date" name="dataan" size="8" required="true" class="input" value="<?php echo "$datashow"; ?>" />
		Arxiu: <input type="text" name="arxiuan" size="80" maxlength="199" class="input" />	
		<br />
		Descripció*: <br /><textarea name="descripcioan" rows="2"cols="122" required="true" class="input"></textarea>
		<br />
		<input type="submit" value="Insertar" class="boto"/><input type="reset" value="Esborrar" class="boto" />
	</form>
	<br />
	
<?php
	
	// 2ª part: comprovem que s'hagi escrit algo en alguns camps

if (isset ($_POST['dataan']) && !empty($_POST['dataan']) &&
	isset ($_POST['descripcioan']) && !empty($_POST['descripcioan']))
{

	$datainsan = date('Y-m-d');
	$horainsan = date('H:i:s');

	//anomenem variables
	$dataan = $_POST['dataan'];
	$arxiuan = $_POST['arxiuan'];
	$descripcioan = $_POST['descripcioan'];	
	
	//afegim slash a totes les cometes i apostrofs mitjançant escape
	$dataan2 =  mysql_real_escape_string($dataan);
	$arxiuan2 =  mysql_real_escape_string($arxiuan);
	$descripcioan2 =  mysql_real_escape_string($descripcioan);

	
	//connectem per introduir dades 
	$conan=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conan)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	mysql_query("INSERT INTO annexes VALUES ('','$datainsan','$horainsan','$dataan2','$descripcioan2','$arxiuan2','$nomusuari')",$conan);
	//echo "Dades insertades correctament";
	
 
	//reset del formulari per evitar F5
	$_POST = array();
	@header ("location:ok_annexes.php");
}

?>
<br />
<?php
	// 3er pas: Taula que es mostra en pantalla sempre, referent al dia actual
	$dataxconsan = date('Y-m-d');
	$datasensean =  mysql_real_escape_string($dataxconsan);

	$con2an=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2an)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registro2an=mysql_query("SELECT * FROM annexes WHERE ANDATA='$datasensean' ORDER BY ANHORAINS ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table class=\"ampletaula\" border = '1'> \n";
	

	echo "<th colspan=\"4\" class=\"taula\"><div align=\"left\">Annexes</div></th> \n";	
	
	echo "<tr> \n";

	echo "<td class=\"taula\"><b>Descripci&oacute;</b></td> \n";
	
	echo "<td class=\"taula\"><b>Arxiu</b></td> \n";
	
	echo "<td class=\"taula\" width=\"7%\"><b>Modificar</b></td> \n";

	echo "<td class=\"taula\" width=\"7%\"><b>Eliminar</b></td> \n";
	
	echo "</tr> \n";
	
		//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extractean3 = mysql_fetch_assoc($registro2an);
	if (isset($extractean3['ANDATA']) && !empty($extractean3['ANDATA'])	&& 
				$extractean3['ANDATA'] == $datasensean) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasensean23 =  mysql_real_escape_string($datashow);
			
			$coneanz3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$coneanz3)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroan3z=mysql_query("SELECT * FROM annexes WHERE ANDATA='$datasensean23' ORDER BY ANHORAINS ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowan3 = mysql_fetch_row($registroan3z))
		{	
			echo  "<tr> \n";
			//Descripció
			echo "<td>";
			echo (nl2br($rowan3[4]));
			echo "</td> \n";		
			echo  "<td><i>$rowan3[5] </i></td> \n";						
			echo  "<td><form action=\"aneditar.php\" method=\"post\" name=\"forman13\">";
			echo  "<input type=\"hidden\" name=\"idmodificaran\" value=\"$rowan3[0]\"/>";
			echo  "<input type=\"submit\" value=\"Modificar\" class=\"botoa\"/>";
			echo  "</form></td> \n";	
			echo  "<td><form action=\"aneliminar.php\" method=\"post\" name=\"forman23\">";
			echo  "<input type=\"hidden\" name=\"idmodificaran\" value=\"$rowan3[0]\"/>";
			echo  "<input type=\"submit\" value=\"Eliminar\"class=\"botoe\"/>";
			echo  "</form></td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"4\">Sense arxius adjunts</td> \n 
				</tr> \n";
	}

	echo "</table> \n";	
	
	echo "<br />";

?>
<br />
</div>	
<br />
<br />



<br />	
<br />
<?php require_once("footer.php"); ?>

