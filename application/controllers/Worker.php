<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Worker extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// set timezone
		date_default_timezone_set('Asia/Jakarta');

		// set site languange
		sitelang();
		$this->config->set_item('language', sitelang());

		// set template layout
		$this->template->set_template('layouts/front');

		// load default models
		$this->load->model('CompanyModel');
		$this->load->model('WorkersModel');
		$this->load->model('WorkerAttachmentsModel');
		$this->load->model('ExperiencesModel');
		$this->load->model('AgencyLocationsModel');
		$this->load->model('ProvincesModel');
		$this->load->model('UserLevelsModel');

		// load default data
		$this->result['company'] = [];
		if ($this->CompanyModel->get()['status'] == 'success') {
			$this->result['company'] = $this->CompanyModel->get()['data'];
		}

		// load socket helper
		$this->load->helper('socket');
	}

	/**
	 *  index method
	 *  index page
	 */
	public function index()
	{
		$session	= $this->session->userdata('AuthUser');
		$params		= $this->input->get();
		$clause		= [];
		$total		= 0;

		$clause = [
			'limit'				=> 6,
			'page'				=> (array_key_exists('page', $params) && is_numeric($params['page'])) ? $params['page'] : 1,
			'like_nik'			=> array_key_exists('nik', $params) ? $params['nik'] : '',
			'like_fullname'		=> array_key_exists('fullname', $params) ? $params['fullname'] : '',
			'gender_id'			=> array_key_exists('gender', $params) ? $params['gender'] : '',
			'marital_status_id'	=> array_key_exists('marital_status', $params) ? $params['marital_status'] : '',
			'age'				=> array_key_exists('age', $params) ? $params['age'] : '',
			'order'				=> 'fullname',
			'sort'				=> 'asc'
		];

		if ($session) {
			// user level agency
			if ($session['user_level_id'] == 3) {
				$clause['inset_ready_placement_ids'] = $session['agency_location_id'];
			}
		}

		if (!$session) {
			if ((($clause['page'] * $clause['limit']) - $clause['limit']) >= $clause['limit']) {
				setFlashError($this->lang->line('error')['auth'], 'worker');
				redirect($_SERVER['HTTP_REFERER']);
			}

			$clause['page'] = 1;
		}

		$clause = array_map('strClean', $clause);

		if (array_key_exists('experience', $params)) {
			if (!empty($params['experience'])) {
				$experience = explode('-', $params['experience']);
				sort($experience);
				$clause['inset_experience_ids'] = $experience;
			}
		}

		if (array_key_exists('oversea_experience', $params)) {
			if (!empty($params['oversea_experience'])) {
				$experience = explode('-', $params['oversea_experience']);
				sort($experience);
				$clause['inset_oversea_experience_ids'] = $experience;
			}
		}

		$request = [
			'workers' => $this->WorkersModel->getAll($clause),
			'experiences' => $this->ExperiencesModel->getAll(['order' => 'name']),
			'placements' => $this->AgencyLocationsModel->getAll(['order' => 'name']),
			// 'user_levels' => $this->UserLevelsModel->getAll(['order' => 'name'])
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

		$this->result['pagination'] = bs4pagination('worker', $total, $clause['limit'], $params);

		$this->template->content->view('templates/front/Worker/index', $this->result);
		$this->template->publish();
	}

	/**
	 *  detail method
	 *  detail page by id
	 */
	public function detail($worker_nik = 0)
	{
		$session = $this->session->userdata('AuthUser');

		if (!$session) {
			setFlashError($this->lang->line('error')['auth'], 'worker');
			redirect($_SERVER['HTTP_REFERER']);
		}

		if (empty($worker_nik)) {
			redirect($_SERVER['HTTP_REFERER']);
		}

		$request = $this->WorkersModel->getDetailByNik($worker_nik);

		if ($request['status'] != 'success') {
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->result['worker'] = $request['data'];
		$this->result['attachments'] = [];

		$request = $this->WorkerAttachmentsModel->getByWorkerId($this->result['worker']['id']);

		if ($request['status'] == 'success') {
			$this->result['attachments'] = $request['data'];
		}

		$this->template->title = 'Detail';
		$this->template->content->view('templates/front/Worker/detail', $this->result);
		$this->template->publish();
	}

	/**
	 *  booking method
	 *  booking process
	 */
	public function booking()
	{
		$session = $this->session->userdata('AuthUser');

		$this->result = [
			'status' => 'error'
		];

		if ($this->input->is_ajax_request()) {
			$input = array_map('strClean', $this->input->post());

			if (array_key_exists('worker', $input) && array_key_exists('booking', $input)) {
				if (!empty($input['worker']) && in_array($input['booking'], [2,3])) {
					$request = $this->WorkersModel->getAll(['nik' => $input['worker']]);

					if ($request['status'] = 'success' && $request['total_data'] > 0) {
						$worker_id = $request['data'][0]['id'];

						$data = [
							'update_user_id' => $session['id'],
							'booking_status_id' => $input['booking']
						];

						if ($input['booking'] == 2) {
							$data['booking_user_id'] = $session['id'];
						}

						$request = $this->WorkersModel->update($data, $worker_id);

						if ($request['status'] == 'success') {
							$this->result['status'] = 'success';
							// setFlashSuccess('Data successfully created.');
							socketEmit('count-total');
						}
					}
				}
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  downloadAttachment method
	 *  download atachment, return json
	 */
	public function downloadAttachment()
	{
		$session = $this->session->userdata('AuthUser');

		$this->result = [
			'status' => 'error'
		];

		if ($this->input->is_ajax_request()) {
			$input = array_map('strClean', $this->input->post());

			if (is_numeric($input['worker']) && !empty($input['filename'])) {
				
				$file_url = base_url('files/workers/' . $input['worker'] . '/' . $input['filename']);
				
				if (@fopen($file_url, 'r')) {
					$this->result['status'] = 'success';
					$this->result['file'] = $file_url;
				}
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}
}
