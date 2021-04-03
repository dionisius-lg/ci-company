<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UserRequests extends CI_Controller {
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

		$this->result = [];
	}

	private $upload_errors = [];

	// public function index()
	// {
	// 	print_r('asd'); exit;
	// }

	public function index()
	{
		$session	= $this->session->userdata('AuthUser');
		$params		= $this->input->get();
		$clause		= [];

		$clause = [
			'limit'					=> 10,
			'page'					=> (array_key_exists('page', $params) && is_numeric($params['page'])) ? $params['page'] : 1,
			'like_fullname'			=> array_key_exists('fullname', $params) ? $params['fullname'] : '',
			'like_email'			=> array_key_exists('email', $params) ? $params['email'] : '',
			'order'					=> 'request_date',
			'sort'					=> 'desc',
			'is_request_register'	=> 1
		];

		$this->load->library('pagination');

		$config_pagination = [
			'full_tag_open'			=> '<ul class="pagination">',
			'full_tag_close'		=> '</ul>',
			'num_tag_open'			=> '<li class="page-item">',
			'num_tag_close'			=> '</li>',
			'cur_tag_open'			=> '<li class="page-item active"><span>',
			'cur_tag_close'			=> '</span></li>',
			'next_tag_open'			=> '<li class="page-item">',
			'next_tagl_close'		=> '</li>',
			'prev_tag_open'			=> '<li class="page-item">',
			'prev_tagl_close'		=> '</li>',
			'first_tag_open'		=> '<li><li class="page-item">',
			'first_tagl_close'		=> '</li>',
			'last_tag_open'			=> '<li class="page-item">',
			'last_tagl_close'		=> '</li>',
			'prev_link'				=> 'Prev',
			'next_link'				=> 'Next',
			'first_link'			=> 'First',
			'last_link'				=> 'Last',

			'base_url'				=> base_url('admin/user-requests'),
			'total_rows'			=> 0,
			'per_page'				=> $clause['limit'],
			'page_query_string'		=> true,
			'page_query_string'		=> true,
			'use_page_numbers'		=> true,
			'query_string_segment'	=> 'page'
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
						$config_pagination['total_rows'] = $val['total_data'];
					}
				}
			}
		}

		$this->pagination->initialize($config_pagination);
		$this->result['pagination'] = $this->pagination->create_links();
		$this->result['no'] = (($clause['page'] * $clause['limit']) - $clause['limit']) + 1;

		$this->template->title = 'User Requests Data';
		$this->template->content->view('templates/back/UserRequests/index', $this->result);

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

			$request = $this->UsersModel->getDetail($id);

			if ($request['status'] == 'success') {
				$result = [
					'status' => 'success',
					'data' => $request['data']
				];

				unset($result['message']);
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
				'username'				=> strtolower($input['username']),
				'password'				=> $input['password'],
				'user_level_id'			=> $input['user_level'],
				'register_user_id'		=> $session['id'],
				'is_register'			=> 1,
				'is_request_register'	=> '0'
			];

			$data = array_map('strClean', $data);

			$request = $this->UsersModel->update($data, $id);

			if ($request['status'] == 'success') {
                setFlashSuccess('Data successfully registered.');

                $result['status'] = 'success';
                unset($result['message']);
				// $result['message'] = 'Data successfully registered.';
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
				'rules' => 'trim|required|max_length[30]|callback__checkUsername['.$id.']|xss_clean'
			],
            [
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required|min_length[4]|max_length[10]|xss_clean'
			],
            [
				'field' => 'password_repeat',
				'label' => 'Password Repeat',
				'rules' => 'trim|required|matches[password]|xss_clean'
			],
			[
				'field' => 'user_level',
				'label' => 'User Level',
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
