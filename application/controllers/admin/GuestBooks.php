<?php defined('BASEPATH') OR exit('No direct script access allowed');

class GuestBooks extends CI_Controller {
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
        $this->template->title = 'Guest Books';

        // $this->load->library('user_agent');

        // load default models
        $this->load->model('CompanyModel');
        $this->load->model('GuestBooksModel');
        $this->load->model('UsersModel');
        $this->load->model('UserLevelsModel');
        $this->load->model('WorkersModel');
        $this->load->model('AgencyLocationsModel');

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
            'like_subject' => array_key_exists('subject', $params) ? $params['subject'] : '',
            'like_sender_name' => array_key_exists('sender_name', $params) ? $params['sender_name'] : '',
            'like_sender_email' => array_key_exists('sender_email', $params) ? $params['sender_email'] : '',
            'status_id' => array_key_exists('status', $params) ? $params['status'] : '',
            'order' => 'create_date',
            'sort' => 'desc',
            'is_active' => 1
        ];

        $request = [
            'guest_books' => $this->GuestBooksModel->getAll($clause)
        ];

        foreach ($request as $key => $val) {
            $this->result[$key] = [];

            if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
                if ($request[$key]['status'] == 'success') {
                    $this->result[$key] = $val['data'];

                    if ($key == 'guest_books') {
                        $total = $val['total_data'];
                    }
                }
            }
        }

        $this->result['pagination'] = bs4pagination('admin/guest-books', $total, $clause['limit'], $params);
        $this->result['no'] = (($clause['page'] * $clause['limit']) - $clause['limit']) + 1;

        $this->template->content->view('templates/back/GuestBooks/index', $this->result);
        $this->template->publish();
    }

    /**
     *  detail method
     *  detail page
     */
    public function detail($id)
    {
        $session = $this->session->userdata('AuthUser');

        if (!empty($id) && is_numeric($id)) {
            $request = [
                'guest_book' => $this->GuestBooksModel->getDetail($id),
            ];

            foreach ($request as $key => $val) {
                $this->result[$key] = [];
    
                if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
                    if ($request[$key]['status'] == 'success') {
                        $this->result[$key] = $val['data'];
                    }
                }
            }

            if (empty($this->result['guest_book'])) {
                setFlashError('An error occurred, please try again.');
                redirect($_SERVER['HTTP_REFERER']);
            }

            if ($this->result['guest_book']['status_id'] == 1) {
                $this->GuestBooksModel->update([
                    'status_id' => 2,
                    'update_date' => date('Y-m-d H:i:s'),
                    'update_user_id' => $session['id']
                ], $this->result['guest_book']['id']);
            }

            $this->template->content->view('templates/back/GuestBooks/detail', $this->result);
            $this->template->publish();
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /**
     *  delete method
     *  delete data by id, delete attachment by worker id
     */
    public function delete($id = null)
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

            $request = $this->GuestBooksModel->getDetail($id);

            if ($request['status'] == 'success' && $request['total_data'] > 0) {
                $request = $this->GuestBooksModel->delete($id);

                if ($request['status'] == 'success') {
                    $this->result['status'] = 'success';
                    unset($this->result['message']);
                    setFlashSuccess('Data successfully deleted.');
                }
            }

            echo json_encode($this->result); exit();
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
}
