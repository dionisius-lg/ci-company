<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
	}

	public function worker($worker_id)
	{
		$this->load->model('AgencyLocationsModel');
		$this->load->model('CompanyModel');
		$this->load->model('CookingAbilitiesModel');
		$this->load->model('LanguageAbilitiesModel');
		$this->load->model('SkillExperiencesModel');
		$this->load->model('SuplementaryQuestionsModel');
		$this->load->model('WorkersModel');
		$this->load->model('WorkerPreviousEmploymentsModel');

		$request = [
			'worker' => $this->WorkersModel->getDetail($worker_id),
			'skill_experiences' => $this->SkillExperiencesModel->getAll(['order' => 'name', 'limit' => 100]),
			'cooking_abilities' => $this->CookingAbilitiesModel->getAll(['order' => 'name', 'limit' => 100]),
			'language_abilities' => $this->LanguageAbilitiesModel->getAll(['order' => 'name', 'limit' => 100]),
			'agency_locations' => $this->AgencyLocationsModel->getAll(['order' => 'name', 'limit' => 100]),
			'suplementary_questions' => $this->SuplementaryQuestionsModel->getAll(['order' => 'question', 'limit' => 1000]),
			'previous_employments' => $this->WorkerPreviousEmploymentsModel->getAll(['order' => 'period', 'sort' => 'desc', 'limit' => 100, 'worker_id' => $worker_id]),
			'company' => $this->CompanyModel->get(),
		];

		foreach ($request as $key => $val) {
			$data[$key] = [];

			if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
				if ($request[$key]['status'] == 'success') {
					$data[$key] = $val['data'];
				}
			}
		}
// print_r($data); exit;
		echo $this->load->view('pdf/worker_detail', $data, true);
	}
}
