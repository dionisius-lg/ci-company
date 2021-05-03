<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('strClean')) {
	function strClean($str) {
		// return htmlentities(trim($str), ENT_QUOTES, 'UTF-8');
		return addslashes(htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8'));
	}
}

if (!function_exists('unStrClean')) {
	function unStrClean($str) {
		return stripslashes(html_entity_decode($str));
	}
}

if (!function_exists('nl2space')) {
	function nl2space($str) {
		return preg_replace('/\s+/', ' ', trim($str));
	}
}

// if (!function_exists('slugify')) {
// 	function slugify($str) {
// 		return strtolower(str_slug($str, '-'));
// 	}
// }

if (!function_exists('strRandom')) {
	function strRandom($length = '') {
		if (is_numeric($length)) {
			$result    = "";
			$chars     = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$charArray = str_split($chars);

			for ($i = 0; $i < $length; $i++) {
				$randItem = array_rand($charArray);
				$result  .= "". $charArray[$randItem];
			}

			return $result;
		}
		
		return false;
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
			'japanese',
			'korean',
			'mandarin'
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

if (!function_exists('bs4pagination')) {
	function bs4pagination($url = null, $total = 0, $limit = 0, $params = []) {
		$ci = &get_instance();
		$ci->load->library('pagination');

		$base_url	= base_url($url);
		$suffix		= [];

		if (is_array($params)) {
			if (count($params) > 0) {
				foreach ($params as $key => $val) {
					if (!empty($val) && $key != 'page') {
						$suffix[] = $key . '=' . $val;
					}
				}
			}
		}

		if (count($suffix) > 0) {
			$base_url .= '?' . implode(addslashes('&'), $suffix);
		}

		$config = [
			'full_tag_open'			=> '<ul class="pagination pagination-ci3-bs4">',
			'full_tag_close'		=> '</ul>',
			'num_tag_open'			=> '<li class="page-item">',
			'num_tag_close'			=> '</li>',
			'cur_tag_open'			=> '<li class="page-item active"><span>',
			'cur_tag_close'			=> '</span></li>',
			'next_tag_open'			=> '<li class="page-item">',
			'next_tagl_close'		=> '</li>',
			'prev_tag_open'			=> '<li class="page-item">',
			'prev_tagl_close'		=> '</li>',
			'first_tag_open'		=> '<li><li class="page-item">',
			'first_tagl_close'		=> '</li>',
			'last_tag_open'			=> '<li class="page-item">',
			'last_tagl_close'		=> '</li>',
			'prev_link'				=> 'Prev',
			'next_link'				=> 'Next',
			'first_link'			=> 'First',
			'last_link'				=> 'Last',

			'base_url'				=> $base_url,
			'total_rows'			=> $total,
			'per_page'				=> !empty($limit) ? $limit : 20,
			'page_query_string'		=> true,
			'use_page_numbers'		=> true,
			'query_string_segment'	=> 'page'
		];

		$ci->pagination->initialize($config);

		return $ci->pagination->create_links();
	}
}

if (!function_exists('slugify')) {
	function slugify($str = false, $table = null, $except = []) {
		$ci = &get_instance();
		$i = 0;
		$conditions = [];

		if ($str) {
			$slug = url_title($str);
			$slug = strtolower($slug);

			if ($table) {
				$conditions['slug'] = $slug;

				if (!empty($except) && is_array($except)) {
					foreach ($except as $key => $val) {
						$conditions[$key . ' !='] = $val;
					}
				}

				$query = $ci->db->where($conditions)->get($table);

				while ($query->num_rows()) {
					if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
						$slug .= '-' . ++$i;
					} else {
						$slug = preg_replace('/[0-9]+$/', ++$i, $slug);
					}

					$conditions['slug'] = $slug;
				}
			}

			return $slug;
		}

		return false;
	}
}
