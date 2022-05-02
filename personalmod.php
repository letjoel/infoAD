<?php require_once("header.php"); ?>
<?php require_once("sessio.php"); ?>
<?php include("nav.php"); ?>
<?php include("connexio.php"); ?>
<?php	$datashow = date('Y-m-d'); ?>
<?php
	// Incidències Personal ->Taula que es mostra en pantalla sempre, referent al dia actual
	$datasenseir =  mysql_real_escape_string($datashow);

	$con6ir=mysql_connect($host,$user,$pw)or die("Hi ha hagut un problema amb la connexió");
	mysql_select_db($db,$con6ir)or die("Hi ha problemes per connectar amb la base de dades");
	
	mysql_query("SET NAMES 'utf8'");
	
	$registro6ir=mysql_query("SELECT * FROM personal WHERE PERSDATA='$datasenseir'")or die("Error en la consulta: ".mysql_error());
			
	$extracteir = mysql_fetch_assoc($registro6ir);
?>
<form method="post" action="personalmod_ok.php" autocomplete="off" name="formpersonalmod">

<table border="1" width="1000" id="table1">
	<tr>
		<td colspan="11" class="taula"><strong>Incidencies Personal</strong></td>
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
		<textarea class="input" name="incid_n" rows="2" cols="60" required="true">
<?php 
			if (isset($extracteir['INCID_N']) && !empty ($extracteir['INCID_N'])) 
			
				{echo $extracteir['INCID_N'];
			} else {echo "Sense incid&egrave;ncies";}
		 ?>
</textarea>
		</td>
	</tr>
	<tr>
		<td width="117">ZF</td>
		<td width="40">
		<input type="number" class="input" name="fra1_n_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA1_N_ZF'] > 0) 
			
				{echo $extracteir['FRA1_N_ZF'];
			} else { echo 0 ;}
		 ?>" />
		</td>
		<td width="40">
		<input type="number" class="input" name="fra2_n_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA2_N_ZF'] > 0) 
			
				{echo $extracteir['FRA2_N_ZF'];
			} else { echo 0 ;}
		 ?>" />
		</td>
		<td width="40">
		<input type="number" class="input" name="fra3_n_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA3_N_ZF'] > 0) 
			
				{echo $extracteir['FRA3_N_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra4_n_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA4_N_ZF'] > 0) 
			
				{echo $extracteir['FRA4_N_ZF'];
			} else { echo 0 ;}
		 ?>" />		
		</td>
		<td width="40">
		<input type="number" class="input" name="fra5_n_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA5_N_ZF'] > 0) 
			
				{echo $extracteir['FRA5_N_ZF'];
			} else { echo 0 ;}
		 ?>" />		
		</td>
		<td width="40">
		<input type="number" class="input" name="fra6_n_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA6_N_ZF'] > 0) 
			
				{echo $extracteir['FRA6_N_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra7_n_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA7_N_ZF'] > 0) 
			
				{echo $extracteir['FRA7_N_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra8_n_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA8_N_ZF'] > 0) 
			
				{echo $extracteir['FRA8_N_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
	</tr>
	<tr>
		<td width="117">Reus</td>
		<td width="40">
		<input type="number" class="input" name="fra1_n_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA1_N_R'] > 0) 
			
				{echo $extracteir['FRA1_N_R'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra2_n_r" size="1" maxlength="3" min="0" max="999" value="<?php 
			if ($extracteir['FRA2_N_R'] > 0) 
			
				{echo $extracteir['FRA2_N_R'];
			} else { echo 0 ;}
		 ?>" />		
		</td>
		<td width="40">
		<input type="number" class="input" name="fra3_n_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA3_N_R'] > 0) 
			
				{echo $extracteir['FRA3_N_R'];
			} else { echo 0 ;}
		 ?>" />		
		</td>
		<td width="40">
		<input type="number" class="input" name="fra4_n_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA4_N_R'] > 0) 
			
				{echo $extracteir['FRA4_N_R'];
			} else { echo 0 ;}
		 ?>" />		
		</td>
		<td width="40">
		<input type="number" class="input" name="fra5_n_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA5_N_R'] > 0) 
			
				{echo $extracteir['FRA5_N_R'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra6_n_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA6_N_R'] > 0) 
			
				{echo $extracteir['FRA6_N_R'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra7_n_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA7_N_R'] > 0) 
			
				{echo $extracteir['FRA7_N_R'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra8_n_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA8_N_R'] > 0) 
			
				{echo $extracteir['FRA8_N_R'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
	</tr>
	<tr>
		<td width="265" colspan="2">Total Nit</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
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
		<textarea class="input" name="incid_m" rows="2" cols="60" required="true">
<?php 
			if (isset($extracteir['INCID_M']) && !empty ($extracteir['INCID_M'])) 
			
				{echo $extracteir['INCID_M'];
			}else {echo "Sense incid&egrave;ncies";}
		 ?>
</textarea>
		</td>
	</tr>
	<tr>
		<td width="117">ZF</td>
		<td width="40">
		<input type="number" class="input" name="fra1_m_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA1_M_ZF'] > 0) 
			
				{echo $extracteir['FRA1_M_ZF'];
			} else { echo 0 ;}
		 ?>" />		
		</td>
		<td width="40">
		<input type="number" class="input" name="fra2_m_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA2_M_ZF'] > 0) 
			
				{echo $extracteir['FRA2_M_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra3_m_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA3_M_ZF'] > 0) 
			
				{echo $extracteir['FRA3_M_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra4_m_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA4_M_ZF'] > 0) 
			
				{echo $extracteir['FRA4_M_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra5_m_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA5_M_ZF'] > 0) 
			
				{echo $extracteir['FRA5_M_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra6_m_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA6_M_ZF'] > 0) 
			
				{echo $extracteir['FRA6_M_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra7_m_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA7_M_ZF'] > 0) 
			
				{echo $extracteir['FRA7_M_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra8_m_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA8_M_ZF'] > 0) 
			
				{echo $extracteir['FRA8_M_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
	</tr>
	<tr>
		<td width="117">Reus</td>
		<td width="40">
		<input type="number" class="input" name="fra1_m_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA1_M_R'] > 0) 
			
				{echo $extracteir['FRA1_M_R'];
			} else { echo 0 ;}
		 ?>" />		
		</td>
		<td width="40">
		<input type="number" class="input" name="fra2_m_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA2_M_R'] > 0) 
			
				{echo $extracteir['FRA2_M_R'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra3_m_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA3_M_R'] > 0) 
			
				{echo $extracteir['FRA3_M_R'];
			} else { echo 0 ;}
		 ?>" />		
		</td>
		<td width="40">
		<input type="number" class="input" name="fra4_m_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA4_M_R'] > 0) 
			
				{echo $extracteir['FRA4_M_R'];
			} else { echo 0 ;}
		 ?>" />		
		</td>
		<td width="40">
		<input type="number" class="input" name="fra5_m_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA5_M_R'] > 0) 
			
				{echo $extracteir['FRA5_M_R'];
			} else { echo 0 ;}
		 ?>" />		
		</td>
		<td width="40">
		<input type="number" class="input" name="fra6_m_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA6_M_R'] > 0) 
			
				{echo $extracteir['FRA6_M_R'];
			} else { echo 0 ;}
		 ?>" />		
		</td>
		<td width="40">
		<input type="number" class="input" name="fra7_m_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA7_M_R'] > 0) 
			
				{echo $extracteir['FRA7_M_R'];
			} else { echo 0 ;}
		 ?>" />		
		</td>
		<td width="40">
		<input type="number" class="input" name="fra8_m_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA8_M_R'] > 0) 
			
				{echo $extracteir['FRA8_M_R'];
			} else { echo 0 ;}
		 ?>" />		
		</td>
	</tr>
	<tr>
		<td width="265" colspan="2">Total Mati</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
		<td width="40">
		<?php 
			if (!empty ($extracteir['FRA5_M_ZF']) &&
				!empty ($extracteir['FRA5_M_R'])  ) 			
			{echo $extracteir['FRA5_M_R']+$extracteir['FRA1_M_ZF'];
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
		</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
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
		<textarea class="input" name="incid_t" rows="2" cols="60" required="true">
<?php 
			if (isset($extracteir['INCID_T']) && !empty ($extracteir['INCID_T'])) 
			
				{echo $extracteir['INCID_T'];
			}else {echo "Sense incid&egrave;ncies";}
		 ?>
</textarea>
		</td>
	</tr>
	<tr>
		<td width="117">ZF</td>
		<td width="40">		
		<input type="number" class="input" name="fra1_t_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA1_T_ZF'] > 0) 
			
				{echo $extracteir['FRA1_T_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		 </td>
		<td width="40">
		<input type="number" class="input" name="fra2_t_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA2_T_ZF'] > 0) 
			
				{echo $extracteir['FRA2_T_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra3_t_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA3_T_ZF'] > 0) 
			
				{echo $extracteir['FRA3_T_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra4_t_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA4_T_ZF'] > 0) 
			
				{echo $extracteir['FRA4_T_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra5_t_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA5_T_ZF'] > 0) 
			
				{echo $extracteir['FRA5_T_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra6_t_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA6_T_ZF'] > 0) 
			
				{echo $extracteir['FRA6_T_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra7_t_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA7_T_ZF'] > 0) 
			
				{echo $extracteir['FRA7_T_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra8_t_zf" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA8_T_ZF'] > 0) 
			
				{echo $extracteir['FRA8_T_ZF'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
	</tr>
	<tr>
		<td width="117">Reus</td>
		<td width="40">
		<input type="number" class="input" name="fra1_t_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA1_T_R'] > 0) 
			
				{echo $extracteir['FRA1_T_R'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra2_t_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA2_T_R'] > 0) 
			
				{echo $extracteir['FRA2_T_R'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra3_t_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA3_T_R'] > 0) 
			
				{echo $extracteir['FRA3_T_R'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra4_t_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA4_T_R'] > 0) 
			
				{echo $extracteir['FRA4_T_R'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra5_t_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA5_T_R'] > 0) 
			
				{echo $extracteir['FRA5_T_R'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra6_t_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA6_T_R'] > 0) 
			
				{echo $extracteir['FRA6_T_R'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra7_t_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA7_T_R'] > 0) 
			
				{echo $extracteir['FRA7_T_R'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
		<td width="40">
		<input type="number" class="input" name="fra8_t_r" size="1" maxlength="3" min="0" max="999" value="<?php 
				if ($extracteir['FRA8_T_R'] > 0) 
			
				{echo $extracteir['FRA8_T_R'];
			} else { echo 0 ;}
		 ?>" />	
		</td>
	</tr>
	<tr>
		<td width="265" colspan="2">Total Tarda</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
		<td width="40">
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
		</td>
	</tr>
</table>
<br />
	<input type="hidden" name="persid" value="<?php
				if ($extracteir['PERSID'] > 0) 
			
				{echo $extracteir['PERSID'];
			} else { echo "falso" ;}
			?>" />
	<input type="submit" value="Modificar" class="input" />
</form>
	<form action="pantalla.php">
	<input type="submit" value="Tornar" class="boto"  />	
	</form>	
	
<br /><br />





















<?php require_once("footer.php"); ?>