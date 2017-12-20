<?php namespace Controller;

use DAOS\OrderDAO as OrderDAO;
use DAOS\ClientDAO as ClientDAO;
use PDOException;

class consultarEstadoController extends GestionController {
	private $oderDAO;
	private $clientDAO;

	public function __construct()	{
		$this->OrderDAO=OrderDAO::getInstance();
		$this->clientDAO=ClientDAO::getInstance();
	}
	public function Index(){
		if(isset($_SESSION['date'])){
			$fechas=explode(" fecha ", $_SESSION['date']);
			$from=strtotime($fechas[0]);
			$to=strtotime($fechas[1]);
			$orderList=$this->consultar($fechas[0],$fechas[1]);
		}
		require_once 'Views/Lobby.php';
		require_once 'Views/consultarEstado.php';
	}

	public function consultar($from, $to){
		$_SESSION['date']=$from." fecha ".$to;
		if(isset($from)&&isset($to)) {
			$tomorrow=date(('Y-m-d'), strtotime('+1 day'));
			strtotime($tomorrow);
			strtotime($from);
			strtotime($to);
			if($to>$from){
				if( ($from >= $tomorrow)){
					$msj='No puede consultar fechas que aun no han ocurrido';
					require_once 'Views/Lobby.php';
					require_once 'Views/consultarEstado.php';

				} else{
				try {
					$client=$this->clientDAO->SelectByAccount($_SESSION['account']);
					if(isset($client))
					{
						$dni=$client->getDNI();
						$orderList=$this->OrderDAO->SelectByClientDNIBetweenDates($dni, $from, $to);
						if($orderList==null)
						{
							$msj='no existen ordenes cargadas';
						}
						require_once 'Views/Lobby.php';
						require_once 'Views/consultarEstado.php';
						#header('location: /'.BASE_URL.'Lobby/consultarEstado');
					}
					else
					{
						$msj='Primero debe completar el registro con sus datos primero';
						require_once 'Views/Register.php';
					}

				}
				catch(\PDOException $e ){
					echo "Error! ".$e->getMessage();
				}

		} } else{
			$msj='La fecha "desde" no puede ser mayor a la fecha "hasta"';
			require_once 'Views/Lobby.php';
			require_once 'Views/consultarEstado.php';

		}}else{
			$msj='debe ingresar al menos un rango de fechas';
			require_once 'Views/consultarEstado.php';
		}
	}

	public function verDetalle($order)
	{
		try{
				$order=$this->OrderDAO->SelectByID($order);
				require_once 'Views/Lobby.php';
				require_once 'Views/detalle.php';
		}
		catch(\PDOException $e ){
				echo "Error! ".$e->getMessage();
			}

	}
	public function finalizarConsulta()
	{
		unset($_SESSION['date']);
		header('location: /'.BASE_URL.'Lobby');
	} 
}

?>
