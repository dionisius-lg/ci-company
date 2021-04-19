<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APPPATH.'libraries/phpmailer/src/Exception.php';
require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
require APPPATH.'libraries/phpmailer/src/SMTP.php';

if (!function_exists('sendMail')) {
	function sendMail($subject = '', $body = '', $data = []) {
		if (empty($subject) || empty($content) || empty($data) || !is_array($data)) {
            return $response;
        }

        $ci = &get_instance();
        $ci->load->model('MailerConfigModel');

        // PHPMailer object
		$response = false;
		$request  = $ci->MailerConfigModel->get();

        if ($request['status'] != 'success') {
			return $response;
		}

        $config = $request['data'];
		$mail   = new PHPMailer(true);

        // Server settings
		$mail->SMTPOptions = [
			'ssl' => [
				'verify_peer'       => false,
				'verify_peer_name'  => false,
				'allow_self_signed' => true
			]
		];

		// SMTP configuration
		$mail->isSMTP();
		$mail->isHTML(true);
		$mail->Host       = $config['host'];
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = $config['encryption'];
		$mail->Port       = $config['port'];
		// $mail->SMTPDebug  = 3;
		$mail->Username   = $config['username'];
		$mail->Password   = $config['password'];

		$mail->setFrom($config['username']);
		$mail->addReplyTo($config['username']);

		// Add a recipient
		$mail->addAddress($data['email']);
		// $mail->addAddress('gatotbeling288@yahoo.co.id');

		// Email subject
		$mail->Subject = $subject;
		// $mail->Subject = 'Test Mail Sender';

		// Email body content
		$mail->Body = $body;
		// $mailContent = "<h1>SMTP Mailer</h1><p>Test mail sender</p>";
		// $mail->Body = $mailContent;

		// Send email
		// if (!$mail->send()) {
		// 	echo 'Message could not be sent.';
		// 	echo 'Mailer Error: ' . $mail->ErrorInfo;
		// } else {
		// 	echo 'Message has been sent';
		// }

		if ($mail->send()) {
			$response = true;
		}

		return $response;
	}
}
