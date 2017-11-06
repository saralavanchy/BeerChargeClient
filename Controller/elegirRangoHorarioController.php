<?php namespace Controller;

use DAOS\TimeRangeDAO as TimeRangeDAO;
use Model\TimeRange as TimeRange;

class elegirRangoHorarioController {

	private $timerangeDAO;

	public function __construct()
	{
		$timerangeDAO=TimeRangeDAO::getInstance();
	}

	public function Index() {
		if (isset($_SESSION['order'])) {
			$order=$_SESSION['order'];
		}
		isset($this->timerangeDAO) ? $horarios=$this->timerangeDAO : $horarios=null;
		require_once 'Views/elegirRangoHorario.php';
	}

}

?>