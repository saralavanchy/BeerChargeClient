<?php namespace Views;
	isset($_SESSION['order']) ? $orden=$_SESSION['order'] : $orden=null;
 	?>
<!DOCTYPE html>
<html>
<head>
	<title>Ingresar Pedido</title>
	 <meta charset="utf-8">
	 <link rel="stylesheet" href="/<?= BASE_URL ?>Css/style.css"/>
</head>
  <body class="fondo-carga expandir-fondo">


 <div class="centrar" style="width: 80%; margin-top: 40px;">
	 <form action='/<?= BASE_URL ?>AgregarCerveza/newOrder' method='post'>
		<!-- cabecera del pedido  !-->
		<center>
			<p class="tabla-envases pizarra expandir-fondo" style="font-family: 'Old Bookshop'"> INGRESO  DE  PEDIDO </p></center>

        <table  align='center' class="tabla-envases pizarra expandir-fondo">
        	<tr>
        		<td>Fecha: </td>
        		<td><input type="text" name="" 
        			value="<?php if(isset($orden))
        			{
        				if ($orden->getOrderDate() != null)
        				echo $orden->getOrderDate();
        			} ?>" disabled></td>
        	</tr>
        	<tr>
        		<td>Sucursal: </td>
        		<td>
	        		<?php if(isset($orden)){ 
	        		if($orden->getSubsidiary()==null) 
	        		{?>
	        			<a href="/<?= BASE_URL ?>seleccionarSucursal/select" class="btn-volver"> Ingresar Sucursal</a>
	        		<?php }
	        		else{ ?>
	        			<input type="text" name="sucursal" value="<?=$orden->getSubsidiary();?>" disabled> 
	        		<?php }
	        		} else{?>
	        			<a href="/<?= BASE_URL ?>seleccionarSucursal/select" class="btn-volver"> Ingresar Sucursal</a>
	        		<?php } ?>
        		</td>        		
        	</tr>
        	<tr>
        		<td>Rango Horario: </td>
        		<td><a href="/<?= BASE_URL ?>elegirRangoHorario/Index" class="btn-volver"> Ingresar Rango Horario</a></td>
        	</tr>
        	<tr><td colspan="2" align="left">Detalle: </td></tr>

        </table>

         <!-- detalle del pedido  !-->
        <table align='center' class="tabla-envases pizarra expandir-fondo">
        	
        	<center><tr>
            <td>CERVEZA</td>
            <td>ENVASE</td>
            <td>SUBTOTAL</td>
          	</tr></center>

          	<?php if(isset($orden)){
	            $orderlines=$orden->getOrderLines();
	            $total=0;

	            foreach ($orderlines as $orderline) {?>
	            <tr>
	              <td><?= $orderline->getBeer();?></td>
	              <td><?= $orderline->getPackaging();?></td>
	              <td><?php $subtotal=$orderline->getAmount()*$orderline->getPrice(); 
	                    echo '$'.$subtotal;?></td>
	              <?php $total=$total+$subtotal;?>
	            </tr>
	          <?php }?> 
	          <tr>
	          	<td colspan="2">TOTAL</td>
	          	<td align="right"><?='$'.$total;?></td>>
	          </tr>
	        <?php }

	        else{
	        	echo '<tr>'.'<td colspan="3" align="center">'.'debe ingresar un pedido primero'.'<td>'.'</tr>';
	        }
	        ?>

	         <!-- acciones del pedido  !-->
	       	<tr>
	          <input type="hidden" name="total" value=<?php $total;?>>
	          <td><a href="/<?= BASE_URL ?>listaCervezas" class="btn-volver">Ingresar Nueva Cerveza</a></td>
	          <td align="right"><a href="/<?= BASE_URL ?>AgregarCerveza/deleteOrder" class="btn-volver"> Eliminar Pedido</td>
	          <td><input type="submit" name="enter" value='Ingresar Pedido' class="submit"></td>
	        </tr>
        </table>

    </form>
  </div>

</body>
</html>