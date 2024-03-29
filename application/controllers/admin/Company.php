<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {
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
        $this->template->title = 'Company Profile';

        // $this->load->library('user_agent');

        // load default models
        $this->load->model('CompanyModel');
        $this->load->model('ProvincesModel');

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
            'company' => $this->CompanyModel->get(),
            'provinces' => $this->ProvincesModel->getAll(['limit' => 100])
        ];

        foreach ($request as $key => $val) {
            $this->result[$key] = [];

            if (is_array($request[$key]) && array_key_exists('status', $request[$key])) {
                if ($request[$key]['status'] == 'success') {
                    $this->result[$key] = $val['data'];
                }
            }
        }

        $this->template->content->view('templates/back/Company/detail', $this->result);
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
            $file = false;

            if (is_uploaded_file($_FILES['logo']['tmp_name'])) {
                $input['logo'] = $_FILES['logo'];
                $file = true;
            }

            if ($file) {
                $file_path = './files/company/';
                $thumb_path = $file_path.'thumb/';

                if (!is_dir($file_path)) {
                    mkdir($file_path, 0777, true);
                }

                if (!is_dir($thumb_path)) {
                    mkdir($thumb_path, 0777, true);
                }

                $config_file = [
                    'upload_path' => $file_path,
                    'allowed_types' => 'jpg|jpeg|png',
                    'max_size' => '2048',
                    //'max_width' => '1024',
                    //'max_height' => '768',
                    // 'encrypt_name' => true,
                    'file_name' => 'logo_'.base64url_encode(time())
                ];

                $this->load->library('upload', $config_file);

                if (!$this->upload->do_upload('logo')) {
                    $this->upload_errors['file'] = $this->upload->display_errors('','');
                } else {
                    $upload_data = $this->upload->data();

                    $config_resize = [
                        'image_library' => 'gd2',
                        'source_image' => $upload_data['full_path'],
                        'create_thumb' => false,
                        'maintain_ratio' => true,
                        'quality' => '50%',
                        'width' => 400,
                        'height' => 100,
                        'new_image' => $thumb_path
                    ];

                    $this->load->library('image_lib', $config_resize);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
            }

            $validate = $this->validate($file);

            $this->form_validation->set_rules($validate);
            $this->form_validation->set_error_delimiters('','');

            if ($this->form_validation->run() == false) {
                if ($file) {
                    if ($upload_data == true && file_exists($file_path.$upload_data['file_name'])) {
                        unlink($file_path.$upload_data['file_name']);
                    }
                }

                foreach ($input as $key => $val) {
                    if (!empty(form_error($key))) {
                        setFlashError(form_error($key), $key);
                    }
                }

                setOldInput($input);
                redirect('admin/company');
            }

            $data = [
                'name' => ucwords($input['name']),
                'address_eng' => nl2space(ucwords($input['address_eng'])),
                'address_ind' => nl2space(ucwords($input['address_ind'])),
                'city_id' => $input['city'],
                'province_id' => $input['province'],
                'zip_code' => $input['zip_code'],
                'phone_1' => $input['phone_1'],
                'phone_2' => $input['phone_2'],
                'email_1' => $input['email_1'],
                'email_2' => $input['email_2'],
                'fax' => $input['fax'],
                'update_user_id' => $session['id']
            ];

            $data = array_map('strClean', $data);

            if ($file) {
                $data['logo'] = $upload_data['file_name'];
                $request = $this->CompanyModel->get();
                $file_old = null;

                if ($request['status'] == 'success') {
                    $file_old = $request['data']['logo'];
                }
            }

            $request = $this->CompanyModel->update($data);

            if ($request['status'] == 'success') {
                setFlashSuccess('Data successfully updated.');

                if ($file && !empty($file_old)) {
                    if (file_exists($file_path.$file_old)) {
                        unlink($file_path.$file_old);
                    }

                    if (file_exists($thumb_path.$file_old)) {
                        unlink($thumb_path.$file_old);
                    }
                }
            } else {
                setFlashError('An error occurred, please try again.');

                if ($file && !empty($file_old)) {
                    if (file_exists($file_path.$upload_data['file_name'])) {
                        unlink($file_path.$upload_data['file_name']);
                    }

                    if (file_exists($thumb_path.$upload_data['file_name'])) {
                        unlink($thumb_path.$upload_data['file_name']);
                    }
                }
            }

            redirect('admin/company');
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
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required|max_length[100]|regexTextInput|xss_clean'
            ],
            [
                'field' => 'address_eng',
                'label' => 'Address (English)',
                'rules' => 'trim|required|max_length[255]|regexTextArea|xss_clean'
            ],
            [
                'field' => 'address_ind',
                'label' => 'Address (Indonesian)',
                'rules' => 'trim|required|max_length[255]|regexTextArea|xss_clean'
            ],
            [
                'field' => 'province',
                'label' => 'Province',
                'rules' => 'trim|required|is_natural|xss_clean'
            ],
            [
                'field' => 'zip_code',
                'label' => 'Zip Code',
                'rules' => 'trim|required|max_length[6]|numeric|xss_clean'
            ],
            [
                'field' => 'city',
                'label' => 'City',
                'rules' => 'trim|required|is_natural|xss_clean'
            ],
            [
                'field' => 'phone_1',
                'label' => 'Phone 1',
                'rules' => 'trim|required|max_length[30]|numeric|xss_clean'
            ],
            [
                'field' => 'phone_2',
                'label' => 'Phone 2',
                'rules' => 'trim|max_length[30]|numeric|xss_clean'
            ],
            [
                'field' => 'email_1',
                'label' => 'Email 1',
                'rules' => 'trim|required|max_length[100]|valid_email|xss_clean'
            ],
            [
                'field' => 'email_2',
                'label' => 'Email 2',
                'rules' => 'trim|max_length[100]|valid_email|xss_clean'
            ],
            [
                'field' => 'fax',
                'label' => 'fax',
                'rules' => 'trim|max_length[30]|numeric|xss_clean'
            ],
        ];

        if ($file) {
            $validate[] = [
                'field' => 'logo',
                'label' => 'Logo',
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
