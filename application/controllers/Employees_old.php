<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

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
		$this->load->model('EmployeesModel');
		$this->load->model('ProvincesModel');
		$this->load->model('UserLevelsModel');

		// load default data
		$this->result['company'] = [];
		if ($this->CompanyModel->getDetail()['status'] == 'success') {
			$this->result['company'] = $this->CompanyModel->getDetail()['data'];
		}
	}

	public function index()
	{
		$session	= $this->session->userdata('AuthUser');

		$request = [
			'employees' => $this->EmployeesModel->getAll(['limit' => 10]),
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
		$this->template->content->view('templates/front/employees', $this->result);
		$this->template->publish();
	}

	public function detail($id)
	{
		$session = $this->session->userdata('AuthUser');

		$request = [
			'employees' => $this->EmployeesModel->getAll(['limit' => 10]),
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
		$this->template->content->view('templates/front/employees_detail', $this->result);
		$this->template->publish();
	}

	// page title in multi language
	private function pageTitle($lang) {
		switch ($lang) {
			case 'english':
				return 'Employees';
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
