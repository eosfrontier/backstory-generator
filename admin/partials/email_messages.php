<?php
use Eos\Backstory_generator\Email\Send_Email;
use Eos\Backstory_generator\Api\Put;
$apiPut = new Put();

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
    //Reminder that concept is approved, backstory is not started
    if ($_POST['type'] == 'concept_approved_remind') {
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
			$status->update_status($_POST['id'], $_POST['status'], 'backstory', $jid);
		}
        //Concept approved by SL - Notify player to work on their backstory 
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
			$apiPut->set_reminder_time($_POST['id']);
		} 
		elseif ($_POST['type'] == 'changes_requested') {
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

// Remind concept or backstory stuck in editing status

if (isset($_POST['type']) && isset($_POST['status']) && ($_POST['status'] == 'being_edited')) {
	$email = $api->get_user_email($_POST['id']);
    //Reminder that concept is approved, backstory is not started
    if ($_POST['type'] == 'concept_not_submitted_remind') {
		$mail = new Send_Email();
		$subject = 'REMINDER: Character Concept not yet submitted.';
		$body = "Dear player,
		<br /><br />
		The SL team would like to remind you that your Character Concept has been in the 'Being edited' status for an extended period of time. <br />
		Please proceed to <a href='https://www.eosfrontier.space/eos_backstory/'>the backstory editor</a> to finish editing your concept and/or submit it to the SLs for approval.
		<br /><br />
		Kind regards,
		<br />
		The Spelleider Team<br />
		Eos: Frontier";
		$mail->send_email_to_player($email, $subject, $body);
		$apiPut->set_reminder_time($_POST['id']);
	} 
    elseif ($_POST['type'] == 'backstory_not_submitted_remind') {
        $mail = new Send_Email();
		$subject = 'REMINDER: Backstory not yet submitted.';
		$body = "Dear player,
		<br /><br />
		The SL team would like to remind you that your Backstory has been in the 'Being edited' status for an extended period of time. <br />
		Please proceed to <a href='https://www.eosfrontier.space/eos_backstory/'>the backstory editor</a> to finish editing your backstory and/or submit it to the SLs for approval.
		<br /><br />
		Kind regards,
		<br />
		The Spelleider Team<br />
		Eos: Frontier";
		$mail->send_email_to_player($email, $subject, $body);
		$apiPut->set_reminder_time($_POST['id']);
    }
}

if (isset($_POST['type']) && isset($_POST['status']) && ($_POST['status'] == 'requested')) {
    if ($_POST['type'] == 'concept_not_started_remind') {
        $mail = new Send_Email();
        $subject = 'REMINDER: Concept not yet submitted.';
        $body = "Dear player,
        <br /><br />
        The SL team would like to remind you that we still need a Character Concept submitted. <br />
        Please proceed to <a href='https://www.eosfrontier.space/eos_backstory/'>the backstory editor</a> to submit your Character Concept for approval.
        <br /><br />
        Kind regards,
        <br />
        The Spelleider Team<br />
        Eos: Frontier";
        $mail->send_email_to_player($email, $subject, $body);
		$apiPut->set_reminder_time($_POST['id']);
    }
}