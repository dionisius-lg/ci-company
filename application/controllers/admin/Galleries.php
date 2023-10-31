<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Galleries extends CI_Controller {
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
        $this->template->title = 'Galleries';

        // $this->load->library('user_agent');

        // load default models
        $this->load->model('CompanyModel');
        $this->load->model('GalleriesModel');

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
            'limit' => 5,
            'page' => (array_key_exists('page', $params) && is_numeric($params['page'])) ? $params['page'] : 1,
            'sort' => 'asc'
        ];

        $request = [
            'galleries' => $this->GalleriesModel->getAll($clause)
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

        $this->result['pagination'] = bs4pagination('admin/galleries', $total, $clause['limit'], $params);
        $this->result['no'] = (($clause['page'] * $clause['limit']) - $clause['limit']) + 1;

        $this->template->content->view('templates/back/Galleries/index', $this->result);
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

            $request = $this->GalleriesModel->getDetail($id);

            if ($request['status'] == 'success') {
                $this->result['status'] = 'success';
                $this->result['data'] = [
                    'file' => checkRemoteFile(base_url('files/galleries/'.$request['data']['picture'])) ? base_url('files/galleries/'.$request['data']['picture']) : base_url('assets/img/default-picture.jpg'),
                    'pictname' => $request['data']['pictname'],
                    'description' => $request['data']['description'],
                    'create_date' => $request['data']['create_date'],
                    // 'create_by' => $request['data']['create_by'],
                    // 'update_date' => $request['data']['update_date'],
                    // 'update_by' => $request['data']['update_by'],
                ];
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

            $input['picture'] = $_FILES['picture'];

            $file_path = './files/galleries/';

            if (!is_dir($file_path)) {
                mkdir($file_path, 0777, true);
            }

            $config_file = [
                'upload_path' => $file_path,
                'allowed_types' => 'jpg|jpeg|png',
                'max_size' => 1000,
                // 'encrypt_name' => true,
                'file_name' => 'img-galleries'.base64url_encode(time())
            ];

            $this->load->library('upload', $config_file);

            if ($this->upload->do_upload('picture')) {
                $upload_data = $this->upload->data();

                $config_resize = [
                    'image_library' => 'gd2',
                    'source_image' => $upload_data['full_path'],
                    'create_thumb' => false,
                    'maintain_ratio' => true,
                    // 'quality' => '100%',
                    'width' => '1200',
                    // 'height' => '675',
                    'new_image' => $upload_data['full_path']
                ];

                $this->load->library('image_lib', $config_resize);
                $this->image_lib->resize();
                $this->image_lib->clear();
            } else {
                $this->upload_errors['file'] = $this->upload->display_errors('','');
            }

            $validate = $this->validate($file);

            $this->form_validation->set_rules($validate);
            $this->form_validation->set_error_delimiters('','');

            if ($this->form_validation->run() == false) {
                foreach ($input as $key => $val) {
                    $this->result['error'][$key] = form_error($key);
                }

                echo json_encode($this->result); exit();
            }

            $data = [
                'pictname' => $input['pictname'],
                'description' => $input['description']
            ];
            
            $data = array_map('strClean', $data);

            $data['picture'] = $upload_data['file_name'];

            $request = $this->GalleriesModel->insert($data);

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
            $file = false;

            if (is_uploaded_file($_FILES['picture']['tmp_name'])) {
                $input['picture'] = $_FILES['picture'];
                $file = true;
            }

            if ($file) {
                $file_path = './files/galleries/';

                if (!is_dir($file_path)) {
                    mkdir($file_path, 0777, true);
                }

                $config_file = [
                    'upload_path' => $file_path,
                    'allowed_types' => 'jpg|jpeg|png',
                    'max_size' => 1000,
                    'file_name' => 'img-galleries'.base64url_encode(time())
                ];

                $this->load->library('upload', $config_file);

                if (!$this->upload->do_upload('picture')) {
                    $this->upload_errors['file'] = $this->upload->display_errors('','');
                } else {
                    $upload_data = $this->upload->data();

                    $config_resize = [
                        'image_library' => 'gd2',
                        'source_image' => $upload_data['full_path'],
                        'create_thumb' => false,
                        'maintain_ratio' => true,
                        // 'quality' => '100%',
                        'width' => '1200',
                        // 'height' => '675',
                        'new_image' => $upload_data['full_path']
                    ];

                    $this->load->library('image_lib', $config_resize);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }

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
                'pictname' => $input['pictname'],
                'description' => $input['description']
            ];

            $data = array_map('strClean', $data);

            if ($file) {
                $data['picture'] = $upload_data['file_name'];

                $request = $this->GalleriesModel->getDetail($id);

                $file_old = null;

                if ($request['status'] == 'success') {
                    $file_old = $request['data']['picture'];
                }
            }

            $request = $this->GalleriesModel->update($data, $id);

            if ($request['status'] == 'success') {
                $this->result['status'] = 'success';
                unset($this->result['message']);
                setFlashSuccess('Data successfully updated.');

                if ($file) {
                    if (file_exists($file_path.$file_old)) {
                        unlink($file_path.$file_old);
                    }
                }
            } else {
                if ($file) {
                    if (file_exists($file_path.$upload_data['file_name'])) {
                        unlink($file_path.$upload_data['file_name']);
                    }
                }
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

            $file_old = null;

            $request = $this->GalleriesModel->getDetail($id);

            if ($request['status'] == 'success') {
                $file_old = './files/testimonies/'.$request['data']['picture'];
            }

            $request = $this->GalleriesModel->delete($id);

            if ($request['status'] == 'success') {
                $this->result['status'] = 'success';
                unset($this->result['message']);
                setFlashSuccess('Data successfully deleted.');

                if (!empty($file_old)) {
                    if (file_exists($file_old)) {
                        unlink($file_old);
                    }
                }
            }

            echo json_encode($this->result); exit();
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    private function validate($file = false, $id = 0)
    {
        $validate = [
            [
                'field' => 'pictname',
                'label' => 'Picture Name',
                'rules' => 'trim|required|xss_clean'
            ],
            [
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'trim|required|xss_clean'
            ],
        ];

        if ($file) {
            $validate[] = [
                'field' => 'picture',
                'label' => 'Slider',
                'rules' => 'trim|callback__errorFile|xss_clean'
            ];
        }

        return $validate;
    }

    public function _errorFile($str)
    {
        if (isset($this->upload_errors['file'])) {
            $this->form_validation->set_message('_errorFile', $this->upload_errors['file']);
            return false;
        }

        return true;
    }
}
