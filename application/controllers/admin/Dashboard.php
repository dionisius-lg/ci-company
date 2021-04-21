<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		setReferrer(current_url());

		if (!$this->session->has_userdata('AuthUser')) {
			$auth_error = 'Please login first';

			switch (sitelang()) {
				case 'indonesian':
					$auth_error = 'Silahkan masuk terlebih dahulu';
					break;
				case 'japanese':
					$auth_error = '最初にログインしてください';
					break;
				case 'korean':
					$auth_error = '먼저 로그인하시기 바랍니다';
					break;
				case 'mandarin':
					$auth_error = '請先登錄';
					break;
			}

			setFlashError($auth_error, 'auth');
			redirect('auth');
		}

		if ($this->session->userdata('AuthUser')['user_level_id'] != 1) {
			hasReferrer() == true ? redirect(Referrer(), 'refresh') : redirect(base_url(), 'refresh');
		}
		
		$this->template->set_template('layouts/back');
		$this->template->title = 'Dashboard';

		// $this->load->library('user_agent');

		// load default models
		$this->load->model('CompanyModel');

		// load default data
		$this->result['company'] = [];
		if ($this->CompanyModel->get()['status'] == 'success') {
			$this->result['company'] = $this->CompanyModel->get()['data'];
		}
	}

	private $upload_errors = [];

	/**
	 *  index method
	 *  index page or we can call it home or dashboard
	 */
	public function index()
	{
		$this->template->content->view('templates/back/Home/dashboard', $this->result);
		$this->template->publish();
	}
}
