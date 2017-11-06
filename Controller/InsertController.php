<?php namespace Controller;
use DAOS\BeerDAO as BeerDAO;
use Model\Beer as Beer;

class InsertController {

  public function Index() {
    require_once 'Views/insert.php';
  }

  public function Insert($name, $description, $price, $ibu, $srm, $graduation, $image) {
    $BeerDAO = BeerDAO::getInstance();
    $beer = new Beer($name, $description, $price, $ibu, $srm, $graduation, $image);
    $BeerDAO->Insert($beer);
    #require_once 'menu principal';
  }
} ?>
