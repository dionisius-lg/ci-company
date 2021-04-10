<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Worker extends CI_Controller {

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
		$this->load->model('WorkersModel');
		$this->load->model('ProvincesModel');
		$this->load->model('UserLevelsModel');

		// load default data
		$this->result['company'] = [];
		if ($this->CompanyModel->get()['status'] == 'success') {
			$this->result['company'] = $this->CompanyModel->get()['data'];
		}
	}

	public function index()
	{
		$session = $this->session->userdata('AuthUser');

		$request = [
			'workers' => $this->WorkersModel->getAll(['limit' => 10]),
			'provinces' => $this->ProvincesModel->getAll(['limit' => 100]),
			'user_levels' => $this->UserLevelsModel->getAll()
		];

		foreach ($request as $key => $val) {
			$this->result[$key] = [];

			if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
				if ($request[$key]['status'] == 'success') {
					$this->result[$key] = $val['data'];
				}
			}
		}

		$this->template->title = $this->pageTitle(sitelang());
		$this->template->content->view('templates/front/Worker/index', $this->result);
		$this->template->publish();
	}

	public function detail($id)
	{
		$session = $this->session->userdata('AuthUser');

		$request = [
			'worker' => $this->WorkersModel->getDetail($id), 
			'workers' => $this->WorkersModel->getAll(['limit' => 10]),
			'provinces' => $this->ProvincesModel->getAll(['limit' => 100]),
			'user_levels' => $this->UserLevelsModel->getAll()
		];

		foreach ($request as $key => $val) {
			$this->result[$key] = [];

			if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
				if ($request[$key]['status'] == 'success') {
					$this->result[$key] = $val['data'];
				}
			}
		}

		$this->template->title = $this->pageTitle(sitelang());
		$this->template->content->view('templates/front/Worker/detail', $this->result);
		$this->template->publish();
	}

	// page title in multi language
	private function pageTitle($lang) {
		switch ($lang) {
			case 'english':
				return 'Worker';
				break;
			case 'indonesian':
				return 'Pekerja';
				break;
			case 'korean':
				return '직원';
				break;
			case 'japanese':
				return '従業員';
				break;
			case 'mandarin':
				return '雇员';
				break;
		}
	}
}
