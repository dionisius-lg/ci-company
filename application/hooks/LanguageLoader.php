<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');

        $sitelang = $ci->session->userdata('SiteLang')['name'];

        // if ($sitelang) {
            $ci->lang->load('content', $sitelang);
        // } else {
        //     $ci->lang->load('content', 'english');
        // }
    }
}