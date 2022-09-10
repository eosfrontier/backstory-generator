<?php
namespace Eos\Backstory_generator\Text;

use Eos\Backstory_generator\Api\Get;

class Text {

	public $api;

	public function __construct() {
		$this->api = new Get();
	}

	public function get_backstory( $id ) {
		$backstory = json_decode( $this->api->get_user_backstory( $id ) );

		return $backstory;
	}
}
