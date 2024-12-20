<?php
require getcwd() . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

if (isset($_POST['tab'])) {
	$tab = $_POST['tab'];
} elseif (isset($_GET['tab'])) {
	$tab = $_GET['tab'];
} else {
	$tab = 'concept';
}

if (isset($_GET['current_event'])) {
	$current_event = $_GET['current_event'];
} elseif (isset($_POST['current_event'])) {
	$current_event = $_POST['current_event'];
} else {
	$current_event = '';
}

require_once '../includes/SSO.php';

if ($jid === 0) {
	header('Status: 303 Moved Temporarily', false, 303);
	header('location: https://www.eosfrontier.space/return-to-backstory-admin');
} elseif (!in_array('32', $jgroups, true) && !in_array('30', $jgroups, true)) {
	header('Status: 303 Moved Temporarily', false, 303);
	header('Location: ../');
}
if (in_array('30', $jgroups, true)) {
	$IS_SL = true;
} else {
	$IS_SL = false;
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

if ($current_event == 'Yes') {
	$current_event_characters = $api->get_characters_upcoming_event();
}

function hasId( $arr, $id ) {
	foreach ($arr as $value) {
		if ($value['characterID'] == $id) {
			return true;
		}
	}
	return false;
}
//
// messaging section
//

// Request Backstory Changes
if (isset($_POST['backstory_changes'])) {

	$email = $api->get_user_email($_POST['id']);

	if ($email) {
		$mail = new Send_Email();
		if ($_POST['type'] == 'backstory_changes_remind') {
			$subject = 'REMINDER: Backstory changes requested';
			$body = "Dear player,
		<br /><br />
		This is a reminder that the SL team have requested a change in your character backstory. <br />
		Please proceed to <a href='https://www.eosfrontier.space/eos_backstory/'>the backstory editor</a> to see the changes we've requested.
		<br />
		<br />
		Kind regards,
		<br />
		The Spelleider Team<br />
		Eos: Frontier";
		} 
			else {
				$content['content'] = str_replace("'", '&#39;', $_POST['backstory_changes']);
				$return = $text->save_backstory_changes($_POST['id'], $content, $jid);
				$saved = $status->update_status($_POST['id'], $_POST['status'], 'backstory', $jid);
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
			}
		$mail->send_email_to_player($email, $subject, $body);

	}

	unset($_POST['backstory_changes']);
	unset($_POST['content']);
	header('Location: ./?tab=' . $tab . '&current_event=' . $current_event);
}

if (isset($_POST['type']) && isset($_POST['status']) && ($_POST['status'] == 'approved')) {
	$email = $api->get_user_email($_POST['id']);
	if ($_POST['type'] == 'concept_remind') {
		$mail = new Send_Email();
		$subject = 'REMINDER: Character Concept approved - please submit backstory.';
		$body = "Dear player,
		<br /><br />
		This is a reminder that the SL team have approved your character concept. <br />
		Please proceed to <a href='https://www.eosfrontier.space/eos_backstory/'>the backstory editor</a> to submit your full character backstory.
		<br /><br />
		Kind regards,
		<br />
		The Spelleider Team<br />
		Eos: Frontier";
		$mail->send_email_to_player($email, $subject, $body);
	} 
	else {
		if (isset($_POST['backstory-content']) && $_POST['type'] == 'backstory') {
			$id = $_POST['id'];
			$content['content'] = str_replace("'", '&#39;', $_POST['backstory-content']);
			$text->save_backstory($id, $content, $jid);
		}

		if (isset($_POST['method']) && $_POST['method'] == 'sl_backend') {
			$status->update_status($_POST['id'], $_POST['status'], 'concept', $jid);
		} 
		else {
			$mail = new Send_Email();
			if ($_POST['type'] == 'concept') {
				$subject = 'Character Concept approved - please submit backstory.';
				if (isset($_POST['concept_comment'])) {
					$content['content'] = str_replace("'", '&#39;', $_POST['concept_comment']);
					$return = $text->save_concept_comment($_POST['id'], $content);
					$comment = $content['content'];
					$body = "Dear player,	
						<br /><br />
						The SL team have approved your character concept. <br />
						Please proceed to <a href='https://www.eosfrontier.space/eos_backstory/'>the backstory editor</a> to submit your full character backstory.
						<br />
						The SL team have included the following comment: " . $content['content'] . "
						<br />
						Kind regards,
						<br />
						The Spelleider Team<br />
						Eos: Frontier";
				} 
				else {
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
			}
			if ($_POST['type'] == 'backstory') {
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
			$saved = $status->update_status($_POST['id'], $_POST['status'], $_POST['type'], $jid);
		}
	}
	unset($_POST);
	header('Location: ./?tab=' . $tab . '&current_event=' . $current_event);
}

// Request concept changes
if (isset($_POST['concept_changes'])) {
	$email = $api->get_user_email($_POST['id']);
	if ($email) {
		$mail = new Send_Email();
		if ($_POST['type'] == 'concept_changes_remind') {
			$saved = $status->update_status($_POST['id'], $_POST['status'], 'concept', $jid);
			$subject = 'REMINDER: Character Concept changes requested.';
			$body = "Dear player,
			<br /><br />
			This is a reminder that the SL team have requested a change in your character concept. <br />
			Please proceed to <a href='https://www.eosfrontier.space/eos_backstory/'>the backstory editor</a> to see the changes we've requested.
			<br />
			<br />
			Kind regards,
			<br />
			The Spelleider Team<br />
			Eos: Frontier";
			$mail->send_email_to_player($email, $subject, $body);
		} 
		else {
			$content['content'] = str_replace("'", '&#39;', $_POST['concept_changes']);
			$return = $text->save_concept_changes($_POST['id'], $content, $jid);
			$saved = $status->update_status($_POST['id'], $_POST['status'], 'concept', $jid);
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
	}

	unset($_POST['concept_changes']);
	unset($content);
	header('Location: ./?tab=' . $tab . '&current_event=' . $current_event);
}

//
// End messaging section
//


?>
<!DOCTYPE html>
<html>

<head>
	<title>Admin - Concept/Backstory editor </title>
	<link rel="stylesheet" href="../assets/css/style.css" />
	<!-- Import jQuery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="../node_modules/jquery/dist/jquery-3.3.1.min.js"><\/script>')</script>

	<!-- Import Trumbowyg -->
	<script src="../node_modules/trumbowyg/dist/trumbowyg.min.js"></script>

	<!-- Import Trumbowyg plugins... -->
	<script src="../node_modules/trumbowyg/dist/plugins/cleanpaste/trumbowyg.cleanpaste.min.js"></script>
	<script src="../node_modules/trumbowyg/dist/plugins/colors/trumbowyg.colors.min.js"></script>
	<script src="../node_modules/trumbowyg/dist/plugins/pasteimage/trumbowyg.pasteimage.min.js"></script>

	<!-- <script src="../vendor/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script> -->

	<script>
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}
	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body onload="switchFactionBlurb('*');">
	<header>
		<div class="header">
			<img class="logo" src="../assets/img/outpost-icc-pm.png" alt="logo" title="ICC logo" /><br>
			<div class="slider-section">
				<form method="get">
					<label class="switch" onchange="this.form.submit()">
						<input type="checkbox" name="current_event" value="Yes" <?php
						if ($current_event == 'Yes') {
							echo 'checked';
						}
						?>>
						<span class="slider round"></span>
						<input type="hidden" name="tab" value="<?php echo $tab; ?>" />
					</label>
					<div class="filter-display">
						<?php
						if (isset($_GET['current_event']) && $_GET['current_event'] == 'Yes') {
							echo 'This Event Only';
						} else {
							echo 'All active characters';
						}
						?>
					</div>
				</form>
			</div>
		</div>
		<h1>
			Admin - Concept/Backstory editor
		</h1>
		<p> Welcome,
			<?php echo $jname; ?>!
		</p>

		<div class="formitem center-xs factionblurb fct_selector" style="display: none">
			Filter by faction:</br>
			<select name="factionselect" id="chooseFactionSelect" onchange="switchFactionBlurb(this.value);">
				<option selected value="*">All Factions</option>
				<?php
				$factions = array('aquila', 'dugo', 'ekanesh', 'pendzal', 'sona');
				foreach ($factions as $faction) {
					echo '<option value="' . $faction . '">' . ucfirst($faction) . '</option>';
				}
				?>
			</select>
		</div>

	</header>
	<main>
		<div class="tabs-overview">
			<div class="tab-list">
				<button data-tab="concept" <?php
				if ($tab === 'concept') {
					echo 'class="active"';
				}
				?>
					onclick="window.location.href='?tab=concept&current_event=' . $current_event; ?>';">
					Concept
				</button>
				<button data-tab="backstory" <?php
				if ($tab === 'backstory') {
					echo 'class="active"';
				}
				?>
					onclick="window.location.href='?tab=backstory&current_event=' . $current_event; ?>';">
					Backstory
				</button>
				<button data-tab="completed" <?php
				if ($tab === 'completed') {
					echo 'class="active"';
				}
				?>
					onclick="window.location.href='?tab=completed&current_event=' . $current_event; ?>';">
					Completed
				</button>
				<button data-tab="submit_existing" <?php
				if ($tab === 'submit_existing') {
					echo 'class="active"';
				}
				?>
					onclick="window.location.href='?tab=submit_existing&current_event=' . $current_event; ?>';">
					Submit Existing Backstory
				</button>
			</div>
			<div class="tabs">
				<div data-tab="concept" class="tab
			<?php
			if ($tab === 'concept') {
				echo ' active';
			}
			?>
			">
					<h2>Concept</h2>
					<?php require './partials/concepts.php'; ?>
				</div>
				<div data-tab="backstory" class="tab
			<?php
			if ($tab === 'backstory') {
				echo ' active';
			}
			?>
			">
					<h2>Backstory</h2>
					<?php require './partials/backstory.php'; ?>
				</div>
				<div data-tab="completed" class="tab
			<?php
			if ($tab === 'completed') {
				echo ' active';
			}
			?>
			">
					<h2>Completed</h2>
					<?php require './partials/completed.php'; ?>
				</div>
				<div data-tab="submit_existing" class="tab
			<?php
			if ($tab === 'submit_existing') {
				echo ' active';
			}
			?>
			">
					<h2>Submit Existing Backstory</h2>
					<?php require './partials/submit_existing.php'; ?>
				</div>
			</div>
		</div>
	</main>
	<footer>
	</footer>
	<script src="../assets/js/admin.js"></script>
</body>

</html>
