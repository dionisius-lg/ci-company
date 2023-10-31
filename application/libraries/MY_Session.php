<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Session extends CI_Session {

    function __construct() {
        parent::__construct();
    }

    function sess_destroy()
    {
        $this->CI =& get_instance();

        $this->CI->load->library('user_agent');

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }

        if ($this->CI->agent->is_browser()) {
            $agent = $this->agent->browser().' '.$this->agent->version();
        } elseif ($this->CI->agent->is_robot()) {
            $agent = $this->agent->robot();
        } elseif ($this->CI->agent->is_mobile()) {
            $agent = $this->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }

        $data = [
            'event_name' => 'Logout',
            'event_date' => date('Y-m-d H:i:s'),
            'agent' => $agent,
            'platform' => $this->CI->agent->platform(),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'user_id' => $this->CI->session->userdata('AuthUser')['id']
        ];

        //write your update here 
        $this->CI->db->insert('user_events', $data);

        //call the parent 
        parent::sess_destroy();
    }
}