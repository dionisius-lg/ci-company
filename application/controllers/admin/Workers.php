<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Workers extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		if (!$this->session->has_userdata('AuthUser')) {
			$this->session->set_userdata('referer', current_url());
			$this->config->item('language', sitelang());
			setFlashError($this->lang->line('error')['auth'], 'auth');
			redirect('auth');
		}

		if ($this->session->userdata('AuthUser')['user_level_id'] != 1) {
			// redirect($_SERVER['HTTP_REFERER']);
			redirect(base_url(), 'refresh');
		}
		
		$this->template->set_template('layouts/back');
		$this->template->title = 'Workers Data';

		// $this->load->library('user_agent');

		// load default models
		$this->load->model('CompanyModel');
		$this->load->model('ExperiencesModel');
		$this->load->model('AgencyLocationsModel');
		$this->load->model('ProvincesModel');
		$this->load->model('UserLevelsModel');
		$this->load->model('WorkersModel');
		$this->load->model('WorkerAttachmentsModel');

		// load default data
		$this->result['company'] = [];
		if ($this->CompanyModel->get()['status'] == 'success') {
			$this->result['company'] = $this->CompanyModel->get()['data'];
		}

		// load socket helper
		$this->load->helper('socket');

		//$this->config->set_item('language', 'indonesian'); 
	}

	private $upload_errors = [];

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
			'limit'				=> 10,
			'page'				=> (array_key_exists('page', $params) && is_numeric($params['page'])) ? $params['page'] : 1,
			'like_nik'			=> array_key_exists('nik', $params) ? $params['nik'] : '',
			'like_fullname'		=> array_key_exists('fullname', $params) ? $params['fullname'] : '',
			'like_email'		=> array_key_exists('email', $params) ? $params['email'] : '',
			'placement_id'		=> array_key_exists('placement', $params) ? $params['placement'] : '',
			'booking_status_id'	=> array_key_exists('booking_status', $params) ? $params['booking_status'] : '',
			'order'				=> 'fullname',
			'sort'				=> 'asc'
		];

		$request = [
			'workers' => $this->WorkersModel->getAll($clause),
			'placements' => $this->AgencyLocationsModel->getAll(['order' => 'name', 'limit' => 100]),
			'user_levels' => $this->UserLevelsModel->getAll(['order' => 'name'])
		];

		foreach ($request as $key => $val) {
			$this->result[$key] = [];

			if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
				if ($request[$key]['status'] == 'success') {
					$this->result[$key] = $val['data'];

					if ($key == 'workers') {
						$total = $val['total_data'];
					}
				}
			}
		}

		$this->result['pagination'] = bs4pagination('admin/workers', $total, $clause['limit'], $params);
		$this->result['no'] = (($clause['page'] * $clause['limit']) - $clause['limit']) + 1;

		$this->template->content->view('templates/back/Workers/index', $this->result);
		$this->template->publish();
	}

	/**
	 *  add method
	 *  add page
	 */
	public function add()
	{
		$session = $this->session->userdata('AuthUser');

		$request = [
			'experiences' => $this->ExperiencesModel->getAll(['order' => 'name', 'limit' => 100]),
			'placements' => $this->AgencyLocationsModel->getAll(['order' => 'name', 'limit' => 100]),
			'user_levels' => $this->UserLevelsModel->getAll(['order' => 'name']),
			'provinces' => $this->ProvincesModel->getAll(['order' => 'name', 'limit' => 100])
		];

		foreach ($request as $key => $val) {
			$this->result[$key] = [];

			if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
				if ($request[$key]['status'] == 'success') {
					$this->result[$key] = $val['data'];
				}
			}
		}

		$this->template->content->view('templates/back/Workers/add', $this->result);
		$this->template->publish();
	}

	/**
	 *  detail method
	 *  detail page
	 */
	public function detail($id = null)
	{
		$session = $this->session->userdata('AuthUser');

		if (!empty($id) && is_numeric($id)) {
			$request = [
				'worker' => $this->WorkersModel->getDetail($id),
				'experiences' => $this->ExperiencesModel->getAll(['order' => 'name', 'limit' => 100]),
				'placements' => $this->AgencyLocationsModel->getAll(['order' => 'name', 'limit' => 100]),
				'user_levels' => $this->UserLevelsModel->getAll(['order' => 'name']),
				'provinces' => $this->ProvincesModel->getAll(['order' => 'name', 'limit' => 100])
			];

			foreach ($request as $key => $val) {
				$this->result[$key] = [];
	
				if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
					if ($request[$key]['status'] == 'success') {
						$this->result[$key] = $val['data'];
					}
				}
			}

			if (empty($this->result['worker'])) {
				setFlashError('An error occurred, please try again.');
				redirect($_SERVER['HTTP_REFERER']);
			}

			$this->template->content->view('templates/back/Workers/detail', $this->result);
			$this->template->publish();
		} else {
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	/**
	 *  create method
	 *  create data
	 */
	public function create()
	{
		$session = $this->session->userdata('AuthUser');

		if ($this->input->method() == 'post') {
			$input = $this->input->post();

			if (array_key_exists('experience', $input)) {
				sort($input['experience']);
				$input['experience'] = implode(',', $input['experience']);
			} else {
				$input['experience'] = '';
			}

			if (array_key_exists('oversea_experience', $input)) {
				sort($input['oversea_experience']);
				$input['oversea_experience'] = implode(',', $input['oversea_experience']);
			} else {
				$input['oversea_experience'] = '';
			}

			if (array_key_exists('ready_placement', $input)) {
				sort($input['ready_placement']);
				$input['ready_placement'] = implode(',', $input['ready_placement']);
			} else {
				$input['ready_placement'] = '';
			}

			$input = array_map('trim', $input);
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

				redirect('admin/workers/add');
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
				'marital_status_id' => $input['marital_status'],
				'religion_id' => $input['religion'],
				'address' => nl2space(ucwords($input['address'])),
				'province_id' => $input['province'],
				'city_id' => $input['city'],
				'religion_id' => $input['religion'],
				'description' => nl2space($input['description']),
				'link_video' => $input['link_video'],
				'experience_ids' => $input['experience'],
				'oversea_experience_ids' => $input['oversea_experience'],
				'ready_placement_ids' => $input['ready_placement'],
				'placement_id' => $input['placement'],
				'create_user_id' => $session['id']
			];

			$data = array_map('strClean', $data);

			$request = $this->WorkersModel->insert($data);

			if ($request['status'] == 'success') {
				setFlashSuccess('Data successfully created.');
				socketEmit('count-total');
			} else {
				setFlashError('An error occurred, please try again.');
				setOldInput($input);
			}

			redirect('admin/workers/detail/' . $request['data']['id']);
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  update method
	 *  update data by id
	 */
	public function update($id)
	{
		$session = $this->session->userdata('AuthUser');

		if ($this->input->method() == 'post') {
			$input = $this->input->post();

			if (array_key_exists('experience', $input)) {
				sort($input['experience']);
				$input['experience'] = implode(',', $input['experience']);
			} else {
				$input['experience'] = '';
			}

			if (array_key_exists('oversea_experience', $input)) {
				sort($input['oversea_experience']);
				$input['oversea_experience'] = implode(',', $input['oversea_experience']);
			} else {
				$input['oversea_experience'] = '';
			}

			if (array_key_exists('ready_placement', $input)) {
				sort($input['ready_placement']);
				$input['ready_placement'] = implode(',', $input['ready_placement']);
			} else {
				$input['ready_placement'] = '';
			}

			$input = array_map('trim', $input);
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

				redirect('admin/workers/detail/'.$id);
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
				'marital_status_id' => $input['marital_status'],
				'religion_id' => $input['religion'],
				'address' => nl2space(ucwords($input['address'])),
				'province_id' => $input['province'],
				'city_id' => $input['city'],
				'religion_id' => $input['religion'],
				'description' => nl2space($input['description']),
				'link_video' => $input['link_video'],
				'experience_ids' => $input['experience'],
				'oversea_experience_ids' => $input['oversea_experience'],
				'ready_placement_ids' => $input['ready_placement'],
				'placement_id' => $input['placement'],
				'user_id' => $input['user_id'],
				'update_user_id' => $session['id']
			];

			$data = array_map('strClean', $data);

			$request = $this->WorkersModel->update($data, $id);

			if ($request['status'] == 'success') {
				setFlashSuccess('Data successfully updated.');
			} else {
				setFlashError('An error occurred, please try again.');
				setOldInput($input);
			}

			redirect('admin/workers/detail/'.$id);
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  delete method
	 *  delete data by id, delete attachment by worker id
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

			$request = $this->WorkersModel->getDetail($id);

			if ($request['status'] == 'success' && $request['total_data'] > 0) {
				$worker = $request['data'];

				$file_path = './files/workers/'.$id.'/';
				$thumb_path = $file_path.'thumb/';

				$request = $this->WorkersModel->delete($id);

				if ($request['status'] == 'success') {
					if (!empty($worker['photo'])) {
						if (file_exists($file_path.$worker['photo'])) {
							unlink($file_path.$worker['photo']);
						}

						if (file_exists($thumb_path.$worker['photo'])) {
							unlink($thumb_path.$worker['photo']);
						}
					}

					$request = $this->WorkerAttachmentsModel->getAll(['worker_id' => $id]);

					if ($request['status'] == 'success' && $request['total_data'] > 0) {
						$attachments = $request['data'];

						foreach ($attachments as $attachment) {
							if (!empty($attachment['file_name'])) {
								if (file_exists($file_path.$attachment['file_name'])) {
									unlink($file_path.$attachment['file_name']);
								}
							}
						}
					}

					$request = $this->WorkerAttachmentsModel->deleteByWorker($id);

					$this->result['status'] = 'success';
					unset($this->result['message']);
					setFlashSuccess('Data successfully deleted.');
					socketEmit('count-total');
				}
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  uploadPhoto method
	 *  upload photo by worker id, return json
	 */
	public function uploadPhoto($id = null)
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

			$request = $this->WorkersModel->getDetail($id);

			if ($request['status'] == 'success' && $request['total_data'] == 1) {
				$worker = $request['data'];

				$file_path = './files/workers/'.$id.'/';
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
					// 'max_width' => '1024',
					// 'max_height' => '768',
					'encrypt_name' => true,
					// 'file_name' => 'worker'.time()
				];

				$this->load->library('upload', $config_file);

				if (!$this->upload->do_upload('photo')) {
					$this->result['error'] = $this->upload->display_errors('','');
					echo json_encode($this->result); exit();
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

				$request = $this->WorkersModel->update($data, $id);

				if ($request['status'] == 'success') {
					$this->result['status'] = 'success';
					$this->result['message'] = 'Photo successfully updated.';

					$file_url = base_url('files/workers/'.$id.'/');
					$this->result['data']['file'] = base_url(substr($file_path, 2).$data['photo']);
					$this->result['data']['thumb'] = base_url(substr($thumb_path, 2).$data['photo']);

					if (!empty($worker['photo'])) {
						if (file_exists($file_path.$worker['photo'])) {
							unlink($file_path.$worker['photo']);
						}

						if (file_exists($thumb_path.$worker['photo'])) {
							unlink($thumb_path.$worker['photo']);
						}
					}
				}
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  uploadAttachment method
	 *  upload attachment by worker id, return json
	 */
	public function uploadAttachment($id = null)
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
			$input['attachment_file'] = $_FILES['attachment_file'];

			$request = $this->WorkersModel->getDetail($id);

			if ($request['status'] == 'success' && $request['total_data'] == 1) {
				$worker = $request['data'];

				$file_path = './files/workers/'.$id.'/';

				if (!is_dir($file_path)) {
					mkdir($file_path, 0777, true);
				}

				$config_file = [
					'upload_path' => $file_path,
					'allowed_types' => 'jpg|jpeg|png|doc|docx|xls|xlsx|pdf',
					'max_size' => '5120',
					'encrypt_name' => true,
					// 'file_name' => 'worker'.time()
				];

				$this->load->library('upload', $config_file);

				$upload_data = [];

				if (!$this->upload->do_upload('attachment_file')) {
					$this->upload_errors['file'] = $this->upload->display_errors('','');
				} else {
					$upload_data = $this->upload->data();
				}

				$validate = [
					[
						'field' => 'attachment_file',
						'label' => 'Attachment File',
						'rules' => 'trim|callback__errorFile|xss_clean'
					],
					[
						'field' => 'attachment_name',
						'label' => 'Attachment Name',
						'rules' => 'trim|required|max_length[100]|alpha_numeric_spaces|xss_clean'
					]
				];

				$this->form_validation->set_rules($validate);
				$this->form_validation->set_error_delimiters('','');

				if ($this->form_validation->run() == false) {
					if ($upload_data == true && file_exists($file_path.$upload_data['file_name'])) {
						unlink($file_path.$upload_data['file_name']);
					}

					foreach ($input as $key => $val) {
						$this->result['error'][$key] = form_error($key);
					}
	
					echo json_encode($this->result); exit();
				}

				$data = [
					'name'				=> strClean(ucwords($input['attachment_name'])),
					'file_path'			=> $file_path,
					'file_name'			=> $upload_data['file_name'],
					'file_size'			=> $upload_data['file_size'],
					'file_type'			=> $upload_data['file_type'],
					'worker_id'			=> $id,
					'create_user_id'	=> $session['id']
				];

				$request = $this->WorkerAttachmentsModel->insert($data);

				if ($request['status'] == 'success') {
					$this->result['status'] = 'success';
					$this->result['message'] = 'Attachment successfully uploaded.';
				}
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  deleteAttachment method
	 *  delete attachment by id, return json
	 */
	public function deleteAttachment($id)
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

			$request = $this->WorkerAttachmentsModel->getDetail($id);

			if ($request['status'] == 'success' && $request['total_data'] == 1) {
				$attachment = $request['data'];

				$request = $this->WorkerAttachmentsModel->delete($id);

				if ($request['status'] == 'success') {
					$this->result['status'] = 'success';
					$this->result['message'] = 'Attachment successfully deleted.';

					if (file_exists($attachment['file_path'].$attachment['file_name'])) {
						unlink($attachment['file_path'].$attachment['file_name']);
					}
				}
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  approveBooking method
	 *  approve booking by id
	 */
	public function approveBooking($id = null)
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
				'booking_status_id'	=> 4, // set to approved
				'update_user_id'	=> $session['id'],
			];

			$request = $this->WorkersModel->update($data, $id);

			if ($request['status'] == 'success') {
				$this->result['status'] = 'success';
				unset($this->result['message']);
				setFlashSuccess('Booking request successfully approved.');
				socketEmit('count-total');
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  validate method
	 *  validate data before action
	 */
	private function validate($file = false, $id = null)
	{
		$validate = [
			[
				'field' => 'nik',
				'label' => 'NIK',
				'rules' => 'trim|required|max_length[20]|is_natural|checkWorkersNik['.$id.']|xss_clean'
			],
			[
				'field' => 'fullname',
				'label' => 'Fullname',
				'rules' => 'trim|required|max_length[100]|regexTextInput|xss_clean'
			],
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|max_length[100]|valid_email|checkWorkersEmail['.$id.']|xss_clean'
			],
			[
				'field' => 'phone_1',
				'label' => 'Phone 1',
				'rules' => 'trim|required|max_length[30]|is_natural|xss_clean'
			],
			[
				'field' => 'phone_2',
				'label' => 'Phone 2',
				'rules' => 'trim|max_length[30]|is_natural|xss_clean'
			],
			[
				'field' => 'birth_place',
				'label' => 'Birth Place',
				'rules' => 'trim|required|max_length[100]|regexAlphaSpace|xss_clean'
			],
			[
				'field' => 'birth_date',
				'label' => 'Birth Date',
				'rules' => 'trim|required|max_length[20]|regexDate|xss_clean'
			],
			[
				'field' => 'gender',
				'label' => 'Gender',
				'rules' => 'trim|required|is_natural|xss_clean'
			],
			[
				'field' => 'marital_status',
				'label' => 'Marital Status',
				'rules' => 'trim|required|is_natural|xss_clean'
			],
			[
				'field' => 'religion',
				'label' => 'Religion',
				'rules' => 'trim|is_natural|xss_clean'
			],
			[
				'field' => 'address',
				'label' => 'Address',
				'rules' => 'trim|max_length[255]|regexTextArea|xss_clean'
			],
			[
				'field' => 'province',
				'label' => 'Province',
				'rules' => 'trim|is_natural|xss_clean'
			],
			[
				'field' => 'city',
				'label' => 'City',
				'rules' => 'trim|is_natural|xss_clean'
			],
			[
				'field' => 'description',
				'label' => 'Description',
				'rules' => 'trim|max_length[255]|regexTextArea|xss_clean'
			],
			[
				'field' => 'link_video',
				'label' => 'Video Link',
				'rules' => 'trim|valid_url|filterValidateUrl|xss_clean'
			],
			[
				'field' => 'experience',
				'label' => 'Experience',
				'rules' => 'trim|regexAlphaNumericSpaceComma|xss_clean'
			],
			[
				'field' => 'oversea_experience',
				'label' => 'Oversea Experience',
				'rules' => 'trim|regexAlphaNumericSpaceComma|xss_clean'
			],
			[
				'field' => 'ready_placement',
				'label' => 'Ready to Placement',
				'rules' => 'trim|regexAlphaNumericSpaceComma|xss_clean'
			],
			[
				'field' => 'user_id',
				'label' => 'User',
				'rules' => 'trim|checkWorkersUserId['.$id.']|xss_clean'
			],
		];

		return $validate;
	}

	/**
	 *  _errorFile method
	 *  validate message upload error
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
