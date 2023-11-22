<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

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
        $this->load->model('GuestBooksModel');

        // load default data
        $this->result['company'] = [];
        if ($this->CompanyModel->get()['status'] == 'success') {
            $this->result['company'] = $this->CompanyModel->get()['data'];
        }
    }

    /**
     *  index method
     *  index page
     */
    public function index()
    {
        $session = $this->session->userdata('AuthUser');

        $this->template->content->view('templates/front/Contact/index', $this->result);
        $this->template->publish();
    }

    public function send() {
        if ($this->input->method() == 'post') {
            $input    = array_map('trim', $this->input->post());
            $validate = $this->validate();

            $this->form_validation->set_rules($validate);
            $this->form_validation->set_error_delimiters('','');

            if ($this->form_validation->run() == false) {
                foreach ($input as $key => $val) {
                    if (!empty(form_error($key))) {
                        setFlashError(form_error($key), $key);
                    }
                }

                setOldInput($input);
                redirect('contact');
            }

            $data = [
                'subject' => $input['contact_subject'],
                'body' => nl2br($input['contact_message']),
                'sender_name' => $input['contact_name'],
                'sender_email' => strtolower($input['contact_email']),
            ];

            $data = array_map('strClean', $data);
            $request = $this->GuestBooksModel->insert($data);

            if ($request['status'] == 'success') {
                setFlashSuccess('Your message has been sent, thank you.', 'contact');
            } else {
                setFlashError('An error occurred, please try again.', 'contact');
            }
        }

        redirect('contact');
    }

    /**
     *  validate method
     *  validate data before action
     */
    private function validate($file = false, $id = null)
    {
        $validate = [
            [
                'field' => 'contact_name',
                'label' => 'Name',
                'rules' => 'trim|required|max_length[100]|regexAlphaSpace|xss_clean'
            ],
            [
                'field' => 'contact_email',
                'label' => 'Email',
                'rules' => 'trim|required|max_length[100]|valid_email|xss_clean'
            ],
            [
                'field' => 'contact_subject',
                'label' => 'Subject',
                'rules' => 'trim|required|max_length[100]|regexAlphaSpace|xss_clean'
            ],
            [
                'field' => 'contact_message',
                'label' => 'Message',
                'rules' => 'trim|max_length[255]|regexTextArea|xss_clean'
            ],
        ];

        return $validate;
    }
}
