<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> User Lobby  | DLL</title>
    <link rel="stylesheet" href="/<?= BASE_URL ?>Css/style.css"/>
  </head>
  <body>
    <!-- <script src="/<?= BASE_URL ?>Js/Comprobacion.js" charset="utf-8"></script> -->
    <!-- <script src="/<?= BASE_URL ?>Js/Ajax.js" charset="utf-8"></script> -->
    <style media="screen">
      .account {
        text-align: right;

        font-size: 15px;
        margin-right: 20px;
        margin-bottom: 5px;
      }
    </style>
    <div class="account pizarra expandir-fondo">
      Usuario <?php echo $_SESSION['account']->getUsername(); 
      if(isset($_SESSION['role'])){?> logueado como <?= $_SESSION['role']->getRolename();}?>
    
    <ul class="dropdown-contenedor">
      <li><a href="/<?= BASE_URL ?> ListaCervezas" class="dropdown-link">Seleccionar Cerveza</a>
      </li>
      <li><a href="/<?= BASE_URL ?> SeleccionarSucursal/select" class="dropdown-link">Elegir Sucursal</a>
      </li>
      <li><a href="/<?= BASE_URL ?> elegirRangoHorario/Index" class="dropdown-link">Elegir Rango Horario</a>
      </li>
      <li><a href="/<?= BASE_URL ?> submitOrder" class="dropdown-link">Ingresar Pedido</a>
      </li>
      <li><a href="/<?= BASE_URL ?> consultarEstado/Index" class="dropdown-link">Consultar Estado</a>
      </li>      
      <li><a href="/<?= BASE_URL ?>login/logout" class="dropdown-link" align='right'>Cerrar sesión</a></li>
    </ul>

    </div>
    