<?php namespace Controller;

use Model\Order as Order;
use DAOS\BeerDAO as BeerDAO;
use DAOS\PackagingDAO as PackagingDAO;
use DAOS\SubsidiaryDAO as SubsidiaryDAO;
use DAOS\TimeRangeDAO as TimeRangeDAO;
use DAOS\ClientDAO as ClientDAO;
use Exception;

class LobbyController {

  private $beerDAO;
  private $packagingDAO;
  private $subsidiaryDAO;
  private $timeRangeDAO;
  private $clientDAO;

  public function __construct() {
    $this->beerDAO = BeerDAO::getInstance();
    $this->packagingDAO = PackagingDAO::getInstance();
    $this->subsidiaryDAO = SubsidiaryDAO::getInstance();
    $this->timeRangeDAO = TimeRangeDAO::getInstance();
    $this->clientDAO = ClientDAO::getInstance();
    if (!isset($_SESSION['account'])) {
      header('location: /'.BASE_URL);
    }
    if (!isset($_SESSION['order'])) {
      try{
         $client = $this->clientDAO->SelectByAccount($_SESSION['account']);
          $_SESSION['order'] = new Order(null, null, $client, null);  
      } catch (\Exception $e){

      }
     
    }
    require_once 'Views/Lobby.php';
  }

  public function Index() {
    try{
    $cervezas = $this->beerDAO->SelectAll();
    $cervezas = $this->QuitarCervezasSinPackaging($cervezas);
  }catch(\Exception $e){

  }
  require_once 'Views/ListaCervezas.php';
  }

  public function AgregarCerveza($id_beer) {
    unset($_SESSION['date']);
    try {
      $beer = $this->beerDAO->SelectByID($id_beer);
      if (isset($beer)) {
        require_once 'Views/AgregarCerveza.php';
      } else {
      }
    } catch (\Exception $e) {
    }
  }

   private function QuitarCervezasSinPackaging($lista) {
    $aux = array();
    foreach ($lista as $cerveza) {
      if (!empty($cerveza->getPackagings())) {
        array_push($aux, $cerveza);
      }
    }
    return $aux;
  }

  public function ElegirSucursal() {
    unset($_SESSION['date']);
    $subsidiarys = $this->subsidiaryDAO->SelectAll();
    require_once 'Views/ElegirSucursal.php';
  }

  public function SubmitOrder() {
    unset($_SESSION['date']);
    if (isset($_SESSION['order'])) {
      $order = $_SESSION['order'];
      try{
        $subsidiary = $order->getSubsidiary();
      }catch(\Exception $e){

      }
      
      require_once 'Views/SubmitOrder.php';
    } else {
      header('location: /'.BASE_URL.'Lobby');
    }
  }

  public function ConsultarEstado(){
    unset($_SESSION['date']);
    require_once 'Views/consultarEstado.php';
  }
} ?>
