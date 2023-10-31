<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimony extends CI_Controller {

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

        // load default data
        $this->result['company'] = [];
        if ($this->CompanyModel->get()['status'] == 'success') {
            $this->result['company'] = $this->CompanyModel->get()['data'];
        }
    }

    public function index()
    {
        $session = $this->session->userdata('AuthUser');

        $this->template->content->view('templates/front/Testimony/index', $this->result);
        $this->template->publish();
    }
}
