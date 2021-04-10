<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->load->model('SlidersModel');
		$this->load->model('AgencyCountriesModel');
		$this->load->model('WorkExperiencesModel');

		// load default data
		$this->result['company'] = [];
		if ($this->CompanyModel->getDetail()['status'] == 'success') {
			$this->result['company'] = $this->CompanyModel->getDetail()['data'];
		}
	}

	public function index()
	{
		$session = $this->session->userdata('AuthUser');

		$request = [
			'sliders' => $this->SlidersModel->getAll(['limit' => 10, 'order' => 'order_number', 'sort' => 'asc']),
			'agency_countries' => $this->AgencyCountriesModel->getAll(),
			'work_experiences' => $this->WorkExperiencesModel->getAll(['limit' => 2, 'order' => 'name', 'sort' => 'asc', 'like' => '%C%'])
		];

		foreach ($request as $key => $val) {
			$this->result[$key] = [];

			if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
				if ($request[$key]['status'] == 'success') {
					$this->result[$key] = $val['data'];
				}
			}
		}

		$this->template->content->view('templates/front/home', $this->result);
		$this->template->publish();
	}
}
