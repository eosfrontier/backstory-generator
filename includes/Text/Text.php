<?php

namespace Eos\Backstory_generator\Text;

use Eos\Backstory_generator\Api\Get;
use Eos\Backstory_generator\Api\Put;

class Text {

	public $get;

	public $put;

	public function __construct() {
		 $this->get = new Get();
		$this->put  = new Put();
	}

	public function get_backstory( $id ) {
		$backstory = json_decode( $this->get->get_user_backstory( $id ) );

		return $backstory;
	}

	public function get_all_backstory() {
		$backstory = json_decode( $this->get->get_user_backstory( 'all' ) );

		return $backstory;
	}

	public function save_backstory( $id, $content, $user ) {
		return $this->put->update_backstory( $id, $content, $user );
	}

	public function save_concept( $id, $content, $user ) {
		return $this->put->update_concept( $id, $content, $user );
	}

	public function save_backstory_changes( $id, $content, $user ) {
		return $this->put->update_backstory_changes( $id, $content, $user );
	}

	public function save_concept_changes( $id, $content, $user ) {
		return $this->put->update_concept_changes( $id, $content, $user );
	}

	public function get_concept( $id ) {
		$concept = json_decode( $this->get->get_user_concept( $id ) );

		return $concept;
	}

	public function get_all_concept() {
		 $concept = json_decode( $this->get->get_user_concept( 'all' ) );

		return $concept;
	}
}
