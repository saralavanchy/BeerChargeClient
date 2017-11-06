<!DOCTYPE html>
<html>
<head>
  <title>Elegir sucursal</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/<?= BASE_URL ?>Css/style.css"/>
</head>

 <body class="fondo-sucursal expandir-fondo">

  <form class="form" name="form" method="post" action="/<?= BASE_URL ?>SeleccionarSucursal/chargeSubsidiary">
    <table class="centrar pizarra expandir-fondo" style="font-family: 'Old Bookshop'">
      <tr>
        <td colspan="2"><h1>Seleccionar Sucursal</h1></td>
      </tr>
      <tr>
        <td colspan="2">
          <select name="id" id="subsidiary" onchange="Actualizar()" style="margin-left: 0px;">
            <?php foreach($list as $subsidiary) { ?>
            <option value="<?=$subsidiary->getId();?>"><?=$subsidiary->getAddress();?></option>
            <?php } ?>
          </select>
        </td>
      </tr>
      <tr>
        <td><input type="text" name="lat" value=""></td>
        <td><input type="text" name="lon" value=""></td>
        <input type="hidden" name="sucursal" id='sucursal'>
      </tr>
      <tr>
        <td colspan="2">
          <div id="map" style="height: 400px; width:400px;"></div>
        </td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" class="submit" value="Aceptar" style="margin-left: 0px;"></td>
      </tr>
    </table>
  </form>

  
  <script src="/<?= BASE_URL ?>Js/GoogleMaps.js" charset="utf-8"></script>
  <script type="text/javascript">
  
  function Actualizar() {
    var subsidiary = form.subsidiary.options[form.subsidiary.selectedIndex].value;
   
    var selectBox = document.getElementById("subsidiary");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    document.getElementById('sucursal').value = selectedValue;

    Ajax('/<?= BASE_URL ?>Ajax/GetSubsidiary', 'post', 'msj='+subsidiary, function(respuestaAjax) {
      Mostrar(respuestaAjax);
    });
  }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCBbhiQn8Z1G7-uj5IVlDj1pSYKlgfT3I&callback=GenerateMap">
  </script>

</body>
</html>