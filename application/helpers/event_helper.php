<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('setEvent')) {
	function setEvent($event_name = null) {
		if (!empty($event_name)) {
			$ci =& get_instance();
			$ci->load->library('session');
			$ci->load->library('user_agent');

			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip_address = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip_address = $_SERVER['REMOTE_ADDR'];
			}

			if ($ci->agent->is_browser()) {
				$agent = $this->agent->browser().' '.$this->agent->version();
			} elseif ($ci->agent->is_robot()) {
				$agent = $this->agent->robot();
			} elseif ($ci->agent->is_mobile()) {
				$agent = $this->agent->mobile();
			} else {
				$agent = 'Unidentified User Agent';
			}

			if ($ci->session->has_userdata('AuthUser')) {
				$user_id = $ci->session->userdata('AuthUser')['id'];
			} else {
				$user_id = null;
			}

			$data = [
				'event_name' => $event_name,
				'event_date' => date('Y-m-d H:i:s'),
				'agent' => $agent,
				'platform' => $ci->agent->platform(),
				'user_agent' => $_SERVER['HTTP_USER_AGENT'],
				'user_id' => $user_id
			];

			$ci->db->insert('user_events', $data);
			return true;
		}

		return false;
	}
}
