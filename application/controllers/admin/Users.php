<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
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

		$this->load->model('UsersModel');
		$this->load->model('EmployeesModel');
		$this->load->model('UserLevelsModel');
	}

	private $upload_errors = [];

	public function index()
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [];

		$request = [
			'user_levels' => $this->UserLevelsModel->getAll()
		];

		foreach ($request as $key => $val) {
			$result[$key] = [];

			if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
				if ($request[$key]['status'] == 'success') {
					$result[$key] = $val['data'];
				}
			}
		}

		$this->template->title = 'Users Data';
		$this->template->content->view('templates/back/users/index', $result);

		$this->template->publish();
	}

	public function detail($id)
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [
			'status' => 'error',
			'message' => 'An error occurred, please try again.'
		];

		if ($this->input->is_ajax_request()) {
			if (empty($id) && !is_numeric($id)) {
				echo json_encode($result); exit();
			}

			$request = [
				'user' => $this->UsersModel->getDetail($id),
				'employees' => $this->EmployeesModel->getAll(['user_id' => $id]),
				//'user_levels' => $this->UserLevelsModel->getAll(),
			];

			foreach ($request as $key => $val) {
				$result[$key] = [];

				if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
					if ($request[$key]['status'] == 'success' && !empty($val['data'])) {
						if (in_array($key, ['employees'])) {
							$result[$key] = $val['data'][0];
						} else {
							$result[$key] = $val['data'];
						}
					}
				}
			}

			if (empty($result['user'])) {
				echo json_encode($result); exit();
			}

			echo json_encode($result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function create()
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [
			'status' => 'error',
			'message' => 'An error occurred, please try again.'
		];

		if ($this->input->is_ajax_request()) {
			$input = array_map('trim', $this->input->post());
			$file = false;

			$validate = $this->validate($file);

			$this->form_validation->set_rules($validate);
			$this->form_validation->set_error_delimiters('','');

			if ($this->form_validation->run() == false) {
				foreach ($input as $key => $val) {
					$result['error'][$key] = form_error($key);
				}

				echo json_encode($result); exit();
			}

			$data = [
				'username'			=> strtolower($input['username']),
				'user_level_id'		=> $input['user_level'],
				'is_register'		=> 0,
				'password'			=> '12345678',
				'update_user_id'	=> $session['id']
			];

			$data = array_map('strClean', $data);

			$request = $this->UsersModel->insert($data);

			if ($request['status'] == 'success') {
				$result['status'] = 'success';
				$result['message'] = 'Data successfully created.';
			}

			echo json_encode($result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function update($id)
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [
			'status' => 'error',
			'message' => 'An error occurred, please try again.'
		];

		if ($this->input->is_ajax_request()) {
			if (empty($id) && !is_numeric($id)) {
				echo json_encode($result); exit();
			}

			$input = array_map('trim', $this->input->post());
			$file = false;

			$validate = $this->validate($file, $id);

			$this->form_validation->set_rules($validate);
			$this->form_validation->set_error_delimiters('','');

			if ($this->form_validation->run() == false) {
				foreach ($input as $key => $val) {
					$result['error'][$key] = form_error($key);
				}

				echo json_encode($result); exit();
			}

			$data = [
				'username'			=> strtolower($input['username']),
				'user_level_id'		=> $input['user_level'],
				'is_register'		=> $input['is_register'],
				'update_user_id'	=> $session['id']
			];

			if ($data['is_register'] == 1) {
				$data['register_user_id'] = $session['id'];
			}

			$data = array_map('strClean', $data);

			$request = $this->UsersModel->update($data, $id);

			if ($request['status'] == 'success') {
				$result['status'] = 'success';
				$result['message'] = 'Data successfully updated.';
			}

			echo json_encode($result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete($id = null)
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [
			'status' => 'error',
			'message' => 'An error occurred, please try again.'
		];

		if ($this->input->is_ajax_request()) {
			if (empty($id) && !is_numeric($id)) {
				echo json_encode($result); exit();
			}

			$data = [
				'is_active'			=> 0,
				'update_user_id'	=> $session['id']
			];

			$data = array_map('strClean', $data);

			$request = $this->UsersModel->update($data, $id);

			if ($request['status'] == 'success') {
				$result['status'] = 'success';
				$result['message'] = 'Data successfully deleted.';
			}

			echo json_encode($result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function resetPassword($id = null)
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [
			'status' => 'error',
			'message' => 'An error occurred, please try again.'
		];

		if ($this->input->is_ajax_request()) {
			if (empty($id) && !is_numeric($id)) {
				echo json_encode($result); exit();
			}

			$data = [
				'password'			=> '12345678',
				'update_user_id'	=> $session['id']
			];

			$data = array_map('strClean', $data);

			$request = $this->UsersModel->update($data, $id);

			if ($request['status'] == 'success') {
				$result['status'] = 'success';
				$result['message'] = 'Password successfully reset.';
			}

			echo json_encode($result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	private function validate($file = false, $id = 0)
	{
		$validate = [
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'trim|required|max_length[30]|valid_email|callback__checkUsername['.$id.']|xss_clean'
			],
			[
				'field' => 'user_level',
				'label' => 'User Level',
				'rules' => 'trim|required|callback__regexNumeric|xss_clean'
			],
			[
				'field' => 'is_register',
				'label' => 'Register Status',
				'rules' => 'trim|required|callback__regexNumeric|xss_clean'
			],
		];

		return $validate;
	}

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

	public function _regexAddress($str = false)
	{
		if ($str) {
			if (!preg_match('/^[a-zA-Z0-9 \-,.()\r\n]*$/', $str)) {
				$this->form_validation->set_message('_regexAddress', 'The %s format is invalid.');
				return false;
			}
		}

		return true;
	}

	public function _regexNumeric($str = false)
	{
		if ($str) {
			if (!preg_match('/^[0-9]*$/', $str)) {
				$this->form_validation->set_message('_regexNumeric', 'The %s format is invalid.');
				return false;
			}
		}

		return true;
	}

	public function _formatDate($str = false)
	{
		if ($str) {
			$date = DateTime::createFromFormat('Y-m-d', $str);
			$error = DateTime::getLastErrors();

			if ($error['warning_count'] > 0 || $error['error_count'] > 0) {
				$this->form_validation->set_message('_formatDate', 'The %s format is invalid.');
				return false;
			}
		}

		return true;
    }

	public function _errorFile($str)
	{
		if (isset($this->upload_errors['file'])) {
			$this->form_validation->set_message('_errorFile', $this->upload_errors['file']);
			return false;
		}

		return true;
	}

	public function _checkUsername($str = false, $id = 0)
	{
		if ($str) {
			$term = ['username' => $str];

			if (!empty($id) && is_numeric($id)) {
				$term['not_id'] = $id;
			}

			$request = $this->UsersModel->getAll($term);

			if ($request['total_data'] > 0) {
				$this->form_validation->set_message('_checkUsername', '%s already exist');
				return false;
			}
		}

		return true;
	}
}
