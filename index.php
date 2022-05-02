<?php require_once("header.php"); ?>
<?php include("includes/_arrays.php"); ?>

<br />
<br />
<div class="barrah2index">	


<div class="taulainici">
		<strong>Accedir</strong> 
		<br />
		<br />
		<form action="validar.php" method="post" autocomplete="off" name="form">
		Usuari: 
		<br />
		<input type="text" name="user"/>
		<br/>
		Password: <br /><input type="password" name="pass"/>
		<br/>
		<br/>
		<input type="submit" value="Entrar"/>
</form>
</div>

<div class="barrah2bindex">
<strong>Tip del dia:</strong>
<br />
<br />
<?php

echo $tip[rand(0, 9)];

 ?>


</div>

</div>
<br />

<?php require_once("footer.php"); ?>