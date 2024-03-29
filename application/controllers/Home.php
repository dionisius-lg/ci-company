<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        // set timezone
        date_default_timezone_set('Asia/Jakarta');

        // set site languange
        $this->config->set_item('language', siteLang()['name']);

        // set template layout
        $this->template->set_template('layouts/front');

        // load default models
        $this->load->model('CompanyModel');
        $this->load->model('SlidersModel');
        $this->load->model('SkillExperiencesModel');
        $this->load->model('AgencyLocationsModel');
        $this->load->model('WorkersModel');

        // load default data
        $this->result['company'] = [];
        if ($this->CompanyModel->get()['status'] == 'success') {
            $this->result['company'] = $this->CompanyModel->get()['data'];
        }
    }

    public function index()
    {
        $session = $this->session->userdata('AuthUser');

        $request = [
            'sliders' => $this->SlidersModel->getAll(['limit' => 10, 'order' => 'order_number', 'sort' => 'asc']),
            'skill_experiences' => $this->SkillExperiencesModel->getAll(['limit' => 3, 'order' => 'rand()']),
            'agency_locations' => $this->AgencyLocationsModel->getAll(['limit' => 3, 'is_default' => 1]),
        ];

        foreach ($request as $key => $val) {
            $this->result[$key] = [];

            if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
                if ($request[$key]['status'] == 'success') {
                    $this->result[$key] = $val['data'];
                }
            }
        }

        $this->template->content->view('templates/front/Home/index', $this->result);
        $this->template->publish();
    }
}
