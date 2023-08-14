<?php
namespace Eos\Backstory_generator\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Send_Email {

	public function send_concept_changes_email() {
		$mail = new PHPMailer();

		$mail->isSMTP();
		$mail->Host     = 'email-smtp.eu-west-1.amazonaws.com';
		$mail->SMTPAuth = true;
		$mail->Username = '';
		$mail->Password = '';
		$mail->Port     = 25;

		$mail->setFrom( 'spelleider@eosfrontier.space', 'Frontier SL-team' );
		$mail->Subject = 'Concept changes requested';
		$mail->Body    = 'test email';

		$mail->addAddress( 'rolfsiebers@gmail.com' );

		$mail->send();
	}
}
