<?php defined('BASEPATH') OR exit('No direct script access allowed');

class BookingRequests extends CI_Controller {
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
        $this->template->title = 'Booking Requests';

        // $this->load->library('user_agent');

        // load default models
        $this->load->model('CompanyModel');
        $this->load->model('AgencyLocationsModel');
        $this->load->model('WorkersModel');

        // load default data
        $this->result['company'] = [];
        if ($this->CompanyModel->get()['status'] == 'success') {
            $this->result['company'] = $this->CompanyModel->get()['data'];
        }

        // load socket helper
        $this->load->helper('socket');
    }

    private $upload_errors = [];

    /**
     *  index method
     *  index page
     */
    public function index()
    {
        $session = $this->session->userdata('AuthUser');
        $params  = $this->input->get();
        $clause  = [];
        $total   = 0;

        $clause = [
            'limit' => 10,
            'page' => (array_key_exists('page', $params) && is_numeric($params['page'])) ? $params['page'] : 1,
            'like_ref_number' => array_key_exists('ref_number', $params) ? $params['ref_number'] : '',
            'like_fullname' => array_key_exists('fullname', $params) ? $params['fullname'] : '',
            'like_email' => array_key_exists('email', $params) ? $params['email'] : '',
            'order' => 'booking_date',
            'sort' => 'desc',
            'booking_status_id' => 3
        ];

        $request = [
            'workers' => $this->WorkersModel->getAll($clause),
            'agency_locations' => $this->AgencyLocationsModel->getAll(['order' => 'name', 'limit' => 100]),
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

        $this->result['pagination'] = bs4pagination('admin/user-requests', $total, $clause['limit'], $params);
        $this->result['no'] = (($clause['page'] * $clause['limit']) - $clause['limit']) + 1;

        $this->template->content->view('templates/back/BookingRequests/index', $this->result);
        $this->template->publish();
    }

    /**
     *  detail method
     *  detail data, return json
     */
    public function detail($id)
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
     *  update method
     *  update data, return json
     */
    public function update($id)
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
            $file = false;

            $validate = $this->validate($file, $id);

            $this->form_validation->set_rules($validate);
            $this->form_validation->set_error_delimiters('','');

            if ($this->form_validation->run() == false) {
                foreach ($input as $key => $val) {
                    $this->result['error'][$key] = form_error($key);
                }

                echo json_encode($this->result); exit();
            }

            $data = [
                'placement_id' => $input['placement'],
                'booking_status_id' => 4,
                'update_user_id' => $session['id']
            ];

            $data = array_map('strClean', $data);

            $request = $this->WorkersModel->update($data, $id);

            if ($request['status'] == 'success') {
                // $request = $this->UsersModel->getDetail($request['data']['id']);

                // if ($request['status'] == 'success') {
                    // $data_email = $request['data'];
                    // $data_email['password'] = $data['password'];

                    // if ($this->_emailNotification($data_email)) {
                        $this->result['status'] = 'success';
                        unset($this->result['message']);
                        setFlashSuccess('Data successfully approved.');
                        // socketEmit('count-total');
                    // }
                // }
            }

            echo json_encode($this->result); exit();
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     *  validate method
     *  validate data before action
     */
    private function validate($file = false, $id = 0)
    {
        $validate = [
            [
                'field' => 'placement',
                'label' => 'Placement',
                'rules' => 'trim|required|is_natural|xss_clean'
            ],
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

    /**
     *  _emailNotification method
     *  send email notification after register user
     */
    private function _emailNotification($data = []) {
        if (is_array($data) && !empty($data)) {

            $this->load->model('CompanyModel');

            $request  = $this->CompanyModel->get();

            if ($request['status'] != 'success') {
                return false;
            }

            $company = $request['data'];

            $subject = $company['name'] . ' - Confirmation Register Account';
            $body    = '<p>Dear <b>' . $data['fullname'] . '</b>,</p>
                        <p>You have just made a request to register an account on our website on ' . $data['request_date'] . '.<br>
                        Here is your information access,<br>
                        Username: ' . $data['username'] . '<br>
                        Password: ' . $data['password'] . '<br>
                        Thank you</p>';
            $body    = preg_replace('/([\s])\1+/', '', $body);

            $data = [
                'subject' => $subject,
                'email_to' => $data['email'],
                'content' => $body,
                'content_html' => $body,
                'create_date' => date('Y-m-d H:i:s'),
                'create_user_id' => $this->session->userdata('AuthUser')['id'],
                'email_status_id' => 9,
                'direction_id' => 2
            ];

            $request = $this->EmailsModel->insert($data);

            if ($request['status'] == 'success') {
                return true;
            }
        }

        return false;
    }
}
