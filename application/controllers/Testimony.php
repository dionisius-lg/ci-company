<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimony extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// set timezone
		date_default_timezone_set('Asia/Jakarta');

		// set site languange
		$this->config->set_item('language', siteLang()['name']);

		// set template layout
		$this->template->set_template('layouts/front');

		// load default models
		$this->load->model('CompanyModel');
		$this->load->model('TestimoniesModel');

		// load default data
		$this->result['company'] = [];
		if ($this->CompanyModel->get()['status'] == 'success') {
			$this->result['company'] = $this->CompanyModel->get()['data'];
		}
	}

	public function index()
	{
		$session = $this->session->userdata('AuthUser');
		$params		= $this->input->get();
		$clause		= [];
		$total		= 0;

		$clause = [
			'limit' => 5,
			'page' => (array_key_exists('page', $params) && is_numeric($params['page'])) ? $params['page'] : 1,
			'order' => 'create_date',
			'sort' => 'desc'
		];

		$request = [
			'testimonies' => $this->TestimoniesModel->getAll($clause),
		];

		foreach ($request as $key => $val) {
			$this->result[$key] = [];

			if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
				if ($request[$key]['status'] == 'success') {
					$this->result[$key] = $val['data'];

					if ($key == 'testimonies') {
						$total = $val['total_data'];
					}
				}
			}
		}

		$this->result['pagination'] = bs4pagination('testimony', $total, $clause['limit'], $params);
		$this->template->content->view('templates/front/Testimony/index', $this->result);
		$this->template->publish();
	}
}
