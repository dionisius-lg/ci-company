<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// set timezone
		date_default_timezone_set('Asia/Jakarta');

		// set referrer
		setReferrer(current_url());

		// site languange
		sitelang();
		$this->config->set_item('language', sitelang());

		// set layout template
		$this->template->set_template('layouts/front');

		// load default models
		$this->load->model('CompanyModel');
		$this->load->model('UsersModel');

		// load default data
		$this->result['company'] = [];
		if ($this->CompanyModel->getDetail()['status'] == 'success') {
			$this->result['company'] = $this->CompanyModel->getDetail()['data'];
		}

		// google recapctha
		$this->load->config('recaptcha');
		$recaptcha_lang = [
			'english'		=> 'en',
			'indonesian'	=> 'id',
			'japanese'		=> 'ja',
			'korean'		=> 'ko',
			'mandarin'		=> 'zh-TW'
		];
		if (array_key_exists(sitelang(), $recaptcha_lang)) {
			$this->config->set_item('recaptcha_lang', $recaptcha_lang[sitelang()]);
		}
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
				setFlashError($this->_errorCaptcha(sitelang()));
				redirect('auth', 'refresh');
			}

			$verify = $this->UsersModel->login($input['username'], $input['password']);

			if ($verify['status'] != 'success') {
				setFlashError($this->_errorAuth(sitelang()));
				redirect('auth', 'refresh');
			}

			$request = $this->UsersModel->getDetail($verify['data']['id']);

			if ($request['status'] == 'success') {
				$this->session->set_userdata('AuthUser', $request['data']);

				if (in_array($request['data']['user_level_id'], [1])) {
					hasReferrer() == true ? redirect(Referrer(), 'refresh') : redirect('admin', 'refresh');
				} else {
					redirect(base_url(), 'refresh');
				}
			}

			setFlashError($this->_errorDefault(sitelang()));
			redirect('auth', 'refresh');
		}

		$this->template->title = $this->pageTitle(sitelang(), 'login');
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
						if ($key == 'g-recaptcha-response') {
							setFlashError($this->_errorCaptcha(sitelang()));
						} else {
							setFlashError(form_error($key), $key);
						}
					}
				}

				setOldInput($input);
				redirect('auth/register');
			}

			$data = [
				'username' => strtolower($input['email']),
				'fullname' => ucwords($input['fullname']),
				'email' => strtolower($input['email']),
				'country' => ucwords($input['country']),
				'company' => ucwords($input['company']),
				'is_request_register' => 1
			];

			$data = array_map('strClean', $data);

			$this->load->library('encrypt');
			$verification_code = $this->encrypt->encode(strRandom(strlen($data['email'])));
			$data['verification_code'] = $verification_code;

			$request = $this->UsersModel->insert($data);

			if ($request['status'] == 'success') {
				setFlashSuccess($this->_successRegister(sitelang()));
			} else {
				setFlashError($this->_errorDefault(sitelang()));
				setOldInput($input);
			}

			redirect('auth/register');
		}

		$this->template->title = $this->pageTitle(sitelang(), 'register');
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
				'label' => $this->lang->line('page_register')['fullname'],
				'rules' => 'trim|required|max_length[100]|callback__regexName|xss_clean'
			],
			[
				'field' => 'email',
				'label' => $this->lang->line('page_register')['email'],
				'rules' => 'trim|required|max_length[100]|valid_email|callback__checkEmail[0]|xss_clean'
			],
			[
				'field' => 'company',
				'label' => $this->lang->line('page_register')['company'],
				'rules' => 'trim|max_length[200]|callback__regexName|xss_clean'
			],
			[
				'field' => 'country',
				'label' => $this->lang->line('page_register')['country'],
				'rules' => 'trim|max_length[100]|callback__regexName|xss_clean'
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
	 *  pageTitle method
	 *  return title for login & register in multi lang
	 */
	private function pageTitle($lang, $page = null) {
		if ($page == 'login') {
			switch ($lang) {
				case 'english':
					return 'Login';
					break;
				case 'indonesian':
					return 'Masuk';
					break;
				case 'japanese':
					return 'ログイン';
					break;
				case 'korean':
					return '로그인';
					break;
				case 'mandarin':
					return '登錄';
					break;
			}
		} elseif ($page == 'register') {
			switch ($lang) {
				case 'english':
					return 'Register';
					break;
				case 'indonesian':
					return 'Daftar';
					break;
				case 'japanese':
					return '登録';
					break;
				case 'korean':
					return '레지스터';
					break;
				case 'mandarin':
					return '登記';
					break;
			}
		} else {
			return '';
		}
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
	 *  _errorCaptcha method
	 *  return invalid message for captcha in multi lang
	 */
	private function _errorCaptcha($lang) {
		switch ($lang) {
			case 'english':
				return 'Captcha is required';
				break;
			case 'indonesian':
				return 'Captcha wajib diisi';
				break;
			case 'japanese':
				return 'キャプチャが必要です';
				break;
			case 'korean':
				return '보안 문자가 필요합니다';
				break;
			case 'mandarin':
				return '必須輸入驗證碼';
				break;
		}
	}

	/**
	 *  _errorAuth method
	 *  return invalid message for login in multi lang
	 */
	private function _errorAuth($lang) {
		switch ($lang) {
			case 'english':
				return 'Invalid login credentials';
				break;
			case 'indonesian':
				return 'Kredensial login tidak valid';
				break;
			case 'japanese':
				return '無効なログイン資格情報';
				break;
			case 'korean':
				return '로그인 자격 증명이 잘못되었습니다';
				break;
			case 'mandarin':
				return '無效的登錄憑證';
				break;
		}
	}

	/**
	 *  _errorDefault method
	 *  return default error message system in multi lang
	 */
	private function _errorDefault($lang) {
		switch ($lang) {
			case 'english':
				return 'An error occurred, please try again';
				break;
			case 'indonesian':
				return 'Terjadi kesalahan, silahkan coba lagi';
				break;
			case 'japanese':
				return 'エラーが発生しました, もう一度やり直してください';
				break;
			case 'korean':
				return '에러 발생됨, 다시 시도 해주세요';
				break;
			case 'mandarin':
				return '發生錯誤, 請重試';
				break;
		}
	}

	/**
	 *  _successRegister method
	 *  return default error message system in multi lang
	 */
	private function _successRegister($lang) {
		switch ($lang) {
			case 'english':
				return 'We are currently processing your request, please wait for confirmation via email';
				break;
			case 'indonesian':
				return 'Permintaan anda sedang kami proses, harap tunggu konfirmasi melalui email';
				break;
			case 'japanese':
				return '現在、リクエストを処理しています。メールでの確認をお待ちください';
				break;
			case 'korean':
				return '현재 귀하의 요청을 처리 중입니다. 이메일을 통해 확인을 기다려주십시오';
				break;
			case 'mandarin':
				return '我们目前正在处理您的请求，请等待通过电子邮件进行的确认';
				break;
		}
	}

	/**
	 *  _successMailer method
	 *  return success message for (send) mailer in multi lang
	 */
	private function _successMailer($lang) {
		switch ($lang) {
			case 'english':
				return 'Verification has been sent, please check your email';
				break;
			case 'indonesian':
				return 'Verifikasi sudah terkirim, silahkan cek email anda';
				break;
			case 'japanese':
				return '確認が送信されました, メールを確認してください';
				break;
			case 'korean':
				return '확인이 전송되었습니다, 이메일을 확인하세요';
				break;
			case 'mandarin':
				return '驗證已發送, 請檢查您的電子郵件';
				break;
		}
	}

	/**
	 *  _errorMailer method
	 *  return invalid message for (send) mailer in multi lang
	 */
	private function _errorMailer($lang) {
		switch ($lang) {
			case 'english':
				return 'Email not found';
				break;
			case 'indonesian':
				return 'Email tidak ditemukan';
				break;
			case 'japanese':
				return 'メールが見つかりません';
				break;
			case 'korean':
				return '이메일을 찾을 수 없습니다';
				break;
			case 'mandarin':
				return '電子郵件找不到';
				break;
		}
	}

	/**
	 *  _regexName method
	 *  validation data to regex
	 */
	public function _regexName($str = false)
	{
		if ($str) {
			if (!preg_match('/^[a-zA-Z0-9 .,\-\&]*$/', $str)) {
				$this->form_validation->set_message('_regexName', 'The %s format is invalid.');
				return false;
			}
		}

		return true;
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

				switch (sitelang()) {
					case 'english':
						$message .= ' already registered';
						break;
					case 'indonesian':
						$message .= ' sudah terdaftar';
						break;
					case 'japanese':
						$message .= ' が既に登録されてい';
						break;
					case 'korean':
						$message .= ' 이 이미 등록되었습니다';
						break;
					case 'mandarin':
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
