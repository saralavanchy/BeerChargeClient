<?php namespace Controller;
use DAOS\BeerDAO as BeerDAO;
class ListaCervezasController {

  public function Index($mensaje = null) {
    #$BeerDAO = BeerDAO::getInstance();
    $BeerDAO = BeerDAO::getInstance();
    $cervezas = $BeerDAO->SelectAll();
    $msj=$mensaje;
    require_once 'Views/ListaCervezas.php';
  }
} ?>
