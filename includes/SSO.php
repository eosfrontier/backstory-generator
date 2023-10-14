<?php
require 'joomla.php';
$curl = curl_init();

curl_setopt_array(
	$curl,
	[
		CURLOPT_URL => 'https://api.eosfrontier.space/orthanc/v2/chars_player/',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => [
			'accountID:' . $jid,
			'token: am9zaHNwbGF5Z3JvdW5k',
		],
	]
);

$response = curl_exec($curl);

curl_close($curl);

$logged_in_char = json_decode($response);