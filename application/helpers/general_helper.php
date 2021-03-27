<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('strClean')) {
	function strClean($str) {
		return addslashes(htmlspecialchars(trim($str), ENT_QUOTES));
	}
}

if (!function_exists('nl2space')) {
	function nl2space($str) {
		return preg_replace('/\s+/', ' ', trim($str));
	}
}

if (!function_exists('slugify')) {
	function slugify($str) {
		return strtolower(str_slug($str, '-'));
	}
}

if (!function_exists('sitelang')) {
	function sitelang($lang = null) {
		$ci = &get_instance();
		$ci->load->library('session');
		$ci->load->helper('language');

		$allowed_lang = [
			'english',
			'indonesian',
		];

		if (!empty($lang) && in_array($lang, $allowed_lang)) {
			$ci->session->set_userdata('SiteLang', $lang);
		} else {
            if (!$ci->session->has_userdata('SiteLang')) {
                $ci->session->set_userdata('SiteLang', $allowed_lang['0']);
            }
		}

		$ci->lang->load('content', $ci->session->userdata('SiteLang'));

		return $ci->session->userdata('SiteLang');
	}
}

/*
function generate_url_slug($string,$table,$field='url_slug',$key=NULL,$value=NULL){
	$t =& get_instance();
	$slug = url_title($string);
	$slug = strtolower($slug);
	$i = 0;
	$params = array ();
	$params[$field] = $slug;
 
	if($key)$params["$key !="] = $value; 
 
	while ($t->db->where($params)->get($table)->num_rows())
	{   
		if (!preg_match ('/-{1}[0-9]+$/', $slug ))
			$slug .= '-' . ++$i;
		else
			$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
		 
		$params [$field] = $slug;
	}   
	return $slug;   
}
*/
