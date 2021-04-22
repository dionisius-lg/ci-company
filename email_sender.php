<?php

// load script gue
require __DIR__ . '/application/libraries/phpscript/config.php';
require __DIR__ . '/application/libraries/phpscript/database.php';
require __DIR__ . '/application/libraries/phpscript/function.php';

//load phpmailer
require __DIR__ . '/application/libraries/phpmailer/src/Exception.php';
require __DIR__ . '/application/libraries/phpmailer/src/PHPMailer.php';
require __DIR__ . '/application/libraries/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$status = @$_SERVER['argv'][1];

//get mailer config
$mailer = dbget('mailer_config');

if (!count($mailer) > 0) {
	exit();
}

$config['email_server'] = $mailer[0];

// get email on queue
$condition = [
	'DATE(create_date) = \''.date('Y-m-d').'\'',
	'email_status_id = '.$config['email_status']['queued'],
	'direction_id = 2'
];

$emails = dbget('emails', [], $condition);

if (count($emails) > 0) {
	foreach ($emails as $email) {
		$mail = new PHPMailer(true);

		try {
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
			$mail->Host       = $config['email_server']['host'];
			$mail->SMTPAuth   = true;
			$mail->SMTPSecure = $config['email_server']['encryption'];
			$mail->Port       = $config['email_server']['port'];
			$mail->SMTPDebug  = 3;
			$mail->Username   = $config['email_server']['username'];
			$mail->Password   = $config['email_server']['password'];

			//$mail->Sender     = $config['email_server']['username'];
			//$mail->From       = (!empty($email['email_from']) ? $email['email_from'] : $config['email_server']['username']);
			//$mail->FromName   = (!empty($email['email_from']) ? $email['email_from'] : $config['email_server']['username']);

			// Set from
			$mail->setFrom($config['email_server']['username']);
			// Email subject & body
			$mail->Subject    = $email['subject'];
			$mail->Body       = $email['content_html'];

			$mail->clearAllRecipients();

			// Add recipient
			if ($email['email_to']) {
				$recipient_num = substr_count($email['email_to'], ';');
				$recipient = explode(';', $email['email_to']);

				for ($i=0; $i<=$recipient_num; $i++) {
					if (!empty($recipient[$i])) {
						$email_to = str_replace(' ', '', $recipient[$i]);

						if (filter_var($email_to, FILTER_VALIDATE_EMAIL)) {
							$mail->addAddress($recipient[$i]);
						}
					}
				}
			}

			// Add CC
			if ($email['email_cc']) {
				$cc_num = substr_count($email['email_cc'], ';');
				$cc = explode(';', $email['email_cc']);
				
				for ($i=0; $i<=$cc_num; $i++) {
					$email_cc = str_replace(' ', '', $cc[$i]);

					if (filter_var($email_cc, FILTER_VALIDATE_EMAIL)) {
						$mail->addCC($cc[$i]);
					}
				}
			}

			// add BCC
			if ($email['email_bcc']) {
				$bcc_num = substr_count($email['email_bcc'], ';');
				$bcc = explode(';', $email['email_bcc']);
				
				for ($i=0; $i<=$bcc_num; $i++) {
					$email_bcc = str_replace(' ', '', $bcc[$i]);

					if (filter_var($email_bcc, FILTER_VALIDATE_EMAIL)) {
						$mail->addBCC($bcc[$i]);
					}
				}
			}

			echo "\nMail debug :".$mail->SMTPDebug;
			echo "\nMail Host :".$mail->Host;
			echo "\nMail SMTP Auth :".$mail->SMTPAuth;
			echo "\nMail SMTPSecure :".$mail->SMTPSecure;
			echo "\nMail SMTPPort :".$mail->Port;
			echo "\nMail Username :".$mail->Username;
			echo "\nMail Password :".$mail->Password;
			echo "\nMail Sender :".$mail->Sender;
			echo "\nMail From :".$mail->From;
			echo "\nMail FromName :".$mail->FromName;
			echo "\nMail Subject :".$mail->Subject;
			echo "\nMail Body :".$mail->Body;
			echo PHP_EOL;

			// update email status to process
			$condition = [
				'id' => $email['id']
			];

			$data = [
				'email_status_id' => $config['email_status']['process']
			];

			$process = dbupdate('emails', $condition, $data);

			if ($process) {
				$mail->send();

				// update email status to sent
				$condition = [
					'id' => $email['id']
				];

				$data = [
					'email_status_id' => $config['email_status']['sent'],
					'email_from'      => $config['email_server']['username'],
					'email_date'      => date('Y-m-d H:i:s')
				];

				$sent = dbupdate('emails', $condition, $data);
				
				if (!$sent) {
					createLog($config['log']['dir'] . $config['log']['error'], basename($_SERVER['SCRIPT_FILENAME']) . ' - Email successfully sent || Error to update status to SENT. Email ID: ' . $email['id']);
				}

				echo 'update email ' . $status . ' id: ' . $email['id'];
				echo PHP_EOL;
			} else {
				createLog($config['log']['dir'] . $config['log']['error'], basename($_SERVER['SCRIPT_FILENAME']) . ' - Failed to update status to PROCESS || Email not SEND. Email ID: ' . $email['id']);
			}

			$mail->clearAddresses();
			$mail->clearAttachments();
		} catch (Exception $e) {
			// update email status to error
			$condition = [
				'id' => $email['id']
			];

			$data = [
				'email_status_id' => $config['email_status']['error'],
				'mail_error_info' => $mail->ErrorInfo
				//'mail_error_info' => $e->errorMessage()
			];

			$error = dbupdate('emails', $condition, $data);

			if (!$error) {
				createLog($config['log']['dir'] . $config['log']['error'], basename($_SERVER['SCRIPT_FILENAME']) . $mail->ErrorInfo . ' - || Error to update status to: ' . $config['email_status']['error'] . 'Email ID: ' . $email['id']);
			} else {
				createLog($config['log']['dir'] . $config['log']['error'], basename($_SERVER['SCRIPT_FILENAME']) . $mail->ErrorInfo);
			}

			echo 'Message could not be sent.';
			echo PHP_EOL;
			echo 'Mailer Error: ' . $mail->ErrorInfo;
			echo PHP_EOL;
		}
	}
}