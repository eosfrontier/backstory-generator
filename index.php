<?php
require './includes/include.php';
require_once './includes/SSO.php';

if ( $jid === 0 ) {
	header( 'location: https://eosfrontier.space/return-to-backstory-system' );
}

$id = $logged_in_char->characterID;

use Eos\Backstory_generator\Character\Character;
use Eos\Backstory_generator\Status\Status;
use Eos\Backstory_generator\Text\Text;
use Eos\Backstory_generator\Api\Get;
use Eos\Backstory_generator\Email\Send_Email;


$text      = new Text();
$character = new Character();
$status    = new Status();
$mail      = new Send_Email();
$api       = new Get();

if ( isset( $_POST['concept-content'] ) ) {
	$content['content'] = str_replace( "'", '&#39;', $_POST['concept-content'] );
	$text->save_concept( $id, $content, $jid );
}

if ( isset( $_POST['backstory-content'] ) ) {
	$content['content'] = str_replace( "'", '&#39;', $_POST['backstory-content'] );
	$text->save_backstory( $id, $content, $jid );

}

if ( isset( $_POST['status'] ) && isset( $_POST['type'] ) ) {
	$saved        = $status->update_status( $id, $_POST['status'], $_POST['type'], $jid );
	$email        = $api->get_user_email( $id );
	$char_name    = $character->get_character_name( $id );
	$char_faction = $character->get_character_faction( $id );
	if ( $_POST['status'] == 'awaiting_review' ) {
		if ( $_POST['type'] == 'concept' ) {
			$subject = 'Character Concept submitted: ' . $char_name . '. Please review.';
			$body    = 'Dear SL Team,
			<br /><br />
			A character concept for new character <strong>' . $char_name . "</strong> has been submitted.. <br />
			Please proceed to <a href='https://www.eosfrontier.space/eos_backstory/admin'>the backstory editor</a> to review their proposed concept.
			<br />
			Kind regards,
			<br />
			The Backstory System<br />
			Eos: Frontier";
		}
		if ( $_POST['type'] == 'backstory' ) {
			$subject = 'Character Backstory submitted: ' . $char_name . '. Please review.';
			$body    = 'Dear SL Team,
			<br /><br />
			A character backstory for new character <strong>' . $char_name . "</strong> has been submitted.. <br />
			Please proceed to <a href='https://www.eosfrontier.space/eos_backstory/admin'>the backstory editor</a> to review their proposed backstory.
			<br />
			Kind regards,
			<br />
			The Backstory System<br />
			Eos: Frontier";
		}
		$mail->send_email_from_player( $email, $subject, $body, $char_faction );
	}
	header( 'Refresh:0' );
}

$backstory = $text->get_backstory( $id );
$concept   = $text->get_concept( $id );
?>
<!DOCTYPE html>
<html>

<head>
	<title>Concept/Backstory editor -
		<?php echo $character->get_character_name( $id ); ?>
	</title>
	<link rel="stylesheet" href="./assets/css/style.css" />

	<!-- Import jQuery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="node_modules/jquery/dist/jquery-3.3.1.min.js"><\/script>')</script>

	<!-- Import Trumbowyg -->
	<script src="node_modules/trumbowyg/dist/trumbowyg.min.js"></script>

	<!-- Import Trumbowyg plugins... -->
	<script src="node_modules/trumbowyg/dist/plugins/cleanpaste/trumbowyg.cleanpaste.min.js"></script>
	<script src="node_modules/trumbowyg/dist/plugins/pasteimage/trumbowyg.pasteimage.min.js"></script>

	<!-- <script src="./vendor/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script> -->
</head>

<body>
	<header>
		<div class="header">
			<img class="logo" src="assets/img/outpost-icc-pm.png" alt="logo" title="ICC logo" />
			<a href="/eoschargen/index.php?viewChar=<?php echo $id; ?>"> <button type="button" class="button"
					name="button"><strong>Return to Chargen</strong></button></a>
			<?php
			if ( in_array( '32', $jgroups, true ) || in_array( '30', $jgroups, true ) ) {
				echo '<a href="./admin"> <button type="button" class="button"
				name="button"><strong>Admin Portal</strong></button></a>';
			}
			?>
		</div>
	</header>
	<main>
		<?php
		if ( $concept !== 'None found.' && $concept->status_name !== 'requested' ) {
			require './partials/concept.php';

			if ( $concept->status_name === 'approved' ) {
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
