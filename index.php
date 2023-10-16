<?php
require './includes/include.php';

$id = $logged_in_char->characterID;

use Eos\Backstory_generator\Character\Character;
use Eos\Backstory_generator\Status\Status;
use Eos\Backstory_generator\Text\Text;
use Eos\Backstory_generator\Api\Get;
use Eos\Backstory_generator\Email\Send_Email;


$text = new Text();
$character = new Character();
$status = new Status();
$mail = new Send_Email();
$api = new Get();

if (isset($_POST['concept-content'])) {
	$content['content'] = htmlspecialchars($_POST['concept-content']);
	echo '<pre>';
	var_dump($content);
	echo '</pre>';
	$text->save_concept($id, $content);
}

if (isset($_POST['backstory-content'])) {
	$content['content'] = htmlspecialchars($_POST['backstory-content']);
	$text->save_backstory($id, $content);

}

if (isset($_POST['status']) && isset($_POST['type'])) {
	$saved = $status->update_status($id, $_POST['status'], $_POST['type']);
	$email = $api->get_user_email($id);
	$char_name = $character->get_character_name($id);
	$char_faction = $character->get_character_faction($id);
	if ($_POST['status'] == "awaiting_review") {
		if ($_POST['type'] == "concept") {
			$subject = 'Character Concept submitted: ' . $char_name . '. Please review.';
			$body = "Dear SL Team,
			<br /><br />
			A character concept for new character <strong>" . $char_name . "</strong> has been submitted.. <br />
			Please proceed to <a href='https://www.eosfrontier.space/eos_backstory/admin'>the backstory editor</a> to review their proposed concept.
			<br />
			Kind regards,
			<br />
			The Backstory System<br />
			Eos: Frontier";
		}
		if ($_POST['type'] == "backstory") {
			$subject = 'Character Backstory submitted: ' . $char_name . '. Please review.';
			$body = "Dear SL Team,
			<br /><br />
			A character backstory for new character <strong>" . $char_name . "</strong> has been submitted.. <br />
			Please proceed to <a href='https://www.eosfrontier.space/eos_backstory/admin'>the backstory editor</a> to review their proposed backstory.
			<br />
			Kind regards,
			<br />
			The Backstory System<br />
			Eos: Frontier";
		}
		$mail->send_email_from_player($email, $subject, $body, $char_faction);
	}
	header('Refresh:0');
}

$backstory = $text->get_backstory($id);
$concept = $text->get_concept($id);
?>
<!DOCTYPE html>
<html>

<head>
	<title>Concept/Backstory editor -
		<?php echo $character->get_character_name($id); ?>
	</title>
	<link rel="stylesheet" href="./assets/css/style.css" />
	<script src="./vendor/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
	<header>
		<div class="logo cell">
			<img class="responsive" src="assets/img/outpost-icc-pm.png" alt="logo" title="ICC logo" />
			<a href="/eoschargen/index.php?viewChar=<?php echo $id; ?>"> <button type="button" class="button"
					name="button"><strong>Return to Chargen</strong></button></a>
		</div>
	</header>
	<main>
		<h2>
			<?php echo $character->get_character_name($id); ?>
		</h2>
		<?php
		if ($concept !== 'None found.' && $concept->status_name !== 'requested') {
			require './partials/concept.php';

			if ($concept->status_name === 'approved') {
				require './partials/backstory.php';
			}
		} else {
			require './partials/new_concept.php';
		}
		?>
	</main>
	<footer>
	</footer>
	<script src="./assets/js/include.js"></script>
	<?php require_once './footer.php'; ?>

</html>