<?php
namespace Eos\Backstory_generator\Character;

use Eos\Backstory_generator\Api\Get;

class Character
{

	public $api;

	public function __construct()
	{
		$this->api = new Get();
	}

	public function get_character_name($id)
	{
		$character = json_decode($this->api->get_character($id));

		return $character->character_name;
	}
}