<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuickSearch extends CI_Controller {

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
		$this->load->model('SlidersModel');
		$this->load->model('ExperiencesModel');
		$this->load->model('PlacementsModel');
		$this->load->model('WorkersModel');
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
		$params		= $this->input->get();
		$clause		= [];
		$total		= 0;
		
		$clause = [
			'limit' => 10,
			'page' => (array_key_exists('page', $params) && is_numeric($params['page'])) ? $params['page'] : 1,
			'like_nik' => array_key_exists('nik', $params) ? $params['nik'] : '',
			'placement_id' => array_key_exists('placement', $params) ? $params['placement'] : '',
			'inset_ready_placement_ids'	=> array_key_exists('ready_placement', $params) ? $params['ready_placement'] : '',
			'sort' => 'asc'
		];

		$request = [
			'workers' => $this->WorkersModel->getAll($clause),
			'placements' => $this->PlacementsModel->getAll(['order' => 'name']),
			'user_levels' => $this->UserLevelsModel->getAll(['order' => 'name']),
			'experiences' => $this->ExperiencesModel->getAll(['limit' => 2, 'order' => 'name', 'sort' => 'asc']),
			'placements' => $this->PlacementsModel->getAll(['limit' => 10, 'order' => 'name', 'sort' => 'asc']),
		];

		foreach ($request as $key => $val) {
			$this->result[$key] = [];

			if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
				if ($request[$key]['status'] == 'success') {
					$this->result[$key] = $val['data'];

					if ($key == 'workers') {
						$total = $val['total_data'];
					}
				}
			}
		}

		$this->result['pagination'] = bs4pagination('admin/workers', $total, $clause['limit']);
		$this->result['no'] = (($clause['page'] * $clause['limit']) - $clause['limit']) + 1;

		$this->template->content->view('templates/front/Home/quick_search', $this->result);
		$this->template->publish();
	}
}
