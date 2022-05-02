<?php include("connexio.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Informes d'Activitat 112</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
</head>
<body>

<?php
$datashow2 = $_POST['datashow'];
$datashowtitol=date("Ymd",strtotime($datashow2));
$datashow3=date("d/m/Y",strtotime($datashow2));

$datasense2 =  mysql_real_escape_string($datashow2);
header('Content-Type: application/msword');
header('Content-Disposition:inline;filename="Informe_'.$datashowtitol.'.doc"');

// ESTIL :
//<table border=\"1\" bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\" id=\"table2\">
//<span lang=\"CA\" style=\"font-size: 18.0pt; font-family: Arial\">


//capçalera
//
// MOLT IMPORTANT!! LA IMATGE LOGO HA D'ESTAR EN RUTA AMB L'ARXIU DESCARREGAT !!!
echo "
<table border=\"0\" width=\"100%\" id=\"table1\">
	<tr>
		<td width=\"175\">
		<img border=\"0\" src=\"imatges/logotip2.jpg\"></td>
		<td width=\"20\">&nbsp;</td>
		<td align=\"center\">
		<table border=\"1\" bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\" id=\"table2\">
			<tr>
				<td align=\"center\">
				<p align=\"center\" style=\"text-align: center; background: white\">&nbsp;</p>
				<p align=\"center\" style=\"text-align: center; background: white\">
				<b>
				<span lang=\"CA\" style=\"font-size: 18.0pt; font-family: Arial\">
				INFORME ACTIVITAT SERVEI</span></b></p>
				<p align=\"center\" style=\"text-align: center; background: white\">&nbsp;</td>
			</tr>
		</table>
	</tr>
</table>
";

echo "<br /><br />";

//############# DATA ################
echo "
<table border=\"2\" width=\"100%\" bordercolor=\"#000000\" bgcolor=\"#303030 \" style=\"border-collapse: collapse\" width=\"100%\" id=\"table2\">
	<tr>
		<td> 
		<strong><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\">DATA: $datashow3</strong>
		</td>
	</tr>	
</table>	
";

echo "<br /><br />";

//############# COMANDAMENTS ################

	$datasense2 =  mysql_real_escape_string($datashow2);

	$con6=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con6)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registro6=mysql_query("SELECT * FROM comandaments WHERE CMDDATA='$datasense2'")or die("Error en la consulta: ".mysql_error());
			
			

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



	echo "<table border=\"1\" bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\"> \n";
	echo "<tr> \n";
		echo "<th bgcolor=\"#303030\" colspan=\"4\" class=\"taula\"><p align=\"left\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\" align=\"center\"> \n";
		echo	"<strong>COMANDAMENTS</strong></th> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td bgcolor=\"#C0C0C0\" colspan=\"2\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">SUPERVISI&Oacute; ZONA FRANCA</i></td> \n";
		echo "<td bgcolor=\"#C0C0C0\" colspan=\"2\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">SUPERVISI&Oacute; REUS</i></td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td width=\"72\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">00-08h:</td> \n";
		echo "<td width=\"415\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			if (isset($SPVnitZF) && !empty ($SPVnitZF)) 
			
				{echo "$SPVnitZF";
			}		
		echo "</td> \n";
		echo "<td width=\"72\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">00-08h:</td> \n";
		echo "<td width=\"413\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			if (isset($SPVnitReus) && !empty ($SPVnitReus)) 
			
				{echo "$SPVnitReus";
			}		
		echo "</td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td width=\"72\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">08-16h:</td> \n";	
		echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			if (isset($SPVmatiZF) && !empty ($SPVmatiZF)) 
			
				{echo "$SPVmatiZF";
			}	
		echo "</td> \n";
		echo "<td width=\"72\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">08-16h:</td> \n";
		echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			if (isset($SPVmatiReus) && !empty ($SPVmatiReus)) 
			
				{echo "$SPVmatiReus";
			}
		echo "</td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td width=\"72\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">16-00h:</td> \n";
		echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			if (isset($SPVtardaZF) && !empty ($SPVtardaZF)) 
			
				{echo "$SPVtardaZF";
			}
		echo "</td> \n";
		echo "<td width=\"72\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">16-00h:</td> \n";		
		echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			if (isset($SPVtardaReus) && !empty ($SPVtardaReus)) 
			
				{echo "$SPVtardaReus";
			}
		echo "</td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td bgcolor=\"#C0C0C0\" colspan=\"2\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">COORDINACI&Oacute; ZONA FRANCA</i></td> \n";
		echo "<td bgcolor=\"#C0C0C0\" colspan=\"2\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">COORDINACI&Oacute; REUS</i></td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td width=\"72\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">00-08h:</td> \n";
		echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			if (isset($CORnitZF) && !empty ($CORnitZF)) 
			
				{echo "$CORnitZF";
			}
		echo "</td> \n";
		echo "<td width=\"72\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">00-08h:</td> \n";
		echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			if (isset($CORnitR) && !empty ($CORnitR)) 
			
				{echo "$CORnitR";
			}
		echo "</td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td width=\"72\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">08-16h:</td> \n";
		echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			if (isset($CORmatiZF) && !empty ($CORmatiZF)) 
			
				{echo "$CORmatiZF";
			}
		echo "</td> \n";
		echo "<td width=\"72\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">08-16h:</td> \n";
		echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			if (isset($CORmatiR) && !empty ($CORmatiR)) 
			
				{echo "$CORmatiR";
			}
		echo "</td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td width=\"72\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">16-00h:</td> \n";
		echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			if (isset($CORtardaZF) && !empty ($CORtardaZF)) 
			
				{echo "$CORtardaZF";
			}
		echo "</td> \n";
		echo "<td width=\"72\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">16-00h:</td> \n";
		echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			if (isset($CORtardaR) && !empty ($CORtardaR)) 
			
				{echo "$CORtardaR";
			}
		echo "</td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td align=\"center\" bgcolor=\"#C0C0C0\" colspan=\"4\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\"> \n";
		echo "TSSO</i></td> \n";
	echo "</tr> \n";
	echo "<tr> \n";
		echo "<td width=\"72\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">23-07h:</td> \n";	
		echo "<td colspan=\"3\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			if (isset($TSSOnit) && !empty ($TSSOnit)) 
				{echo "$TSSOnit";
			}
		echo "</td> \n";
		echo "</tr> \n";	
	echo "<tr> \n";
		echo "<td width=\"72\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">07-15h:</td> \n";	
		echo "<td colspan=\"3\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			if (isset($TSSOmati) && !empty ($TSSOmati)) 
				{echo "$TSSOmati";
			}
		echo "</td> \n";
		echo "</tr> \n";		
	echo "<tr> \n";
		echo "<td width=\"72\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">15-23h:</td> \n";	
		echo "<td colspan=\"3\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			if (isset($TSSOtarda) && !empty ($TSSOtarda)) 
				{echo "$TSSOtarda";
			}
		echo "</td> \n";
		echo "</tr> \n";				

	echo "</table> \n";

				



echo "<br /><br />";
//############# INCIDENCIES DE PERSONAL ################

	$datasenseir =  mysql_real_escape_string($datashow2);

	$con6ir=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con6ir)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registro6ir=mysql_query("SELECT * FROM personal WHERE PERSDATA='$datasenseir'")or die("Error en la consulta: ".mysql_error());
			
	$extracteir = mysql_fetch_assoc($registro6ir);

?>	
	
<table border="1" bordercolor="#000000" style="border-collapse: collapse" width="100%">
	<tr>
		<th bgcolor="#303030" colspan="11" class="taula"><p align="left"><span lang="CA" style="font-size: 10.0pt; font-family: Arial" align="center"><strong>INCID&Egrave;NCIES DE PERSONAL</strong></th>
	</tr>
	<tr>
		<td width="148" bgcolor="#C0C0C0"><i><p align="center"><span lang="CA" style="font-size: 8.0pt; font-family: Arial">Torn</i></td>
		<td width="117" bgcolor="#C0C0C0"><i><p align="center"><span lang="CA" style="font-size: 8.0pt; font-family: Arial">Centre</i></td>
		<td width="258" colspan="8" bgcolor="#C0C0C0"><i><p align="center"><span lang="CA" style="font-size: 8.0pt; font-family: Arial">Nombre de posicions</i></td>
		<td width="971" bgcolor="#C0C0C0"><i><p align="center"><span lang="CA" style="font-size: 8.0pt; font-family: Arial">Incid&egrave;ncies</i></td>
	</tr>
	<tr>
		<td rowspan="3" width="148"><span lang="CA" style="font-size: 8.0pt; font-family: Arial">Nit</td>
		<td width="117" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">Hora</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">00h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">01h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">02h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">03h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">04h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">05h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">06h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">07h</i></td>
		<td width="971" rowspan="4"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">
		<?php 
			if (isset($extracteir['INCID_N']) && !empty ($extracteir['INCID_N'])) 
			
				{echo $extracteir['INCID_N'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="117"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">ZF</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA1_N_ZF']) && !empty ($extracteir['FRA1_N_ZF'])) 
			
				{echo $extracteir['FRA1_N_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA2_N_ZF']) && !empty ($extracteir['FRA2_N_ZF'])) 
			
				{echo $extracteir['FRA2_N_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA3_N_ZF']) && !empty ($extracteir['FRA3_N_ZF'])) 
			
				{echo $extracteir['FRA3_N_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA4_N_ZF']) && !empty ($extracteir['FRA4_N_ZF'])) 
			
				{echo $extracteir['FRA4_N_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA5_N_ZF']) && !empty ($extracteir['FRA5_N_ZF'])) 
			
				{echo $extracteir['FRA5_N_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA6_N_ZF']) && !empty ($extracteir['FRA6_N_ZF'])) 
			
				{echo $extracteir['FRA6_N_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA7_N_ZF']) && !empty ($extracteir['FRA7_N_ZF'])) 
			
				{echo $extracteir['FRA7_N_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA8_N_ZF']) && !empty ($extracteir['FRA8_N_ZF'])) 
			
				{echo $extracteir['FRA8_N_ZF'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="117"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">Reus</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA1_N_R']) && !empty ($extracteir['FRA1_N_R'])) 
			
				{echo $extracteir['FRA1_N_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA2_N_R']) && !empty ($extracteir['FRA2_N_R'])) 
			
				{echo $extracteir['FRA2_N_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA3_N_R']) && !empty ($extracteir['FRA3_N_R'])) 
			
				{echo $extracteir['FRA3_N_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA4_N_R']) && !empty ($extracteir['FRA4_N_R'])) 
			
				{echo $extracteir['FRA4_N_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA5_N_R']) && !empty ($extracteir['FRA5_N_R'])) 
			
				{echo $extracteir['FRA5_N_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA6_N_R']) && !empty ($extracteir['FRA6_N_R'])) 
			
				{echo $extracteir['FRA6_N_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA7_N_R']) && !empty ($extracteir['FRA7_N_R'])) 
			
				{echo $extracteir['FRA7_N_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA8_N_R']) && !empty ($extracteir['FRA8_N_R'])) 
			
				{echo $extracteir['FRA8_N_R'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="265" colspan="2"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">Total Nit</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="148" rowspan="3"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">Mati</td>
		<td width="117" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">Hora</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">08h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">09h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">10h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">11h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">12h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">13h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">14h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">15h</i></td>
		<td width="971" rowspan="4"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">
		<?php 
			if (isset($extracteir['INCID_M']) && !empty ($extracteir['INCID_M'])) 
			
				{echo $extracteir['INCID_M'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="117"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">ZF</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA1_M_ZF']) && !empty ($extracteir['FRA1_M_ZF'])) 
			
				{echo $extracteir['FRA1_M_ZF'];
			}
		 ?>		
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA2_M_ZF']) && !empty ($extracteir['FRA2_M_ZF'])) 
			
				{echo $extracteir['FRA2_M_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA3_M_ZF']) && !empty ($extracteir['FRA3_M_ZF'])) 
			
				{echo $extracteir['FRA3_M_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA4_M_ZF']) && !empty ($extracteir['FRA4_M_ZF'])) 
			
				{echo $extracteir['FRA4_M_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA5_M_ZF']) && !empty ($extracteir['FRA5_M_ZF'])) 
			
				{echo $extracteir['FRA5_M_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA6_M_ZF']) && !empty ($extracteir['FRA6_M_ZF'])) 
			
				{echo $extracteir['FRA6_M_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA7_M_ZF']) && !empty ($extracteir['FRA7_M_ZF'])) 
			
				{echo $extracteir['FRA7_M_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA8_M_ZF']) && !empty ($extracteir['FRA8_M_ZF'])) 
			
				{echo $extracteir['FRA8_M_ZF'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="117"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">Reus</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA1_M_R']) && !empty ($extracteir['FRA1_M_R'])) 
			
				{echo $extracteir['FRA1_M_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA2_M_R']) && !empty ($extracteir['FRA2_M_R'])) 
			
				{echo $extracteir['FRA2_M_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA3_M_R']) && !empty ($extracteir['FRA3_M_R'])) 
			
				{echo $extracteir['FRA3_M_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA4_M_R']) && !empty ($extracteir['FRA4_M_R'])) 
			
				{echo $extracteir['FRA4_M_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA5_M_R']) && !empty ($extracteir['FRA5_M_R'])) 
			
				{echo $extracteir['FRA5_M_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA6_M_R']) && !empty ($extracteir['FRA6_M_R'])) 
			
				{echo $extracteir['FRA6_M_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA7_M_R']) && !empty ($extracteir['FRA7_M_R'])) 
			
				{echo $extracteir['FRA7_M_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA8_M_R']) && !empty ($extracteir['FRA8_M_R'])) 
			
				{echo $extracteir['FRA8_M_R'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="265" colspan="2"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">Total Mati</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="148" rowspan="3"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">Tarda</td>
		<td width="117" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">Hora</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">16h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">17h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">18h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">19h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">20h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">21h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">22h</i></td>
		<td width="40" bgcolor="#D3D3D3"><i><p align="center"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">23h</i></td>
		<td width="971" rowspan="4"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">
		<?php 
			if (isset($extracteir['INCID_T']) && !empty ($extracteir['INCID_T'])) 
			
				{echo $extracteir['INCID_T'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="117"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">ZF</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">		
		<?php 
			if (isset($extracteir['FRA1_T_ZF']) && !empty ($extracteir['FRA1_T_ZF'])) 
			
				{echo $extracteir['FRA1_T_ZF'];
			}
		 ?>	
		 </td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA2_T_ZF']) && !empty ($extracteir['FRA2_T_ZF'])) 
			
				{echo $extracteir['FRA2_T_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA3_T_ZF']) && !empty ($extracteir['FRA3_T_ZF'])) 
			
				{echo $extracteir['FRA3_T_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA4_T_ZF']) && !empty ($extracteir['FRA4_T_ZF'])) 
			
				{echo $extracteir['FRA4_T_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA5_T_ZF']) && !empty ($extracteir['FRA5_T_ZF'])) 
			
				{echo $extracteir['FRA5_T_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA6_T_ZF']) && !empty ($extracteir['FRA6_T_ZF'])) 
			
				{echo $extracteir['FRA6_T_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA7_T_ZF']) && !empty ($extracteir['FRA7_T_ZF'])) 
			
				{echo $extracteir['FRA7_T_ZF'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA8_T_ZF']) && !empty ($extracteir['FRA8_T_ZF'])) 
			
				{echo $extracteir['FRA8_T_ZF'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="117"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">Reus</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA1_T_R']) && !empty ($extracteir['FRA1_T_R'])) 
			
				{echo $extracteir['FRA1_T_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA2_T_R']) && !empty ($extracteir['FRA2_T_R'])) 
			
				{echo $extracteir['FRA2_T_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA3_T_R']) && !empty ($extracteir['FRA3_T_R'])) 
			
				{echo $extracteir['FRA3_T_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA4_T_R']) && !empty ($extracteir['FRA4_T_R'])) 
			
				{echo $extracteir['FRA4_T_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA5_T_R']) && !empty ($extracteir['FRA5_T_R'])) 
			
				{echo $extracteir['FRA5_T_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA6_T_R']) && !empty ($extracteir['FRA6_T_R'])) 
			
				{echo $extracteir['FRA6_T_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA7_T_R']) && !empty ($extracteir['FRA7_T_R'])) 
			
				{echo $extracteir['FRA7_T_R'];
			}
		 ?>	
		</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center">
		<?php 
			if (isset($extracteir['FRA8_T_R']) && !empty ($extracteir['FRA8_T_R'])) 
			
				{echo $extracteir['FRA8_T_R'];
			}
		 ?>	
		</td>
	</tr>
	<tr>
		<td width="265" colspan="2"><span lang="CA" style="font-size: 9.0pt; font-family: Arial">Total Tarda</td>
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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
		<td width="40"><span lang="CA" style="font-size: 9.0pt; font-family: Arial"><p align="center"><strong>
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


<?php


echo "<br /><br />";
//############# ACTIVACIÓ DE BORSA ################

	$datasenseab =  mysql_real_escape_string($datashow2);
	
	$conab=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conab)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroab=mysql_query("SELECT * FROM borsa WHERE ABDATA='$datasenseab' ORDER BY ABHORAINS ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\" bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\" id=\"table4\">";
	
	echo "<th bgcolor=\"#303030\" colspan=\"4\" class=\"taula\"><p align=\"left\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\">ACTIVACI&Oacute; DE BORSA</th> \n";	
	 
	echo "<tr> \n";

	echo "<td bgcolor=\"#C0C0C0\" width=\"11%\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Horari</i></td> \n";
	
	echo "<td bgcolor=\"#C0C0C0\" width=\"5%\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";	

	echo "<td bgcolor=\"#C0C0C0\" width=\"27%\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Nombre de gestors activats</i></td> \n";	
	
	echo "<td bgcolor=\"#C0C0C0\" width=\"57%\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Motiu</i></td> \n";	
	
	echo "</tr> \n";
	


	
	
	

	//definim variable unica per permetre una fila anomenada Sense Episodis rellevants en cas que no hi hagi cap dada
	$extracteabp = mysql_fetch_assoc($registroab);
	if (isset($extracteabp['ABDATA']) && !empty($extracteabp['ABDATA'])	&& 
				$extracteabp['ABDATA'] == $datasense2) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseer2 =  mysql_real_escape_string($datashow2);
			
			$conab222=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conab222)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroer2z=mysql_query("SELECT * FROM borsa WHERE ABDATA='$datasenseer2' ")or die("Error en la consulta: ".mysql_error());
			
		while ($rowab = mysql_fetch_row($registroer2z))
		{	
			echo  "<tr> \n";
			echo  "<td valign=\"top\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowab[5]</td> \n";
			echo  "<td valign=\"top\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowab[6]</td> \n";
			echo  "<td valign=\"top\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowab[7]</td> \n";
			echo  "<td valign=\"top\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowab[8]</td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"4\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense activaci&oacute;</td> \n 
				</tr> \n";
	}

	
	
	

	echo "</table> \n";		
	
	
	
	
	
	
echo "<br /><br />";

//####CONTROL DIARI - > al ser temporal no s'exporta

//############## EPISODIS RELLEVANTS ##################

	$datasenseer =  mysql_real_escape_string($datashow2);
	
	$conere=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conere)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroer2=mysql_query("SELECT * FROM episodis WHERE ERDATA='$datasenseer' ")or die("Error en la consulta: ".mysql_error());



	echo "<table border=\"1\" bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\"> \n";
	
	echo "<th bgcolor=\"#303030\" colspan=\"3\" class=\"taula\"><p align=\"left\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\" align=\"center\">EPISODIS RELLEVANTS</th> \n";	

	
	echo "<tr> \n";

	echo "<td bgcolor=\"#C0C0C0\" width=\"11%\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td bgcolor=\"#C0C0C0\" width=\"25%\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Acr&ograve;nim</i></td> \n";	

	echo "<td bgcolor=\"#C0C0C0\" width=\"64%\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</i></td> \n";	
	
	
	echo "</tr> \n";
	
	//definim variable unica per permetre una fila anomenada Sense Episodis rellevants en cas que no hi hagi cap dada
	$extracteerp = mysql_fetch_assoc($registroer2);
	if (isset($extracteerp['ERDATA']) && !empty($extracteerp['ERDATA'])	&& 
				$extracteerp['ERDATA'] == $datasenseer) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseer2 =  mysql_real_escape_string($datashow2);
			
			$conerez=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conerez)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroer2z=mysql_query("SELECT * FROM episodis WHERE ERDATA='$datasenseer2' ")or die("Error en la consulta: ".mysql_error());
			
		while ($rower = mysql_fetch_row($registroer2z))
		{	
			echo  "<tr> \n";
			$rower[4]=substr($rower[4],0,5);
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rower[4]h</td> \n";
			echo  "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rower[6]</td> \n";
			echo  "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rower[7]</td> \n";
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"3\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense Episodis</td> \n 
				</tr> \n";
	}

	

	echo "</table> \n";	


echo "<br /><br />";
//############## INCIDENTS RELLEVANTS ##################

	$dataxcons = $datashow2;
	$datasense =  mysql_real_escape_string($dataxcons);

	$con2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registro2=mysql_query("SELECT * FROM activitat WHERE DATA='$datasense' ORDER BY HORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\"  bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\" id=\"tableire\">";
	

	echo "<th bgcolor=\"#303030\" colspan=\"4\" class=\"taula\"><p align=\"left\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\">INCIDENTS RELLEVANTS</th> \n";	
	
	echo "<tr> \n";

	echo "<td width=\"11%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td width=\"9%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Ext</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"75%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</i></td> \n";


	
	echo "</tr> \n";

	
	while ($rowb = mysql_fetch_row($registro2)){
	
	echo "<tr> \n";


	//NOTA: FUNCIÓ PER RECONEIXER SALTS DE LINIA EN TEXTAREA:	echo (nl2br($text));
	
	//hora
	$rowb[2]=substr($rowb[2],0,5);
	echo "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowb[2]h</td> \n";
	//extensio
	echo "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowb[3]</td> \n";
	//Centre
	echo "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowb[4]</td> \n";
	//Descripcio concatenada
	echo "<td valign=\"top\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"><b>Exp. $rowb[5]. $rowb[6] a $rowb[7]. </b>";
	echo (nl2br($rowb[8]));
	echo "</td> \n";
	echo "</tr> \n";
	}
	echo "</table> \n";


echo "<br /><br />";
//############## SERVEIS OPERATIUS ##################

	echo "<table border=\"1\"  bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\" id=\"tableire\">";
	echo "<th bgcolor=\"#303030\" colspan=\"4\" class=\"taula\"><p align=\"left\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\">SERVEIS OPERATIUS</th> \n";		
	echo "</table> \n";	
	echo "<br />";

####### AGENTS RURALS
	$datasenseso =  mysql_real_escape_string($datashow2);

	$conso2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso2=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso' AND SOCOS='Agents Rurals'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\"  bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\" id=\"tableire\"> \n";
	

	echo "<th bgcolor=\"#C0C0C0\" colspan=\"4\" class=\"taula\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\">AGENTS RURALS</th> \n";	
	
	echo "<tr> \n";


	echo "<td width=\"11%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td width=\"9%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Ext</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"75%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</o></td> \n";
	
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso = mysql_fetch_assoc($registroso2);
	if (isset($extracteso['SODATA']) && !empty($extracteso['SODATA'])	&& 
				$extracteso['SODATA'] == $datasenseso) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso2 =  mysql_real_escape_string($datashow2);
			
			$conesoz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso2z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso2' AND SOCOS='Agents Rurals'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso = mysql_fetch_row($registroerso2z))
		{	
			echo  "<tr> \n";
			$rowso[4]=substr($rowso[4],0,5);
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[4]h</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[5]</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[7]</td> \n";
			//Descripció
			echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			echo (nl2br($rowso[8]));
			echo "</td> \n";		
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";
	
echo "<br />";

#######BOMBERS

	$datasenseso =  mysql_real_escape_string($datashow2);

	$conso2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso2=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso' AND SOCOS='Bombers'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\"  bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\" id=\"tableire\"> \n";
	

	echo "<th bgcolor=\"#C0C0C0\" colspan=\"4\" class=\"taula\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\">BOMBERS</th> \n";	
	
	echo "<tr> \n";


	echo "<td width=\"11%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td width=\"9%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Ext</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"75%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</o></td> \n";
	
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso = mysql_fetch_assoc($registroso2);
	if (isset($extracteso['SODATA']) && !empty($extracteso['SODATA'])	&& 
				$extracteso['SODATA'] == $datasenseso) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso2 =  mysql_real_escape_string($datashow2);
			
			$conesoz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso2z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso2' AND SOCOS='Bombers'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso = mysql_fetch_row($registroerso2z))
		{	
			echo  "<tr> \n";
			$rowso[4]=substr($rowso[4],0,5);
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[4]h</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[5]</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[7]</td> \n";
			//Descripció
			echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			echo (nl2br($rowso[8]));
			echo "</td> \n";		
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";
	
echo "<br />";

############## CREU ROJA

	$datasenseso =  mysql_real_escape_string($datashow2);

	$conso2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso2=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso' AND SOCOS='Creu Roja'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\"  bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\" id=\"tableire\"> \n";
	

	echo "<th bgcolor=\"#C0C0C0\" colspan=\"4\" class=\"taula\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\">CREU ROJA</th> \n";	
	
	echo "<tr> \n";


	echo "<td width=\"11%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td width=\"9%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Ext</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"75%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</o></td> \n";
	
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso = mysql_fetch_assoc($registroso2);
	if (isset($extracteso['SODATA']) && !empty($extracteso['SODATA'])	&& 
				$extracteso['SODATA'] == $datasenseso) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso2 =  mysql_real_escape_string($datashow2);
			
			$conesoz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso2z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso2' AND SOCOS='Creu Roja'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso = mysql_fetch_row($registroerso2z))
		{	
			echo  "<tr> \n";
			$rowso[4]=substr($rowso[4],0,5);
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[4]h</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[5]</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[7]</td> \n";
			//Descripció
			echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			echo (nl2br($rowso[8]));
			echo "</td> \n";		
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";
	
echo "<br />";



############### MOSSOS DE SEGURETAT

	$datasenseso =  mysql_real_escape_string($datashow2);

	$conso2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso2=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso' AND SOCOS='Mossos de Seguretat'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\"  bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\" id=\"tableire\"> \n";
	

	echo "<th bgcolor=\"#C0C0C0\" colspan=\"4\" class=\"taula\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\">MOSSOS DE SEGURETAT</th> \n";	
	
	echo "<tr> \n";


	echo "<td width=\"11%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td width=\"9%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Ext</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"75%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</o></td> \n";
	
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso = mysql_fetch_assoc($registroso2);
	if (isset($extracteso['SODATA']) && !empty($extracteso['SODATA'])	&& 
				$extracteso['SODATA'] == $datasenseso) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso2 =  mysql_real_escape_string($datashow2);
			
			$conesoz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso2z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso2' AND SOCOS='Mossos de Seguretat'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso = mysql_fetch_row($registroerso2z))
		{	
			echo  "<tr> \n";
			$rowso[4]=substr($rowso[4],0,5);
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[4]h</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[5]</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[7]</td> \n";
			//Descripció
			echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			echo (nl2br($rowso[8]));
			echo "</td> \n";		
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";
	
echo "<br />";



############## MOSSOS DE TRÀNSIT

	$datasensesot =  mysql_real_escape_string($datashow2);

	$conso2t=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso2t)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso2t=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasensesot' AND SOCOS='Mossos de Transit'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\"  bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\" id=\"tableire\"> \n";
	

	echo "<th bgcolor=\"#C0C0C0\" colspan=\"4\" class=\"taula\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\">MOSSOS DE TR&Agrave;NSIT</th> \n";	
	
	echo "<tr> \n";


	echo "<td width=\"11%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td width=\"9%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Ext</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"75%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</o></td> \n";
	
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extractesot = mysql_fetch_assoc($registroso2t);
	if (isset($extractesot['SODATA']) && !empty($extractesot['SODATA'])	&& 
				$extractesot['SODATA'] == $datasensesot) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso2t =  mysql_real_escape_string($datashow2);
			
			$conesozt=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesozt)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso2zt=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso2t' AND SOCOS='Mossos de Transit'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowsot = mysql_fetch_row($registroerso2zt))
		{	
			echo  "<tr> \n";
			$rowsot[4]=substr($rowsot[4],0,5);
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowsot[4]h</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowsot[5]</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowsot[7]</td> \n";
			//Descripció
			echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			echo (nl2br($rowsot[8]));
			echo "</td> \n";		
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";
	
echo "<br />";



############## POLICIA LOCAL

	$datasenseso =  mysql_real_escape_string($datashow2);

	$conso2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso2=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso' AND SOCOS='Policia Local'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\"  bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\" id=\"tableire\"> \n";
	

	echo "<th bgcolor=\"#C0C0C0\" colspan=\"4\" class=\"taula\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\">POLICIA LOCAL</th> \n";	
	
	echo "<tr> \n";


	echo "<td width=\"11%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td width=\"9%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Ext</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"75%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</o></td> \n";
	
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso = mysql_fetch_assoc($registroso2);
	if (isset($extracteso['SODATA']) && !empty($extracteso['SODATA'])	&& 
				$extracteso['SODATA'] == $datasenseso) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso2 =  mysql_real_escape_string($datashow2);
			
			$conesoz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso2z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso2' AND SOCOS='Policia Local'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso = mysql_fetch_row($registroerso2z))
		{	
			echo  "<tr> \n";
			$rowso[4]=substr($rowso[4],0,5);
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[4]h</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[5]</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[7]</td> \n";
			//Descripció
			echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			echo (nl2br($rowso[8]));
			echo "</td> \n";		
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";
	
echo "<br />";



############### POLICIA NACIONAL

	$datasenseso =  mysql_real_escape_string($datashow2);

	$conso2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso2=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso' AND SOCOS='Policia Nacional'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\"  bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\" id=\"tableire\"> \n";
	

	echo "<th bgcolor=\"#C0C0C0\" colspan=\"4\" class=\"taula\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\">POLICIA NACIONAL</th> \n";	
	
	echo "<tr> \n";


	echo "<td width=\"11%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td width=\"9%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Ext</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"75%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</o></td> \n";
	
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso = mysql_fetch_assoc($registroso2);
	if (isset($extracteso['SODATA']) && !empty($extracteso['SODATA'])	&& 
				$extracteso['SODATA'] == $datasenseso) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso2 =  mysql_real_escape_string($datashow2);
			
			$conesoz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso2z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso2' AND SOCOS='Policia Nacional'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso = mysql_fetch_row($registroerso2z))
		{	
			echo  "<tr> \n";
			$rowso[4]=substr($rowso[4],0,5);
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[4]h</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[5]</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[7]</td> \n";
			//Descripció
			echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			echo (nl2br($rowso[8]));
			echo "</td> \n";		
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";
	
echo "<br />";



############### SALVAMENT MARITIM

	$datasenseso =  mysql_real_escape_string($datashow2);

	$conso2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso2=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso' AND SOCOS='Salvament Maritim'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\"  bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\" id=\"tableire\"> \n";
	

	echo "<th bgcolor=\"#C0C0C0\" colspan=\"4\" class=\"taula\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\">SALVAMENT MAR&Iacute;TIM</th> \n";	
	
	echo "<tr> \n";


	echo "<td width=\"11%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td width=\"9%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Ext</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"75%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</o></td> \n";
	
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso = mysql_fetch_assoc($registroso2);
	if (isset($extracteso['SODATA']) && !empty($extracteso['SODATA'])	&& 
				$extracteso['SODATA'] == $datasenseso) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso2 =  mysql_real_escape_string($datashow2);
			
			$conesoz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso2z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso2' AND SOCOS='Salvament Maritim'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso = mysql_fetch_row($registroerso2z))
		{	
			echo  "<tr> \n";
			$rowso[4]=substr($rowso[4],0,5);
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[4]h</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[5]</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[7]</td> \n";
			//Descripció
			echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			echo (nl2br($rowso[8]));
			echo "</td> \n";		
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";
	
echo "<br />";


################ SANITAT

	$datasenseso =  mysql_real_escape_string($datashow2);

	$conso2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso2=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso' AND SOCOS='Sanitat'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\"  bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\" id=\"tableire\"> \n";
	

	echo "<th bgcolor=\"#C0C0C0\" colspan=\"4\" class=\"taula\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\">SANITAT</th> \n";	
	
	echo "<tr> \n";


	echo "<td width=\"11%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td width=\"9%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Ext</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"75%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</o></td> \n";
	
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso = mysql_fetch_assoc($registroso2);
	if (isset($extracteso['SODATA']) && !empty($extracteso['SODATA'])	&& 
				$extracteso['SODATA'] == $datasenseso) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso2 =  mysql_real_escape_string($datashow2);
			
			$conesoz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso2z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso2' AND SOCOS='Sanitat'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso = mysql_fetch_row($registroerso2z))
		{	
			echo  "<tr> \n";
			$rowso[4]=substr($rowso[4],0,5);
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[4]h</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[5]</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[7]</td> \n";
			//Descripció
			echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			echo (nl2br($rowso[8]));
			echo "</td> \n";		
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";
	
echo "<br />";


################## ALTRES

	$datasenseso =  mysql_real_escape_string($datashow2);

	$conso2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conso2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroso2=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso' AND SOCOS='Altres'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\"  bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\" id=\"tableire\"> \n";
	

	echo "<th bgcolor=\"#C0C0C0\" colspan=\"4\" class=\"taula\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\">ALTRES</th> \n";	
	
	echo "<tr> \n";


	echo "<td width=\"11%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td width=\"9%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Ext</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"75%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</o></td> \n";
	
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteso = mysql_fetch_assoc($registroso2);
	if (isset($extracteso['SODATA']) && !empty($extracteso['SODATA'])	&& 
				$extracteso['SODATA'] == $datasenseso) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseso2 =  mysql_real_escape_string($datashow2);
			
			$conesoz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesoz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerso2z=mysql_query("SELECT * FROM serveis WHERE SODATA='$datasenseso2' AND SOCOS='Altres'  ORDER BY SOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowso = mysql_fetch_row($registroerso2z))
		{	
			echo  "<tr> \n";
			$rowso[4]=substr($rowso[4],0,5);
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[4]h</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[5]</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowso[7]</td> \n";
			//Descripció
			echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			echo (nl2br($rowso[8]));
			echo "</td> \n";		
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";
	
echo "<br /><br />";



//############## SISTEMES ESPECIALS (ANTIC TAXI) ##################

	$datasensetx =  mysql_real_escape_string($datashow2);

	$contx2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$contx2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registrotx2=mysql_query("SELECT * FROM taxi WHERE TXDATA='$datasensetx' ORDER BY TXHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\" bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\"> \n";
	

	echo "<th bgcolor=\"#303030\" colspan=\"4\" class=\"taula\"><p align=\"left\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\" align=\"center\">SISTEMES ESPECIALS</th> \n";	
	
	echo "<tr> \n";

	//echo "<td><b>Data</b></td> \n";

	echo "<td width=\"11%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td width=\"9%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Ext</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"75%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</i></td> \n";
	
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extractetx = mysql_fetch_assoc($registrotx2);
	if (isset($extractetx['TXDATA']) && !empty($extractetx['TXDATA'])	&& 
				$extractetx['TXDATA'] == $datasensetx) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasensetx2 =  mysql_real_escape_string($datashow2);
			
			$conetxz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conetxz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroertx2z=mysql_query("SELECT * FROM taxi WHERE TXDATA='$datasensetx2'ORDER BY TXHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowtx = mysql_fetch_row($registroertx2z))
		{	
			echo  "<tr> \n";
			$rowtx[4]=substr($rowtx[4],0,5);
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowtx[4]h</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowtx[5]</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowtx[6]</td> \n";
			//Descripció
			echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			echo (nl2br($rowtx[7]));
			echo "</td> \n";		

			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"4\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";

	echo "<br /><br />";


//############## VALIDACIONS TAXI ##################


?>

<table border = '1' bordercolor="#000000" style="border-collapse: collapse" width="100%">
	<th colspan="6" bgcolor="#303030"><p align="left"><span lang="CA" style="font-size: 10.0pt; font-family: Arial" align="center">VALIDACIONS</th>
	<tr>
		<td bgcolor="#C0C0C0"><i><p align="center"><span lang="CA" style="font-size: 8.0pt; font-family: Arial">Torn</i></td>
		<td bgcolor="#C0C0C0"><i><p align="center"><span lang="CA" style="font-size: 8.0pt; font-family: Arial">Llic&egrave;ncies</i></td>
		<td bgcolor="#C0C0C0"><i><p align="center"><span lang="CA" style="font-size: 8.0pt; font-family: Arial">OK</i></td>
		<td bgcolor="#C0C0C0"><i><p align="center"><span lang="CA" style="font-size: 8.0pt; font-family: Arial">KO</i></td>
		<td bgcolor="#C0C0C0"><i><p align="center"><span lang="CA" style="font-size: 8.0pt; font-family: Arial">Efectivitat %</i></td>
		<td bgcolor="#C0C0C0"><i><p align="center"><span lang="CA" style="font-size: 8.0pt; font-family: Arial">Gestor</i></td>

	</tr>
	<?php
	// 3er pas: VALIDACIONS -> taula que mostra els introduits
	
	// NIT
	$datasenseva =  mysql_real_escape_string($datashow2);

	$conva=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conva)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registrova=mysql_query("SELECT * FROM validacions WHERE VADATA='$datasenseva' AND VATORN='Nit' limit 1")or die("Error en la consulta: ".mysql_error());

	$extracteva = mysql_fetch_assoc($registrova);	

if (isset($extracteva['VADATA']) )
{
	if ( $extracteva['VANP'] == 2 )
	{			
			$datasensevaz =  mysql_real_escape_string($datashow2);	
			
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
				echo  "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Nit</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowva[2]</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowva[3]</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowva[4]</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowva[5] %</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowva[6]</td> \n";


				echo  "</tr> \n";		
			}	
		} else {	

			$datasensevax =  mysql_real_escape_string($datashow2);	
			
			$conevax=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conevax)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroervax=mysql_query("SELECT * FROM validacions WHERE VADATA='$datasensevax' AND VATORN='Nit' limit 1 ")or die("Error en la consulta: ".mysql_error());
			
			while ($rowvax = mysql_fetch_row($registroervax))
			{
				echo "<tr> \n"; 
				echo  "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Nit</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">NP</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">NP</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">NP</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">NP</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">NP</td> \n";

				echo "</tr> \n";
			}
	}
} else {
			echo "<tr> \n"; 
			echo  "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Nit</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"></td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"></td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"></td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"></td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"></td> \n";
		echo "</tr> \n";
}


	// MATI
	
		$datasenseva =  mysql_real_escape_string($datashow2);

	$conva=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conva)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registrova=mysql_query("SELECT * FROM validacions WHERE VADATA='$datasenseva' AND VATORN='mati'  limit 1")or die("Error en la consulta: ".mysql_error());

	$extracteva = mysql_fetch_assoc($registrova);	

if (isset($extracteva['VADATA']) )
{
	if ( $extracteva['VANP'] == 2 )
	{			
			$datasensevaz =  mysql_real_escape_string($datashow2);	
			
			$conevaz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conevaz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroervaz=mysql_query("SELECT * FROM validacions WHERE VADATA='$datasensevaz' AND VATORN='mati'  limit 1")or die("Error en la consulta: ".mysql_error());
			
			while ($rowva = mysql_fetch_row($registroervaz))
			{	
				$llicemati = $rowva[2];
				$okmati = $rowva[3];
				$komati = $rowva[4];			
			
				echo  "<tr> \n";
				echo  "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Mat&iacute;</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowva[2]</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowva[3]</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowva[4]</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowva[5] %</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowva[6]</td> \n";


				echo  "</tr> \n";		
			}	
		} else {	

			$datasensevax =  mysql_real_escape_string($datashow2);	
			
			$conevax=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conevax)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroervax=mysql_query("SELECT * FROM validacions WHERE VADATA='$datasensevax' AND VATORN='mati' limit 1 ")or die("Error en la consulta: ".mysql_error());
			
			while ($rowvax = mysql_fetch_row($registroervax))
			{
				echo "<tr> \n"; 
				echo  "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Mat&iacute;</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">NP</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">NP</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">NP</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">NP</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">NP</td> \n";

				echo "</tr> \n";
			}
	}
} else {
			echo "<tr> \n"; 
			echo  "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Mat&iacute;</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"></td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"></td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"></td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"></td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"></td> \n";
		echo "</tr> \n";
}



	// TARDA

	$datasenseva3 =  mysql_real_escape_string($datashow2);

	$conva3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conva3)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registrova3=mysql_query("SELECT * FROM validacions WHERE VADATA='$datasenseva3' AND VATORN='Tarda' limit 1")or die("Error en la consulta: ".mysql_error());

	$extracteva3 = mysql_fetch_assoc($registrova3);	

if (isset($extracteva3['VADATA']) )
{
	if ( $extracteva3['VANP'] == 2 )
	{			

			$datasensevaz3 =  mysql_real_escape_string($datashow2);	
			
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
				echo  "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Tarda</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowva3[2]</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowva3[3]</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowva3[4]</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowva3[5] %</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowva3[6]</td> \n";


				echo  "</tr> \n";		
			}	
		} else 
		{
		

			$datasensevax3 =  mysql_real_escape_string($datashow2);	
			
			$conevax3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conevax3)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroervax3=mysql_query("SELECT * FROM validacions WHERE VADATA='$datasensevax3' AND VATORN='Tarda' limit 1 ")or die("Error en la consulta: ".mysql_error());
			
			while ($rowvax3 = mysql_fetch_row($registroervax3))
			{
				echo "<tr> \n"; 
				echo  "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Tarda</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">NP</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">NP</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">NP</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">NP</td> \n";
				echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">NP</td> \n";


				echo "</tr> \n";
			}
		}
} else {
			echo "<tr> \n"; 
			echo  "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Tarda</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"></td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"></td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"></td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"></td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"></td> \n";

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
			echo  "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"><strong>Totals</strong></td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"><strong>";
			echo $llicenciestotals;
			echo "</strong></td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"><strong>";
			echo $oktotals;			
			echo "</strong></td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"><strong>";
			echo $kototals;					
			echo "</strong></td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"><strong>";
			echo $efectivitattotal5;
			echo "</strong></td> \n";
			echo  "<td></td> \n";

		echo "</tr> \n";	
	
	
	
?>
	
</table>

<?php


	echo "<br /><br />";
//############## SIMULACRES ##################

	echo "<table border=\"1\"  bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\" id=\"tableire\">";
	echo "<th bgcolor=\"#303030\" colspan=\"4\" class=\"taula\"><p align=\"left\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\">SIMULACRES</th> \n";		

	// SIMULACRES ->Taula PROGRAMATS

	$datasensesi =  mysql_real_escape_string($datashow2);

	$consi2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$consi2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registrosi2=mysql_query("SELECT * FROM simulacres WHERE SIDATA='$datasensesi' AND SITIPUS='Programat'  ORDER BY SIHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<tr> \n";

	echo "<td bgcolor=\"#C0C0C0\" colspan=\"4\" class=\"taula\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\"><strong>PROGRAMATS</strong></td> \n";	

	echo "</tr> \n";	

	echo "<tr> \n";
	
	echo "<td bgcolor=\"#D3D3D3\" width=\"11%\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td bgcolor=\"#D3D3D3\" width=\"9%\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Ext</i></td> \n";

	echo "<td bgcolor=\"#D3D3D3\" width=\"5%\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td bgcolor=\"#D3D3D3\" width=\"75%\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</i></td> \n";
	
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extractesi = mysql_fetch_assoc($registrosi2);
	if (isset($extractesi['SIDATA']) && !empty($extractesi['SIDATA'])	&& 
				$extractesi['SIDATA'] == $datasensesi) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasensesi2 =  mysql_real_escape_string($datashow2);
			
			$conesiz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesiz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroersi2z=mysql_query("SELECT * FROM simulacres WHERE SIDATA='$datasensesi2' AND SITIPUS='Programat'  ORDER BY SIHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowsi = mysql_fetch_row($registroersi2z))
		{	
			echo  "<tr> \n";
			$rowsi[4]=substr($rowsi[4],0,5);
			echo  "<td valign=\"top\"><p align=\"center\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowsi[4]h</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowsi[5]</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowsi[7]</td> \n";
			//Descripció
			echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			echo (nl2br($rowsi[8]));
			echo "</td> \n";		

			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"4\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}



	// SIMULACRES -> NO PROGRAMATS

	$datasensesib =  mysql_real_escape_string($datashow2);

	$consi3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$consi3)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registrosi3=mysql_query("SELECT * FROM simulacres WHERE SIDATA='$datasensesib' AND SITIPUS='No Programat'  ORDER BY SIHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	
	echo "<tr> \n";
	echo "<td bgcolor=\"#C0C0C0\" colspan=\"4\" class=\"taula\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\"><strong>NO PROGRAMATS</strong></td> \n";	
	
	echo "</tr> \n";
	
	echo "<tr> \n";

	echo "<td bgcolor=\"#D3D3D3\" width=\"11%\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td bgcolor=\"#D3D3D3\" width=\"9%\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Ext</i></td> \n";

	echo "<td bgcolor=\"#D3D3D3\" width=\"5%\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td bgcolor=\"#D3D3D3\" width=\"75%\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</i></td> \n";
	
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extractesi3 = mysql_fetch_assoc($registrosi3);
	if (isset($extractesi3['SIDATA']) && !empty($extractesi3['SIDATA'])	&& 
				$extractesi3['SIDATA'] == $datasensesib) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasensesi23 =  mysql_real_escape_string($datashow2);
			
			$conesiz3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$conesiz3)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroersi3z=mysql_query("SELECT * FROM simulacres WHERE SIDATA='$datasensesi23' AND SITIPUS='No Programat' ORDER BY SIHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowsi3 = mysql_fetch_row($registroersi3z))
		{	
			echo  "<tr> \n";
			$rowsi3[4]=substr($rowsi3[4],0,5);
			echo  "<td valign=\"top\"><p align=\"center\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowsi3[4]h</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowsi3[5]</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowsi3[7]</td> \n";
			//Descripció
			echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			echo (nl2br($rowsi3[8]));
			echo "</td> \n";		

			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"4\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}


	echo "</table> \n";	



echo "<br /><br />";
//############## GESTIONS DE SUPERVISIÓ (ANTIC OBSERVACIONS DE SPV) ##################


	$datasenseob =  mysql_real_escape_string($datashow2);

	$con2ob=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2ob)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registro2ob=mysql_query("SELECT * FROM observacions WHERE OBDATA='$datasenseob' ORDER BY OBHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\" bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\"> \n";
	

	echo "<th bgcolor=\"#303030\" colspan=\"3\" class=\"taula\"><p align=\"left\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\" align=\"center\">GESTIONS DE SUPERVISI&Oacute;</th> \n";	
	
	echo "<tr> \n";


	echo "<td width=\"11%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"84%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</i></td> \n";
	
	
	echo "</tr> \n";
	
		//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteob3 = mysql_fetch_assoc($registro2ob);
	if (isset($extracteob3['OBDATA']) && !empty($extracteob3['OBDATA'])	&& 
				$extracteob3['OBDATA'] == $datasenseob) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseob23 =  mysql_real_escape_string($datashow2);
			
			$coneobz3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$coneobz3)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroersi3z=mysql_query("SELECT * FROM observacions WHERE OBDATA='$datasenseob23' ORDER BY OBHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowob3 = mysql_fetch_row($registroersi3z))
		{	
			echo  "<tr> \n";
			$rowob3[4]=substr($rowob3[4],0,5);
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowob3[4]h</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowob3[5]</td> \n";
			//Descripció
			echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			echo (nl2br($rowob3[6]));
			echo "</td> \n";		

			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"3\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";	




echo "<br /><br />";
//############## INCIDÈNCIES D'OPERATIVA ##################


	$datasenseio =  mysql_real_escape_string($datashow2);

	$con2io=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2io)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registro2io=mysql_query("SELECT * FROM incidoperativa WHERE IODATA='$datasenseio' ORDER BY IOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\" bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\"> \n";
	

	echo "<th bgcolor=\"#303030\" colspan=\"3\" class=\"taula\"><p align=\"left\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\" align=\"center\">INCID&Egrave;NCIES D'OPERATIVA</th> \n";	
	
	echo "<tr> \n";

	echo "<td width=\"11%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"84%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</i></td> \n";
	
	
	echo "</tr> \n";
	
		//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteio3 = mysql_fetch_assoc($registro2io);
	if (isset($extracteio3['IODATA']) && !empty($extracteio3['IODATA'])	&& 
				$extracteio3['IODATA'] == $datasenseio) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseio23 =  mysql_real_escape_string($datashow2);
			
			$coneioz3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$coneioz3)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroio3z=mysql_query("SELECT * FROM incidoperativa WHERE IODATA='$datasenseio23' ORDER BY IOHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowio3 = mysql_fetch_row($registroio3z))
		{	
			echo  "<tr> \n";
			$rowio3[4]=substr($rowio3[4],0,5);
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowio3[4]h</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowio3[5]</td> \n";
			//Descripció
			echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			echo (nl2br($rowio3[6]));
			echo "</td> \n";		
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"3\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";	





echo "<br /><br />";
//############## INCIDÈNCIES TÈCNIQUES ##################

	$datasenseic =  mysql_real_escape_string($datashow2);

	$con2ic=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2ic)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registro2ic=mysql_query("SELECT * FROM incidtecniques WHERE ICDATA='$datasenseic' ORDER BY ICHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\" bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\"> \n";
	

	echo "<th bgcolor=\"#303030\" colspan=\"3\" class=\"taula\"><p align=\"left\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\" align=\"center\">INCID&Egrave;NCIES T&Egrave;CNIQUES</th> \n";	
	
	echo "<tr> \n";

	echo "<td width=\"11%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"84%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</i></td> \n";
	
	
	echo "</tr> \n";
	
		//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteic3 = mysql_fetch_assoc($registro2ic);
	if (isset($extracteic3['ICDATA']) && !empty($extracteic3['ICDATA'])	&& 
				$extracteic3['ICDATA'] == $datasenseic) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseic23 =  mysql_real_escape_string($datashow2);
			
			$coneicz3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$coneicz3)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroic3z=mysql_query("SELECT * FROM incidtecniques WHERE ICDATA='$datasenseic23' ORDER BY ICHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowic3 = mysql_fetch_row($registroic3z))
		{	
			echo  "<tr> \n";
			$rowic3[4]=substr($rowic3[4],0,5);
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowic3[4]h</td> \n";
			echo  "<td valign=\"top\"><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowic3[5]</td> \n";
			//Descripció
			echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			echo (nl2br($rowic3[6]));
			echo "</td> \n";		

			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"5\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	echo "</table> \n";	






echo "<br /><br />";
//############## INCIDÈNCIES TAXI ##################

	// INCIDÈNCIES TAXI -> TAXIS NO RESPON
	$datasenseit =  mysql_real_escape_string($datashow2);

	$conit2=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conit2)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroit2=mysql_query("SELECT * FROM incidtaxis WHERE ITDATA='$datasenseit' AND ITTIPUS='Taxi no respon'  ORDER BY ITHORA ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\" bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\"> \n";
	

	echo "<th bgcolor=\"#303030\" colspan=\"6\" class=\"taula\"><p align=\"left\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\" align=\"center\">INCID&Egrave;NCIES EN LA GESTI&Oacute; DEL TAXI</th> \n";	

	echo "<tr> \n";	
	
	echo "<td bgcolor=\"#C0C0C0\" colspan=\"6\" class=\"taula\"><p align=\"left\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\"><strong>TAXI NO RESPON</strong></td> \n";	
		
	echo "</tr> \n";
	
	echo "<tr> \n";

	//echo "<td><b>Data</b></td> \n";

	echo "<td width=\"11%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td width=\"9%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Ext</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"30%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Llic&egrave;ncia</i></td> \n";
	
	echo "<td width=\"25%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Id.Carta</i></td> \n";
	
	echo "<td width=\"20%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Num. Trucades</i></td> \n";
	
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteit = mysql_fetch_assoc($registroit2);
	if (isset($extracteit['ITDATA']) && !empty($extracteit['ITDATA'])	&& 
				$extracteit['ITDATA'] == $datasenseit) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseit2 =  mysql_real_escape_string($datashow2);
			
			$coneitz=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$coneitz)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerit2z=mysql_query("SELECT * FROM incidtaxis WHERE ITDATA='$datasenseit2' AND ITTIPUS='Taxi no respon'  ORDER BY ITHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowit = mysql_fetch_row($registroerit2z))
		{	
			echo  "<tr> \n";
			$rowit[4]=substr($rowit[4],0,5);
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit[4]h</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit[5]</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit[7]</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit[10]</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit[8]</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit[9]</td> \n";
		
			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}

	
	// INCIDENCIES TAXI -> NO MONITORITZA
	$dataxit2b = $datashow2;
	$datasenseitb =  mysql_real_escape_string($dataxit2b);

	$conit3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conit3)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroit3=mysql_query("SELECT * FROM incidtaxis WHERE ITDATA='$datasenseitb' AND ITTIPUS='Taxi no monitoritzat'  ORDER BY ITHORA ASC")or die("Error en la consulta: ".mysql_error());
			

	echo "<tr> \n";	
	
	echo "<td bgcolor=\"#C0C0C0\" colspan=\"6\" class=\"taula\"><p align=\"left\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\"><strong>TAXIS NO MONITORITZATS AUTOM&Agrave;TICAMENT</strong></td> \n";	
		
	echo "</tr> \n";
	
	echo "<tr> \n";

	echo "<td width=\"11%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td width=\"9%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Ext</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"30%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Llic&egrave;ncia</i></td> \n";
	
	echo "<td width=\"25%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Id.Carta</i></td> \n";
	
	echo "<td width=\"20%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Num. Trucades</i></td> \n";
	
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteit3 = mysql_fetch_assoc($registroit3);
	if (isset($extracteit3['ITDATA']) && !empty($extracteit3['ITDATA'])	&& 
				$extracteit3['ITDATA'] == $datasenseitb) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseit23 =  mysql_real_escape_string($datashow2);
			
			$coneitz3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$coneitz3)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerit3z=mysql_query("SELECT * FROM incidtaxis WHERE ITDATA='$datasenseit23' AND ITTIPUS='Taxi no monitoritzat' ORDER BY ITHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowit3 = mysql_fetch_row($registroerit3z))
		{	
			echo  "<tr> \n";
			$rowit3[4]=substr($rowit3[4],0,5);
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit3[4]h</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit3[5]</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit3[7]</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit3[10]</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit3[8]</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit3[9]</td> \n";
	

			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\"><p align=\"left\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}
	

	// INCIDENCIES TAXI -> TAXIS REPETITIUS
	$dataxit2c = $datashow2;
	$datasenseitc =  mysql_real_escape_string($dataxit2c);

	$conit4=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$conit4)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registroit4=mysql_query("SELECT * FROM incidtaxis WHERE ITDATA='$datasenseitc' AND ITTIPUS='Taxi repetitiu'  ORDER BY ITHORA ASC")or die("Error en la consulta: ".mysql_error());
			

	echo "<tr> \n";	
	
	echo "<td bgcolor=\"#C0C0C0\" colspan=\"6\" class=\"taula\"><p align=\"left\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\"><strong>TAXIS REPETITIUS</strong></td> \n";	
		
	echo "</tr> \n";
	
	echo "<tr> \n";

	echo "<td width=\"11%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Hora</i></td> \n";
	
	echo "<td width=\"9%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Ext</i></td> \n";

	echo "<td width=\"5%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Cen</i></td> \n";
	
	echo "<td width=\"30%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Llic&egrave;ncia</i></td> \n";
	
	echo "<td width=\"25%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Id.Carta</i></td> \n";
	
	echo "<td width=\"20%\" bgcolor=\"#D3D3D3\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Num. Trucades</i></td> \n";
	
	
	echo "</tr> \n";

	
	//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extracteit4 = mysql_fetch_assoc($registroit4);
	if (isset($extracteit4['ITDATA']) && !empty($extracteit4['ITDATA'])	&& 
				$extracteit4['ITDATA'] == $datasenseitc) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasenseit234 =  mysql_real_escape_string($datashow2);
			
			$coneitz4=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$coneitz4)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroerit4z=mysql_query("SELECT * FROM incidtaxis WHERE ITDATA='$datasenseit234' AND ITTIPUS='Taxi repetitiu' ORDER BY ITHORA ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowit4 = mysql_fetch_row($registroerit4z))
		{	
			echo  "<tr> \n";
			$rowit4[4]=substr($rowit4[4],0,5);
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit4[4]h</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit4[5]</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit4[7]</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit4[10]</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit4[8]</td> \n";
			echo  "<td><p align=\"center\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">$rowit4[9]</td> \n";
	

			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"6\"><p align=\"left\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense incid&egrave;ncies</td> \n 
				</tr> \n";
	}
	
	
	echo "</table> \n";




echo "<br /><br />";
//############## ANNEXES ##################


	$datasensean =  mysql_real_escape_string($datashow2);

	$con2an=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con2an)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registro2an=mysql_query("SELECT * FROM annexes WHERE ANDATA='$datasensean' ORDER BY ANHORAINS ASC")or die("Error en la consulta: ".mysql_error());
			
	echo "<table border=\"1\" bordercolor=\"#000000\" style=\"border-collapse: collapse\" width=\"100%\"> \n";


	echo "<th bgcolor=\"#303030\" colspan=\"2\" class=\"taula\"><p align=\"left\"><span lang=\"CA\" style=\"font-size: 10.0pt; font-family: Arial\" align=\"center\">ANNEXES</th> \n";	
	
	echo "<tr> \n";

	echo "<td width=\"50%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Descripci&oacute;</i></td> \n";
	
	echo "<td width=\"50%\" bgcolor=\"#C0C0C0\" class=\"taula\"><i><p align=\"center\"><span lang=\"CA\" style=\"font-size: 8.0pt; font-family: Arial\">Arxiu</i></td> \n";
	
	
	echo "</tr> \n";
	
		//definim variable unica per permetre una fila anomenada Sense Incidencies en cas que no hi hagi cap dada
	$extractean3 = mysql_fetch_assoc($registro2an);
	if (isset($extractean3['ANDATA']) && !empty($extractean3['ANDATA'])	&& 
				$extractean3['ANDATA'] == $datasensean) 	
	{
			//tornem a carregar connexió, necessari per no perdre la primera linia de dades
			$datasensean23 =  mysql_real_escape_string($datashow2);
			
			$coneanz3=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
			mysql_select_db($db,$coneanz3)or die("Hi ha problemes per connectar amb la base de dades");
			
			mysql_query("SET NAMES 'utf8'");
			
			$registroan3z=mysql_query("SELECT * FROM annexes WHERE ANDATA='$datasensean23' ORDER BY ANHORAINS ASC")or die("Error en la consulta: ".mysql_error());
			
		while ($rowan3 = mysql_fetch_row($registroan3z))
		{	
			echo  "<tr> \n";
			//Descripció
			echo "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">";
			echo (nl2br($rowan3[4]));
			echo "</td> \n";		
			echo  "<td><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\"><i>$rowan3[5] </i></td> \n";						

			echo  "</tr> \n";		
		}	
	} else {	
		echo "<tr> \n 
					<td colspan =\"2\"><span lang=\"CA\" style=\"font-size: 9.0pt; font-family: Arial\">Sense arxius adjunts</td> \n 
				</tr> \n";
	}

	echo "</table> \n";	



	
?>



</body>
</html>

