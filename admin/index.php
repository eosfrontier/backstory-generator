<?php
require getcwd() . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable( __DIR__ . '/..' );
$dotenv->load();

use Eos\Backstory_generator\Character\Character;
use Eos\Backstory_generator\Text\Text;
use Eos\Backstory_generator\Status\Status;
use Eos\Backstory_generator\Api\Get;
use Eos\Backstory_generator\Email\Send_Email;

$character = new Character();
$text      = new Text();
$status    = new Status();
$api       = new Get();

if ( isset( $_POST['concept_changes'] ) ) {
	$content['content'] = $_POST['concept_changes'];

	$return = $text->save_concept_changes( $_POST['id'], $content );
	//$saved  = $status->update_status( $_POST['id'], $_POST['status'], 'concept' );
	$email = $api->get_user_email( $_POST['id'] );

	if ( $email ) {
		$mail = new Send_Email();

		$mail->send_concept_changes_email();

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";

		// Additional headers
		$headers .= 'From: Eos Frontier SL-team<spelleider@eosfrontier.space' . "\r\n";
		$headers .= 'Reply-To: spelleider@eosfrontier.space' . "\r\n";

		mail( $email, 'Concept changes requestd', "Dear player,<br /><br />The SL's requested a change in your character concept. Login into the website and go the the backstory editor to see the changes we've requested.<br /><br />With kind regards,<br />The SL-team", $headers );
	}

	unset( $_POST );
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Admin - Concept/Backstory editor</title>
<link rel="stylesheet" href="../assets/css/style.css" />
<script src="../vendor/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
<header>
	<h1>
		Admin - Concept/Backstory editor
	</h1>
</header>
<main>
	<div class="tabs-overview">
		<div class="tab-list">
			<button data-tab="concept" class="active">Concept</button>
			<button data-tab="backstory">Backstory</button>
		</div>
		<div class="tabs">
			<div data-tab="concept" class="tab active">
				<h2>Concept</h2>
				<?php require './partials/concepts.php'; ?>
			</div>
			<div data-tab="backstory" class="tab">
				<h2>Backstory</h2>
			</div>
		</div>
	</div>
</main>
<footer>
</footer>
<script src="../assets/js/admin.js"></script>
</body>
</html>
