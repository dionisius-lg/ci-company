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
		$this->load->model('WorkerAttachmentsModel');
		$this->load->model('ExperiencesModel');
		$this->load->model('PlacementsModel');
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
		$session	= $this->session->userdata('AuthUser');
		$params		= $this->input->get();
		$clause		= [];
		$total		= 0;

		$clause = [
			'limit'						=> 6,
			'page'						=> (array_key_exists('page', $params) && is_numeric($params['page'])) ? $params['page'] : 1,
			'like_nik'					=> array_key_exists('nik', $params) ? $params['nik'] : '',
			'like_fullname'				=> array_key_exists('fullname', $params) ? $params['fullname'] : '',
			'like_email'				=> array_key_exists('email', $params) ? $params['email'] : '',
			'gender_id'					=> array_key_exists('gender', $params) ? $params['gender'] : '',
			'marital_status_id'			=> array_key_exists('marital_status', $params) ? $params['marital_status'] : '',
			'placement_id'				=> array_key_exists('placement', $params) ? $params['placement'] : '',
			'order'						=> 'fullname',
			'sort'						=> 'asc'
		];

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

		if (array_key_exists('ready_placement', $params)) {
			if (!empty($params['ready_placement'])) {
				$ready_placement = explode('-', $params['ready_placement']);
				sort($ready_placement);
				$clause['inset_ready_placement_ids'] = $ready_placement;
			}
		}

		$request = [
			'workers' => $this->WorkersModel->getAll($clause),
			'experiences' => $this->ExperiencesModel->getAll(['order' => 'name']),
			'placements' => $this->PlacementsModel->getAll(['order' => 'name']),
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
		// $this->result['no'] = (($clause['page'] * $clause['limit']) - $clause['limit']) + 1;

		$this->template->title = $this->pageTitle(sitelang());
		$this->template->content->view('templates/front/Worker/index', $this->result);
		$this->template->publish();
	}

	public function detail($id)
	{
		$session = $this->session->userdata('AuthUser');
		if (empty($session)) {
			redirect(base_url('auth/register'));
		}

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

	public function bookingWorker($id)
	{
		$session = $this->session->userdata('AuthUser');
		$request = [
			'worker' => $this->WorkersModel->getDetail($id),
			'workers' => $this->WorkersModel->getAll(),
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

		$booking_status = $request['worker'];

		if ($booking_status['data']['booking_status_id'] == 1) {
			$data = [
				'booking_status_id' => 2,
				'booking_date' => date('Y-m-d H:i:s'),
				'booking_user_id' => $session['id']
			];

			$request = $this->WorkersModel->update($data, $id);
			if ($request['status'] == 'success') {
				setFlashSuccess('Worker has been booked.');
				
				$this->load->helper('socket');
				socketEmit('count-total');
			}
			redirect('worker/detail/'.$id);

		} else if($booking_status['data']['booking_status_id'] == 2) {
			$data = [
				'booking_status_id' => 3,
				'booking_user_id' => $session['id']
			];

			$request = $this->WorkersModel->update($data, $id);
			if ($request['status'] == 'success') {
				setFlashSuccess('Waiting for confirm.');
			}
			redirect('worker/detail/'.$id);

		} else if($booking_status['data']['booking_status_id'] == 3) {
			$data = [
				'booking_status_id' => 4,
				'booking_user_id' => $session['id']
			];
			$request = $this->WorkersModel->update($data, $id);
				if ($request['status'] == 'success') {
					setFlashSuccess('Approval Success!');
					redirect('worker/detail/'.$id);
				}

		} else {
			redirect('worker');
		}
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
