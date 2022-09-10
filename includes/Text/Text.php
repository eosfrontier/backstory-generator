<?php
namespace Eos\Backstory_generator\Text;

use Eos\Backstory_generator\Api\Get;
use Eos\Backstory_generator\Api\Put;

class Text {

	public $get;

	public $put;

	public function __construct() {
		$this->get = new Get();
		$this->put = new Put();
	}

	public function get_backstory( $id ) {
		$backstory = json_decode( $this->get->get_user_backstory( $id ) );

		return $backstory;
	}

	public function save_backstory( $id, $content ) {
		return $this->put->update_backstory( $id, $content );
	}

	public function save_concept( $id, $content ) {
		return $this->put->update_concept( $id, $content );
	}

	public function get_concept( $id ) {
		$concept = json_decode( $this->get->get_user_concept( $id ) );

		return $concept;
	}
}
