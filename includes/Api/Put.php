<?php
namespace Eos\Backstory_generator\Api;

class Put
{

	public $token;

	public $apilocation;

	public function __construct()
	{
		$this->token = $_ENV['token'];
		$this->apilocation = $_ENV['api_location'];
	}

	private function get($headers, $location, $content = '')
	{
		$curl = curl_init();

		if (empty($content)) {
			curl_setopt_array(
				$curl,
				[
					CURLOPT_URL => $this->apilocation . $location,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'PUT',
					CURLOPT_HTTPHEADER => $headers,
				]
			);
		}

		if (!empty($content)) {
			curl_setopt_array(
				$curl,
				[
					CURLOPT_URL => $this->apilocation . $location,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'PUT',
					CURLOPT_HTTPHEADER => $headers,
					CURLOPT_POSTFIELDS => json_encode($content),
				]
			);
		}

		$response = curl_exec($curl);
		curl_close($curl);

		return $response;
	}

	public function update_backstory($id, $content, $user)
	{

		$headers = [
			'type: backstory',
			"user: $user",
			"token: $this->token",
			"char_id: $id",
		];

		$location = 'v2/chars_player/backstory/';

		$response = $this->get($headers, $location, $content);

		return $response;
	}

	public function update_concept($id, $content, $user)
	{
		$headers = [
			'type: concept',
			"user: $user",
			"token: $this->token",
			"char_id: $id",
		];

		$location = 'v2/chars_player/backstory/';

		$response = $this->get($headers, $location, $content);

		return $response;
	}

	public function update_concept_changes($id, $content, $user)
	{

		$headers = [
			'type: concept_changes',
			"user: $user",
			"token: $this->token",
			"char_id: $id",
		];

		$location = 'v2/chars_player/backstory/';

		$response = $this->get($headers, $location, $content);

		return $response;
	}

	public function update_concept_comment($id, $content)
	{

		$headers = [
			'type: concept_comment',
			"token: $this->token",
			"char_id: $id",
		];

		$location = 'v2/chars_player/backstory/';

		$response = $this->get($headers, $location, $content);

		return $response;
	}

	public function update_backstory_changes($id, $content, $user)
	{

		$headers = [
			'type: backstory_changes',
			"user: $user",
			"token: $this->token",
			"char_id: $id",
		];

		$location = 'v2/chars_player/backstory/';

		$response = $this->get($headers, $location, $content);

		return $response;
	}

	public function update_status($id, $status, $type, $user)
	{

		$headers = [
			"char_id: $id",
			"type: $type",
			"user: $user",
			"status: $status",
			"token: $this->token",
		];

		$location = 'v2/chars_player/backstory/statuses/';

		$response = $this->get($headers, $location);

		return $response;
	}
}
