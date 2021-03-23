<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function switch($lang = '')
	{
		if !empty($lang) {
			$this->session->set_userdata('site_lang', $lang);
		}

		redirect($_SERVER['HTTP_REFERER']);
	}
}
