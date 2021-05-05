<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Composer autoload
require FCPATH . 'vendor/autoload.php';

use Dompdf\Dompdf;

class Worker extends CI_Controller {

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
			'gender'			=> array_key_exists('gender', $params) ? ucwords($params['gender']) : '',
			// 'gender_id'			=> array_key_exists('gender', $params) ? $params['gender'] : '',
			'marital_status'	=> array_key_exists('marital_status', $params) ? ucwords($params['marital_status']) : '',
			// 'marital_status_id'	=> array_key_exists('marital_status', $params) ? $params['marital_status'] : '',
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
				setFlashError($this->lang->line('message')['error']['auth'], 'worker');
				redirect($_SERVER['HTTP_REFERER']);
			}

			$clause['page'] = 1;
		}

		$clause = array_map('strClean', $clause);

		if (array_key_exists('experience', $params)) {
			if (!empty($params['experience'])) {
				$experience = explode(',', urldecode($params['experience']));
				sort($experience);

				foreach ($experience as $key => $val) {
					$clause['inset_experience_slug'][] = '\'' . $val . '\'';
				}
			}
		}

		if (array_key_exists('oversea_experience', $params)) {
			if (!empty($params['oversea_experience'])) {
				$oversea_experience = explode(',', urldecode($params['oversea_experience']));
				sort($oversea_experience);

				foreach ($oversea_experience as $key => $val) {
					$clause['inset_oversea_experience_slug'][] = '\'' . $val . '\'';
				}
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
			setFlashError($this->lang->line('message')['error']['auth'], 'worker');
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

		$menu_booking = [
			'type' => 'button',
			'class' => 'btn btn-secondary btn-booking rounded-0 d-block mx-auto mb-2'
		];

		switch ($this->result['worker']['booking_status_id']) {
			// on booking
			case 2:
				$menu_booking['content'] = '<i class="fa fa-check">&nbsp;</i> Confirm';
				$menu_booking['data-booking'] = 3;
				$menu_booking['data-worker'] = $this->result['worker']['nik'];
				break;
			// confirmed
			case 3:
				$menu_booking['content'] = '<i class="fa fa-spinner">&nbsp;</i> Waiting For Approval';
				$menu_booking['class'] = $menu_booking['class'] . ' disabled';
				break;
			// approved
			case 4:
				$menu_booking['content'] = '<i class="fa fa-check">&nbsp;</i> Approved';
				$menu_booking['class'] = $menu_booking['class'] . ' disabled';
			// free
			default:
				$menu_booking['content'] = '<i class="fa fa-lock">&nbsp;</i> Booking';
				$menu_booking['data-booking'] = 2;
				$menu_booking['data-worker'] = $this->result['worker']['nik'];
				break;
		}

		if ($session['user_level_id'] == 3 && ($this->result['worker']['booking_status_id'] == 1 || ($this->result['worker']['booking_status_id'] != 1 && $this->result['worker']['booking_user_id'] == $session['id']))) {
			$this->result['menu_booking'] = $menu_booking;
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
							'booking_status_id' => $input['booking'],
							'booking_user_id' => $session['id']
						];

						if ($input['booking'] == 2) {
							$data['booking_date'] = date('Y-m-d H:i:s');
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

	/**
	 *  downloadProfile method
	 *  download profile, return json
	 */
	public function downloadProfile()
	{
		$session = $this->session->userdata('AuthUser');
		$company = $this->result['company'];

		$this->result = [
			'status' => 'error'
		];

		if ($this->input->is_ajax_request()) {
			$input = array_map('strClean', $this->input->post());

			if (array_key_exists('worker', $input) && is_numeric($input['worker'])) {
				$request = $this->WorkersModel->getDetailByNik($input['worker']);

				if ($request['status'] == 'success' && $request['total_data'] > 0) {
					$worker = $request['data'];

					$this->load->helper('pdf');

					$pdf = PdfWorkerProfile($worker, $company);

					if ($pdf) {
						if (@fopen($pdf['fileurl'], 'r')) {
							$this->result['status'] = 'success';
							$this->result['file'] = $pdf['fileurl'];
						}
					}
				}
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}
}
