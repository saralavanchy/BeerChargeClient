<?php namespace Controller;
use DAOS\BeerDAO as BeerDAO;
use DAOS\PackagingDAO as PackagingDAO;
#use DAOS\OrderDAO as OrderDAO;
use Model\Order as Order;
use Model\OrderLine as OrderLine;

class AgregarCervezaController {

  private $beerDAO;
  private $packagingDAO;
  private $orderDAO;
  private $order;

  public function __construct() {
    $this->beerDAO = BeerDAO::getInstance();
    $this->packagingDAO = PackagingDAO::getInstance();
    #$this->orderDAO = orderDAO::getInstance();
  }

  public function Traer($id) {
    $beer = $this->beerDAO->SelectByID($id);
    return $beer;
  }

  public function Mostrar($id) {
    $beer = $this->Traer($id);
    $envases = $this->packagingDAO->SelectAll();
    if (isset($beer)) {
      require 'Views/agregarCerveza.php';
    } else {
      #TODO Cerveza no encontrada
    }
  }

  public function deleteOrder($mensaje = null)
  {
    unset($_SESSION['order']);
    $this->returnToBeerList($mensaje);
  }

  public function newBeer()
  {
    isset($_POST['cantidad']) ? $amount=$_POST['cantidad'] : $amount=null;
    isset($_POST['price']) ? $price=$_POST['price'] : $price=null;
    isset($_POST['beer']) ? $beer=$_POST['beer'] : $beer=null;
    isset($_POST['envase']) ? $packaging=$_POST['envase'] : $packaging=null;
    $line=new OrderLine($amount, $price, $beer, $packaging);

    if(!isset($_SESSION['order']))
    {
      $order_date=date('d/m/y');
      $state='solicitado';
      isset($_SESSION['account']) ? $client=$_SESSION['account']->getUserName() : require_once('Views/login.php'); 
      $this->order=new Order($order_date, $state, $client);
      $this->order->newLine($line);
      $_SESSION['order']=$this->order;
      $carga="/BeeRecharge/Css/charge.gif";
    }
    else
    {
      $_SESSION['order']->newLine($line);
    } 
    $this->returnToBeerList();      
  } 

  public function newOrder()
  {
    if(isset($_SESSION['order']))
    {
      if (isset($_POST['total']))
      {
          $_SESSION['order']->setTotal($_POST['total']);
          #$this->orderDAO->Insert($_SESSION['order']); 
          $msj= 'su pedido se ha cargado correctamente. Seleccione una cerveza para ingresar un nuevo pedido';    
          $this->deleteOrder($msj); 
      }   
    }
    else
    {
      $msj='debe ingresar una cerveza primero';
      $this->returnToBeerList($msj);
    }
   
    
  }

  public function returnToBeerList($mensaje = null)
  {
    require_once'Controller/ListaCervezasController.php';
    $msj=$mensaje;
    $controler=new ListaCervezasController();
    $controler->index($msj);
  }

} ?>
