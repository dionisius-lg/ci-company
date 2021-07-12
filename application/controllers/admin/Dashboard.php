<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		if (!$this->session->has_userdata('AuthUser')) {
			// save referer to session
			$this->session->set_userdata('referer', current_url());

			// set site languange
			$this->config->set_item('language', siteLang()['name']);

			// show error message and redirect to login
			// setFlashError($this->lang->line('message')['error']['auth'], 'auth');
			setFlashError('unauthorized', 'auth');
			redirect('auth');
		}

		if ($this->session->userdata('AuthUser')['user_level_id'] != 1) {
			// redirect($_SERVER['HTTP_REFERER']);
			redirect(base_url(), 'refresh');
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
