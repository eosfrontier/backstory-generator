<?php
namespace Eos\Backstory_generator\Api;

class Get {

	public $token;

	public $apilocation;

	public function __construct() {
		$this->token       = $_ENV['token'];
		$this->apilocation = $_ENV['api_location'];
	}

	public function get( $headers, $location ) {
		$curl = curl_init();

		curl_setopt_array(
			$curl,
			[
				CURLOPT_URL            => $this->apilocation . $location,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING       => '',
				CURLOPT_MAXREDIRS      => 10,
				CURLOPT_TIMEOUT        => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST  => 'GET',
				CURLOPT_HTTPHEADER     => $headers,
			]
		);

		$response = curl_exec( $curl );

		curl_close( $curl );

		return $response;
	}

	public function get_user_backstory( $id ) {
		$headers = [
			'type: backstory',
			"token: $this->token",
			"char_id: $id",
		];

		$location = 'v2/chars_player/backstory/';

		$response = $this->get( $headers, $location );

		return $response;
	}

	public function get_character( $id ) {
		$headers = [
			"token: $this->token",
			"char_id: $id",
		];

		$location = 'v2/chars_player/';

		$response = $this->get( $headers, $location );

		return $response;
	}
}
