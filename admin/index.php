<?php
require getcwd() . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable( __DIR__ . '/..' );
$dotenv->load();

require_once '../includes/SSO.php';

var_dump( $jgroups );

use Eos\Backstory_generator\Character\Character;
use Eos\Backstory_generator\Text\Text;
use Eos\Backstory_generator\Status\Status;
use Eos\Backstory_generator\Api\Get;
use Eos\Backstory_generator\Email\Send_Email;

$character = new Character();
$text      = new Text();
$status    = new Status();
$api       = new Get();

if ( isset( $_POST['backstory_changes'] ) ) {
	$content['content'] = $_POST['backstory_changes'];

	$return = $text->save_backstory_changes( $_POST['id'], $content );
	$saved  = $status->update_status( $_POST['id'], $_POST['status'], 'backstory' );
	$email  = $api->get_user_email( $_POST['id'] );

	if ( $email ) {
		$mail = new Send_Email();

		$mail->send_concept_changes_email( $email, 'Backstory changes requested', "Dear player,<br /><br />The SL's requested a change in your character backstory. Login into the website and go the the backstory editor to see the changes we've requested.<br /><br />With kind regards,<br />The SL-team" );
	}

	unset( $_POST );
}

if ( isset( $_POST['concept_changes'] ) ) {
	$content['content'] = $_POST['concept_changes'];

	$return = $text->save_concept_changes( $_POST['id'], $content );
	// $saved  = $status->update_status( $_POST['id'], $_POST['status'], 'concept' );
	$email = $api->get_user_email( $_POST['id'] );

	if ( $email ) {
		$mail = new Send_Email();

		$mail->send_concept_changes_email( $email, 'Concept changes requested', "Dear player,<br /><br />The SL's requested a change in your character Concept. Login into the website and go the the backstory editor to see the changes we've requested.<br /><br />With kind regards,<br />The SL-team" );
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
			<button data-tab="completed">Completed</button>
		</div>
		<div class="tabs">
			<div data-tab="concept" class="tab active">
				<h2>Concept</h2>
				<?php require './partials/concepts.php'; ?>
			</div>
			<div data-tab="backstory" class="tab">
				<h2>Backstory</h2>
				<?php require './partials/backstory.php'; ?>
			</div>
			<div data-tab="completed" class="tab">
				<h2>Completed</h2>
				<?php require './partials/completed.php'; ?>
			</div>
		</div>
	</div>
</main>
<footer>
</footer>
<script src="../assets/js/admin.js"></script>
</body>
</html>
