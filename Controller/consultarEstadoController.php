<?php namespace Controller;

use DAOS\OrderDAO as OrderDAO; 

class consultarEstadoController 
{
	private $oderDAO;

	public function __construct()
	{
		$this->OrderDAO=OrderDAO::getInstance();
	}

	public function Index()
	{
		require_once 'Views/consultarEstado.php';
	}

	public function consultar()
	{
		if(isset($_POST['desde'])&&($_POST['hasta']))
		{
			foreach ($this->OrderDAO as $orders) {
				/*if(){}aca se usará el metodo buscarporFecha y creará una variable if que se pasará a la view*/
				$orders=$this->OrderDAO;
				require_once 'Views/consultarEstado.php';
			}

		}
		else
		{
			$msj='debe ingresar al menos un rango de fechas';
			require_once 'Views/consultarEstado.php';
		}
	}

	public function verDetalle()
	{

	}
}

?>