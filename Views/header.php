<div class="header">
  <p>Usted se ha identificado como: <?= $_SESSION['account']->getUserName(); ?> <a href="/<?= BASE_URL ?>Login/Logout">(Cerrar sesion)</a>

  <a href="/<?= BASE_URL ?>submitOrder/Index" class="btn-volver">Ingresar Pedido</a>
  </p>

</div>
