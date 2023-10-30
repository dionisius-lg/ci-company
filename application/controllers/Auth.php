<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// set timezone
		date_default_timezone_set('Asia/Jakarta');

		// site languange
		$this->config->set_item('language', siteLang()['name']);

		// set layout template
		$this->template->set_template('layouts/front');

		// load default models
		$this->load->model('CompanyModel');
		$this->load->model('UsersModel');
		$this->load->model('UserLevelsModel');
		$this->load->model('AgencyLocationsModel');

		// load default data
		$this->result['company'] = [];
		if ($this->CompanyModel->get()['status'] == 'success') {
			$this->result['company'] = $this->CompanyModel->get()['data'];
		}

		// load socket helper
		$this->load->helper('socket');

		// google recapctha
		$this->load->config('recaptcha');
		$this->config->set_item('recaptcha_lang', siteLang()['key']);
		$this->load->library('Recaptcha');
		$this->result['recaptcha'] = $this->recaptcha->getWidget();
		$this->result['recaptcha_script'] = $this->recaptcha->getScriptTag();
	}

	/**
	 *  login method
	 *  login page, authentication user & save session
	 */
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
			$input = array_map('trim', $this->input->post());

			$input['username'] = $this->security->xss_clean($input['username']);
			$input['password'] = $this->security->xss_clean($input['password']);

			$verify_recaptcha = $this->recaptcha->verifyResponse($input['g-recaptcha-response']);

			if (!isset($verify_recaptcha['success']) || $verify_recaptcha['success'] <> true) {
				setFlashError($this->lang->line('message')['error']['captcha'], 'auth');
				redirect('auth', 'refresh');
			}

			$verify = $this->UsersModel->login($input['username'], $input['password']);

			if ($verify['status'] != 'success') {
				setFlashError($this->lang->line('message')['error']['login'], 'auth');
				redirect('auth', 'refresh');
			}

			$request = $this->UsersModel->getDetail($verify['data']['id']);

			if ($request['status'] == 'success') {
				$this->session->set_userdata('AuthUser', $request['data']);

				if (in_array($request['data']['user_level_id'], [1])) {
					$this->session->has_userdata('referer') == true ? redirect($this->session->userdata('referer')) : redirect('admin');
				} else {
					redirect(base_url(), 'refresh');
				}
			}

			setFlashError($this->lang->line('message')['error']['default'], 'auth');
			redirect('auth', 'refresh');
		}

		$this->template->content->view('templates/auth/login', $this->result);
		$this->template->publish();
	}

	/**
	 *  register method
	 *  register page, register (create) new user
	 */
	public function register()
	{
		if ($this->session->has_userdata('AuthUser')) {
			if (in_array($this->session->userdata('AuthUser')['user_level_id'], [1])) {
				redirect('admin');
			} else {
				redirect(base_url(), 'refresh');
			}
		}

		if ($this->input->method() == 'post') {
			$input = array_map('trim', $this->input->post());
			$validate = $this->validateRegister();
			$verify_recaptcha = $this->recaptcha->verifyResponse($input['g-recaptcha-response']);

			$this->form_validation->set_rules($validate);
			$this->form_validation->set_error_delimiters('','');

			if ($this->form_validation->run() == false || !isset($verify_recaptcha['success']) || $verify_recaptcha['success'] <> true) {
				foreach ($input as $key => $val) {
					if (!empty(form_error($key))) {
						setFlashError(form_error($key), $key);
					}
				}

				if (!isset($verify_recaptcha['success']) || $verify_recaptcha['success'] <> true) {
					setFlashError($this->lang->line('message')['error']['captcha'], 'register');
				}

				setOldInput($input);
				redirect('auth/register');
			}

			$data = [
				'username'				=> strtolower($input['email']),
				'fullname'				=> ucwords($input['fullname']),
				'email'					=> strtolower($input['email']),
				'user_level_id'			=> $input['register_as'],
				'company'				=> ucwords($input['company']),
				'agency_location_id'	=> $input['agency_location'],
				'is_request_register'	=> 1
			];

			$data = array_map('strClean', $data);

			$this->load->library('encrypt');
			$verification_code = $this->encrypt->encode(strRandom(strlen($data['email'])));
			$data['verification_code'] = $verification_code;

			$request = $this->UsersModel->insert($data);

			if ($request['status'] == 'success') {
				setFlashSuccess($this->lang->line('message')['success']['register'], 'register');
				// socketEmit('count-total');
			} else {
				setFlashError($this->lang->line('message')['error']['default'], 'register');
				setOldInput($input);
			}

			redirect('auth/register');
		}

		$request = [
			'user_levels' => $this->UserLevelsModel->getAll(['order' => 'name', 'not_id' => 1]),
			'agency_locations' => $this->AgencyLocationsModel->getAll(['order' => 'name', 'limit' => 100])
		];

		foreach ($request as $key => $val) {
			$this->result[$key] = [];

			if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
				if ($request[$key]['status'] == 'success') {
					$this->result[$key] = $val['data'];
				}
			}
		}

		$this->template->content->view('templates/auth/register', $this->result);
		$this->template->publish();
	}

	/**
	 *  validateRegister method
	 *  validate input data before register method
	 */
	private function validateRegister()
	{
		$validate = [
			[
				'field' => 'fullname',
				'label' => $this->lang->line('front')['page_register']['fullname'],
				'rules' => 'trim|required|max_length[100]|regex_match[/^[a-zA-Z09., ]*$/]|xss_clean'
			],
			[
				'field' => 'email',
				'label' => $this->lang->line('front')['page_register']['email'],
				'rules' => 'trim|required|max_length[100]|valid_email|callback__checkEmail[0]|xss_clean'
			],
			[
				'field' => 'company',
				'label' => $this->lang->line('front')['page_register']['company'],
				'rules' => 'trim|max_length[200]|regex_match[/^[a-zA-Z0-9 .,\-\&]*$/]|xss_clean'
			],
			[
				'field' => 'register_as',
				'label' => $this->lang->line('front')['page_register']['register_as'],
				'rules' => 'trim|required|max_length[1]|numeric|xss_clean'
			],
			[
				'field' => 'agency_location',
				'label' => $this->lang->line('front')['page_register']['agency_location'],
				'rules' => 'trim|numeric|xss_clean'
			],
		];

		return $validate;
	}

	/**
	 *  logout method
	 *  destroy session data
	 */
	public function logout()
	{
		$this->session->unset_userdata('AuthUser');
		//$this->session->sess_destroy();

		//redirect(base_url());
		redirect('auth', 'refresh');
	}

	/**
	 *  mailVerification method
	 *  send mail verification after register
	 */
	private function mailVerification($data = []) {
		if (is_array($data) && !empty($data)) {
			$subject = $this->result['company']['name'] . ' - Verification';
			$body    = '<p>Dear <b>' . $data['fullname'] . '</b>,</p>
						<p>You have just made a request to register an account on our website.<br>
						If this is yours, please click <a href="' . base_url('verification/register/' . $data['verification_code']) . '">here</a> for confirmation. Otherwise, please ignore this email.<br>
						Thank you</p>';
			$body    = preg_replace('/([\s])\1+/', '', $body);

			$this->load->helper('mailer');

			$send_mail = sendMail($subject, $body, $data);

			if ($send_mail) {
				return true;
			}
		}

		return false;
	}


	/**
	 *  _checkEmail method
	 *  validation data duplicate
	 */
	public function _checkEmail($str = false, $id = 0)
	{
		if ($str) {
			$term = ['email' => $str];

			if (!empty($id) && is_numeric($id)) {
				$term['not_id'] = $id;
			}

			$request = $this->UsersModel->getAll($term);

			if ($request['total_data'] > 0) {
				$message = '%s';

				switch (siteLang()['key']) {
					case 'en':
						$message .= ' already registered';
						break;
					case 'id':
						$message .= ' sudah terdaftar';
						break;
					case 'ja':
						$message .= ' が既に登録されてい';
						break;
					case 'ko':
						$message .= ' 이 이미 등록되었습니다';
						break;
					case 'zh-TW':
						$message .= ' 已被註冊';
						break;
				}

				$this->form_validation->set_message('_checkEmail', $message);
				return false;
			}
		}

		return true;
	}
}
