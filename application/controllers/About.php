<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// set timezone
		date_default_timezone_set('Asia/Jakarta');

		// set referrer
		setReferrer(current_url());

		// set site languange
		sitelang();
		$this->config->set_item('language', sitelang());

		// set template layout
		$this->template->set_template('layouts/front');

		// load default models
		$this->load->model('CompanyModel');

		// load default data
		$this->result['company'] = [];
		if ($this->CompanyModel->get()['status'] == 'success') {
			$this->result['company'] = $this->CompanyModel->get()['data'];
		}
	}

	/**
	 *  index method
	 *  index page
	 */
	public function index()
	{
		$session = $this->session->userdata('AuthUser');

		$this->template->title = $this->_callbackPageTitle(sitelang());
		$this->template->content->view('templates/front/About/index', $this->result);
		$this->template->publish();
	}

	/**
	 *  _callbackPageTitle method
	 *  return title for login & register in multi lang
	 */
	private function _callbackPageTitle($lang) {
		switch ($lang) {
			case 'english':
				return 'About Us';
				break;
			case 'indonesian':
				return 'Tentang Kami';
				break;
			case 'korean':
				return '우리에 대해';
				break;
			case 'japanese':
				return '私たちに関しては';
				break;
			case 'mandarin':
				return '关于我们';
				break;
		}
	}
}
