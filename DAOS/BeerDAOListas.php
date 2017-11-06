<?php namespace DAOS;
use Model\Beer as Beer;
use DAOS\IDAO as IDAO;

	class BeerDAOListas extends SingletonDAO implements IDAO
	{
		private $beers;

		public function __construct()
		{
			 $this->beers= array();
		}

		public function Insert($beers)
		{
			$this->beers=$_SESSION['beers'];
			$bandera=null;
			$error=$this->beers;
			array_push($this->beers, $beers);
			$this->Sessionar();
			if($error==$this->beers)
			{
				$bandera=1;
			}
			return $bandera;
		}

		public function SelectByID ($id)
		{
			$this->beers=$_SESSION['beers'];
			foreach ($this->beers as $beertypes) {
				if($beertypes->getId()==$id)
				{
					return $beertypes;
					break;
				}
			}
		}

		public function Select(Beer $beers)
		{
			foreach ($_SESSION['beers'] as $value) {
				if($beertypes->getName()==$beers->getName())
				{
					return $beertypes;
					break;
				}
			}
		}

		public function Delete($beername)
		{
			$this->beers=$_SESSION['beers'];
			$bandera=null;
			$error=$this->beers;
			$i=0;
			foreach ($this->beers as $beertypes) {
				if($beertypes->getName()==$beername)
				{
					unset($this->beers[$i]);
				}
				$i++;
			}
			if($error==$this->beers)
			{
				$bandera=1;	
			}
			$this->Sessionar();
			return $bandera;
		}

		public function DeleteById($id)
		{
			$this->beers=$_SESSION['beers'];
			$i=0;
			foreach ($this->beers as $beertypes) {
				if($beertypes->getId()==$id)
				{
					unset($this->beers[$i]);
					return 1;
				}
				$i++;
			}

		}

		public function SelectAll()
		{
			$this->beers=$_SESSION['beers'];
			return $this->beers;
		}

		public function Update($beers)
		{
			$this->beers=$_SESSION['beers'];
			$bandera=null;
			$error=$this->beers;
			$i=0;
			foreach ($this->beers as $beertypes) {
				if($beertypes==$beers)
				{
					$this->beers[$i]->setDescription($beers->getDescription());
					$this->beers[$i]->setPrice($beers->getPrice());
					$this->beers[$i]->setImage($beers->getImage());
					$this->beers[$i]->setIBU($beers->getIBU());
					$this->beers[$i]->setSRM($beers->getSRM());
					$this->beers[$i]->setGraduation($beers->getGraduation());
				}
				$i++;
			}
			if($error==$this->beers)
			{
				$bandera=1;	
			}
			return $bandera;
		}

		public function Sessionar()
		{
			$_SESSION['beers']=$this->beers;
		}

	}
?>