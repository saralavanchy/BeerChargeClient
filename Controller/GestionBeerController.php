<?php namespace Controller;

use DAOS\BeerDAO as BeerDAO;
use Model\Beer as Beer;
use DAOS\BeerDAOListas as BeerDAOListas;
use Controller\GestionController as GestionController;
use Config\Config as Config;

class GestionBeerController extends GestionController {

  private $beerDAO;

  public function __construct() {
    self::$roles = array('Admin', 'Empleado', 'Vendedor', 'Flaquito');
    $this->beerDAO = BeerDAO::getInstance();
    $this->BeerDAOListas=new BeerDAOListas();
    parent::__construct();
  }

  public function Index() {}

  /*
  La primera vez que entra llama a la vista.
  Cuando se envia el form desde la vista, la funcion recibe la nueva Cerveza
  y aplica la logica necesaria
  */
  public function SubmitBeer($name = null, $description = null, $price = null, $ibu = null, $srm = null, $graduation = null, $image = null) {
    /*
    Si recibo parametros, creo el objeto Beer y lo inserto en la BD.
    */
    if (isset($name)) {
      $beer = new Beer($name, $description, $price, $ibu, $srm, $graduation, $image);
      #$error = $this->beerDAO->Insert($beer);
      $error = $this->BeerDAOListas->Insert($beer);
      if (!isset($error)) {
        $alert = "green";
        $msj = "Cerveza añadida correctamente: ".$beer->getName().$beer->getDescription();
      } else {
        $alert = "yellow";
        $msj = "Ocurrio un problema";
      }
    }
    require_once 'AdminViews/SubmitBeer.php';
  }

  public function UpdateBeer($id_beer = null, $name = null, $description = null, $price = null, $ibu = null, $srm = null, $graduation = null, $image = null) {
    /*
    Si recibo parametros, creo el objeto Beer y actualizo el que tengo en la BD.
    */
    if (isset($name)) {
      $beer = new Beer($name, $description, $price, $ibu, $srm, $graduation, $image);
      $beer->setId($id_beer);
      #$error = $this->beerDAO->Update($beer);
      $error = $this->BeerDAOListas($beer);
      if (!isset($error)) {
        $alert = "green";
        $msj = "Cerveza modificada correctamente: ".$beer->getName();
      } else {
        $alert = "yellow";
        $msj = "Ocurrio un problema";
      }
    }
    $list = $this->BeerDAOListas->SelectAll();
    require_once 'AdminViews/UpdateBeer.php';
  }

  public function DeleteBeer($name = null, $id_beer = null) {
    /*
    Si recibo parametros, elimino el que tengo en la BD.
    */
    if (isset($name)) {
      #$error = $this->beerDAO->DeleteById($id_beer);
      $error = $this->BeerDAOListas->Delete($name);
      if (!isset($error)) {
        $alert = "green";
        $msj = "Cerveza eliminada: ".$name." (id ".$id_beer.")";
      } else {
        $alert = "yellow";
        $msj = "Ocurrio un problema";
      }
    }
    #$list = $this->beerDAO->SelectAll();
    $list = $this->BeerDAOListas->SelectAll();
    require_once 'AdminViews/DeleteBeer.php';
  }
} ?>
