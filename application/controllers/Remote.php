<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remote extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function getCities()
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [];

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
				echo json_encode($request['data']);
			}

			exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function getUsers()
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [];

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
				echo json_encode($request);
			}

			exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function getUsersDatatable()
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [];

		if ($this->input->is_ajax_request()) {
			$this->load->model('UsersModel');

			$list	= $this->UsersModel->getDatatables();
			$no		= $_POST['start'];
			$data	= [];

			foreach ($list as $col) {
				$no++;

				$row	= [];
				$row[]	= $no;
				$row[]	= $col['username'];
				$row[]	= $col['user_level'];
				$row[]	= $col['is_register'] == 1 ? $col['register_date'] : '';
				$row[]	= $col['is_register'] == 1 ? $col['register_by'] : '';
				$row[]	= $col['update_date'];
				$row[]	= $col['update_by'];
				$row[]	= ($col['is_employees'] == 1) ? '<span class="badge bg-primary rounded-0">Employees</span>' : '<span class="badge bg-danger rounded-0">Not Employees</span>';
				$row[]	= ($col['is_register'] == 1) ? '<span class="badge bg-primary rounded-0">Register</span>' : '<span class="badge bg-danger rounded-0 my-1">Not Register</span>';
				$row[]	= '<button type="button" class="btn btn-info btn-xs rounded-0" onclick="detailData(' . $col['id'] . ')" title="Detail"><i class="fa fa-eye fa-fw"></i></button> <button type="button" class="btn btn-danger btn-xs rounded-0 my-1" onclick="deleteData(' . $col['id'] . ')" title="Delete"><i class="fa fa-trash fa-fw"></i></button>';

				$data[]	= $row; 
			}

			$result = [
				'draw'				=> $_POST['draw'],
				'recordsTotal'		=> $this->UsersModel->getAll()['total_data'],
				'recordsFiltered'	=> $this->UsersModel->countDatatablesFilter(),
				'data'				=> $data
			];

			echo json_encode($result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function getEmployees()
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [];

		if ($this->input->is_ajax_request()) {
			$this->load->model('EmployeesModel');

			$input = array_map('trim', $this->input->post());

			if (array_key_exists('id', $input)) {
				if (is_numeric($input['id'])) {
					$request = $this->EmployeesModel->getDetail($input['id']);
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

				$request = $this->EmployeesModel->getAll($condition);

			}

			if ($request['status'] == 'success') {
				echo json_encode($request);
			}

			exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function getEmployeesDatatable()
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [];

		if ($this->input->is_ajax_request()) {
			$this->load->model('EmployeesModel');

			$list	= $this->EmployeesModel->getDatatables();
			$no		= $_POST['start'];
			$data	= [];

			foreach ($list as $col) {
				$no++;

				$row	= [];
				$row[]	= $no;
				$row[]	= $col['nik'];
				$row[]	= $col['fullname'];
				$row[]	= $col['email'];
				$row[]	= $col['create_date'];
				$row[]	= $col['create_by'];
				$row[]	= $col['update_date'];
				$row[]	= $col['update_by'];
				$row[]	= (!empty($col['user_id'])) ? '<span class="badge bg-primary rounded-0">Register</span>' : '<span class="badge bg-danger rounded-0">Not Register</span>';
				$row[]	= '<a href="' . base_url('admin/employees/detail/' . $col['id']) . '" class="btn btn-info btn-xs rounded-0" title="Detail"><i class="fa fa-eye fa-fw"></i></a> <button type="button" class="btn btn-danger btn-xs rounded-0 my-1" onclick="deleteData(' . $col['id'] . ')" title="Delete"><i class="fa fa-trash fa-fw"></i></button>';

				$data[]	= $row; 
			}

			$result = [
				'draw'				=> $_POST['draw'],
				'recordsTotal'		=> $this->EmployeesModel->getAll()['total_data'],
				'recordsFiltered'	=> $this->EmployeesModel->countDatatablesFilter(),
				'data'				=> $data
			];

			echo json_encode($result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function getCompanyAdvantagesDatatable()
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [];

		if ($this->input->is_ajax_request()) {
			$this->load->model('CompanyAdvantagesModel');

			$list	= $this->CompanyAdvantagesModel->getDatatables();
			$no		= $_POST['start'];
			$data	= [];

			foreach ($list as $col) {
				$no++;

				$row	= [];
				$row[]	= $no;
				$row[]	= $col['title_eng'];
				$row[]	= $col['title_ind'];
				$row[]	= $col['create_date'];
				$row[]	= $col['create_by'];
				$row[]	= $col['update_date'];
				$row[]	= $col['update_by'];
				$row[]	= '<button type="button" class="btn btn-info btn-xs rounded-0" onclick="detailData(' . $col['id'] . ')" title="Detail"><i class="fa fa-eye fa-fw"></i></button> <button type="button" class="btn btn-danger btn-xs rounded-0 my-1" onclick="deleteData(' . $col['id'] . ')" title="Delete"><i class="fa fa-trash fa-fw"></i></button>';

				$data[]	= $row; 
			}

			$result = [
				'draw'				=> $_POST['draw'],
				'recordsTotal'		=> $this->CompanyAdvantagesModel->getAll()['total_data'],
				'recordsFiltered'	=> $this->CompanyAdvantagesModel->countDatatablesFilter(),
				'data'				=> $data
			];

			echo json_encode($result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function getSlidersDatatable()
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [];

		if ($this->input->is_ajax_request()) {
			$this->load->model('SlidersModel');

			$list	= $this->SlidersModel->getDatatables();
			$no		= $_POST['start'];
			$data	= [];

			foreach ($list as $col) {
				$no++;

				$row	= [];
				$row[]	= $no;
				$row[]	= @getimagesize(base_url('files/sliders/'.$col['picture'])) ? '<a href="' . base_url('files/sliders/'.$col['picture']) . '" class="venobox" data-href="">View Slider</button>' : 'File not found';
				$row[]	= $col['order_number'];
				$row[]	= !empty($col['link_to']) ? '<div class="text-center text-primary"><i class="fa fa-check fa-fw"></i></div>' : '<div class="text-center text-danger"><i class="fa fa-close fa-fw"></i></div>';
				$row[]	= $col['create_date'];
				$row[]	= $col['create_by'];
				$row[]	= $col['update_date'];
				$row[]	= $col['update_by'];
				$row[]	= '<button type="button" class="btn btn-info btn-xs rounded-0" onclick="detailData(' . $col['id'] . ')" title="Detail"><i class="fa fa-eye fa-fw"></i></button> <button type="button" class="btn btn-danger btn-xs rounded-0 my-1" onclick="deleteData(' . $col['id'] . ')" title="Delete"><i class="fa fa-trash fa-fw"></i></button>';

				$data[]	= $row; 
			}

			$result = [
				'draw'				=> $_POST['draw'],
				'recordsTotal'		=> $this->SlidersModel->getAll()['total_data'],
				'recordsFiltered'	=> $this->SlidersModel->countDatatablesFilter(),
				'data'				=> $data
			];

			echo json_encode($result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function getWorkerAttachmentsDatatable($worker_id = 0)
	{
		$session	= $this->session->userdata('AuthUser');
		$result		= [];

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
				$row[]	= $col['name'];
				$row[]	= $col['create_date'];
				$row[]	= $col['create_by'];
				$row[] = form_button(['type' => 'button', 'class' => 'btn btn-info btn-xs rounded-0', 'content' => '<i class="fa fa-download fa-fw"></i>', 'onclick' => $download_file]) . form_button(['type' => 'button', 'class' => 'btn btn-danger btn-xs rounded-0', 'content' => '<i class="fa fa-trash fa-fw"></i>', 'onclick' => 'deleteAttachment(' . $col['id'] . ')']);

				$data[]	= $row; 
			}

			$result = [
				'draw'				=> $_POST['draw'],
				'recordsTotal'		=> $this->WorkerAttachmentsModel->getAll(['worker_id' => $worker_id])['total_data'],
				'recordsFiltered'	=> $this->WorkerAttachmentsModel->countDatatablesFilter($worker_id),
				'data'				=> $data
			];

			echo json_encode($result); exit();
		}

		redirect($_SERVER['HTTP_REFERER']);
	}
}
