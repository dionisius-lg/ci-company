<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mailer extends CI_Controller {
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
		$this->template->title = 'Mailer';

		$this->load->library('user_agent');

		$this->load->model('MailerConfigModel');
	}

	private $upload_errors = [];
	private $result = [];

	/**
	 *  index method
	 *  index page or return to detail method
	 */
	public function index()
	{
		$this->detail();
	}

	/**
	 *  detail method
	 *  detail page
	 */
	public function detail()
	{
		$session = $this->session->userdata('AuthUser');

		$request = [
			'mailer' => $this->MailerConfigModel->get()
		];

		foreach ($request as $key => $val) {
			$this->result[$key] = [];

			if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
				if ($request[$key]['status'] == 'success') {
					$this->result[$key] = $val['data'];
				}
			}
		}

		$this->template->content->view('templates/back/Mailer/detail', $this->result);
		$this->template->publish();
	}

	/**
	 *  update method
	 *  update data
	 */
	public function update()
	{
		$session = $this->session->userdata('AuthUser');

		if ($this->input->method() == 'post') {
			$input = array_map('trim', $this->input->post());

			$validate = $this->validate($file);

			$this->form_validation->set_rules($validate);
			$this->form_validation->set_error_delimiters('','');

			if ($this->form_validation->run() == false) {
				foreach ($input as $key => $val) {
					if (!empty(form_error($key))) {
						setFlashError(form_error($key), $key);
					}
				}

				setOldInput($input);
				redirect('admin/mailer');
			}

			$data = [
				'host'			=> $input['host'],
				'port'			=> $input['port'],
				'username'		=> $input['username'],
				'password'		=> $input['password'],
				'encryption'	=> $input['encryption']
			];

			$data = array_map('strClean', $data);

			$request = $this->MailerConfigModel->update($data);

			if ($request['status'] == 'success') {
				setFlashSuccess('Data successfully updated.');
			} else {
				setFlashError('An error occurred, please try again.');
			}

			redirect('admin/mailer');
		}

		hasReferrer() == true ? redirect(Referrer(), 'refresh') : redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  validate method
	 *  validate data before action
	 */
	private function validate()
	{
		$validate = [
			[
				'field' => 'host',
				'label' => 'Host',
				'rules' => 'trim|required|max_length[100]|regexAlphaNumericDashDot|xss_clean'
			],
			[
				'field' => 'port',
				'label' => 'Port',
				'rules' => 'trim|required|max_length[5]|is_natural|xss_clean'
			],
			[
				'field' => 'encryption',
				'label' => 'Encryption',
				'rules' => 'trim|required|max_length[3]|alpha|xss_clean'
			],
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'trim|required|max_length[100]|valid_email|xss_clean'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required|max_length[100]|xss_clean'
			]
		];

		return $validate;
	}

	/**
	 *  _errorFile method
	 *  display file upload error
	 */
	public function _errorFile($str)
	{
		if (isset($this->upload_errors['file'])) {
			$this->form_validation->set_message('_errorFile', $this->upload_errors['file']);
			return false;
		}

		return true;
	}
}
