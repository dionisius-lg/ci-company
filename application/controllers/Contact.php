<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// set timezone
		date_default_timezone_set('Asia/Jakarta');

		// set referrer
		setReferrer(current_url());

		// site languange
		sitelang();
		$this->config->set_item('language', sitelang());

		// set layout template
		$this->template->set_template('layouts/front');

		// load default models
		$this->load->model('CompanyModel');

		// load default data
		$this->result['company'] = [];
		if ($this->CompanyModel->getDetail()['status'] == 'success') {
			$this->result['company'] = $this->CompanyModel->getDetail()['data'];
		}
	}

	public function index()
	{
		$session	= $this->session->userdata('AuthUser');

		$this->template->title = $this->pageTitle(sitelang());
		$this->template->content->view('templates/front/contact', $this->result);
		$this->template->publish();
	}

	// page title in multi language
	private function pageTitle($lang) {
		switch ($lang) {
			case 'english':
				return 'Contact Us';
				break;
			case 'indonesian':
				return 'Hubungi Kami';
				break;
			case 'korean':
				return '문의하기';
				break;
			case 'japanese':
				return 'お問い合わせ';
				break;
			case 'mandarin':
				return '联系我们';
				break;
		}
	}
}
