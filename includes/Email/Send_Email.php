<?php
namespace Eos\Backstory_generator\Email;

use PHPMailer\PHPMailer\PHPMailer;

class Send_Email {

	public function send_concept_changes_email() {

		$mail = new PHPMailer();

		$mail->isSMTP();
		$mail->Host       = $_ENV['email_host'];
		$mail->SMTPAuth   = true;
		$mail->Username   = $_ENV['email_user'];
		$mail->Password   = $_ENV['email_pass'];
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port       = 587;

		$mail->setFrom( 'spelleider@eosfrontier.space', 'Frontier SL-team' );
		$mail->Subject = 'Concept changes requested';
		$mail->Body    = 'test email';

		$mail->addAddress();

		$mail->send();
	}
}
