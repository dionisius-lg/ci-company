<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyAdvantages extends CI_Controller {
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

		$this->load->model('CompanyAdvantagesModel');
	}

	private $upload_errors = [];

	public function index()
	{
		$this->template->title = 'Company Advantages';
		$this->template->content->view('templates/back/company_advantages/index');

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

			$request = $this->CompanyAdvantagesModel->getDetail($id);

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
				'title_eng'			=> ucwords($input['title_eng']),
				'title_ind'			=> ucwords($input['title_ind']),
				'detail_eng'		=> nl2space($input['detail_eng']),
				'detail_ind'		=> nl2space($input['detail_ind']),
				'create_user_id'	=> $session['id']
			];

			$data = array_map('strClean', $data);

			$request = $this->CompanyAdvantagesModel->insert($data);

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
				'title_eng'			=> ucwords($input['title_eng']),
				'title_ind'			=> ucwords($input['title_ind']),
				'detail_eng'		=> nl2space($input['detail_eng']),
				'detail_ind'		=> nl2space($input['detail_ind']),
				'update_user_id'	=> $session['id']
			];

			$data = array_map('strClean', $data);

			$request = $this->CompanyAdvantagesModel->update($data, $id);

			if ($request['status'] == 'success') {
				$result['status'] = 'success';
				$result['message'] = 'Data successfully updated.';
			}

			echo json_encode($result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete($id)
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

			$request = $this->CompanyAdvantagesModel->delete($id);

			if ($request['status'] == 'success') {
				$result['status'] = 'success';
				$result['message'] = 'Data successfully deleted.';
			}

			echo json_encode($result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	private function validate($file = false, $id = 0)
	{
		$validate = [
			[
				'field' => 'title_eng',
				'label' => 'Title (Eng)',
				'rules' => 'trim|required|max_length[100]|callback__regexName|xss_clean'
			],
			[
				'field' => 'title_ind',
				'label' => 'Title (Ind)',
				'rules' => 'trim|required|max_length[100]|callback__regexName|xss_clean'
			],
			[
				'field' => 'detail_eng',
				'label' => 'Description (Eng)',
				'rules' => 'trim|max_length[255]|callback__regexName|xss_clean'
			],
			[
				'field' => 'detail_ind',
				'label' => 'Description (Ind)',
				'rules' => 'trim|max_length[255]|callback__regexName|xss_clean'
			]
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
}
