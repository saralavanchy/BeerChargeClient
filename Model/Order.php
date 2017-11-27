<?php namespace Model;

use Model\OrderLine as OrderLine;

class Order {
	private $order_number;
	private $order_date;
	private $state;
	private $client;
	private $subsidiary;
	private $send;
	private $lineas = array();

	public function __construct($order_date, $state, $client, $subsidiary, $send = null) {
		$this->setOrderDate($order_date);
		$this->setState($state);
		$this->setClient($client);
		$this->setSubsidiary($subsidiary);
		$this->setSend($send);
	}

	public function getOrderNumber() {
		return $this->order_number;
	}

	public function setOrderNumber($value) {
		$this->order_number = $value;
	}

	public function getOrderDate() {
		return $this->order_date;
	}

	public function setOrderDate($value) {
		if ($value != null) {
			$this->order_date = $value;
		} else {
			$this->order_date = date("Y-m-d");
		}
	}

	public function getState() {
		return $this->state;
	}

	public function setState($value) {
		$this->state = $value;
	}

	public function getClient() {
		return $this->client;
	}

	public function setClient($value) {
		$this->client = $value;
	}

	public function getSubsidiary() {
		return $this->subsidiary;
	}

	public function setSubsidiary($value) {
		$this->subsidiary = $value;
	}

	public function getSend() {
		return $this->send;
	}

	public function setSend($value) {
		$this->send = $value;
	}

	public function getTotal() {
		$total = 0;
		foreach ($this->lineas as $value) {
			$total += round(($value->getPackaging()->getFactor() * ( $value->getPackaging()->getCapacity() * $value->getBeer()->getPrice()) * $value->getAmount()), 2);
		}
		return $total;
	}

	public function getOrderLines() {
		return $this->lineas;
	}

	public function AddOrderLine($orderLine) {
		array_push($this->lineas, $orderLine);
	}

	public function NewOrderLine($beer, $packaging, $amount) {
		$price = round($packaging->getFactor() * ( $packaging->getCapacity() * $beer->getPrice()), 2);
		$orderLine = new OrderLine($amount, $price, $beer, $packaging);
		$this->AddOrderLine($orderLine);
	}

	public function DeleteOrderLine($index) {
		if ($index >= 0 && $index <= sizeof($this->lineas)) {
			unset($this->lineas[$index]);
			$this->lineas = array_values($this->lineas);
		}
	}
} ?>
