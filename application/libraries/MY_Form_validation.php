<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    function __construct() {
        parent::__construct();
    }

    /**
     *  regexAlphaSpace method
     *  validate format regex
     */
    public function regexAlphaSpace($str = false, $id = 0)
    {
        $ci = &get_instance();

        if ($str) {
            if (!preg_match('/^[a-zA-Z ]*$/', $str)) {
                $ci->form_validation->set_message('regexAlphaSpace', '%s may only contain alpha-space characters.');
                return false;
            }
        }

        return true;
    }

    /**
     *  regexAlphaNumericSpaceComma method
     *  validate format regex
     */
    public function regexAlphaNumericSpaceComma($str = false, $id = 0)
    {
        $ci = &get_instance();

        if ($str) {
            if (!preg_match('/^[a-zA-Z0-9,]*$/', $str)) {
                $ci->form_validation->set_message('regexAlphaNumericSpaceComma', '%s may only contain alpha-numeric characters, space, and comma.');
                return false;
            }
        }

        return true;
    }

    /**
     *  regexAlphaNumericDashDot method
     *  validate format regex
     */
    public function regexAlphaNumericDashDot($str = false, $id = 0)
    {
        $ci = &get_instance();

        if ($str) {
            if (!preg_match('/^[a-zA-Z0-9_.]*$/', $str)) {
                $ci->form_validation->set_message('regexAlphaNumericDashDot', '%s may only contain alpha-numeric characters, dash, and dot.');
                return false;
            }
        }

        return true;
    }

    /**
     *  regexTextInput method
     *  validate format regex
     */
    public function regexTextInput($str = false, $id = 0)
    {
        $ci = &get_instance();

        if ($str) {
            if (!preg_match('/^[a-zA-Z0-9 .,\-\&]*$/', $str)) {
                $ci->form_validation->set_message('regexTextInput', '%s may only contain alpha-numeric characters, comma, dot, dash, and \'&\' symbol.');
                return false;
            }
        }

        return true;
    }

    /**
     *  regexTextQuestion method
     *  validate format regex
     */
    public function regexTextQuestion($str = false, $id = 0)
    {
        $ci = &get_instance();

        if ($str) {
            if (!preg_match('/^[a-zA-Z0-9 .,\-\&\?\(\)]*$/', $str)) {
                $ci->form_validation->set_message('regexTextQuestion', '%s may only contain alpha-numeric characters, comma, dot, dash, \'&\', \'(\', \')\', and \'?\' symbol.');
                return false;
            }
        }

        return true;
    }

    /**
     *  regexTextArea method
     *  validate format regex
     */
    public function regexTextArea($str = false, $id = 0)
    {
        $ci = &get_instance();

        if ($str) {
            if (!preg_match('/^[a-zA-Z0-9 .,\-\&()\r\n]*$/', $str)) {
                $ci->form_validation->set_message('regexTextArea', '%s may only contain alpha-numeric characters, comma, dot, dash, \'&\' symbol, and parentheses.');
                return false;
            }
        }

        return true;
    }

    /**
     *  regexUsername method
     *  validate format regex
     */
    public function regexUsername($str = false, $id = 0)
    {
        $ci = &get_instance();

        if ($str) {
            if (!preg_match('/^[a-zA-Z0-9@.\-\_\@]*$/', $str)) {
                $ci->form_validation->set_message('regexUsername', '%s may only contain alpha-numeric characters, dot. dash, underscore, and \'@\' symbol');
                return false;
            }
        }

        return true;
    }

    /**
     *  regexDate method
     *  validate format regex
     */
    public function regexDate($str = false, $id = 0)
    {
        $ci = &get_instance();

        if ($str) {
            $date = DateTime::createFromFormat('Y-m-d', $str);
            $error = DateTime::getLastErrors();

            if ($error['warning_count'] > 0 || $error['error_count'] > 0) {
                $ci->form_validation->set_message('regexDate', '%s must contain a valid date.');
                return false;
            }
        }

        return true;
    }

    /**
     *  regexYear method
     *  validate format regex
     */
    public function regexYear($str = false, $id = 0)
    {
        $ci = &get_instance();

        if ($str) {
            $date = DateTime::createFromFormat('Y', $str);
            $error = DateTime::getLastErrors();

            if ($error['warning_count'] > 0 || $error['error_count'] > 0) {
                $ci->form_validation->set_message('regexYear', '%s must contain a valid year.');
                return false;
            }
        }

        return true;
    }

    /**
     *  filterValidateUrl method
     *  validate url
     */
    public function filterValidateUrl($str = false, $id = 0)
    {
        $ci = &get_instance();

        if ($str) {
            if (!filter_var($str, FILTER_VALIDATE_URL)) {
                $ci->form_validation->set_message('filterValidateUrl', '%s must be a valid url.');
                return false;
            }
        }

        return true;
    }

    /**
     *  checkWorkersNik method
     *  validate data check
     */
    public function checkWorkersNik($str = false, $id = 0)
    {
        $ci = &get_instance();
        $ci->load->model('WorkersModel');

        if ($str) {
            $term = ['nik' => $str];

            if (!empty($id) && is_numeric($id)) {
                $term['not_id'] = $id;
            }

            $request = $ci->WorkersModel->getAll($term);

            if ($request['total_data'] > 0) {
                $ci->form_validation->set_message('checkWorkersNik', '%s already exist.');
                return false;
            }
        }

        return true;
    }

    /**
     *  checkWorkersRefNumber method
     *  validate data check
     */
    public function checkWorkersRefNumber($str = false, $id = 0)
    {
        $ci = &get_instance();
        $ci->load->model('WorkersModel');

        if ($str) {
            $term = ['ref_number' => $str];

            if (!empty($id) && is_numeric($id)) {
                $term['not_id'] = $id;
            }

            $request = $ci->WorkersModel->getAll($term);

            if ($request['total_data'] > 0) {
                $ci->form_validation->set_message('checkWorkersRefNumber', '%s already exist.');
                return false;
            }
        }

        return true;
    }

    /**
     *  checkWorkersEmail method
     *  validate data check
     */
    public function checkWorkersEmail($str = false, $id = 0)
    {
        $ci = &get_instance();
        $ci->load->model('WorkersModel');

        if ($str) {
            $term = ['email' => $str];

            if (!empty($id) && is_numeric($id)) {
                $term['not_id'] = $id;
            }

            $request = $ci->WorkersModel->getAll($term);

            if ($request['total_data'] > 0) {
                $ci->form_validation->set_message('checkWorkersEmail', '%s already exist.');
                return false;
            }
        }

        return true;
    }

    /**
     *  checkWorkersUserId method
     *  validate data check
     */
    public function checkWorkersUserId($str = false, $id = 0)
    {
        $ci = &get_instance();
        $ci->load->model('WorkersModel');

        if ($str) {
            $term = ['user_id' => $str];

            if (!empty($id) && is_numeric($id)) {
                $term['not_id'] = $id;
            }

            $request = $ci->WorkersModel->getAll($term);

            if ($request['total_data'] > 0) {
                $ci->form_validation->set_message('checkWorkersUserId', '%s already used on other workers.');
                return false;
            }
        }

        return true;
    }

    /**
     *  checkUsersUsername method
     *  validate data check
     */
    public function checkUsersUsername($str = false, $id = 0)
    {
        $ci = &get_instance();
        $ci->load->model('UsersModel');

        if ($str) {
            $term = ['username' => $str];

            if (!empty($id) && is_numeric($id)) {
                $term['not_id'] = $id;
            }

            $request = $ci->UsersModel->getAll($term);

            if ($request['total_data'] > 0) {
                $ci->form_validation->set_message('checkUsersUsername', '%s already exist.');
                return false;
            }
        }

        return true;
    }

    /**
     *  checkUsersEmail method
     *  validate data check
     */
    public function checkUsersEmail($str = false, $id = 0)
    {
        $ci = &get_instance();
        $ci->load->model('UsersModel');

        if ($str) {
            $term = ['email' => $str];

            if (!empty($id) && is_numeric($id)) {
                $term['not_id'] = $id;
            }

            $request = $ci->UsersModel->getAll($term);

            if ($request['total_data'] > 0) {
                $ci->form_validation->set_message('checkUsersEmail', '%s already exist.');
                return false;
            }
        }

        return true;
    }

    /**
     *  checkAgencyLocationsName method
     *  validate data check
     */
    public function checkAgencyLocationsName($str = false, $id = 0)
    {
        $ci = &get_instance();
        $ci->load->model('AgencyLocationsModel');

        if ($str) {
            $term = ['name' => $str];

            if (!empty($id) && is_numeric($id)) {
                $term['not_id'] = $id;
            }

            $request = $ci->AgencyLocationsModel->getAll($term);

            if ($request['total_data'] > 0) {
                $ci->form_validation->set_message('checkAgencyLocationsName', '%s already exist.');
                return false;
            }
        }

        return true;
    }

    /**
     *  checkSkillExperiencesName method
     *  validate data check
     */
    public function checkSkillExperiencesName($str = false, $id = 0)
    {
        $ci = &get_instance();
        $ci->load->model('SkillExperiencesModel');

        if ($str) {
            $term = ['name' => $str];

            if (!empty($id) && is_numeric($id)) {
                $term['not_id'] = $id;
            }

            $request = $ci->SkillExperiencesModel->getAll($term);

            if ($request['total_data'] > 0) {
                $ci->form_validation->set_message('checkSkillExperiencesName', '%s already exist.');
                return false;
            }
        }

        return true;
    }

    /**
     *  checkLanguageAbilitiesName method
     *  validate data check
     */
    public function checkLanguageAbilitiesName($str = false, $id = 0)
    {
        $ci = &get_instance();
        $ci->load->model('LanguageAbilitiesModel');

        if ($str) {
            $term = ['name' => $str];

            if (!empty($id) && is_numeric($id)) {
                $term['not_id'] = $id;
            }

            $request = $ci->LanguageAbilitiesModel->getAll($term);

            if ($request['total_data'] > 0) {
                $ci->form_validation->set_message('checkLanguageAbilitiesName', '%s already exist.');
                return false;
            }
        }

        return true;
    }

    /**
     *  checkCookingAbilitiesName method
     *  validate data check
     */
    public function checkCookingAbilitiesName($str = false, $id = 0)
    {
        $ci = &get_instance();
        $ci->load->model('CookingAbilitiesModel');

        if ($str) {
            $term = ['name' => $str];

            if (!empty($id) && is_numeric($id)) {
                $term['not_id'] = $id;
            }

            $request = $ci->CookingAbilitiesModel->getAll($term);

            if ($request['total_data'] > 0) {
                $ci->form_validation->set_message('checkCookingAbilitiesName', '%s already exist.');
                return false;
            }
        }

        return true;
    }
}