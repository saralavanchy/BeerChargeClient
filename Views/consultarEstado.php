<!DOCTYPE html>
<html>
<head>
	<title>Consultar estados</title>
</head>
<body class="fondo-estados expandir-fondo">

	<center><p class="tabla-envases pizarra expandir-fondo" style="font-family: 'Old Bookshop'"> Selecciona el rango de fechas en las que desea consultar estados</p></center>

	<!--
	<?php/* if(isset($msj)){?>
	<center><p class="tabla-envases pizarra expandir-fondo" style="font-family: 'Old Bookshop'"> 
	<?=$msj;?>
	</p></center>
	<?php}*/?>
	-->

	<form action="consultarEstado/consultar" method="post">
		<table class="tabla-envases pizarra expandir-fondo" style="font-family: 'Old Bookshop'" align="center">
			<tr>
				<td>DESDE:</td>
				<td><input type="date" name="desde" required></td>
			</tr>
				<tr>
				<td>HASTA:</td>
				<td><input type="date" name="hasta" required></td>
			</tr>
			<tr><td colspan="2" align="right">
				<input type="submit" class="submit" value="Consultar" name="enter">
			</td></tr>
		</table>
	</form>

	<!--se comparará la variable booleana y se dara inicio con el formulario de muestra de los pedidos-->
	<?php if(isset($orders)){?>
	<table class="tabla-envases pizarra expandir-fondo" style="font-family: 'Old Bookshop'" align="center">
		<tr>
			<td>FECHA</td>
			<td>DETALLE</td>
			<td>IMPORTE</td>
			<td>ESTADO</td>
		</tr>
		<?php foreach ($orders as $ordenes){ ?>
			<tr>
				<td><?= $ordenes->getOrderDate(); ?></td>
				<td><a href="/<?= BASE_URL ?>consultarEstado/verDetalle" class="btn-volver">Ver Detalle</a></td>
				<td><?= $ordenes->getTotal(); ?></td>
				<td><?= $ordenes->getState();?></td>
			</tr>
		<?php } ?>		
	</table>
	<?php } ?>
</body>
</html>