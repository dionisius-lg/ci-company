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
        $this->load->model('GalleriesModel');

        $this->result['company'] = [];
        if ($this->CompanyModel->get()['status'] == 'success') {
            $this->result['company'] = $this->CompanyModel->get()['data'];
        }
    }

    public function index()
    {
        $session = $this->session->userdata('AuthUser');
        $params        = $this->input->get();
        $clause        = [];
        $total        = 0;

        $clause = [
            'limit' => 6,
            'page' => (array_key_exists('page', $params) && is_numeric($params['page'])) ? $params['page'] : 1,
            'order' => 'create_date',
            'sort' => 'desc'
        ];

        $request = [
            'galleries' => $this->GalleriesModel->getAll($clause),
        ];

        foreach ($request as $key => $val) {
            $this->result[$key] = [];

            if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
                if ($request[$key]['status'] == 'success') {
                    $this->result[$key] = $val['data'];

                    if ($key == 'galleries') {
                        $total = $val['total_data'];
                    }
                }
            }
        }

        $this->result['pagination'] = bs4pagination('gallery', $total, $clause['limit'], $params);
        $this->template->content->view('templates/front/Gallery/index', $this->result);
        $this->template->publish();
    }
}