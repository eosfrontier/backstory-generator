<?php
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
	$content['content'] = str_replace("'", "&#39;", $_POST['concept_changes']);

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