<?php
namespace Eos\Backstory_generator\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Send_Email
{

	public function send_email_to_player($email, $subject, $text)
	{
		try {
			$mail = new PHPMailer();

			$mail->isSMTP();
			$mail->Host = $_ENV['email_host'];
			$mail->SMTPAuth = true;
			$mail->Username = $_ENV['email_user'];
			$mail->Password = $_ENV['email_pass'];
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port = 587;
			$mail->isHTML(true);

			$mail->setFrom('spelleider@eosfrontier.space', 'Eos: Frontier SLs');
			$mail->Subject = $subject;
			$mail->Body = $text;

			$mail->addAddress($email);

			$mail->send();
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}

	public function send_email_from_player($email, $subject, $text, $faction)
	{
		try {
			$recipient = $faction . '_sl@eosfrontier.space';
			$mail = new PHPMailer();

			$mail->isSMTP();
			$mail->Host = $_ENV['email_host'];
			$mail->SMTPAuth = true;
			$mail->Username = $_ENV['email_user'];
			$mail->Password = $_ENV['email_pass'];
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port = 587;
			$mail->isHTML(true);

			$mail->setFrom("spelleider@eosfrontier.space", $email);
			$mail->addReplyTo($email);
			$mail->Subject = $subject;
			$mail->Body = $text;

			$mail->addAddress($recipient);

			$mail->send();
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
}