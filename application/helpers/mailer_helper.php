<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Composer autoload
require FCPATH.'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

        try {
            // Server settings
            $mail->SMTPDebug   = SMTP::DEBUG_SERVER;
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                    'allow_self_signed' => true
                ]
            ];
            $mail->isSMTP();
            $mail->Host         = $config['host'];
            $mail->SMTPAuth     = true;
            $mail->Username     = $config['username'];
            $mail->Password     = $config['password'];
            $mail->SMTPSecure   = PHPMailer::ENCRYPTION_STARTTLS;
            // $mail->SMTPSecure   = $config['encryption'];
            $mail->Port         = $config['port'];

            // Recipients
            $mail->setFrom($config['username']);
            $mail->addAddress($data['email']);
            $mail->addReplyTo($config['username']);

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz'); //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); //Optional name

            // Content
            $mail->isHTML(true);
            $mail->Subject      = $subject;
            $mail->Body         = $body;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            // Send mail
            $mail->send();

            echo 'Message has been sent.';

            $response = true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        return $response;
    }
}
