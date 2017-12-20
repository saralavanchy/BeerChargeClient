<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> Lobby  | DLL</title>
    <link rel="stylesheet" href="/<?= BASE_URL ?>Css/style.css"/>
  </head>
<body class="fondo-madera expandir-fondo">
<!---->
	<center><p class="tabla-envases pizarra expandir-fondo" style="font-family: 'Old Bookshop'"> 
	Selecciona el rango de fechas en las que desea consultar estados</p></center>

	<form action="/<?= BASE_URL ?>consultarEstado/consultar" method="post">
		<table class="tabla-envases pizarra expandir-fondo" align="center" style="font-family: 'Old Bookshop'">
			<tr>
				<td>DESDE:</td>
				<td><input type="date" name="desde" value="<?php if(isset($from))
					{ echo ($from); } else{
						echo(date(('Y-m-d'), strtotime('-1 day')));};?>"  required></td>
			</tr>
				<tr>
				<td>HASTA:</td>
				<td><input type="date" name="hasta" value="<?php if(isset($to))
					{ echo ($to); } else{ 
						echo(date('Y-m-d'));}?>" required></td>
			</tr>
			<tr><td colspan="2" align="right">
				<input type="submit" class="submit" value="consultar"  name="consultar">
			</td></tr>
		</table>
	</form>
	

	<!--se comparará la variable booleana y se dara inicio con el formulario de muestra de los pedidos-->
	<?php if(isset($msj)){ ?>
		<table class="tabla-envases pizarra expandir-fondo" align="center" style="font-family: 'Old Bookshop'">
			<tr><td><?=$msj?></td></tr>
		</table>
	<?php } ?>
	
	<?php  if(isset($orderList)){?>
	<table class="tabla-envases pizarra expandir-fondo" align="center" style="font-family: 'Old Bookshop'">
		<tr>
			
			<td>Cliente: </td>
			<td><?=$client->getName();?></td>
		</tr>
		<tr>
			<td>DNI:</td>
			<td><?=$client->getDNI();?></td>
		</tr>
		<tr>
			<td> FECHA </td>
			<td> DETALLE </td>
			<td> IMPORTE </td>
			<td> ESTADO </td>
		</tr>
		<?php if(isset($msj))echo'<tr><td colspan=2 align="center">'.$msj.'</td></tr>';?>
		<?php foreach ($orderList as $ordenes){ ?>
			<tr>
				<td><?= $ordenes->getOrderDate(); ?></td>
				<td><a href="/<?= BASE_URL ?>consultarEstado/verDetalle/<?=$ordenes->getOrderNumber();?>" class="btn-volver">Ver Detalle</a></td>
				<td><?= $ordenes->getTotal(); ?></td>
				<td><?= $ordenes->getState()->getState();?></td>
			</tr>
		<?php } ?>		
		<tr></tr>
		<tr><td colspan="4" align="center"><a href="/<?= BASE_URL ?>ConsultarEstado/finalizarConsulta" ><button class="btn-login" type="button">Finalizar Consulta</button></a></td></tr>
	</table>
	<?php } ?>

</body>
</html>