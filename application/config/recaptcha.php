<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// To use reCAPTCHA, you need to sign up for an API key pair for your site.
// link: http://www.google.com/recaptcha/admin
// local
$config['recaptcha_site_key'] = '6LcIFdAUAAAAAHgPR_eR2I71CRDCQV02oqrFTVj1';
$config['recaptcha_secret_key'] = '6LcIFdAUAAAAAD56yRcJx0jcek3n6L6fRdPOn6bv';
// ptarj.com
// $config['recaptcha_site_key'] = '6Ler15waAAAAANQxZ3CKPO3a0TYX8cKEhK48iuED';
// $config['recaptcha_secret_key'] = '6Ler15waAAAAABHmjABgjaArMtxCzcyN5lE0aRhO';

// reCAPTCHA supported 40+ languages listed here:
// https://developers.google.com/recaptcha/docs/language
$config['recaptcha_lang'] = 'en';

/* End of file recaptcha.php */
/* Location: ./application/config/recaptcha.php */
