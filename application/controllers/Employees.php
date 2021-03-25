<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		
		$this->template->set_template('layouts/front');

		if (!$this->session->has_userdata('site_lang')) {
			$this->session->set_userdata('site_lang', 'english');
		}

		$this->load->model('EmployeesModel');
		$this->load->model('ProvincesModel');
		$this->load->model('UserLevelsModel');
	}

	public function index()
	{
		$request = [
			'employees' => $this->EmployeesModel->getAll(['limit' => 10]),
			'provinces' => $this->ProvincesModel->getAll(['limit' => 100]),
			'user_levels' => $this->UserLevelsModel->getAll()
		];

		foreach ($request as $key => $val) {
			$result[$key] = [];

			if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
				if ($request[$key]['status'] == 'success') {
					$result[$key] = $val['data'];
				}
			}
		}
		
		$this->template->title = 'Employees';
		$this->template->content->view('templates/front/employees', $result);
		$this->template->publish();
	}
}
