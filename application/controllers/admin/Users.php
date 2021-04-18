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
		$this->template->title = 'Users Data';

		$this->load->library('user_agent');

		$this->load->model('UsersModel');
		$this->load->model('UserLevelsModel');
		$this->load->model('WorkersModel');
	}

	private $upload_errors = [];
	private $result = [];

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
			'limit'					=> 10,
			'page'					=> (array_key_exists('page', $params) && is_numeric($params['page'])) ? $params['page'] : 1,
			'like_fullname'			=> array_key_exists('fullname', $params) ? $params['fullname'] : '',
			'like_email'			=> array_key_exists('email', $params) ? $params['email'] : '',
			'like_company'			=> array_key_exists('company', $params) ? $params['company'] : '',
			'like_country'			=> array_key_exists('country', $params) ? $params['country'] : '',
			'like_username'			=> array_key_exists('username', $params) ? $params['username'] : '',
			'user_level_id'			=> array_key_exists('user_level', $params) ? $params['user_level'] : '',
			'order'					=> 'fullname',
			'sort'					=> 'asc',
			'is_register'			=> 1,
			'is_request_register'	=> '0',
		];

		$request = [
			'users' => $this->UsersModel->getAll($clause),
			'user_levels' => $this->UserLevelsModel->getAll(['order' => 'name'])
		];

		foreach ($request as $key => $val) {
			$this->result[$key] = [];

			if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
				if ($request[$key]['status'] == 'success') {
					$this->result[$key] = $val['data'];

					if ($key == 'users') {
						$total = $val['total_data'];
					}
				}
			}
		}

		$this->result['pagination'] = bs4pagination('admin/users', $total, $clause['limit']);
		$this->result['no'] = (($clause['page'] * $clause['limit']) - $clause['limit']) + 1;

		$this->template->content->view('templates/back/Users/index', $this->result);
		$this->template->publish();
	}

	/**
	 *  detail method
	 *  detail data, return json
	 */
	public function detail($id)
	{
		$session = $this->session->userdata('AuthUser');

		$this->result = [
			'status' => 'error',
			'message' => 'An error occurred, please try again.'
		];

		if ($this->input->is_ajax_request()) {
			if (empty($id) && !is_numeric($id)) {
				echo json_encode($this->result); exit();
			}

			$request = [
				'user' => $this->UsersModel->getDetail($id),
				'worker' => $this->WorkersModel->getAll(['user_id' => $id]),
			];

			foreach ($request as $key => $val) {
				$this->result[$key] = [];

				if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
					if ($request[$key]['status'] == 'success' && !empty($val['data'])) {
						if (in_array($key, ['worker'])) {
							$this->result[$key] = $val['data'][0];
						} else {
							$this->result[$key] = $val['data'];
						}
					}
				}
			}

			if (!empty($this->result['user'])) {
				$this->result['status'] = 'success';
				unset($this->result['message']);
			} else {
				unset($this->result['user']);
				unset($this->result['worker']);
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  create method
	 *  create data, return json
	 */
	public function create()
	{
		$session = $this->session->userdata('AuthUser');

		$this->result = [
			'status' => 'error',
			'message' => 'An error occurred, please try again.'
		];

		if ($this->input->is_ajax_request()) {
			$input = array_map('trim', $this->input->post());
			$file = false;
			$password = true;

			$validate = $this->validate($file, $password);

			$this->form_validation->set_rules($validate);
			$this->form_validation->set_error_delimiters('','');

			if ($this->form_validation->run() == false) {
				foreach ($input as $key => $val) {
					$this->result['error'][$key] = form_error($key);
				}

				echo json_encode($this->result); exit();
			}

			$data = [
				'username'			=> strtolower($input['username']),
				'password'			=> $input['password'],
				'fullname'			=> ucwords($input['fullname']),
				'email'				=> strtolower($input['email']),
				'country'			=> ucwords($input['country']),
				'company'			=> ucwords($input['company']),
				'user_level_id'		=> $input['user_level'],
				'register_user_id'	=> $session['id'],
				'is_register'		=> 1
			];

			$data = array_map('strClean', $data);

			$request = $this->UsersModel->insert($data);

			if ($request['status'] == 'success') {
				$this->result['status'] = 'success';
				unset($this->result['message']);
				setFlashSuccess('Data successfully created.');
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  update method
	 *  update data, return json
	 */
	public function update($id)
	{
		$session = $this->session->userdata('AuthUser');

		$this->result = [
			'status' => 'error',
			'message' => 'An error occurred, please try again.'
		];

		if ($this->input->is_ajax_request()) {
			if (empty($id) && !is_numeric($id)) {
				echo json_encode($this->result); exit();
			}

			$input = array_map('trim', $this->input->post());
			$file = false;
			$password = false;

			$validate = $this->validate($file, $password, $id);

			$this->form_validation->set_rules($validate);
			$this->form_validation->set_error_delimiters('','');

			if ($this->form_validation->run() == false) {
				foreach ($input as $key => $val) {
					$this->result['error'][$key] = form_error($key);
				}

				echo json_encode($this->result); exit();
			}

			$data = [
				'username'			=> strtolower($input['username']),
				'fullname'			=> ucwords($input['fullname']),
				'email'				=> strtolower($input['email']),
				'country'			=> ucwords($input['country']),
				'company'			=> ucwords($input['company']),
				'user_level_id'		=> $input['user_level'],
				'update_user_id'	=> $session['id']
			];

			$data = array_map('strClean', $data);

			$request = $this->UsersModel->update($data, $id);

			if ($request['status'] == 'success') {
				$this->result['status'] = 'success';
				unset($this->result['message']);
				setFlashSuccess('Data successfully updated.');
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  delete method
	 *  delete data, return json
	 */
	public function delete($id = null)
	{
		$session = $this->session->userdata('AuthUser');

		$this->result = [
			'status' => 'error',
			'message' => 'An error occurred, please try again.'
		];

		if ($this->input->is_ajax_request()) {
			if (empty($id) && !is_numeric($id)) {
				echo json_encode($this->result); exit();
			}

			$request = $this->UsersModel->delete($id);

			if ($request['status'] == 'success') {
				$this->result['status'] = 'success';
				unset($this->result['message']);
				setFlashSuccess('Data successfully deleted.');
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  changePassword method
	 *  update data password, return json
	 */
	public function changePassword($id)
	{
		$session = $this->session->userdata('AuthUser');

		$this->result = [
			'status' => 'error',
			'message' => 'An error occurred, please try again.'
		];

		if ($this->input->is_ajax_request()) {
			if (empty($id) && !is_numeric($id)) {
				echo json_encode($this->result); exit();
			}

			$input = array_map('trim', $this->input->post());

			$validate = [
				[
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required|min_length[3]|max_length[10]|xss_clean'
				],
				[
					'field' => 'password_repeat',
					'label' => 'Password Repeat',
					'rules' => 'trim|required|matches[password]|xss_clean'
				]
			];

			$this->form_validation->set_rules($validate);
			$this->form_validation->set_error_delimiters('','');

			if ($this->form_validation->run() == false) {
				foreach ($input as $key => $val) {
					$this->result['error'][$key] = form_error($key);
				}

				echo json_encode($this->result); exit();
			}

			$data = [
				'password'			=> $input['password'],
				'update_user_id'	=> $session['id']
			];

			$data = array_map('strClean', $data);

			$request = $this->UsersModel->update($data, $id);

			if ($request['status'] == 'success') {
				$this->result['status'] = 'success';
				unset($this->result['message']);
				setFlashSuccess('Password successfully updated.');
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  resetPassword method
	 *  reset data password, return json
	 */
	public function resetPassword($id = null)
	{
		$session = $this->session->userdata('AuthUser');

		$this->result = [
			'status' => 'error',
			'message' => 'An error occurred, please try again.'
		];

		if ($this->input->is_ajax_request()) {
			if (empty($id) && !is_numeric($id)) {
				echo json_encode($this->result); exit();
			}

			$data = [
				'password'			=> '12345678',
				'update_user_id'	=> $session['id']
			];

			$data = array_map('strClean', $data);

			$request = $this->UsersModel->update($data, $id);

			if ($request['status'] == 'success') {
				$this->result['status'] = 'success';
				unset($this->result['message']);
				setFlashSuccess('Password successfully reset.');
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  validate method
	 *  validate data before action
	 */
	private function validate($file = false, $password = false, $id = 0)
	{
		$validate = [
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'trim|required|max_length[30]|regexUsername|checkUsersUsername['.$id.']|xss_clean'
			],
			[
				'field' => 'fullname',
				'label' => 'Fullname',
				'rules' => 'trim|required|max_length[100]|regexTextInput|xss_clean'
			],
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|max_length[100]|valid_email|checkUsersEmail['.$id.']|xss_clean'
			],
			[
				'field' => 'country',
				'label' => 'Country',
				'rules' => 'trim|max_length[100]|regexTextInput|xss_clean'
			],
			[
				'field' => 'company',
				'label' => 'Company',
				'rules' => 'trim|max_length[200]|regexTextInput|xss_clean'
			],
			[
				'field' => 'user_level',
				'label' => 'User Level',
				'rules' => 'trim|required|is_natural|xss_clean'
			],
		];

		if ($file) {
			$validate[] = [
				'field' => 'picture',
				'label' => 'Picture',
				'rules' => 'trim|callback__errorFile|xss_clean'
			];
		}

		if ($password) {
			$validate[] = [
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required|min_length[3]|max_length[10]|xss_clean'
			];

			$validate[] = [
				'field' => 'password_repeat',
				'label' => 'Password Repeat',
				'rules' => 'trim|required|matches[password]|xss_clean'
			];
		}

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
