<?php
namespace Eos\Backstory_generator\Status;

use Eos\Backstory_generator\Api\Get;
use Eos\Backstory_generator\Api\Put;

class Status
{

	public $get;

	public $put;

	public function __construct()
	{
		$this->get = new Get();
		$this->put = new Put();
	}

	public function get_all_status()
	{
		return $this->get->get_all_status();
	}

	public function update_status($id, $status, $type, $user)
	{
		return $this->put->update_status($id, $status, $type, $user);
	}
}