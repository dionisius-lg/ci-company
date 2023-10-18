<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Workers extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		if (!$this->session->has_userdata('AuthUser')) {
			// save referer to session
			$this->session->set_userdata('referer', current_url());

			// set site languange
			$this->config->set_item('language', siteLang()['name']);

			// show error message and redirect to login
			// setFlashError($this->lang->line('message')['error']['auth'], 'auth');
			setFlashError('unauthorized', 'auth');
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
		$this->load->model('CookingAbilitiesModel');
		$this->load->model('LanguageAbilitiesModel');
		$this->load->model('SkillExperiencesModel');
		$this->load->model('AgencyLocationsModel');
		$this->load->model('ProvincesModel');
		$this->load->model('UserLevelsModel');
		$this->load->model('WorkersModel');
		$this->load->model('WorkerAttachmentsModel');
		$this->load->model('WorkerPreviousEmploymentsModel');
		$this->load->model('SuplementaryQuestionsModel');
		$this->load->model('WorkerSuplementaryQuestionsModel');

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
			'like_ref_number'	=> array_key_exists('ref_number', $params) ? $params['ref_number'] : '',
			'like_fullname'		=> array_key_exists('fullname', $params) ? $params['fullname'] : '',
			// 'like_email'		=> array_key_exists('email', $params) ? $params['email'] : '',
			// 'like_phone'		=> array_key_exists('phone', $params) ? $params['phone'] : '',
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
			'skill_experiences' => $this->SkillExperiencesModel->getAll(['order' => 'name', 'limit' => 100]),
			'cooking_abilities' => $this->CookingAbilitiesModel->getAll(['order' => 'name', 'limit' => 100]),
			'language_abilities' => $this->LanguageAbilitiesModel->getAll(['order' => 'name', 'limit' => 100]),
			'agency_locations' => $this->AgencyLocationsModel->getAll(['order' => 'name', 'limit' => 100]),
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
				'skill_experiences' => $this->SkillExperiencesModel->getAll(['order' => 'name', 'limit' => 100]),
				'cooking_abilities' => $this->CookingAbilitiesModel->getAll(['order' => 'name', 'limit' => 100]),
				'language_abilities' => $this->LanguageAbilitiesModel->getAll(['order' => 'name', 'limit' => 100]),
				'agency_locations' => $this->AgencyLocationsModel->getAll(['order' => 'name', 'limit' => 100]),
				'suplementary_questions' => $this->SuplementaryQuestionsModel->getAll(['order' => 'question', 'limit' => 1000]),
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

			if (array_key_exists('skill_experience', $input)) {
				sort($input['skill_experience']);
				$input['skill_experience'] = implode(',', $input['skill_experience']);
			} else {
				$input['skill_experience'] = '';
			}

			if (array_key_exists('language_ability', $input)) {
				sort($input['language_ability']);
				$input['language_ability'] = implode(',', $input['language_ability']);
			} else {
				$input['language_ability'] = '';
			}

			if (array_key_exists('cooking_ability', $input)) {
				sort($input['cooking_ability']);
				$input['cooking_ability'] = implode(',', $input['cooking_ability']);
			} else {
				$input['cooking_ability'] = '';
			}

			if (array_key_exists('work_experience', $input)) {
				sort($input['work_experience']);
				$input['work_experience'] = implode(',', $input['work_experience']);
			} else {
				$input['work_experience'] = '';
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
				// personal info
				'ref_number' => strtoupper($input['ref_number']),
				'fullname' => ucwords($input['fullname']),
				'email' => strtolower($input['email']),
				'phone' => $input['phone'],
				'birth_place' => ucwords($input['birth_place']),
				'birth_date' => $input['birth_date'],
				'gender_id' => $input['gender'],
				'marital_status_id' => $input['marital_status'],
				'religion_id' => $input['religion'],
				'last_education_id' => $input['last_education'],
				'height' => $input['height'],
				'weight' => $input['weight'],
				'address' => nl2space($input['address']),
				'province_id' => $input['province'],
				'city_id' => $input['city'],
				'character_evaluation' => $input['character_evaluation'],

				// family background
				'spouse_name' => $input['spouse_name'],
				'spouse_occupation' => $input['spouse_occupation'],
				'children' => $input['children'],
				'children_age' => $input['children_age'],
				'father_name' => $input['father_name'],
				'father_occupation' => $input['father_occupation'],
				'mother_name' => $input['mother_name'],
				'mother_occupation' => $input['mother_occupation'],

				// skills
				'skill_experience_ids' => $input['skill_experience'],
				'language_ability_ids' => $input['language_ability'],
				'cooking_ability_ids' => $input['cooking_ability'],
				'work_experience_ids' => $input['work_experience'],

				// others
				'description' => nl2space($input['description']),
				'link_video' => $input['link_video'],
				'ready_placement_ids' => $input['ready_placement'],
				'placement_id' => $input['placement'],
				'create_user_id' => $session['id']
			];

			$data = array_map('strClean', $data);

			$request = $this->WorkersModel->insert($data);

			if ($request['status'] == 'success') {
				setFlashSuccess('Data successfully created.');
				// socketEmit('count-total');
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

			if (array_key_exists('skill_experience', $input)) {
				sort($input['skill_experience']);
				$input['skill_experience'] = implode(',', $input['skill_experience']);
			} else {
				$input['skill_experience'] = '';
			}

			if (array_key_exists('language_ability', $input)) {
				sort($input['language_ability']);
				$input['language_ability'] = implode(',', $input['language_ability']);
			} else {
				$input['language_ability'] = '';
			}

			if (array_key_exists('cooking_ability', $input)) {
				sort($input['cooking_ability']);
				$input['cooking_ability'] = implode(',', $input['cooking_ability']);
			} else {
				$input['cooking_ability'] = '';
			}

			if (array_key_exists('work_experience', $input)) {
				sort($input['work_experience']);
				$input['work_experience'] = implode(',', $input['work_experience']);
			} else {
				$input['work_experience'] = '';
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
				$asd = [];
				foreach ($input as $key => $val) {
					if (!empty(form_error($key))) {
						setFlashError(form_error($key), $key);
						$asd[$key] = form_error($key);
					}
				}

				setOldInput($input);

				redirect('admin/workers/detail/'.$id);
			}

			$data = [
				// personal info
				'ref_number' => strtoupper($input['ref_number']),
				'fullname' => ucwords($input['fullname']),
				'email' => strtolower($input['email']),
				'phone' => $input['phone'],
				'birth_place' => ucwords($input['birth_place']),
				'birth_date' => $input['birth_date'],
				'gender_id' => $input['gender'],
				'marital_status_id' => $input['marital_status'],
				'religion_id' => $input['religion'],
				'last_education_id' => $input['last_education'],
				'height' => $input['height'],
				'weight' => $input['weight'],
				'address' => nl2space($input['address']),
				'province_id' => $input['province'],
				'city_id' => $input['city'],
				'character_evaluation' => $input['character_evaluation'],

				// family background
				'spouse_name' => $input['spouse_name'],
				'spouse_occupation' => $input['spouse_occupation'],
				'children' => $input['children'],
				'children_age' => $input['children_age'],
				'father_name' => $input['father_name'],
				'father_occupation' => $input['father_occupation'],
				'mother_name' => $input['mother_name'],
				'mother_occupation' => $input['mother_occupation'],

				// skills
				'skill_experience_ids' => $input['skill_experience'],
				'language_ability_ids' => $input['language_ability'],
				'cooking_ability_ids' => $input['cooking_ability'],
				'work_experience_ids' => $input['work_experience'],

				// others
				'description' => nl2space($input['description']),
				'link_video' => $input['link_video'],
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

					$this->WorkerAttachmentsModel->deleteByWorkerId($id);
					$this->WorkerPreviousEmploymentsModel->deleteByWorkerId($id);
					$this->WorkerSuplementaryQuestionsModel->deleteByWorkerId($id);

					$this->result['status'] = 'success';
					unset($this->result['message']);
					setFlashSuccess('Data successfully deleted.');
					// socketEmit('count-total');
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
					// 'encrypt_name' => true,
					'file_name' => 'photo_'.base64url_encode(time())
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
					// 'encrypt_name' => true,
					'file_name' => 'attachment_'.base64url_encode(time())
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
				// socketEmit('count-total');
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  detailPreviousEmployment method
	 *  detail previous employment data, return json
	 */
	public function detailPreviousEmployment($id)
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

			$request = $this->WorkerPreviousEmploymentsModel->getDetail($id);

			if ($request['status'] == 'success') {
				$this->result['status'] = 'success';
				$this->result['data'] = $request['data'];
				unset($this->result['message']);
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  createPreviousEmployment method
	 *  create previous employment data, return json
	 */
	public function createPreviousEmployment($worker_id)
	{
		$session = $this->session->userdata('AuthUser');

		$this->result = [
			'status' => 'error',
			'message' => 'An error occurred, please try again.'
		];

		if ($this->input->method() == 'post') {
			if (empty($worker_id) && !is_numeric($worker_id)) {
				echo json_encode($this->result); exit();
			}

			$input = array_map('trim', $this->input->post());
			$file = false;

			$validate = $this->validatePreviousEmployment($file);

			$this->form_validation->set_rules($validate);
			$this->form_validation->set_error_delimiters('','');

			if ($this->form_validation->run() == false) {
				foreach ($input as $key => $val) {
					$this->result['error'][$key] = form_error($key);
				}

				echo json_encode($this->result); exit();
			}

			if ($input['period_end'] < $input['period_start']) {
				$this->result['error']['period_end'] = 'Period End must be higher than Period Start';

				echo json_encode($this->result); exit();
			}

			$data = [
				'employer_name' => ucwords($input['employer_name']),
				'period' => $input['period_start'] . '-' . $input['period_end'],
				'working_area' => ucwords($input['working_area']),
				'country' => ucwords($input['country']),
				'quit_reason' => nl2space($input['quit_reason']),
				'job_content' => nl2space($input['job_content']),
				'worker_id' => $worker_id,
				'create_user_id' => $session['id']
			];

			$data = array_map('strClean', $data);

			$request = $this->WorkerPreviousEmploymentsModel->insert($data);

			if ($request['status'] == 'success') {
				$this->result['status'] = 'success';
				$this->result['message'] = 'Data successfully created.';
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  updatePreviousEmployment method
	 *  update previous employment data, return json
	 */
	public function updatePreviousEmployment($id)
	{
		$session = $this->session->userdata('AuthUser');

		$this->result = [
			'status' => 'error',
			'message' => 'An error occurred, please try again.'
		];

		if ($this->input->method() == 'post') {
			if (empty($id) && !is_numeric($id)) {
				echo json_encode($this->result); exit();
			}

			$input = array_map('trim', $this->input->post());
			$file = false;

			$validate = $this->validatePreviousEmployment($file);

			$this->form_validation->set_rules($validate);
			$this->form_validation->set_error_delimiters('','');

			if ($this->form_validation->run() == false) {
				foreach ($input as $key => $val) {
					$this->result['error'][$key] = form_error($key);
				}

				echo json_encode($this->result); exit();
			}

			if ($input['period_end'] < $input['period_start']) {
				$this->result['error']['period_end'] = 'Period End must be higher than Period Start';

				echo json_encode($this->result); exit();
			}

			$data = [
				'employer_name' => ucwords($input['employer_name']),
				'period' => $input['period_start'] . '-' . $input['period_end'],
				'working_area' => ucwords($input['working_area']),
				'country' => ucwords($input['country']),
				'quit_reason' => nl2space($input['quit_reason']),
				'job_content' => nl2space($input['job_content']),
				'update_user_id' => $session['id']
			];

			$data = array_map('strClean', $data);

			$request = $this->WorkerPreviousEmploymentsModel->update($data, $id);

			if ($request['status'] == 'success') {
				$this->result['status'] = 'success';
				$this->result['message'] = 'Data successfully updated.';
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  deletePreviousEmployment method
	 *  delete previous employment data, return json
	 */
	public function deletePreviousEmployment($id = null)
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

			$request = $this->WorkerPreviousEmploymentsModel->delete($id);

			if ($request['status'] == 'success') {
				$this->result['status'] = 'success';
				$this->result['message'] = 'Data successfully deleted.';
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  detailSuplementaryQuestion method
	 *  detail suplementary question data, return json
	 */
	public function detailSuplementaryQuestion($id)
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

			$request = $this->WorkerSuplementaryQuestionsModel->getDetail($id);

			if ($request['status'] == 'success') {
				$this->result['status'] = 'success';
				$this->result['data'] = $request['data'];
				unset($this->result['message']);
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  createSuplementaryQuestion method
	 *  create suplementary question data, return json
	 */
	public function createSuplementaryQuestion($worker_id)
	{
		$session = $this->session->userdata('AuthUser');

		$this->result = [
			'status' => 'error',
			'message' => 'An error occurred, please try again.'
		];

		if ($this->input->method() == 'post') {
			if (empty($worker_id) && !is_numeric($worker_id)) {
				echo json_encode($this->result); exit();
			}

			$input = array_map('trim', $this->input->post());
			$file = false;

			$validate = $this->validateSuplementaryQuestion($file);

			$this->form_validation->set_rules($validate);
			$this->form_validation->set_error_delimiters('','');

			if ($this->form_validation->run() == false) {
				foreach ($input as $key => $val) {
					$this->result['error'][$key] = form_error($key);
				}

				echo json_encode($this->result); exit();
			}

			if (empty($input['question_id']) && !is_numeric($input['question_id'])) {
				echo json_encode($this->result); exit();
			}

			$data = [
				'suplementary_question_id' => $input['question_id'],
				'worker_id' => $worker_id,
				'answer' => $input['answer'],
				'create_user_id' => $session['id']
			];

			$data = array_map('strClean', $data);

			$request = $this->WorkerSuplementaryQuestionsModel->insert($data);

			if ($request['status'] == 'success') {
				$this->result['status'] = 'success';
				$this->result['message'] = 'Data successfully created.';
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  deleteSuplementaryQuestion method
	 *  delete suplementary question data, return json
	 */
	public function deleteSuplementaryQuestion($id = null)
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

			$request = $this->WorkerSuplementaryQuestionsModel->delete($id);

			if ($request['status'] == 'success') {
				$this->result['status'] = 'success';
				$this->result['message'] = 'Data successfully deleted.';
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
			// personal data
			[
				'field' => 'ref_number',
				'label' => 'Ref Number',
				'rules' => 'trim|required|max_length[100]|regexTextInput|checkWorkersRefNumber['.$id.']|xss_clean'
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
				'field' => 'phone',
				'label' => 'Phone',
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
				'field' => 'last_education',
				'label' => 'Last Education',
				'rules' => 'trim|is_natural|xss_clean'
			],
			[
				'field' => 'height',
				'label' => 'Height',
				'rules' => 'trim|is_natural|xss_clean'
			],
			[
				'field' => 'weight',
				'label' => 'Weight',
				'rules' => 'trim|is_natural|xss_clean'
			],
			[
				'field' => 'character_evaluation',
				'label' => 'Character Evaluation',
				'rules' => 'trim|max_length[255]|regexTextArea|xss_clean'
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

			// familiy background
			[
				'field' => 'spouse_name',
				'label' => 'Spouse Name',
				'rules' => 'trim|max_length[100]|regexTextInput|xss_clean'
			],
			[
				'field' => 'spouse_occupation',
				'label' => 'Spouse Occupation',
				'rules' => 'trim|max_length[100]|regexTextInput|xss_clean'
			],
			[
				'field' => 'children',
				'label' => 'Children',
				'rules' => 'trim|max_length[100]|regexTextInput|xss_clean'
			],
			[
				'field' => 'children_age',
				'label' => 'Children Age',
				'rules' => 'trim|max_length[100]|regexTextInput|xss_clean'
			],
			[
				'field' => 'father_name',
				'label' => 'Father Name',
				'rules' => 'trim|max_length[100]|regexTextInput|xss_clean'
			],
			[
				'field' => 'father_occupation',
				'label' => 'Father Occupation',
				'rules' => 'trim|max_length[100]|regexTextInput|xss_clean'
			],
			[
				'field' => 'mother_name',
				'label' => 'Mother Name',
				'rules' => 'trim|max_length[100]|regexTextInput|xss_clean'
			],
			[
				'field' => 'mother_occupation',
				'label' => 'Mother Occupation',
				'rules' => 'trim|max_length[100]|regexTextInput|xss_clean'
			],

			// skills
			[
				'field' => 'skill_experience',
				'label' => 'Skill Experience',
				'rules' => 'trim|regexAlphaNumericSpaceComma|xss_clean'
			],
			[
				'field' => 'language_ability',
				'label' => 'Language Ability',
				'rules' => 'trim|regexAlphaNumericSpaceComma|xss_clean'
			],
			[
				'field' => 'cooking_ability',
				'label' => 'Cooking Ability',
				'rules' => 'trim|regexAlphaNumericSpaceComma|xss_clean'
			],
			[
				'field' => 'work_experience',
				'label' => 'Work Experience',
				'rules' => 'trim|regexAlphaNumericSpaceComma|xss_clean'
			],

			// others
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
	 *  validatePreviousEmployment method
	 *  validate previous employment data before action
	 */
	private function validatePreviousEmployment($file = false, $id = null)
	{
		$validate = [
			[
				'field' => 'employer_name',
				'label' => 'Employer Name',
				'rules' => 'trim|max_length[200]|regexTextInput|xss_clean'
			],
			[
				'field' => 'period_start',
				'label' => 'Period Start',
				'rules' => 'trim|required|max_length[100]|regexYear|xss_clean'
			],
			[
				'field' => 'period_end',
				'label' => 'Period End',
				'rules' => 'trim|required|max_length[100]|regexYear|xss_clean'
			],
			[
				'field' => 'working_area',
				'label' => 'Working_area',
				'rules' => 'trim|max_length[100]|regexTextInput|xss_clean'
			],
			[
				'field' => 'country',
				'label' => 'Country',
				'rules' => 'trim|required|max_length[100]|regexAlphaSpace|xss_clean'
			],
			[
				'field' => 'quit_reason',
				'label' => 'Quit Reason',
				'rules' => 'trim|max_length[255]|regexTextArea|xss_clean'
			],
			[
				'field' => 'job_content',
				'label' => 'Job Content',
				'rules' => 'trim|required|max_length[255]|regexTextArea|xss_clean'
			],
		];

		return $validate;
	}

	/**
	 *  validateSuplementaryQuestion method
	 *  validate suplementary question data before action
	 */
	private function validateSuplementaryQuestion($file = false, $id = null)
	{
		$validate = [
			[
				'field' => 'question',
				'label' => 'Question',
				'rules' => 'trim|required|xss_clean'
			],
			[
				'field' => 'answer',
				'label' => 'Answer',
				'rules' => 'trim|required|max_length[255]|regexTextQuestion|xss_clean'
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
