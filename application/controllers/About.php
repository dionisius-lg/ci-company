<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		setReferrer(current_url());

		sitelang();
		$this->config->set_item('language', sitelang());
		$this->lang->load('content', sitelang());

		$this->template->set_template('layouts/front');

		$this->load->model('CompanyModel');
	}

	public function index()
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [];

		$this->load->model('SlidersModel');
		$this->load->model('CompanyAdvantagesModel');

		$request = [
			'company' => $this->CompanyModel->getDetail(),
			'advantages' => $this->CompanyAdvantagesModel->getAll(['limit' => 12]),
		];

		foreach ($request as $key => $val) {
			$result[$key] = [];

			if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
				if ($request[$key]['status'] == 'success') {
					$result[$key] = $val['data'];
				}
			}
		}

		if (sitelang() == 'english') {
			$this->template->title = 'About Us';
		} else {
			$this->template->title = 'Tentang Kami';
		}

		$this->template->content->view('templates/front/about', $result);
		$this->template->publish();
	}
}
