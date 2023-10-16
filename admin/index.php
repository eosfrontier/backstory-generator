<?php
require getcwd() . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

require_once '../includes/SSO.php';
if (!in_array("32", $jgroups, true) && !in_array("30", $jgroups, true)) {
	die("Sorry, you don't have access here. Naughty person.");
}

use Eos\Backstory_generator\Character\Character;
use Eos\Backstory_generator\Text\Text;
use Eos\Backstory_generator\Status\Status;
use Eos\Backstory_generator\Api\Get;
use Eos\Backstory_generator\Email\Send_Email;

$character = new Character();
$text = new Text();
$status = new Status();
$api = new Get();

if (isset($_POST['backstory_changes'])) {
	$content['content'] = str_replace("'", "&#39;", $_POST['backstory_changes']);

	$return = $text->save_backstory_changes($_POST['id'], $content);
	$saved = $status->update_status($_POST['id'], $_POST['status'], 'backstory');
	$email = $api->get_user_email($_POST['id']);

	if ($email) {
		$mail = new Send_Email();
		$subject = 'Backstory changes requested';
		$body = "Dear player,
		<br /><br />
		The SL team have requested a change in your character backstory. <br />
		Please proceed to <a href='https://www.eosfrontier.space/eos_backstory/'>the backstory editor</a> to see the changes we've requested.
		<br />
		<br />
		Kind regards,
		<br />
		The Spelleider Team<br />
        Eos: Frontier";
		$mail->send_email_to_player($email, $subject, $body);
	}

	unset($_POST);
}

if (isset($_POST['type']) && isset($_POST['status']) && ($_POST['status'] == 'approved')) {
	$email = $api->get_user_email($_POST['id']);
	$saved = $status->update_status($_POST['id'], $_POST['status'], $_POST['type']);
	$mail = new Send_Email();
	if ($_POST['type'] == 'concept') {
		$subject = 'Character Concept approved - please submit backstory.';
		$body = "Dear player,
		<br /><br />
		The SL team have approved your character concept. <br />
		Please proceed to <a href='https://www.eosfrontier.space/eos_backstory/'>the backstory editor</a> to submit your full character backstory.
		<br />
		Kind regards,
		<br />
		The Spelleider Team<br />
        Eos: Frontier";
	}
	if ($_POST['type'] == 'backstory') {
		$email = $api->get_user_email($_POST['id']);
		$mail = new Send_Email();
		$subject = 'Character Backstory approved.';
		$body = "Dear player,
		<br /><br />
		The SL team have approved your character backstory. You're all set! <br />
		We look forward to welcoming your new character to Eos!		<br />
		<br />
		<br />
		Kind regards,
		<br />
		The Spelleider Team<br />
        Eos: Frontier";
	}
	$mail->send_email_to_player($email, $subject, $body);
	unset($_POST);
}

if (isset($_POST['concept_changes'])) {
	$content['content'] = $_POST['concept_changes'];

	$return = $text->save_concept_changes($_POST['id'], $content);
	$saved = $status->update_status($_POST['id'], $_POST['status'], 'concept');
	$email = $api->get_user_email($_POST['id']);

	if ($email) {
		$mail = new Send_Email();
		$subject = 'Character Concept changes requested.';
		$body = "Dear player,
		<br /><br />
		The SL team have requested a change in your character concept. <br />
		Please proceed to <a href='https://www.eosfrontier.space/eos_backstory/'>the backstory editor</a> to see the changes we've requested.
		<br />
		<br />
		Kind regards,
		<br />
		The Spelleider Team<br />
        Eos: Frontier";
		$mail->send_email_to_player($email, $subject, $body);
	}

	unset($_POST);
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
		<div class="logo cell">
			<img class="responsive" src="../assets/img/outpost-icc-pm.png" alt="logo" title="ICC logo" />
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