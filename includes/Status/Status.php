<?php
namespace Eos\Backstory_generator\Status;

use Eos\Backstory_generator\Api\Get;

class Status {

	public $api;

	public function __construct() {
		$this->api = new Get();
	}

	public function get_all_status() {
		return $this->api->get_all_status();
	}
}
