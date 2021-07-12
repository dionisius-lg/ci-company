<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remote extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');

		$this->result = [];
	}

	/**
	 *  getUsers getCities
	 *  get all cities data, return json
	 */
	public function getCities()
	{
		$session = $this->session->userdata('AuthUser');

		if ($this->input->is_ajax_request()) {
			$this->load->model('CitiesModel');

			$input = array_map('trim', $this->input->post());

			if (array_key_exists('id', $input)) {
				if (is_numeric($input['id'])) {
					$request = $this->CitiesModel->getDetail($input['id']);
				}
			} else {
				$condition = [];

				if (!array_key_exists('is_active', $input)) {
					$input['is_active'] = 1;
				}

				foreach ($input as $key => $val) {
					if (!empty($val)) {
						$condition[$key] = $val;
					}
				}

				$request = $this->CitiesModel->getAll($condition);

			}

			if ($request['status'] == 'success') {
				$this->result = $request;
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  getUsers method
	 *  get all users data, return json
	 */
	public function getUsers()
	{
		$session = $this->session->userdata('AuthUser');

		if ($this->input->is_ajax_request()) {
			$this->load->model('UsersModel');

			$input = array_map('trim', $this->input->post());

			if (array_key_exists('id', $input)) {
				if (is_numeric($input['id'])) {
					$request = $this->UsersModel->getDetail($input['id']);
				}
			} else {
				$condition = [];

				if (!array_key_exists('is_active', $input)) {
					$input['is_active'] = 1;
				}

				foreach ($input as $key => $val) {
					if (!empty($val)) {
						$condition[$key] = $val;
					}
				}

				$request = $this->UsersModel->getAll($condition);

			}

			if ($request['status'] == 'success') {
				$this->result = $request;
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  getSuplementaryQuestions method
	 *  get all suplementary questions data, return json
	 */
	public function getSuplementaryQuestions()
	{
		$session = $this->session->userdata('AuthUser');

		if ($this->input->is_ajax_request()) {
			$this->load->model('SuplementaryQuestionsModel');

			$input = array_map('trim', $this->input->post());

			if (array_key_exists('id', $input)) {
				if (is_numeric($input['id'])) {
					$request = $this->SuplementaryQuestionsModel->getDetail($input['id']);
				}
			} else {
				$condition = [];

				if (!array_key_exists('is_active', $input)) {
					$input['is_active'] = 1;
				}

				foreach ($input as $key => $val) {
					if (!empty($val)) {
						$condition[$key] = $val;
					}
				}

				$request = $this->SuplementaryQuestionsModel->getAll($condition);

			}

			if ($request['status'] == 'success') {
				$this->result = $request;
			}

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  getWorkerPreviousEmploymentsDatatable method
	 *  get all worker previous employments data, return json on datatables
	 */
	public function getWorkerPreviousEmploymentsDatatable($worker_id = 0)
	{
		$session = $this->session->userdata('AuthUser');

		if ($this->input->is_ajax_request()) {
			$this->load->model('WorkerPreviousEmploymentsModel');

			$list	= $this->WorkerPreviousEmploymentsModel->getDatatables($worker_id);
			$no		= $_POST['start'];
			$data	= [];

			foreach ($list as $col) {
				$no++;

				$row	= [];
				$row[]	= $no;
				$row[]	= unStrClean($col['employer_name']);
				$row[]	= unStrClean($col['working_area']);
				$row[]	= unStrClean($col['country']);
				$row[]	= unStrClean($col['period']);
				$row[] = form_button(['type' => 'button', 'class' => 'btn btn-info btn-xs rounded-0', 'content' => '<i class="fa fa-eye fa-fw"></i>', 'title' => 'Detail', 'onclick' => 'detailDataPreviousEmployment(' . $col['id'] . ')']) . form_button(['type' => 'button', 'class' => 'btn btn-danger btn-xs rounded-0', 'content' => '<i class="fa fa-trash fa-fw"></i>', 'title' => 'Delete', 'onclick' => 'deleteDataPreviousEmployment(' . $col['id'] . ')']);

				$data[]	= $row; 
			}

			$this->result = [
				'draw'				=> $_POST['draw'],
				'recordsTotal'		=> $this->WorkerPreviousEmploymentsModel->getAll(['worker_id' => $worker_id])['total_data'],
				'recordsFiltered'	=> $this->WorkerPreviousEmploymentsModel->countDatatablesFilter($worker_id),
				'data'				=> $data
			];

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  getWorkerSuplementaryQuestionsDatatable method
	 *  get all worker suplementary questions data, return json on datatables
	 */
	public function getWorkerSuplementaryQuestionsDatatable($worker_id = 0)
	{
		$session = $this->session->userdata('AuthUser');

		if ($this->input->is_ajax_request()) {
			$this->load->model('WorkerSuplementaryQuestionsModel');

			$list	= $this->WorkerSuplementaryQuestionsModel->getDatatables($worker_id);
			$no		= $_POST['start'];
			$data	= [];

			foreach ($list as $col) {
				$no++;

				$row	= [];
				$row[]	= $no;
				$row[]	= unStrClean($col['question']);
				$row[]	= unStrClean($col['answer']);
				$row[] = form_button(['type' => 'button', 'class' => 'btn btn-info btn-xs rounded-0', 'content' => '<i class="fa fa-eye fa-fw"></i>', 'title' => 'Detail', 'onclick' => 'detailDataSuplementaryQuestion(' . $col['id'] . ')']) . form_button(['type' => 'button', 'class' => 'btn btn-danger btn-xs rounded-0', 'content' => '<i class="fa fa-trash fa-fw"></i>', 'title' => 'Delete', 'onclick' => 'deleteDataSuplementaryQuestion(' . $col['id'] . ')']);

				$data[]	= $row; 
			}

			$this->result = [
				'draw'				=> $_POST['draw'],
				'recordsTotal'		=> $this->WorkerSuplementaryQuestionsModel->getAll(['worker_id' => $worker_id])['total_data'],
				'recordsFiltered'	=> $this->WorkerSuplementaryQuestionsModel->countDatatablesFilter($worker_id),
				'data'				=> $data
			];

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 *  getWorkerAttachmentsDatatable method
	 *  get all worker attachments data, return json on datatables
	 */
	public function getWorkerAttachmentsDatatable($worker_id = 0)
	{
		$session = $this->session->userdata('AuthUser');

		if ($this->input->is_ajax_request()) {
			$this->load->model('WorkerAttachmentsModel');

			$list	= $this->WorkerAttachmentsModel->getDatatables($worker_id);
			$no		= $_POST['start'];
			$data	= [];

			foreach ($list as $col) {
				$no++;

				if (@fopen(base_url('files/workers/' . $col['worker_id'] . '/' . $col['file_name']), 'r')) {
					$download_file = 'saveAs(\'' . base_url('files/workers/' . $col['worker_id'] . '/' . $col['file_name']) . '\', \'' . $col['file_name'] . '\')';
				} else {
					$download_file = 'return swalAlert(\'File not found\');';
				}

				$row	= [];
				$row[]	= $no;
				$row[]	= unStrClean($col['name']);
				$row[]	= $col['create_date'];
				$row[]	= $col['create_by'];
				$row[] = form_button(['type' => 'button', 'class' => 'btn btn-info btn-xs rounded-0', 'content' => '<i class="fa fa-download fa-fw"></i>', 'title' => 'Download', 'onclick' => $download_file]) . form_button(['type' => 'button', 'class' => 'btn btn-danger btn-xs rounded-0', 'content' => '<i class="fa fa-trash fa-fw"></i>', 'title' => 'Delete', 'onclick' => 'deleteAttachment(' . $col['id'] . ')']);

				$data[]	= $row; 
			}

			$this->result = [
				'draw'				=> $_POST['draw'],
				'recordsTotal'		=> $this->WorkerAttachmentsModel->getAll(['worker_id' => $worker_id])['total_data'],
				'recordsFiltered'	=> $this->WorkerAttachmentsModel->countDatatablesFilter($worker_id),
				'data'				=> $data
			];

			echo json_encode($this->result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}
}
