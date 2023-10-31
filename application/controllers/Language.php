<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
    }

    public function change($key = '')
    {
        sitelang($key);

        if (isset($_SERVER['HTTP_REFERER'])) {
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        } else {
            redirect(base_url(), 'refresh');
        }
    }
}
