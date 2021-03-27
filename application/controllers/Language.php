<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
	}

	public function change($lang = '')
	{
		if (!empty($lang) && in_array($lang, ['english', 'indonesian'])) {
			// $this->session->set_userdata('site_lang', $lang);
			sitelang($lang);
		}

		hasReferrer() == true ? redirect(Referrer(), 'refresh') : redirect(base_url(), 'refresh');

		// redirect($_SERVER['HTTP_REFERER']);
	}
}
