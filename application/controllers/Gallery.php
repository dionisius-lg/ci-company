<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        // set timezone
        date_default_timezone_set('Asia/Jakarta');

        // set site languange
        $this->config->set_item('language', siteLang()['name']);

        $this->template->set_template('layouts/front');

        $this->load->model('CompanyModel');

        $this->result['company'] = [];
        if ($this->CompanyModel->get()['status'] == 'success') {
            $this->result['company'] = $this->CompanyModel->get()['data'];
        }
    }

    public function index()
    {
        $session = $this->session->userdata('AuthUser');
        // load views
        $this->template->content->view('templates/front/Gallery/index', $this->result);
        $this->template->publish();
    }
}