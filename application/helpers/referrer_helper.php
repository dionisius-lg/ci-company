<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('setReferrer')) {
	function setReferrer($url = null) {
		$ci = &get_instance();
		$ci->load->library('session');

		if (!empty($url)) {
			return $ci->session->set_userdata('Referrer', $url);
		}

		return false;
	}
}

if (!function_exists('hasReferrer')) {
	function hasReferrer() {
		$ci = &get_instance();
		$ci->load->library('session');

		if ($ci->session->has_userdata('Referrer')) {
			return true;
		}

		return false;
	}
}

if (!function_exists('Referrer')) {
	function Referrer($key = null) {
		$ci = &get_instance();
		$ci->load->library('session');

		if ($ci->session->has_userdata('Referrer')) {
			return $ci->session->userdata('Referrer'.$key);
		}

		return false;
	}
}
