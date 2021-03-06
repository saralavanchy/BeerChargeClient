<?php namespace Controller;

use DAOS\SubsidiaryDAO as SubsidiaryDAO;
use Model\Subsidiary as Subsidiary;
use Controller\GestionController as GestionController;

/**
* 
*/
class SeleccionarSucursalController extends GestionController
{
	private $subsidiaryDAO;
	
	function __construct()
	{
		$this->subsidiaryDAO = SubsidiaryDAO::getInstance();
    	parent::__construct();
	}

	public function Index() {
		require_once 'Views/ElegirSucursal.php';
	}

	public function select ($lat = 0.0, $lon = 0.0, $id_subsidiary = null, $address = null, $phone = null) {
		
		if(isset($address)){
			$subsidiary = new Subsidiary($address, $phone, $lat, $lon);
		}
		$list = $this->subsidiaryDAO->SelectAll();
    	require_once 'Views/ElegirSucursal.php';
	}
}