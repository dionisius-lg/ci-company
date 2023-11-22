<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Composer autoload
require FCPATH.'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (!function_exists('mailOutbound')) {
    function mailOutbound($recipient = null, $subject = null, $body = null) {
        if (empty($recipient) || empty($subject) || empty($body)) {
            return false;
        }

        $ci = &get_instance();
        $ci->load->model('MailerModel');

        $request = $ci->MailerModel->get();

        if ($request['status'] != 'success') {
            return false;
        }

        $conf = $request['data'];
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->isHTML(true);

            $mail->Host         = $conf['host'];
            $mail->Port         = $conf['port'];
            $mail->Username     = $conf['username'];
            $mail->Password     = $conf['password'];
            $mail->From         = !empty($conf['alias']) ? $conf['alias'] : $conf['username'];
            $mail->SMTPSecure   = $conf['encryption'];
            // $mail->SMTPSecure   = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPDebug    = SMTP::DEBUG_SERVER;
            $mail->SMTPAuth     = true;
            $mail->SMTPOptions  = [
                'ssl' => [
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                    'allow_self_signed' => true
                ]
            ];

            if (isset($_SERVER['CI_NAME']) && !empty($_SERVER['CI_NAME'])) {
                $mail->FromName = $_SERVER['CI_NAME'];
            }

            $mail->Subject      = $subject;
            $mail->Body         = $body;

            $mail->addAddress($recipient);
            $mail->addReplyTo(!empty($conf['alias']) ? $conf['alias'] : $conf['username']);

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name

            $mail->send();

            echo 'Message has been sent.';

            $response = true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

            return false;
        }
    }
}
