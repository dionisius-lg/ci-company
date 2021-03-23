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

		/*--- load model -----------------------------------*/
		/*$this->load->model('admin_m');
		$this->load->model('news_m');
		$this->load->model('about_m');
		$this->load->model('academic_m');
		$this->load->model('log_m');*/
	}

	public function index()
	{
		$this->template->content->view('templates/back/home/dashboard');

		$this->template->publish();
	}
}
