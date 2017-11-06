<?php namespace Model;
use Model\OrderLine as OrderLine;

class Order {
	private $order_number;
	private $order_date;
	private $state;
	private $client;
	private $subsidiary;
	private $orderLines;
	private $total;

	public function __construct($order_date, $state, $client, $subsidiary = null) {
		$this->setOrderDate($order_date);
		$this->setState($state);
		$this->setClient($client);
		$this->setSubsidiary($subsidiary);
		$this->orderLines= array();
	}

	public function getTotal()
	{
		return $this->total;
	}

	public function getOrderNumber() {
		return $this->order_number;
	}

	public function getOrderDate() {
		return $this->order_date;
	}

	public function getState() {
		return $this->state;
	}

	public function getClient() {
		return $this->client;
	}

	public function getSubsidiary() {
		return $this->subsidiary;
	}

	public function getOrderLines()
	{
		return $this->orderLines;
	}

	public function setTotal($total)
	{
		$this->total=$total;
	}

	public function setSubsidiary($value) {
		$this->subsidiary = $value;
	}

	public function setOrderNumber($value) {
		$this->order_number = $value;
	}

	public function setOrderDate($value) {
		$this->order_date = $value;
	}

	public function setState($value) {
		$this->state = $value;
	}

	public function setClient($value) {
		$this->client = $value;
	}

	public function newLine(OrderLine $line)
	{
		array_push($this->orderLines, $line);
	}

	public function deleteLine(OrderLine $line)
	{
		$i=0;
		foreach ($this->orderLines as $lines) {
			if($lines == $line)
			{
				unset($this->orderLines[$i]);
			}
			$i++;
		}
	}


} ?>


