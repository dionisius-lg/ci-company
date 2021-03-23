<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		
		$this->template->set_template('layouts/auth');

		$this->load->model('UsersModel');
	}

	public function login()
	{
		if ($this->session->has_userdata('AuthUser')) {
			if (in_array($this->session->userdata('AuthUser')['user_level_id'], [1])) {
				redirect('admin');
			} else {
				redirect(base_url(), 'refresh');
			}
		}

		if ($this->input->method() == 'post') {
			$username = trim(xss_clean($this->input->post('username')));
			$password = trim(xss_clean($this->input->post('password')));
			$remember = trim(xss_clean($this->input->post('remember')));

			$verify = $this->UsersModel->login(['username' => $username, 'password' => $password]);

			if ($verify['status'] != 'success') {
				setFlashError('Invalid login credentials', 'auth');
				redirect('auth/login', 'refresh');
			}

			$request = $this->UsersModel->getDetail($verify['data']['id']);

			if ($request['status'] == 'success') {
				$this->session->set_userdata('AuthUser', $request['data']);

				if ($remember) {
					$this->load->helper('cookie');
					$cookie = $this->input->cookie('ci_session');
					$this->input->set_cookie('ci_session', $cookie, '2628000'); //set cookies 1 month
				}

				if (in_array($request['data']['user_level_id'], [1])) {
					hasReferrer() == true ? redirect(Referrer(), 'refresh') : redirect('admin', 'refresh');
				} else {
					redirect(base_url(), 'refresh');
				}
			}

			setFlashError('An error occurred, please try again', 'auth');
			redirect('auth/login', 'refresh');
		}

		$this->template->content->view('templates/auth/login');
		$this->template->publish();
	}

	public function logout()
	{
		$this->session->unset_userdata('AuthUser');
		//$this->session->sess_destroy();

		//redirect(base_url());
		redirect('auth/login', 'refresh');
	}
}
