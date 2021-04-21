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
		sitelang($lang);

		($_SERVER['HTTP_REFERER']) ? redirect($_SERVER['HTTP_REFERER'], 'refresh') : redirect(base_url(), 'refresh');
	}
}
