<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SuplementaryQuestions extends CI_Controller {
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
        $this->template->title = 'Suplementary Questions';

        // $this->load->library('user_agent');

        // load default models
        $this->load->model('CompanyModel');
        $this->load->model('SuplementaryQuestionsModel');
        $this->load->model('WorkerSuplementaryQuestionsModel');

        // load default data
        $this->result['company'] = [];
        if ($this->CompanyModel->get()['status'] == 'success') {
            $this->result['company'] = $this->CompanyModel->get()['data'];
        }
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
            'like_question' => array_key_exists('question', $params) ? $params['question'] : '',
            'answer_type_id' => array_key_exists('answer_type', $params) ? $params['answer_type'] : '',
            'order' => 'question',
            'sort' => 'asc'
        ];

        $request = [
            'suplementary_questions' => $this->SuplementaryQuestionsModel->getAll($clause)
        ];

        foreach ($request as $key => $val) {
            $this->result[$key] = [];

            if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
                if ($request[$key]['status'] == 'success') {
                    $this->result[$key] = $val['data'];

                    if ($key == 'suplementary_questions') {
                        $total = $val['total_data'];
                    }
                }
            }
        }

        $this->result['pagination'] = bs4pagination('admin/suplementary-questions', $total, $clause['limit'], $params);
        $this->result['no'] = (($clause['page'] * $clause['limit']) - $clause['limit']) + 1;
        
        $this->template->content->view('templates/back/SuplementaryQuestions/index', $this->result);
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

            $request = $this->SuplementaryQuestionsModel->getDetail($id);

            if ($request['status'] == 'success') {
                $this->result['status'] = 'success';

                foreach ($request['data'] as $key => $val) {
                    $this->result['data'][$key] = unStrClean($val);
                }

                unset($this->result['message']);
            }

            echo json_encode($this->result); exit();
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     *  create method
     *  create data, return json
     */
    public function create()
    {
        $session = $this->session->userdata('AuthUser');

        $this->result = [
            'status' => 'error',
            'message' => 'An error occurred, please try again.'
        ];

        if ($this->input->is_ajax_request()) {
            $input = array_map('trim', $this->input->post());
            $file = true;
            $answer_type = true;

            $validate = $this->validate($file, $answer_type);

            $this->form_validation->set_rules($validate);
            $this->form_validation->set_error_delimiters('','');

            if ($this->form_validation->run() == false) {
                foreach ($input as $key => $val) {
                    $this->result['error'][$key] = form_error($key);
                }

                echo json_encode($this->result); exit();
            }

            $data = [
                'question' => $input['question'],
                'answer_type_id' => slugify($input['answer_type']),
                'create_user_id' => $session['id']
            ];

            $data = array_map('strClean', $data);

            $request = $this->SuplementaryQuestionsModel->insert($data);

            if ($request['status'] == 'success') {
                $this->result['status'] = 'success';
                unset($this->result['message']);
                setFlashSuccess('Data successfully created.');
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
            $file = true;
            $answer_type = false;

            $validate = $this->validate($file, $answer_type, $id);

            $this->form_validation->set_rules($validate);
            $this->form_validation->set_error_delimiters('','');

            if ($this->form_validation->run() == false) {
                foreach ($input as $key => $val) {
                    $this->result['error'][$key] = form_error($key);
                }

                echo json_encode($this->result); exit();
            }

            $data = [
                'question' => $input['question'],
                // 'answer_type_id' => slugify($input['answer_type']),
                'update_user_id' => $session['id']
            ];

            $data = array_map('strClean', $data);

            $request = $this->SuplementaryQuestionsModel->update($data, $id);

            if ($request['status'] == 'success') {
                $this->result['status'] = 'success';
                unset($this->result['message']);
                setFlashSuccess('Data successfully updated.');
            }

            echo json_encode($this->result); exit();
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     *  delete method
     *  delete data, return json
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

            $request = $this->SuplementaryQuestionsModel->delete($id);

            if ($request['status'] == 'success') {
                $this->WorkerSuplementaryQuestionsModel->deleteBySuplementaryQuestionId($id);

                $this->result['status'] = 'success';
                unset($this->result['message']);
                setFlashSuccess('Data successfully deleted.');
            }

            echo json_encode($this->result); exit();
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     *  validate method
     *  validate data before action
     */
    private function validate($file = false, $answer_type = false, $id = 0)
    {
        $validate = [
            [
                'field' => 'question',
                'label' => 'Question',
                'rules' => 'trim|required|max_length[100]|regexTextQuestion|xss_clean'
            ],
        ];

        if ($answer_type) {
            $validate[] = [
                'field' => 'answer_type',
                'label' => 'Answer Type',
                'rules' => 'trim|required|is_natural|xss_clean'
            ];
        }

        if ($file) {
            $validate[] = [
                'field' => 'picture',
                'label' => 'Picture',
                'rules' => 'trim|callback__errorFile|xss_clean'
            ];
        }

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
