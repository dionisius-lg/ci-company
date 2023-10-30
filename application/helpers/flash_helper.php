<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('setFlashSuccess')) {
	function setFlashSuccess($message = null, $key = null) {
		$ci = &get_instance();
		$ci->load->library('session');

		if (!empty($message)) {
			if (!empty($key)) {
				return $ci->session->set_flashdata('FlashSuccess_'.$key, $message);
			}

			return $ci->session->set_flashdata('FlashSuccess', $message);
		}

		return false;
	}
}

if (!function_exists('setFlashError')) {
	function setFlashError($message = null, $key = null) {
		$ci = &get_instance();
		$ci->load->library('session');

		if (!empty($message)) {
			if (!empty($key)) {
				return $ci->session->set_flashdata('FlashError_'.$key, $message);
			}

			return $ci->session->set_flashdata('FlashError', $message);
		}

		return false;
	}
}

if (!function_exists('hasFlashSuccess')) {
	function hasFlashSuccess($key = null) {
		$ci = &get_instance();
		$ci->load->library('session');

		if (!empty($key) && $ci->session->has_userdata('FlashSuccess_'.$key)) {
			return true;
		}

		if (empty($key) && $ci->session->has_userdata('FlashSuccess')) {
			return true;
		}

		return false;
	}
}

if (!function_exists('hasFlashError')) {
	function hasFlashError($key = null) {
		$ci = &get_instance();
		$ci->load->library('session');

		if (!empty($key) && $ci->session->has_userdata('FlashError_'.$key)) {
			return true;
		}

		if (empty($key) && $ci->session->has_userdata('FlashError')) {
			return true;
		}

		return false;
	}
}

if (!function_exists('flashSuccess')) {
	function flashSuccess($key = null) {
		$ci = &get_instance();
		$ci->load->library('session');

		if (!empty($key) && $ci->session->has_userdata('FlashSuccess_'.$key)) {
			return $ci->session->flashdata('FlashSuccess_'.$key);
		}

		if (empty($key) && $ci->session->has_userdata('FlashSuccess')) {
			return $ci->session->flashdata('FlashSuccess');
		}

		return false;
	}
}

if (!function_exists('flashError')) {
	function flashError($key = null) {
		$ci = &get_instance();
		$ci->load->library('session');

		if (!empty($key) && $ci->session->has_userdata('FlashError_'.$key)) {
			return $ci->session->flashdata('FlashError_'.$key);
		}

		if (empty($key) && $ci->session->has_userdata('FlashError')) {
			return $ci->session->flashdata('FlashError');
		}

		return false;
	}
}

if (!function_exists('setOldInput')) {
	function setOldInput($args1 = null, $args2 = null) {
		$ci = &get_instance();
		$ci->load->library('session');

		if (!empty($args1)) {
			if (is_array($args1)) {
				foreach ($args1 as $key => $val) {
					$ci->session->set_flashdata('OldInput_'.$key, $val);
				}
			} else {
				if (!empty($args2)) {
					$ci->session->set_flashdata('OldInput_'.$args1, $args2);
				}
			}
		}

		return false;
	}
}

if (!function_exists('oldInput')) {
	function oldInput($key = null, $old = null) {
		$ci = &get_instance();
		$ci->load->library('session');

		if (!empty($key)) {
			if ($ci->session->has_userdata('OldInput_'.$key)) {
				return $ci->session->flashdata('OldInput_'.$key);
			} else {
				if (!empty($old) || $old === '0') {
					return $old;
				}
			}
		}

		return false;
	}
}
