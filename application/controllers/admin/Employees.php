<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {
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

		$this->load->model('EmployeesModel');
		$this->load->model('ProvincesModel');
		$this->load->model('UserLevelsModel');

		//$this->config->set_item('language', 'indonesian'); 
	}

	private $upload_errors = [];

	public function index()
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [];

		
		$this->template->title = 'Employees Data';
		$this->template->content->view('templates/back/employees/index');

		$this->template->publish();
	}

	public function add()
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [];

		$request = [
			'provinces' => $this->ProvincesModel->getAll(['limit' => 100]),
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

		$this->template->title = 'Employees Data';
		$this->template->content->view('templates/back/employees/add', $result);

		$this->template->publish();
	}

	public function detail($id = null)
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [];

		if (!empty($id) && is_numeric($id)) {
			$request = [
				'employees' => $this->EmployeesModel->getDetail($id),
				'provinces' => $this->ProvincesModel->getAll(['limit' => 100]),
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

			if (empty($result['employees'])) {
				setFlashError('An error occurred, please try again.');
				redirect($_SERVER['HTTP_REFERER']);
			}

			$this->template->title = 'Employees Data';
			$this->template->content->view('templates/back/employees/detail', $result);

			$this->template->publish();
		} else {
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function create()
	{
		$session = $this->session->userdata('AuthUser');
		$result = [];

		if ($this->input->method() == 'post') {
			$input = array_map('trim', $this->input->post());
			$file = false;

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
				redirect('admin/employees/add/');
			}

			$data = [
				'nik' => $input['nik'],
				'fullname' => ucwords($input['fullname']),
				'email' => strtolower($input['email']),
				'phone_1' => $input['phone_1'],
				'phone_2' => $input['phone_2'],
				'birth_place' => ucwords($input['birth_place']),
				'birth_date' => $input['birth_date'],
				'gender_id' => $input['gender'],
				'address' => nl2space(ucwords($input['address'])),
				'city_id' => $input['city'],
				'province_id' => $input['province'],
				'religion_id' => $input['religion'],
				'create_user_id' => $session['id'],
				'country_id' => 1,
				'description' => $input['description']
			];

			$data = array_map('strClean', $data);

			$request = $this->EmployeesModel->insert($data);

			if ($request['status'] == 'success') {
				setFlashSuccess('Data successfully created.');
				redirect('admin/employees/detail/'.$request['data']['id']);
			} else {
				setFlashError('An error occurred, please try again.');
				setOldInput($input);
				redirect('admin/employees/add');
			}
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function update($id)
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [];

		if ($this->input->method() == 'post') {
			$input = array_map('trim', $this->input->post());
			$file = false;

			$validate = $this->validate($file, $id);

			$this->form_validation->set_rules($validate);
			$this->form_validation->set_error_delimiters('','');

			if ($this->form_validation->run() == false) {
				foreach ($input as $key => $val) {
					if (!empty(form_error($key))) {
						setFlashError(form_error($key), $key);
					}
				}

				setOldInput($input);

				redirect('admin/employees/detail/'.$id);
			}

			$data = [
				'nik' => $input['nik'],
				'fullname' => ucwords($input['fullname']),
				'email' => strtolower($input['email']),
				'phone_1' => $input['phone_1'],
				'phone_2' => $input['phone_2'],
				'birth_place' => ucwords($input['birth_place']),
				'birth_date' => $input['birth_date'],
				'gender_id' => $input['gender'],
				'address' => nl2space(ucwords($input['address'])),
				'city_id' => $input['city'],
				'province_id' => $input['province'],
				'religion_id' => $input['religion'],
				'create_user_id' => $session['id'],
				'country_id' => 1,
				'description' => $input['description']
			];

			$data = array_map('strClean', $data);

			$request = $this->EmployeesModel->update($data, $id);

			if ($request['status'] == 'success') {
				setFlashSuccess('Data successfully updated.');
			} else {
				setFlashError('An error occurred, please try again.');
				setOldInput($input);
			}

			redirect('admin/employees/detail/'.$id);
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

			$request = $this->EmployeesModel->update($data, $id);

			if ($request['status'] == 'success') {
				$result['status'] = 'success';
				$result['message'] = 'Data successfully deleted.';
			}

			echo json_encode($result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function uploadPhoto($id = null)
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

			$request = $this->EmployeesModel->getDetail($id);

			if ($request['status'] == 'success' && $request['total_data'] == 1) {
				$employees = $request['data'];

				$file_path = './files/employees/'.$id.'/';
				$thumb_path = $file_path.'thumb/';

				if (!is_dir($file_path)) {
					mkdir($file_path, 0777, true);
				}

				if (!is_dir($thumb_path)) {
					mkdir($thumb_path, 0777, true);
				}

				$config_file = [
					'upload_path' => $file_path,
					'allowed_types' => 'jpg|jpeg|png',
					'max_size' => '150',
					//'max_width' => '1024',
					//'max_height' => '768',
					'encrypt_name' => true,
					//'file_name' => 'employees_'.time()
				];

				$this->load->library('upload', $config_file);

				if (!$this->upload->do_upload('photo')) {
					$result['error'] = $this->upload->display_errors('','');
					echo json_encode($result); exit();
				}

				$upload_data = $this->upload->data();

				$config_resize = [
					'image_library' => 'gd2',
					'source_image' => $upload_data['full_path'],
					'create_thumb' => false,
					'maintain_ratio' => true,
					'quality' => '50%',
					'width' => 120,
					//'height' => 340,
					'new_image' => $thumb_path
				];

				$this->load->library('image_lib', $config_resize);
				$this->image_lib->resize();

				$data = [
					'photo'				=> $upload_data['file_name'],
					'update_user_id'	=> $session['id']
				];

				$request = $this->EmployeesModel->update($data, $id);

				if ($request['status'] == 'success') {
					$result['status'] = 'success';
					$result['message'] = 'Photo successfully updated.';

					$file_url = base_url('files/employees/'.$id.'/');
					$result['data']['file'] = base_url(substr($file_path, 2).$data['photo']);
					$result['data']['thumb'] = base_url(substr($thumb_path, 2).$data['photo']);

					if (file_exists($file_path.$employees['photo'])) {
						unlink($file_path.$employees['photo']);
					}

					if (file_exists($thumb_path.$employees['photo'])) {
						unlink($thumb_path.$employees['photo']);
					}
				}
			}

			echo json_encode($result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	private function validate($file = false, $id = null)
	{
		$validate = [
			[
				'field' => 'nik',
				'label' => 'NIK',
				'rules' => 'trim|required|max_length[20]|callback__regexNumeric|callback__checkNik['.$id.']|xss_clean'
			],
			[
				'field' => 'fullname',
				'label' => 'Fullname',
				'rules' => 'trim|required|max_length[100]|callback__regexName|xss_clean'
			],
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|max_length[100]|valid_email|callback__checkEmail['.$id.']|xss_clean'
			],
			[
				'field' => 'phone_1',
				'label' => 'Phone 1',
				'rules' => 'trim|required|max_length[30]|callback__regexNumeric|xss_clean'
			],
			[
				'field' => 'phone_2',
				'label' => 'Phone 2',
				'rules' => 'trim|max_length[30]|callback__regexNumeric|xss_clean'
			],
			[
				'field' => 'birth_place',
				'label' => 'Birth Place',
				'rules' => 'trim|max_length[100]|callback__regexName|xss_clean'
			],
			[
				'field' => 'birth_date',
				'label' => 'Birth Date',
				'rules' => 'trim|max_length[20]|callback__formatDate|xss_clean'
			],
			[
				'field' => 'gender',
				'label' => 'Gender',
				'rules' => 'trim|callback__regexNumeric|xss_clean'
			],
			[
				'field' => 'address',
				'label' => 'Address',
				'rules' => 'trim|max_length[255]|callback__regexAddress|xss_clean'
			],
			[
				'field' => 'city',
				'label' => 'City',
				'rules' => 'trim|callback__regexNumeric|xss_clean'
			],
			[
				'field' => 'province',
				'label' => 'Province',
				'rules' => 'trim|callback__regexNumeric|xss_clean'
			],
			[
				'field' => 'religion',
				'label' => 'Religion',
				'rules' => 'trim|max_length[1]|callback__regexNumeric|xss_clean'
			],
			[
				'field' => 'user_id',
				'label' => 'User',
				'rules' => 'trim|callback__checkUserId['.$id.']|xss_clean'
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

	public function _checkNik($str = false, $id = 0)
	{
		if ($str) {
			$term = ['nik' => $str];

			if (!empty($id) && is_numeric($id)) {
				$term['not_id'] = $id;
			}

			$request = $this->EmployeesModel->getAll($term);

			if ($request['total_data'] > 0) {
				$this->form_validation->set_message('_checkNik', '%s already exist');
				return false;
			}
		}

		return true;
	}

	public function _checkEmail($str = false, $id = 0)
	{
		if ($str) {
			$term = ['email' => $str];

			if (!empty($id) && is_numeric($id)) {
				$term['not_id'] = $id;
			}

			$request = $this->EmployeesModel->getAll($term);

			if ($request['total_data'] > 0) {
				$this->form_validation->set_message('_checkEmail', '%s already exist');
				return false;
			}
		}

		return true;
	}

	public function _checkUserId($str = false, $id = 0)
	{
		if ($str) {
			$term = ['user_id' => $str];

			if (!empty($id) && is_numeric($id)) {
				$term['not_id'] = $id;
			}

			$request = $this->EmployeesModel->getAll($term);

			if ($request['total_data'] > 0) {
				$this->form_validation->set_message('_checkUserId', '%s already used on other employees');
				return false;
			}
		}

		return true;
	}
}
