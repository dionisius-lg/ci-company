<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sliders extends CI_Controller {
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

		$this->load->model('SlidersModel');
	}

	private $upload_errors = [];

	public function index()
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [];

		$this->template->title = 'Sliders';
		$this->template->content->view('templates/back/sliders/index');

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

			$request = $this->SlidersModel->getDetail($id);

			if ($request['status'] == 'success') {
				$result = [
					'status' => 'success',
					'file' => @getimagesize(base_url('files/sliders/'.$request['data']['picture'])) ? base_url('files/sliders/'.$request['data']['picture']) : '',
					'order_number' => $request['data']['order_number'],
					'link_to' => $request['data']['link_to']
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
			$file = true;

			$input['picture'] = $_FILES['picture'];

			$file_path = './files/sliders/';

			if (!is_dir($file_path)) {
				mkdir($file_path, 0777, true);
			}

			$config_file = [
				'upload_path' => $file_path,
				'allowed_types' => 'jpg|jpeg|png',
				'max_size' => '500',
				//'max_width' => '1200',
				//'max_height' => '675',
				'encrypt_name' => true,
				//'file_name' => 'slider'.time()
			];

			$this->load->library('upload', $config_file);

			if ($this->upload->do_upload('picture')) {
				$upload_data = $this->upload->data();

				$config_resize = [
					'image_library' => 'gd2',
					'source_image' => $upload_data['full_path'],
					'create_thumb' => false,
					'maintain_ratio' => true,
					'quality' => '50%',
					'width' => '1200',
					'height' => '675',
					'new_image' => $upload_data['full_path'],
					//'new_image' => $file_path,
				];

				$this->load->library('image_lib', $config_resize);
				$this->image_lib->resize();
				$this->image_lib->clear();
			} else {
				$this->upload_errors['file'] = $this->upload->display_errors('','');
			}

			$validate = $this->validate($file);

			$this->form_validation->set_rules($validate);
			$this->form_validation->set_error_delimiters('','');

			$this->form_validation->set_rules($validate);
			$this->form_validation->set_error_delimiters('','');

			if ($this->form_validation->run() == false) {
				foreach ($input as $key => $val) {
					$result['error'][$key] = form_error($key);
				}

				echo json_encode($result); exit();
			}

			$data = [
				'order_number'		=> $input['order_number'],
				'link_to'			=> $input['link_to'],
			];

			$data = array_map('strClean', $data);

			$data['picture'] = $upload_data['file_name'];

			$request = $this->SlidersModel->insert($data);

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

			if (is_uploaded_file($_FILES['picture']['tmp_name'])) {
				$input['picture'] = $_FILES['picture'];
				$file = true;
			}

			if ($file) {
				$file_path = './files/sliders/';

				if (!is_dir($file_path)) {
					mkdir($file_path, 0777, true);
				}

				$config_file = [
					'upload_path' => $file_path,
					'allowed_types' => 'jpg|jpeg|png',
					'max_size' => '500',
					'encrypt_name' => true,
					//'file_name' => 'slider'.time()
				];

				$this->load->library('upload', $config_file);

				if (!$this->upload->do_upload('logo')) {
					$this->upload_errors['file'] = $this->upload->display_errors('','');
				} else {
					$upload_data = $this->upload->data();

					$config_resize = [
						'image_library' => 'gd2',
						'source_image' => $upload_data['full_path'],
						'create_thumb' => false,
						'maintain_ratio' => true,
						'quality' => '50%',
						'width' => '1200',
						'height' => '675',
						'new_image' => $upload_data['full_path']
					];

					$this->load->library('image_lib', $config_resize);
					$this->image_lib->resize();
					$this->image_lib->clear();
				}
			}

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
				'order_number'		=> $input['order_number'],
				'link_to'			=> $input['link_to'],
			];

			$data = array_map('strClean', $data);

			if ($file) {
				$data['picture'] = $upload_data['file_name'];

				$request = $this->SlidersModel->getDetail($id);

				$file_old = null;

				if ($request['status'] == 'success') {
					$file_old = $request['data']['picture'];
				}
			}

			$request = $this->SlidersModel->update($data, $id);

			if ($request['status'] == 'success') {
				$result['status'] = 'success';
				$result['message'] = 'Data successfully updated.';

				if ($file) {
					if (file_exists($file_path.$file_old)) {
						unlink($file_path.$file_old);
					}
				}
			} else {
				if ($file) {
					if (file_exists($file_path.$upload_data['file_name'])) {
						unlink($file_path.$upload_data['file_name']);
					}
				}
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

			$file_old = null;

			$request = $this->SlidersModel->getDetail($id);

			if ($request['status'] == 'success') {
				$file_old = './files/sliders/'.$request['data']['picture'];
			}

			$request = $this->SlidersModel->delete($id);

			if ($request['status'] == 'success') {
				$result['status'] = 'success';
				$result['message'] = 'Data successfully deleted.';

				if (!empty($file_old)) {
					if (file_exists($file_old)) {
						unlink($file_old);
					}
				}
			}

			echo json_encode($result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	private function validate($file = false, $id = 0)
	{
		$validate = [
			[
				'field' => 'order_number',
				'label' => 'Order',
				'rules' => 'trim|numeric|xss_clean'
			],
			[
				'field' => 'link_to',
				'label' => 'Link To',
				'rules' => 'trim|valid_url|xss_clean'
			],
		];

		if ($file) {
			$validate[] = [
				'field' => 'picture',
				'label' => 'Slider',
				'rules' => 'trim|callback__errorFile|xss_clean'
			];
		}

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
