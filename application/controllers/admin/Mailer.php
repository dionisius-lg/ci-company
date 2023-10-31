<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mailer extends CI_Controller {
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
        $this->template->title = 'Mailer';

        // $this->load->library('user_agent');

        // load default models
        $this->load->model('CompanyModel');
        $this->load->model('MailerConfigModel');

        // load default data
        $this->result['company'] = [];
        if ($this->CompanyModel->get()['status'] == 'success') {
            $this->result['company'] = $this->CompanyModel->get()['data'];
        }
    }

    private $upload_errors = [];

    /**
     *  index method
     *  index page or return to detail method
     */
    public function index()
    {
        $this->detail();
    }

    /**
     *  detail method
     *  detail page
     */
    public function detail()
    {
        $session = $this->session->userdata('AuthUser');

        $request = [
            'mailer' => $this->MailerConfigModel->get()
        ];

        foreach ($request as $key => $val) {
            $this->result[$key] = [];

            if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
                if ($request[$key]['status'] == 'success') {
                    $this->result[$key] = $val['data'];
                }
            }
        }

        $this->template->content->view('templates/back/Mailer/detail', $this->result);
        $this->template->publish();
    }

    /**
     *  update method
     *  update data
     */
    public function update()
    {
        $session = $this->session->userdata('AuthUser');

        if ($this->input->method() == 'post') {
            $input = array_map('trim', $this->input->post());

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
                redirect('admin/mailer');
            }

            $data = [
                'host' => $input['host'],
                'port' => $input['port'],
                'username' => $input['username'],
                'password' => $input['password'],
                'encryption' => $input['encryption']
            ];

            $data = array_map('strClean', $data);

            $request = $this->MailerConfigModel->update($data);

            if ($request['status'] == 'success') {
                setFlashSuccess('Data successfully updated.');
            } else {
                setFlashError('An error occurred, please try again.');
            }

            redirect('admin/mailer');
        }

        hasReferrer() == true ? redirect(Referrer(), 'refresh') : redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     *  validate method
     *  validate data before action
     */
    private function validate()
    {
        $validate = [
            [
                'field' => 'host',
                'label' => 'Host',
                'rules' => 'trim|required|max_length[100]|regexAlphaNumericDashDot|xss_clean'
            ],
            [
                'field' => 'port',
                'label' => 'Port',
                'rules' => 'trim|required|max_length[5]|is_natural|xss_clean'
            ],
            [
                'field' => 'encryption',
                'label' => 'Encryption',
                'rules' => 'trim|required|max_length[3]|alpha|xss_clean'
            ],
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required|max_length[100]|valid_email|xss_clean'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|max_length[100]|xss_clean'
            ]
        ];

        return $validate;
    }

    /**
     *  _errorFile method
     *  display file upload error
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
