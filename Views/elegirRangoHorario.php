<!DOCTYPE html>
<html>
<head>
	<title>Rango Horario</title>
	 <meta charset="utf-8">
	 <link rel="stylesheet" href="/<?= BASE_URL ?>Css/style.css"/>
</head>
<body class="fondo-horario expandir-fondo">

	<center><p class="tabla-envases pizarra expandir-fondo" style="font-family: 'Old Bookshop'"> Selecciona el rango horario correspondiente en el que desea recibir su pedido</p></center>

	<form>
		<table class="tabla-envases pizarra expandir-fondo" style="font-family: 'Old Bookshop'" align="center">
			<tr>
				<td>Si desea recibir su pedido en una fecha diferente, por favor seleccione la fecha deseada:</td>
			</tr>
			<tr>
				<td><center><input type="text" name="fecha" value="<?php echo date("d/m/Y"); ?>"></center>
				</td>
			</tr>
		</table>

		<table class="tabla-envases pizarra expandir-fondo" style="font-family: 'Old Bookshop'" align="center">
			<tr>
				<td>ENTRE LAS:</td>
				<td>
					<?php if(isset($horarios)){ 
						foreach ($horarios as $key) {?>
							<input type="checkbox" name="desde" value="<?=$key->getFrom()?>"><?=$key->getFrom()?>
						<?php } 
					} else{?>
						<input type="time" name="desde" min=”10:00:00″ value='10:00:00' required>
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td>HASTA LAS:</td>
				<td>
					<?php if(isset($horarios)){ 
						foreach ($horarios as $key) {?>
							<input type="checkbox" name="hasta" value="<?=$key->getTo()?>"><?=$key->getTo()?>
						<?php } 
					} else{?>
						<input type="time" name="hasta" max=”23:59:59″ value="23:59:59" required>
					<?php } ?>
				</td>	
			</tr>
			<tr><td colspan="2" align="right">
				<input type="submit" class="submit" value="seleccionar" name="enter">
			</td></tr>
		</table>

		<table  align='center' class="tabla-envases pizarra expandir-fondo">
          <tr><td> <img src="/BeeRecharge/Css/beer2.gif" style="width: 300px"></td></tr>         
      </table>

	</form>

</body>
</html>