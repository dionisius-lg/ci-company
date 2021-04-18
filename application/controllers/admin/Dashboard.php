<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		setReferrer(current_url());

		if (!$this->session->has_userdata('AuthUser')) {
			setFlashError('Please login first', 'auth');
			redirect('auth');
		}

		if ($this->session->userdata('AuthUser')['user_level_id'] != 1) {
			hasReferrer() == true ? redirect(Referrer(), 'refresh') : redirect(base_url(), 'refresh');
		}
		
		$this->template->set_template('layouts/back');

		$this->load->library('user_agent');

		// $this->load->model('CompanyModel');
		// $this->load->model('ProvincesModel');
	}

	private $upload_errors = [];
	private $result = [];

	/**
	 *  index method
	 *  index page or we can call it home or dashboard
	 */
	public function index()
	{
		$this->template->title = 'Dashboard';
		$this->template->content->view('templates/back/Home/dashboard', $this->result);

		$this->template->publish();
	}
}
